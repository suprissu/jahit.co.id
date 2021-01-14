<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Constant\RoleConstant;
use App\Constant\TransactionConstant;
use App\Constant\WarningStatusConstant;

use App\Models\PaymentSlip;
use App\Models\Transaction;

use App\Helper\FileHelper;
use App\Helper\RedirectionHelper;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the user's transaction.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userTransaction(Request $request)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home.transaction'));
        if ($expectedStage == route('home.transaction')) {
            $user = auth()->user();
            $role = $user->roles()->first()->name;
            switch ($role) {
                case RoleConstant::ADMINISTRATOR:
                    return $this->administratorTransaction($request, $user, $role);
                    break;
                case RoleConstant::CUSTOMER:
                    return $this->customerTransaction($request, $user, $role);
                    break;
                case RoleConstant::PARTNER:
                    return $this->partnerTransaction($request, $user, $role);
                    break;
                default:
                    return redirect()->route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
            }
        }
        return redirect($expectedStage);
    }

    /**
     * Show the customer's transaction.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function customerTransaction(Request $request, $user, $role)
    {
        $customer = $user->customer()->first();
        $transactions = $customer->transactions()
                            ->where('status', TransactionConstant::PAY_WAIT)
                            ->orWhere('status', TransactionConstant::PAY_IN_VERIF)
                            ->orWhere('status', TransactionConstant::PAY_FAIL)
                            ->orderBy('created_at', 'desc')
                            ->get();
        $sample_transactions = $customer->transactions()
                            ->where('type', TransactionConstant::SAMPLE_TYPE)
                            ->where('status', TransactionConstant::PAY_OK)
                            ->orderBy('created_at', 'desc')
                            ->get();
        $dp_transactions = $customer->transactions()
                            ->where('type', TransactionConstant::DOWN_PAYMENT_TYPE)
                            ->where('status', TransactionConstant::PAY_OK)
                            ->orderBy('created_at', 'desc')
                            ->get();
        $full_transactions = $customer->transactions()
                            ->where('type', TransactionConstant::PELUNASAN_TYPE)
                            ->where('status', TransactionConstant::PAY_OK)
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('pages.customer.transaction', get_defined_vars());
    }

    /**
     * Show the partner's transaction.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function partnerTransaction(Request $request, $user, $role)
    {
        $partner = $user->partner()->first();
        $transactions = $partner->transactions()->orderBy('created_at', 'desc')->get();

        return view('pages.partner.transaction', get_defined_vars());
    }

    /**
     * Show the admin's transaction.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function administratorTransaction(Request $request)
    {
        $transactionsCheck = Transaction::where('status', TransactionConstant::PAY_IN_VERIF)
                                    ->orderBy('created_at', 'desc')
                                    ->get();
        
        $transactionsVerified = Transaction::where('status', TransactionConstant::PAY_OK)
                                    ->orderBy('created_at', 'desc')
                                    ->get();
     
        $transactionsFailed = Transaction::where('status', TransactionConstant::PAY_FAIL)
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        return view('pages.administrator.transaction', get_defined_vars());
    }

    public function uploadPaymentSlip(Request $request)
    {
        $this->validate($request, [
            'transactionID' => [
                'required',
                'integer',
                'min:1'
            ],
            'deadline' => [
                'required',
                'date'
            ],
            'payment_slip_path' => [
                'mimes:jpeg,jpg,png,gif,bmp,svg',
                'required',
                'max:25000'
            ],
        ]);

        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home.transaction'));
        if ($expectedStage == route('home.transaction')) {
            
            $user = auth()->user();
            $role = $user->roles()->first()->name;
            if ($role == RoleConstant::CUSTOMER) {
                // TO DO: check deadline > now
                $transaction = Transaction::find($request->transactionID);
                $transaction->status = TransactionConstant::PAY_IN_VERIF;
                $transaction->save();

                $file_path_prefix = '/img/customer/transaction/';
                
                $paymentSlip = new PaymentSlip;
                $paymentSlip->path = FileHelper::saveResizedImageToPublic($request->file('payment_slip_path'), $file_path_prefix . 'paymentslip');;
                $paymentSlip->transaction_id = $request->transactionID;
                $paymentSlip->save();
            } else {
                return redirect()->route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
            }
        }
        return redirect($expectedStage);
    }
}