<?php

namespace App\Http\Controllers;

use App\Constant\ChatTemplateConstant;
use App\Constant\RoleConstant;
use App\Constant\ProjectStatusConstant;
use App\Constant\WarningStatusConstant;
use App\Constant\SampleStatusConstant;

use App\Helper\FileHelper;
use App\Helper\RedirectionHelper;

use App\Models\Chat;
use App\Models\Customer;
use App\Models\Inbox;
use App\Models\Partner;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectImage;
use App\Models\Sample;

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // TO DO
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
            $user = auth()->user();
            $partner = $user->partner;

            $sample = Sample::find($sampleId);

            if ($sample == null) {
                return redirect()->route('warning', ['type' => WarningStatusConstant::NOT_FOUND]); 
            }

            $sample->status = SampleStatusConstant::SAMPLE_SENT;
            $sample->save();
            
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
}