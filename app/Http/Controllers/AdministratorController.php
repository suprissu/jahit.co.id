<?php

namespace App\Http\Controllers;

use App\Constant\ChatTemplateConstant;
use App\Constant\ProjectStatusConstant;
use App\Constant\RoleConstant;
use App\Constant\SampleStatusConstant;
use App\Constant\TransactionConstant;
use App\Constant\WarningStatusConstant;

use App\Helper\RedirectionHelper;

use App\Models\Chat;
use App\Models\Customer;
use App\Models\Inbox;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Transaction;

use Illuminate\Http\Request;

class AdministratorController extends Controller
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
     * Show the admin's dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function verification(Request $request)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home.transaction'));
        if ($expectedStage == route('home.transaction')) {
            if ($role == RoleConstant::ADMINISTRATOR) {

                $paymentSlips = PaymentSlip::orderBy('created_at', 'desc')->get();
                return view('pages.administrator.paymentVerification', get_defined_vars());

            } else {
                return redirect()->route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
            }
        }
        return redirect($expectedStage);
    }
    
    public function paymentVerification(Request $request)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home.transaction'));
        if ($expectedStage == route('home.transaction')) {
            $this->validate($request, [
                'transactionID' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'status' => [
                    'required',
                    'string'
                ],
            ]);

            $user = auth()->user();
            $role = $user->roles()->first()->name;
            if ($role == RoleConstant::ADMINISTRATOR) {
                
                $transaction = Transaction::find($request->transactionID);

                switch ($request->status) {
                    case "WAITING":
                        $transaction->status = TransactionConstant::PAY_IN_VERIF;
                        if ($transaction->type == TransactionConstant::SAMPLE_TYPE) {
                            $sample = $transaction->sample;
                            $sample->status = SampleStatusConstant::SAMPLE_WAIT_PAYMENT;
                            $sample->save();
                        } else if ($transaction->type == TransactionConstant::DOWN_PAYMENT_TYPE) {
                            $project = $transaction->project;
                            $project->status = ProjectStatusConstant::PROJECT_DEALT;
                            $project->save();
                        } else if ($transaction->type == TransactionConstant::PELUNASAN_TYPE) {
                            $project = $transaction->project;
                            $project->status = ProjectStatusConstant::PROJECT_FINISHED;
                            $project->save();
                        }
                        break;

                    case "ACCEPT":
                        $transaction->status = TransactionConstant::PAY_OK;
                        if ($transaction->type == TransactionConstant::SAMPLE_TYPE) {
                            $sample = $transaction->sample;
                            $sample->status = SampleStatusConstant::SAMPLE_PAYMENT_OK;
                            $sample->save();
                        } else if ($transaction->type == TransactionConstant::DOWN_PAYMENT_TYPE) {
                            $project = $transaction->project;
                            $project->status = ProjectStatusConstant::PROJECT_DP_OK;
                            $project->save();
                        } else if ($transaction->type == TransactionConstant::PELUNASAN_TYPE) {
                            $project = $transaction->project;
                            $project->status = ProjectStatusConstant::PROJECT_FULL_PAYMENT_OK;
                            $project->save();
                        }
                        $inbox = Inbox::where("customer_id", $transaction->customer_id)
                                    ->where("partner_id", $transaction->partner_id)
                                    ->first();

                        $chatVerification = new Chat;
                        $chatVerification->role = ChatTemplateConstant::ADMIN_ROLE;
                        $chatVerification->type = ChatTemplateConstant::VERIFICATION_TYPE;
                        $chatVerification->inbox_id = $inbox->id;
                        $chatVerification->save();
                        break;

                    case "REJECT":
                        $transaction->status = TransactionConstant::PAY_FAIL;
                        if ($transaction->type == TransactionConstant::SAMPLE_TYPE) {
                            $sample = $transaction->sample;
                            $sample->status = SampleStatusConstant::SAMPLE_WAIT_PAYMENT;
                            $sample->save();
                        } else if ($transaction->type == TransactionConstant::DOWN_PAYMENT_TYPE) {
                            $project = $transaction->project;
                            $project->status = ProjectStatusConstant::PROJECT_DEALT;
                            $project->save();
                        } else if ($transaction->type == TransactionConstant::PELUNASAN_TYPE) {
                            $project = $transaction->project;
                            $project->status = ProjectStatusConstant::PROJECT_FULL_PAYMENT_FAIL;
                            $project->save();
                        }
                        $inbox = Inbox::where("customer_id", $transaction->customer_id)
                                    ->where("partner_id", $transaction->partner_id)
                                    ->first();

                        $chatVerification = new Chat;
                        $chatVerification->role = ChatTemplateConstant::ADMIN_ROLE;
                        $chatVerification->type = ChatTemplateConstant::VERIFICATION_REJECTED_TYPE;
                        $chatVerification->inbox_id = $inbox->id;
                        $chatVerification->save();
                        break;

                    default:
                        return redirect()->route('warning', ['type' => WarningStatusConstant::NOT_FOUND]);
                }
                $transaction->save();
            } else {
                return redirect()->route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
            }
        }
        return redirect($expectedStage);
    }
}