<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\AdminChat;
use App\Models\AdminInbox;
use App\Models\Chat;
use App\Models\Inbox;
use App\Models\Negotiation;
use App\Models\Project;
use App\Models\Review;
use App\Models\Sample;
use App\Models\Transaction;

use App\Constant\ChatTemplateConstant;
use App\Constant\ProjectStatusConstant;
use App\Constant\RoleConstant;
use App\Constant\WarningStatusConstant;
use App\Constant\SampleStatusConstant;
use App\Constant\TransactionConstant;

use App\Helper\RedirectionHelper;

use Illuminate\Http\Request;

class InboxController extends Controller
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
     * Show the user's inbox.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userInbox(Request $request)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home.inbox'));
        if ($expectedStage == route('home.inbox')) {
            $user = auth()->user();
            $role = $user->roles()->first()->name;
            switch ($role) {
                case RoleConstant::ADMINISTRATOR:
                    // return redirect()->route('warning', ['type' => WarningStatusConstant::WORK_IN_PROGRESS]);
                    return $this->administratorDashboard($request, $user, $role);
                    break;
                case RoleConstant::CUSTOMER:
                    // TO DO: for next phase, uncomment this code
                    return $this->customerInbox($request, $user, $role);
                    // return redirect()->route('warning', ['type' => WarningStatusConstant::WAITING_VALIDATION]); 
                    break;
                case RoleConstant::PARTNER:
                    // TO DO: for next phase, uncomment this code
                    return $this->partnerInbox($request, $user, $role);
                    // return redirect()->route('warning', ['type' => WarningStatusConstant::WAITING_VALIDATION]); 
                    break;
                default:
                    return redirect()->route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
            }
        }
        return redirect($expectedStage);
    }

    /**
     * Show the administrator's inbox.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function administratorDashboard(Request $request, $user, $role)
    {
        $inboxes = AdminInbox::orderBy('updated_at', 'desc')->with('adminChats', 'receiver')->get();
        $role = "ADMIN";
        
        return view('pages.administrator.inbox', get_defined_vars());
    }

    /**
     * Show the customer's inbox.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function customerInbox(Request $request, $user, $role)
    {
        $customer = $user->customer()->first();
        $inboxes = $customer->inboxes()
                    ->with('project', 'project.images', 'project.category','chats', 'chats.negotiation', 'partner')
                    ->orderBy('updated_at', 'desc')
                    ->get();
        $role = "CLIENT";

        $adminInbox = $user->adminInboxes()->with('adminChats')->orderBy('updated_at', 'desc')->get();

        return view('pages.customer.inbox', get_defined_vars());
    }

    /**
     * Show the partner's inbox.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function partnerInbox(Request $request, $user, $role)
    {
        $partner = $user->partner()->first();
        $inboxes = $partner->inboxes()->orderBy('updated_at', 'desc')->get();
        $offers = Chat::whereHas('inbox', function($query) use($partner) {
                            $query->where('partner_id', $partner->id);
                        })
                        ->where('type', ChatTemplateConstant::INITIATION_TYPE)
                        ->with('inbox')
                        ->orderBy('updated_at')
                        ->get();
                        
        if ($offers->count() == 0) {
            $offerLastDate = "";
        } else {
            $offerLastDate = $offers->last()->created_at->format('j F Y');
        }
        $role = "VENDOR";

        $adminInbox = $user->adminInboxes;

        return view('pages.partner.inbox', get_defined_vars());
    }

    public function offerNego(Request $request)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home.inbox'));
        if ($expectedStage == route('home.inbox')) {
            $this->validate($request, [
                'projectID' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'customerID' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'partnerID' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'inboxID' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'chatID' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'cost' => [
                    'required',
                    'numeric',
                    'min:1'
                ],
                'startDate' => [
                    'required',
                    'date'
                ],
                'deadline' => [
                    'required',
                    'date',
                    'after_or_equal:start_date'
                ],
            ]);

            $user = auth()->user();
            $role = $user->roles()->first()->name;
            if ($role == RoleConstant::CUSTOMER) {
                $customer = $user->customer;
                
                $negotiation = new Negotiation;
                $negotiation->partner_id = $request->partnerID;
                $negotiation->customer_id = $customer->id;

                $chatNego = new Chat;
                $chatNego->role = ChatTemplateConstant::CUSTOMER_ROLE;

                $chatOffer = new Chat;
                $chatOffer->role = ChatTemplateConstant::CUSTOMER_ROLE;

            } else if ($role == RoleConstant::PARTNER) {
                $partner = $user->partner;
                
                $negotiation = new Negotiation;
                $negotiation->partner_id = $partner->id;
                $negotiation->customer_id = $request->customerID;
          
                $chatNego = new Chat;
                $chatNego->role = ChatTemplateConstant::PARTNER_ROLE;

                $chatOffer = new Chat;
                $chatOffer->role = ChatTemplateConstant::PARTNER_ROLE;

            } else {
                return redirect()->route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
            }

            $negotiation->project_id = $request->projectID;
            $negotiation->cost = $request->cost;
            $negotiation->start_date = $request->startDate;
            $negotiation->deadline = $request->deadline;

            $negotiation->save();

            $inbox = Inbox::find($request->inboxID);

            $chatPrevious = Chat::find($request->chatID);
            $chatPrevious->answer = ChatTemplateConstant::ACCEPT_ANSWER;
            $chatPrevious->save();

            $chatNego->type = ChatTemplateConstant::NEGOTIATION_TYPE;
            $chatNego->answer = ChatTemplateConstant::BLANK_ANSWER;
            $chatNego->inbox_id = $request->inboxID;
            $chatNego->negotiation()->associate($negotiation);
            $chatNego->save();
        
            $chatOffer->type = ChatTemplateConstant::PROJECT_OFFER_TYPE;
            $chatOffer->inbox_id = $request->inboxID;
            $chatOffer->negotiation()->associate($negotiation);
            $chatOffer->save();
        }
        return redirect($expectedStage);
    }

    public function rejectNego(Request $request)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home.inbox'));
        if ($expectedStage == route('home.inbox')) {
            $this->validate($request, [
                'chatID' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'excuse' => [
                    'required',
                    'string'
                ],
            ]);
            $user = auth()->user();
            $role = $user->roles()->first()->name;
            if ($role != RoleConstant::CUSTOMER && $role != RoleConstant::PARTNER) {
                return redirect()->route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
            }
            
            $chatPrevious = Chat::find($request->chatID);
            $chatPrevious->answer = ChatTemplateConstant::REJECT_ANSWER;
            $chatPrevious->excuse = $request->excuse;
            $chatPrevious->save();
        }
        return redirect($expectedStage);
    }

    public function acceptNego(Request $request)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home.inbox'));
        if ($expectedStage == route('home.inbox')) {
            $this->validate($request, [
                'inboxID' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'chatID' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'negotiationID' => [
                    'required',
                    'integer',
                    'min:1'
                ],
            ]);
            $user = auth()->user();
            $role = $user->roles()->first()->name;
            if ($role != RoleConstant::CUSTOMER && $role != RoleConstant::PARTNER) {
                return redirect()->route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
            }

            $negotiation = Negotiation::find($request->negotiationID);
            $negotiation->deal = true;
            $negotiation->save();

            $chatPrevious = Chat::find($request->chatID);
            $chatPrevious->answer = ChatTemplateConstant::ACCEPT_ANSWER;
            $chatPrevious->save();

            $chatNego = new Chat;
            $chatNego->role = ChatTemplateConstant::CUSTOMER_ROLE;
            $chatNego->type = ChatTemplateConstant::PROJECT_ACCEPT_TYPE;
            $chatNego->inbox_id = $request->inboxID;
            $chatNego->negotiation()->associate($negotiation);
            $chatNego->save();
        }
        return redirect($expectedStage);
    }

    public function requestSample(Request $request)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home.inbox'));
        if ($expectedStage == route('home.inbox')) {
            $this->validate($request, [
                'projectID' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'partnerID' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'inboxID' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'chatID' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'negotiationID' => [
                    'required',
                    'integer',
                    'min:1'
                ],
            ]);

            $user = auth()->user();
            $role = $user->roles()->first()->name;
            if ($role == RoleConstant::CUSTOMER) {
                $customer = $user->customer;
                
                $transaction = new Transaction;
                $transaction->partner_id = $request->partnerID;
                $transaction->customer_id = $customer->id;

                $chatSampleRequest = new Chat;
                $chatSampleRequest->role = ChatTemplateConstant::CUSTOMER_ROLE;
            } else {
                return redirect()->route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
            }

            $negotiation = Negotiation::find($request->negotiationID);

            // TO DO: Delivery cost
            $deliveryCost = 0;
            $sampleCount = 1;
            $transactionCost = $negotiation->cost * $sampleCount + $deliveryCost;

            $transaction->project_id = $request->projectID;
            $transaction->cost = $transactionCost;
            $transaction->status = TransactionConstant::PAY_WAIT;
            $transaction->type = TransactionConstant::SAMPLE_TYPE;
            $transaction->deadline = Carbon::now()->addDays(1);
            $transaction->save();

            $sample = new Sample;
            $sample->status = SampleStatusConstant::SAMPLE_WAIT_PAYMENT;
            $sample->negotiation_id = $request->negotiationID;
            $sample->transaction()->associate($transaction);
            $sample->save();

            $chatPrevious = Chat::find($request->chatID);
            $chatPrevious->answer = ChatTemplateConstant::SAMPLE_ANSWER;
            $chatPrevious->save();

            $chatSampleRequest->type = ChatTemplateConstant::SAMPLE_REQUEST_TYPE;
            $chatSampleRequest->inbox_id = $request->inboxID;
            $chatSampleRequest->negotiation()->associate($negotiation);
            $chatSampleRequest->save();
        }
        return redirect($expectedStage);
    }

    public function dealSample(Request $request)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home.inbox'));
        if ($expectedStage == route('home.inbox')) {
            $this->validate($request, [
                'projectID' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'partnerID' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'inboxID' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'chatID' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'negotiationID' => [
                    'required',
                    'integer',
                    'min:1'
                ],
            ]);

            $user = auth()->user();
            $role = $user->roles()->first()->name;
            if ($role == RoleConstant::CUSTOMER) {
                $customer = $user->customer;
                
                $transaction = new Transaction;
                $transaction->partner_id = $request->partnerID;
                $transaction->customer_id = $customer->id;

                $chatSampleRequest = new Chat;
                $chatSampleRequest->role = ChatTemplateConstant::CUSTOMER_ROLE;
            } else {
                return redirect()->route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
            }

            $negotiation = Negotiation::find($request->negotiationID);
            
            $project = $customer->projects->find($request->projectID);
            $project->partner_id = $request->partnerID;
            $project->status = ProjectStatusConstant::PROJECT_DEALT;
            $project->cost = $negotiation->cost * $project->count;
            $project->start_date = Carbon::now();
            $project->deadline = $negotiation->deadline;
            $project->save();

            // TO DO: Delivery cost
            $deliveryCost = 0;
            $dpPercentage = 0.5;
            $transactionCost = $dpPercentage * $negotiation->cost * $project->count + $deliveryCost;

            $transaction->project_id = $request->projectID;
            $transaction->cost = $transactionCost;
            $transaction->status = TransactionConstant::PAY_WAIT;
            $transaction->type = TransactionConstant::DOWN_PAYMENT_TYPE;
            $transaction->deadline = Carbon::now()->addDays(1);
            $transaction->save();

            $sample = $negotiation->sample;
            if ($sample != null) {
                $sample->status = SampleStatusConstant::SAMPLE_APPROVED;
                $sample->save();
            }

            $chatPrevious = Chat::find($request->chatID);
            $chatPrevious->answer = ChatTemplateConstant::DEAL_ANSWER;
            $chatPrevious->save();

            $chatSampleDeal = new Chat;
            $chatSampleDeal->role = ChatTemplateConstant::CUSTOMER_ROLE;
            $chatSampleDeal->type = ChatTemplateConstant::PROJECT_DEAL_TYPE;
            $chatSampleDeal->inbox_id = $request->inboxID;
            $chatSampleDeal->negotiation()->associate($negotiation);
            $chatSampleDeal->save();

            $otherInboxes = Inbox::where('project_id', $request->projectID)
                        ->where('customer_id', $customer->id)
                        ->where('partner_id', '!=', $request->partnerID)
                        ->delete();
        }
        return redirect($expectedStage);
    }

    public function chatAdmin(Request $request, $inboxId)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home.inbox'));
        if ($expectedStage == route('home.inbox')) {
            $this->validate($request, [
                'message' => [
                    'required',
                    'string'
                ],
            ]);

            $user = auth()->user();
            $role = $user->roles()->first()->name;
            if ($role == RoleConstant::ADMINISTRATOR) {

                $inbox = AdminInbox::find($inboxId);

                $chat = new AdminChat;
                $chat->admin_user_id = $user->id;
                $chat->admin_inbox_id = $inbox->id;
                $chat->role = $role;
                $chat->message = $request->message;
                $chat->save();
                    
            } else {
                return redirect()->route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
            }
        }
        return redirect($expectedStage);
    }

    public function replyAdmin(Request $request, $inboxId)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home.inbox'));
        if ($expectedStage == route('home.inbox')) {
            $this->validate($request, [
                'message' => [
                    'required',
                    'string'
                ],
            ]);

            $user = auth()->user();
            $role = $user->roles()->first()->name;
            if ($role != RoleConstant::ADMINISTRATOR) {

                $inbox = $user->adminInboxes;

                if ($inbox == null) {
                    $inbox = new AdminInbox;
                    $inbox->receiver_user_id = $user->id;
                    $inbox->save();
                } else {
                    $inbox = $inbox->find($inboxId);
                }

                $chat = new AdminChat;
                $chat->admin_user_id = $user->id;
                $chat->admin_inbox_id = $inbox->id;
                $chat->role = $role;
                $chat->message = $request->message;
                $chat->save();
                    
            } else {
                return redirect()->route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
            }
        }
        return redirect($expectedStage);
    }

    public function reviewProject(Request $request)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home.inbox'));
        if ($expectedStage == route('home.inbox')) {
            $this->validate($request, [
                'projectID' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'inboxID' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'chatID' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'feedback' => [
                    'required'
                ],
                'star' => [
                    'required',
                    'integer',
                    'min:1',
                    'max:5'
                ]
            ]);
            
            $user = auth()->user();
            $role = $user->roles()->first()->name;
            if ($role == RoleConstant::CUSTOMER) {
                $customer = $user->customer;
                
                $project = $customer->projects->find($request->projectID);

                $chatPrevious = Chat::find($request->chatID);
                $chatPrevious->answer = $request->star;
                $chatPrevious->save();

                $review = new Review;
                $review->project_id = $project->id;
                $review->stars = $request->star;
                $review->feedback = $request->feedback;
                $review->save();

                $partner = $project->partner;
                $partner->review_number = $partner->review_number + 1;
                $partner->rating = $partner->rating + $request->star;
                $partner->save();

            } else {
                return redirect()->route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
            }
        }
        return redirect($expectedStage);
    }
}