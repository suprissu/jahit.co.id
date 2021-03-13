<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Constant\MaterialRequestStatusConstant;
use App\Constant\RoleConstant;
use App\Constant\TransactionConstant;
use App\Constant\WarningStatusConstant;

use App\Models\InvoiceFile;
use App\Models\Material;
use App\Models\MaterialRequest;
use App\Models\MouFile;
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
     * Show the transaction detail.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $transactionId)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home.transaction.detail', ['transactionId' => $transactionId]));
        if ($expectedStage == route('home.transaction.detail', ['transactionId' => $transactionId])) {

            $user = auth()->user();
            $role = $user->roles()->first()->name;
            
            switch ($role) {
                case RoleConstant::ADMINISTRATOR:
                    $transaction = Transaction::find($transactionId);
                    break;
                case RoleConstant::CUSTOMER:
                    $customer = $user->customer;
                    $transaction = $customer->projects->find($transactionId);
                    break;
                case RoleConstant::PARTNER:
                    $partner = $user->partner;
                    $transaction = $partner->projects->find($transactionId);
                    break;
                default:
                    return redirect()->route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
            }
            if ($transaction == null) {
                return redirect()->route('warning', ['type' => WarningStatusConstant::NOT_FOUND]);
            }
            return view('pages.projectDetail', get_defined_vars());
        }
        return redirect($expectedStage);
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
                            ->with('project', 'mou', 'invoice')
                            ->where('status', TransactionConstant::PAY_WAIT)
                            ->orWhere('status', TransactionConstant::PAY_IN_VERIF)
                            ->orWhere('status', TransactionConstant::PAY_FAIL)
                            ->orderBy('updated_at', 'desc')
                            ->get();
        $sample_transactions = $customer->transactions()
                            ->with('project', 'mou', 'invoice')
                            ->where('type', TransactionConstant::SAMPLE_TYPE)
                            ->where('status', TransactionConstant::PAY_OK)
                            ->orderBy('updated_at', 'desc')
                            ->get();
        $dp_transactions = $customer->transactions()
                            ->with('project', 'mou', 'invoice')
                            ->where('type', TransactionConstant::DOWN_PAYMENT_TYPE)
                            ->where('status', TransactionConstant::PAY_OK)
                            ->orderBy('updated_at', 'desc')
                            ->get();
        $full_transactions = $customer->transactions()
                            ->with('project', 'mou', 'invoice')
                            ->where('type', TransactionConstant::PELUNASAN_TYPE)
                            ->where('status', TransactionConstant::PAY_OK)
                            ->orderBy('updated_at', 'desc')
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
        $partner = $user->partner()->with('projects')->first();

        $materials = Material::all();

        $requestsAll = $partner->projects()
                            ->whereHas('materialRequests')
                            ->with('materialRequests')
                            ->orderBy('updated_at', 'desc')
                            ->get();

        $requestsRequested = $partner->projects()
                            ->whereHas('materialRequests', function($query) {
                                $query->where('status', MaterialRequestStatusConstant::MATERIAL_REQUESTED);
                            })
                            ->with('materialRequests')
                            ->orderBy('updated_at', 'desc')
                            ->get();

        $requestsApproved = $partner->projects()
                            ->whereHas('materialRequests', function($query) {
                                $query->where('status', MaterialRequestStatusConstant::MATERIAL_APPROVED);
                            })
                            ->with('materialRequests')
                            ->orderBy('updated_at', 'desc')
                            ->get();
        
        $requestsSent = $partner->projects()
                            ->whereHas('materialRequests', function($query) {
                                $query->where('status', MaterialRequestStatusConstant::MATERIAL_SENT);
                            })
                            ->with('materialRequests')
                            ->orderBy('updated_at', 'desc')
                            ->get();

        $requestsRejected = $partner->projects()
                            ->whereHas('materialRequests', function($query) {
                                $query->where('status', MaterialRequestStatusConstant::MATERIAL_REJECTED);
                            })
                            ->with('materialRequests')
                            ->orderBy('updated_at', 'desc')
                            ->get();
                            
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
                                    ->with('mou', 'invoice', 'project', 'paymentSlip')
                                    ->orderBy('updated_at', 'desc')
                                    ->get();
        
        $transactionsVerified = Transaction::where('status', TransactionConstant::PAY_OK)
                                    ->with('mou', 'invoice', 'project', 'paymentSlip')
                                    ->orderBy('updated_at', 'desc')
                                    ->get();
     
        $transactionsFailed = Transaction::where('status', TransactionConstant::PAY_FAIL)
                                    ->with('mou', 'invoice', 'project', 'paymentSlip')
                                    ->orderBy('updated_at', 'desc')
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

    public function requestMaterialPage(Request $request)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home.transaction.material.request.page'));
        if ($expectedStage == route('home.transaction.material.request.page')) {
            
            $user = auth()->user();
            $role = $user->roles()->first()->name;

            if ($role == RoleConstant::PARTNER) {
                $partner = $user->partner()->first();
                
                $projects = $partner->projects;
                $materials = Material::all();

                return view('pages.partner.material', get_defined_vars());
            } else {
                return redirect()->route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
            }
        }
        return redirect($expectedStage);    
    }

    public function requestMaterial(Request $request)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home.transaction'));
        if ($expectedStage == route('home.transaction')) {
            
            $user = auth()->user();
            $role = $user->roles()->first()->name;

            if ($role == RoleConstant::PARTNER) {
                $partner = $user->partner()->first();

                $this->validate($request, [
                    'projectID' => [
                        'required',
                        'integer',
                        'min:1'
                    ],
                    'materialID' => [
                        'required',
                        'integer',
                        'min:1'
                    ],
                    'quantity' => [
                        'required',
                        'integer',
                        'min:1'
                    ],
                ]);

                $materialRequest = new MaterialRequest;
                $materialRequest->partner_id = $partner->id;
                $materialRequest->project_id = $request->projectID;
                $materialRequest->material_id = $request->materialID;
                $materialRequest->additional_info = $request->additionalInfo;
                $materialRequest->status = MaterialRequestStatusConstant::MATERIAL_REQUESTED;
                $materialRequest->quantity = $request->quantity;
                $materialRequest->note = $request->note;
                $materialRequest->save();
            } else {
                return redirect()->route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
            }
        }
        return redirect($expectedStage);
    }

    public function downloadMou(Request $request, $mouId)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home.transaction'));
        if ($expectedStage == route('home.transaction')) {
            
            $user = auth()->user();
            $role = $user->roles()->first()->name;
            switch ($role) {
                case RoleConstant::ADMINISTRATOR:
                    $mou = MouFile::find($mouId);
                    break;
                case RoleConstant::CUSTOMER:
                    $customer = $user->customer;
                    $mou = MouFile::find($mouId);
                    if ($mou == null) {
                        return redirect()->route('warning', ['type' => WarningStatusConstant::NOT_FOUND]);
                    }
                    if ($customer->id != $mou->transaction->customer->id) {
                        return redirect()->route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
                    }
                    break;
                case RoleConstant::PARTNER:
                    $partner = $user->partner;
                    $mou = MouFile::find($mouId);
                    if ($mou == null) {
                        return redirect()->route('warning', ['type' => WarningStatusConstant::NOT_FOUND]);
                    }
                    if ($partner->id != $mou->transaction->partner->id) {
                        return redirect()->route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
                    }
                    break;
                default:
                    return redirect()->route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
            }
            $file = public_path() . $mou->path;

            $headers = array(
                'Content-Type: application/pdf',
            );

            $filename = "MOU " . $mou->transaction->project->name . ".pdf"; 
        
            return response()->download($file, $filename, $headers);
        }
        return redirect($expectedStage);
    }

    public function downloadInvoice(Request $request, $invoiceId)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home.transaction'));
        if ($expectedStage == route('home.transaction')) {
            
            $user = auth()->user();
            $role = $user->roles()->first()->name;
            switch ($role) {
                case RoleConstant::ADMINISTRATOR:
                    $invoice = InvoiceFile::find($invoiceId);
                    break;
                case RoleConstant::CUSTOMER:
                    $customer = $user->customer;
                    $invoice = InvoiceFile::find($invoiceId);
                    if ($invoice == null) {
                        return redirect()->route('warning', ['type' => WarningStatusConstant::NOT_FOUND]);
                    }
                    if ($customer->id != $invoice->transaction->customer->id) {
                        return redirect()->route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
                    }
                    break;
                case RoleConstant::PARTNER:
                    $partner = $user->partner;
                    $invoice = InvoiceFile::find($invoiceId);
                    if ($invoice == null) {
                        return redirect()->route('warning', ['type' => WarningStatusConstant::NOT_FOUND]);
                    }
                    if ($partner->id != $invoice->transaction->partner->id) {
                        return redirect()->route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
                    }
                    break;
                default:
                    return redirect()->route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
            }
            $file = public_path() . $invoice->path;

            $headers = array(
                'Content-Type: application/pdf',
            );

            $filename = "Invoice " . $invoice->transaction->project->name . ".pdf"; 
        
            return response()->download($file, $filename, $headers);
        }
        return redirect($expectedStage);
    }
}