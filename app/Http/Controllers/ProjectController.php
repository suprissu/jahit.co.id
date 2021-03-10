<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Constant\ChatTemplateConstant;
use App\Constant\RoleConstant;
use App\Constant\ProjectStatusConstant;
use App\Constant\WarningStatusConstant;
use App\Constant\SampleStatusConstant;
use App\Constant\TransactionConstant;

use App\Helper\FileHelper;
use App\Helper\RedirectionHelper;

use App\Models\Chat;
use App\Models\Customer;
use App\Models\Inbox;
use App\Models\Negotiation;
use App\Models\Partner;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectImage;
use App\Models\Sample;
use App\Models\ShipmentReceipt;
use App\Models\Transaction;

use Illuminate\Http\Request;

class ProjectController extends Controller
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
     * Show the project detail.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $projectId)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home.project.detail', ['projectId' => $projectId]));
        if ($expectedStage == route('home.project.detail', ['projectId' => $projectId])) {

            $user = auth()->user();
            $role = $user->roles()->first()->name;
            
            if ($role == RoleConstant::CUSTOMER) {
                $customer = $user->customer;
                $project = $customer->projects->find($projectId);
            } else if ($role == RoleConstant::ADMINISTRATOR || $role == RoleConstant::PARTNER) {
                $project = Project::find($projectId);
            } else {
                return redirect()->route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
            }
            if ($project == null) {
                return redirect()->route('warning', ['type' => WarningStatusConstant::NOT_FOUND]);
            }
            return view('pages.projectDetail', get_defined_vars());
        }
        return redirect($expectedStage);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home'));
        if ($expectedStage == route('home')) {
            $this->validate($request, [
                'name' => [
                    'required',
                    'string',
                    'max:255'
                ],
                'category' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'count' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'address' => [
                    'required',
                    'string',
                    'max:255'
                ],
                'project_pict_path.*' => [
                    'mimes:jpeg,jpg,png,gif,bmp,svg',
                    'max:25000'
                ],
            ]);

            $user = auth()->user();

            $project = new Project;
            $project->name = $request->name;
            $project->address = $request->address;
            $project->count = $request->count;
            $project->status = ProjectStatusConstant::PROJECT_OPENED;
            $project->category_id = $request->category;
            if ($request->note != null) {
                $project->note = $request->note;
            } else {
                $project->note = "";
            }

            $customer = $user->customer;
            $customer->projects()->save($project);

            $file_path_prefix = '/img/customer/project/';
                
            $files = $request->file('project_pict_path');
            if ($files != null) {
                foreach($files as $imageFile){
                    $projectImage = new ProjectImage;
                    $projectImage->path = FileHelper::saveResizedImageToPublic($imageFile, $file_path_prefix . 'design');;
                    $projectImage->project()->associate($project);
                    $projectImage->save();
                }
            }

            $partners = Partner::all();
            foreach($partners as $partner){
                $inbox = new Inbox;
                $inbox->partner_id = $partner->id;
                $inbox->customer_id = $customer->id;
                $inbox->project()->associate($project);
                $inbox->save();

                $chatInit = new Chat;
                $chatInit->role = ChatTemplateConstant::CUSTOMER_ROLE;
                $chatInit->type = ChatTemplateConstant::INITIATION_TYPE;
                $chatInit->inbox()->associate($inbox);
                $chatInit->save();
            }
        }
        return redirect($expectedStage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home'));
        if ($expectedStage == route('home')) {
            $this->validate($request, [
                'id' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'name' => [
                    'required',
                    'string',
                    'max:255'
                ],
                'category' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'count' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'address' => [
                    'required',
                    'string',
                    'max:255'
                ],
                'deadline' => [
                    'date',
                    'after_or_equal:start_date'
                ],
                'project_pict_path.*' => [
                    'mimes:jpeg,jpg,png,gif,bmp,svg',
                    'max:25000'
                ],
            ]);

            $user = auth()->user();
            $customer = $user->customer;

            $project = $customer->projects->find($request->id);

            if ($project == null) {
                return redirect()->route('warning', ['type' => WarningStatusConstant::NOT_FOUND]); 
            }

            $project->name = $request->name;
            $project->address = $request->address;
            $project->count = $request->count;
            $project->category_id = $request->category;
            if ($request->note != null) {
                $project->note = $request->note;
            } else {
                $project->note = "";
            }
            $project->deadline = $request->deadline;

            $customer->projects()->save($project);

            $file_path_prefix = '/img/customer/project/';
                
            $files = $request->file('project_pict_path');
            if ($files != null) {
                foreach($files as $imageFile){
                    $projectImage = new ProjectImage;
                    $projectImage->path = FileHelper::saveResizedImageToPublic($imageFile, $file_path_prefix . 'design');;
                    $projectImage->project()->associate($project);
                    $projectImage->save();
                }    
            }

            $partners = Partner::all();
            foreach($partners as $partner){
                $inbox = new Inbox;
                $inbox->partner_id = $partner->id;
                $inbox->customer_id = $customer->id;
                $inbox->project()->associate($project);
                $inbox->save();

                $chatInit = new Chat;
                $chatInit->role = ChatTemplateConstant::CUSTOMER_ROLE;
                $chatInit->type = ChatTemplateConstant::INITIATION_TYPE;
                $chatInit->inbox()->associate($inbox);
                $chatInit->save();
            }
        }
        return redirect($expectedStage);
    }

    public function startSample(Request $request, $sampleId)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home'));
        if ($expectedStage == route('home')) {
            $user = auth()->user();
            $partner = $user->partner;

            $sample = Sample::find($sampleId);

            if ($sample == null) {
                return redirect()->route('warning', ['type' => WarningStatusConstant::NOT_FOUND]); 
            }

            $sample->status = SampleStatusConstant::SAMPLE_WORK_IN_PROGRESS;
            $sample->save();
        }
        return redirect($expectedStage);
    }

    public function finishSample(Request $request, $sampleId)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home'));
        if ($expectedStage == route('home')) {
            $user = auth()->user();
            $partner = $user->partner;

            $sample = Sample::find($sampleId);

            if ($sample == null) {
                return redirect()->route('warning', ['type' => WarningStatusConstant::NOT_FOUND]); 
            }

            $sample->status = SampleStatusConstant::SAMPLE_FINISHED;
            $sample->save();
        }
        return redirect($expectedStage);
    }

    public function sendSample(Request $request, $sampleId)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home'));
        if ($expectedStage == route('home')) {
            $this->validate($request, [
                'shipment_receipt_path' => [
                    'mimes:jpeg,jpg,png,gif,bmp,svg',
                    'required',
                    'max:25000'
                ]
            ]);

            $user = auth()->user();
            $partner = $user->partner;

            $sample = Sample::find($sampleId);

            if ($sample == null) {
                return redirect()->route('warning', ['type' => WarningStatusConstant::NOT_FOUND]); 
            }

            $sample->status = SampleStatusConstant::SAMPLE_SENT;
            $sample->save();

            $file_path_prefix = '/img/customer/transaction/';
            $shipment = new ShipmentReceipt;
            $shipment->path = FileHelper::saveResizedImageToPublic($request->file('shipment_receipt_path'), $file_path_prefix . 'shipmentReceipt');
            $shipment->sample_id = $sample->id;
            $shipment->save();
            
            $negotiation = Negotiation::find($sample->negotiation_id);
            $transaction = Transaction::find($sample->transaction_id);
            $inbox = Inbox::where("customer_id", $transaction->customer_id)
                        ->where("partner_id", $transaction->partner_id)
                        ->first();
            
            $chatVerification = new Chat;
            $chatVerification->role = ChatTemplateConstant::PARTNER_ROLE;
            $chatVerification->type = ChatTemplateConstant::SAMPLE_SENT_TYPE;
            $chatVerification->inbox_id = $inbox->id;
            $chatVerification->negotiation()->associate($negotiation);
            $chatVerification->save();   
        }
        return redirect($expectedStage);
    }

    public function startProject(Request $request, $projectId)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home'));
        if ($expectedStage == route('home')) {
            $user = auth()->user();
            $partner = $user->partner;

            $project = Project::find($projectId);

            if ($project == null) {
                return redirect()->route('warning', ['type' => WarningStatusConstant::NOT_FOUND]); 
            }

            $project->status = ProjectStatusConstant::PROJECT_WORK_IN_PROGRESS;
            $project->save();
        }
        return redirect($expectedStage);
    }

    public function finishProject(Request $request, $projectId)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home'));
        if ($expectedStage == route('home')) {
            $user = auth()->user();
            $partner = $user->partner;

            $project = Project::find($projectId);

            if ($project == null) {
                return redirect()->route('warning', ['type' => WarningStatusConstant::NOT_FOUND]); 
            }

            $project->status = ProjectStatusConstant::PROJECT_FINISHED;
            $project->save();

            $inbox = Inbox::where('customer_id', $project->customer_id)
                            ->where('partner_id', $partner->id)
                            ->where('project_id', $project->id)
                            ->first();
            
            $chatProjectDeal = new Chat;
            $chatProjectDeal->role = ChatTemplateConstant::PARTNER_ROLE;
            $chatProjectDeal->type = ChatTemplateConstant::PROJECT_FINISH_TYPE;
            $chatProjectDeal->inbox_id = $inbox->id;
            $chatProjectDeal->save();

            // TO DO: Delivery cost
            $deliveryCost = 0;
            $dpPercentage = 0.5;
            $transactionCost = $dpPercentage * $project->cost * $project->count + $deliveryCost;

            $transaction = new Transaction;
            $transaction->customer_id = $project->customer_id;
            $transaction->partner_id = $partner->id;
            $transaction->project_id = $projectId;
            $transaction->status = TransactionConstant::PAY_WAIT;
            $transaction->type = TransactionConstant::PELUNASAN_TYPE;
            $transaction->cost = $transactionCost;
            $transaction->deadline = Carbon::now()->addDays(3);
            $transaction->save();
        }
        return redirect($expectedStage);
    }

    public function sendProject(Request $request, $projectId)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home'));
        if ($expectedStage == route('home')) {
            $this->validate($request, [
                'shipment_receipt_path' => [
                    'mimes:jpeg,jpg,png,gif,bmp,svg',
                    'required',
                    'max:25000'
                ],
            ]);
            $user = auth()->user();
            $partner = $user->partner;

            $project = Project::find($projectId);

            if ($project == null) {
                return redirect()->route('warning', ['type' => WarningStatusConstant::NOT_FOUND]); 
            }

            $project->status = ProjectStatusConstant::PROJECT_SENT;
            $project->save();

            $file_path_prefix = '/img/customer/transaction/';

            $shipment = new ShipmentReceipt;
            $shipment->path = FileHelper::saveResizedImageToPublic($request->file('shipment_receipt_path'), $file_path_prefix . 'shipmentReceipt');
            $shipment->project_id = $project->id;
            $shipment->save();

            $inbox = $project->inbox;
            
            $chatReview = new Chat;
            $chatReview->role = ChatTemplateConstant::CUSTOMER_ROLE;
            $chatReview->type = ChatTemplateConstant::REVIEW_TYPE;
            $chatReview->inbox_id = $inbox->id;
            $chatReview->save();
        }
        return redirect($expectedStage);
    }
}