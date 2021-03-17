<?php

namespace App\Http\Controllers;

use App\Constant\ProjectStatusConstant;
use App\Constant\RoleConstant;
use App\Constant\SampleStatusConstant;
use App\Constant\WarningStatusConstant;

use App\Helper\RedirectionHelper;

use App\Models\Customer;
use App\Models\Partner;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Sample;

use Illuminate\Http\Request;

class HomeController extends Controller
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
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home'));
        if ($expectedStage == route('home')) {
            $user = auth()->user();
            $role = $user->roles()->first()->name;
            switch ($role) {
                case RoleConstant::ADMINISTRATOR:
                    return $this->administratorDashboard($request, $user, $role);
                    break;
                case RoleConstant::CUSTOMER:
                    return $this->customerDashboard($request, $user, $role);
                    break;
                case RoleConstant::PARTNER:
                    return $this->partnerDashboard($request, $user, $role);
                    break;
                default:
                    return redirect()->route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
            }
        }
        return redirect($expectedStage);
    }

    private function partnerDashboard(Request $request, $user, $role)
    {
        $partner = $user->partner()->first();
        
        $projectsAll = $partner->projects()
                        ->with('images','category', 'partner')
                        ->orderBy('updated_at', 'desc')
                        ->get();

        $projectsRequest = $partner->projects()
                        ->with('images','category', 'partner')
                        ->orderBy('updated_at', 'desc')
                        ->where('status', ProjectStatusConstant::PROJECT_OPENED)
                        ->orWhere('status', ProjectStatusConstant::PROJECT_DEALT)
                        ->orWhere('status', ProjectStatusConstant::PROJECT_DP_OK)
                        ->get();
        
        $projectsInProgress = $partner->projects()
                        ->with('images','category', 'partner')
                        ->orderBy('updated_at', 'desc')
                        ->where('status', ProjectStatusConstant::PROJECT_WORK_IN_PROGRESS)
                        ->get();
        
        $projectsDone = $partner->projects()
                        ->with('images','category', 'partner')
                        ->orderBy('updated_at', 'desc')
                        ->where('status', ProjectStatusConstant::PROJECT_FINISHED)
                        ->orWhere('status', ProjectStatusConstant::PROJECT_FULL_PAYMENT_OK)
                        ->orWhere('status', ProjectStatusConstant::PROJECT_SENT)
                        ->orWhere('status', ProjectStatusConstant::PROJECT_DONE)
                        ->get();
        
        $projectsRejected = $partner->projects()
                        ->with('images','category', 'partner')
                        ->orderBy('updated_at', 'desc')
                        ->where('status', ProjectStatusConstant::PROJECT_FAILED)
                        ->orWhere('status', ProjectStatusConstant::PROJECT_CANCELED)
                        ->get();

        $samplesAll =  $partner->transactions()
                        ->orderBy('updated_at', 'desc')
                        ->with('sample', 'project', 'project.images')
                        ->whereHas('sample')
                        ->get();

        $samplesRequest = $partner->transactions()
                        ->orderBy('updated_at', 'desc')
                        ->with('sample', 'project', 'project.images')
                        ->whereHas('sample', function($query) {
                            $query->where('status', SampleStatusConstant::SAMPLE_WAIT_PAYMENT)
                                ->orWhere('status', SampleStatusConstant::SAMPLE_PAYMENT_OK);
                        })
                        ->get();
        
        $samplesInProgress = $partner->transactions()
                        ->orderBy('updated_at', 'desc')
                        ->with('sample', 'project', 'project.images')
                        ->whereHas('sample', function($query) {
                            $query->where('status', SampleStatusConstant::SAMPLE_WORK_IN_PROGRESS);
                        })
                        ->get();
        
        $samplesDone = $partner->transactions()
                        ->orderBy('updated_at', 'desc')
                        ->with('sample', 'project', 'project.images')
                        ->whereHas('sample', function($query) {
                            $query->where('status', SampleStatusConstant::SAMPLE_FINISHED)
                                ->orWhere('status', SampleStatusConstant::SAMPLE_SENT)
                                ->orWhere('status', SampleStatusConstant::SAMPLE_APPROVED);
                        })
                        ->get();
        
        $samplesRejected = $partner->transactions()
                        ->orderBy('updated_at', 'desc')
                        ->with('sample', 'project', 'project.images')
                        ->whereHas('sample', function($query) {
                            $query->where('status', SampleStatusConstant::SAMPLE_REJECTED);
                        })
                        ->get();
        
        $categories = ProjectCategory::all();

        return view('pages.partner.dashboard', get_defined_vars());
    }

    private function customerDashboard(Request $request, $user, $role)
    {
        $customer = $user->customer()->first();

        $projectsAll = $customer->projects()
                        ->with('images','category', 'partner')
                        ->orderBy('updated_at', 'desc')
                        ->get();

        $projectsRequest = $customer->projects()
                        ->with('images','category', 'partner')
                        ->orderBy('updated_at', 'desc')
                        ->where('status', ProjectStatusConstant::PROJECT_OPENED)
                        ->orWhere('status', ProjectStatusConstant::PROJECT_DEALT)
                        ->orWhere('status', ProjectStatusConstant::PROJECT_DP_OK)
                        ->get();
        
        $projectsInProgress = $customer->projects()
                        ->with('images','category', 'partner')
                        ->orderBy('updated_at', 'desc')
                        ->where('status', ProjectStatusConstant::PROJECT_WORK_IN_PROGRESS)
                        ->get();
        
        $projectsDone = $customer->projects()
                        ->with('images','category', 'partner')
                        ->orderBy('updated_at', 'desc')
                        ->where('status', ProjectStatusConstant::PROJECT_FINISHED)
                        ->orWhere('status', ProjectStatusConstant::PROJECT_FULL_PAYMENT_OK)
                        ->orWhere('status', ProjectStatusConstant::PROJECT_SENT)
                        ->orWhere('status', ProjectStatusConstant::PROJECT_DONE)
                        ->get();
        
        $projectsRejected = $customer->projects()
                        ->with('images','category', 'partner')
                        ->orderBy('updated_at', 'desc')
                        ->where('status', ProjectStatusConstant::PROJECT_FAILED)
                        ->orWhere('status', ProjectStatusConstant::PROJECT_CANCELED)
                        ->get();

        $samplesAll =  $customer->transactions()
                        ->orderBy('updated_at', 'desc')
                        ->with('sample', 'project', 'project.images')
                        ->whereHas('sample')
                        ->get();

        $samplesRequest = $customer->transactions()
                        ->orderBy('updated_at', 'desc')
                        ->with('sample', 'project', 'project.images')
                        ->whereHas('sample', function($query) {
                            $query->where('status', SampleStatusConstant::SAMPLE_WAIT_PAYMENT)
                                ->orWhere('status', SampleStatusConstant::SAMPLE_PAYMENT_OK);
                        })
                        ->get();
        
        $samplesInProgress = $customer->transactions()
                        ->orderBy('updated_at', 'desc')
                        ->with('sample', 'project', 'project.images')
                        ->whereHas('sample', function($query) {
                            $query->where('status', SampleStatusConstant::SAMPLE_WORK_IN_PROGRESS);
                        })
                        ->get();
        
        $samplesDone = $customer->transactions()
                        ->orderBy('updated_at', 'desc')
                        ->with('sample', 'project', 'project.images')
                        ->whereHas('sample', function($query) {
                            $query->where('status', SampleStatusConstant::SAMPLE_FINISHED)
                                ->orWhere('status', SampleStatusConstant::SAMPLE_SENT)
                                ->orWhere('status', SampleStatusConstant::SAMPLE_APPROVED);
                        })
                        ->get();
        
        $samplesRejected = $customer->transactions()
                        ->orderBy('updated_at', 'desc')
                        ->with('sample', 'project', 'project.images')
                        ->whereHas('sample', function($query) {
                            $query->where('status', SampleStatusConstant::SAMPLE_REJECTED);
                        })
                        ->get();
        
        $categories = ProjectCategory::all();

        return view('pages.customer.dashboard', get_defined_vars());
    }

    private function administratorDashboard(Request $request, $user, $role)
    {
        $activeCustomers = Customer::with('user', 'projects', 'projects.images')
                            ->whereHas('user', function($query) {
                                $query->where('is_active', true);
                            })
                            ->orderBy('created_at', 'desc')
                            ->get();
        $inactiveCustomers = Customer::with('user', 'projects', 'projects.images')
                            ->whereHas('user', function($query) {
                                $query->where('is_active', false);
                            })
                            ->orderBy('created_at', 'desc')
                            ->get();
        $activePartners = Partner::with('user')
                            ->whereHas('user', function($query) {
                                $query->where('is_active', true);
                            })
                            ->orderBy('created_at', 'desc')
                            ->get();
        $inactivePartners = Partner::with('user')
                            ->whereHas('user', function($query) {
                                $query->where('is_active', false);
                            })
                            ->orderBy('created_at', 'desc')
                            ->get();
        $categories = ProjectCategory::with('projects', 'projects.images', 'projects.receipt')->get();
        $samples =  Sample::orderBy('updated_at', 'desc')->with('transaction.project', 'transaction.project.images', 'receipt')
                        ->get();


        return view('pages.administrator.dashboard', get_defined_vars());
    }
}
