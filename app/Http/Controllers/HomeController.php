<?php

namespace App\Http\Controllers;

use App\Constant\RoleConstant;
use App\Constant\WarningStatusConstant;

use App\Helper\RedirectionHelper;

use App\Models\Customer;
use App\Models\Partner;
use App\Models\Project;
use App\Models\ProjectCategory;

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
                    // TO DO: for next phase, uncomment this code
                    return $this->customerDashboard($request, $user, $role);
                    // return redirect()->route('warning', ['type' => WarningStatusConstant::WAITING_VALIDATION]); 
                    break;
                case RoleConstant::PARTNER:
                    // TO DO: for next phase, uncomment this code
                    return $this->partnerDashboard($request, $user, $role);
                    // return redirect()->route('warning', ['type' => WarningStatusConstant::WAITING_VALIDATION]); 
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
        $projects_all = $partner->projects()->orderBy('created_at', 'desc')->get();
        $categories = ProjectCategory::all();

        return view('pages.partner.dashboard', get_defined_vars());
    }

    private function customerDashboard(Request $request, $user, $role)
    {
        $customer = $user->customer()->first();
        $projects_all = $customer->projects()->orderBy('created_at', 'desc')->get();
        $categories = ProjectCategory::all();

        return view('pages.customer.dashboard', get_defined_vars());
    }

    private function administratorDashboard(Request $request, $user, $role)
    {
        $customers = Customer::all();
        $partners = Partner::all();
        $projects = Project::all();
        $categories = ProjectCategory::all();

        return view('pages.administrator.dashboard', get_defined_vars());
    }
}
