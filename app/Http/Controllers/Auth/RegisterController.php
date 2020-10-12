<?php

namespace App\Http\Controllers\Auth;

use App\Constant\ProjectStatusConstant;
use App\Constant\RoleConstant;
use App\Constant\WarningStatusConstant;

use App\Helper\FileHelper;
use App\Helper\RedirectionHelper;

use App\Models\Customer;
use App\Models\Partner;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectImage;
use App\Models\Role;
use App\Models\User;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^.*(?=.{3,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\x]).*$/'
            ],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_active' => false,
        ]);
    }

    /**
     * Override get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        $expectedPath = property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
        return RedirectionHelper::routeBasedOnRegistrationStage($expectedPath);
    }

    private function nextPathStage($currentPathStage)
    {
        $user = auth()->user();
        $role = $user->roles()->first()->name;
        switch ($currentPathStage) {
            case route('register.choice.page'):
                if ($role == RoleConstant::CUSTOMER) {
                    return route('register.customer.page');
                } else if ($role == RoleConstant::PARTNER) {
                    return route('register.partner.page');
                } else {
                    return route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
                }
                break;
            case route('register.customer.page'):
                return route('register.customer.project.page');
                break;
            case route('register.customer.project.page'):
                if ($user->is_active == true) {
                    return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
                } else {
                    return route('warning', ['type' => WarningStatusConstant::WAITING_VALIDATION]);
                }
                break;
            case route('register.partner.page'):
                if ($user->is_active == true) {
                    return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
                } else {
                    return route('warning', ['type' => WarningStatusConstant::WAITING_VALIDATION]);    
                }
                break;
            default:
                return $this->redirectTo();
        }
    }

    public function registerChoicePage(Request $request)
    {
        $expectedStage = $this->redirectPath();
        if ($expectedStage == route('register.choice.page')) {
            return view('auth.registerChoice', get_defined_vars());
        }
        return redirect($expectedStage);
    }

    public function registerPartnerPage(Request $request)
    {
        $expectedStage = $this->redirectPath();
        if ($expectedStage == route('register.partner.page')) {
            return view('auth.registerPartner', get_defined_vars());
        }
        return redirect($expectedStage);
    }
    
    public function registerCustomerPage(Request $request)
    {
        $expectedStage = $this->redirectPath();
        if ($expectedStage == route('register.customer.page')) {
            return view('auth.registerCustomer', get_defined_vars());
        }
        return redirect($expectedStage);
    }
    
    public function registerProjectPage(Request $request)
    {
        $expectedStage = $this->redirectPath();
        $categories = ProjectCategory::all();
        if ($expectedStage == route('register.customer.project.page')) {
            return view('auth.registerFirstProject', get_defined_vars());
        }
        return redirect($expectedStage);
    }

    public function registerChoiceSubmit(Request $request)
    {
        $this->validate($request, [
            'role' => [
                'required',
                'string'
            ],
        ]);

        $expectedStage = $this->redirectPath();

        if ($expectedStage == route('register.choice.page')) {
            
            $user = auth()->user();
            
            if ($request->role == 'CUST') {
                $role = Role::where('name', RoleConstant::CUSTOMER)->first();
            } else if ($request->role == 'PART') {
                $role = Role::where('name', RoleConstant::PARTNER)->first();
            } else {
                return redirect()->route('warning', ['type' => WarningStatusConstant::NOT_FOUND]);
            }
            $user->roles()->save($role);

            $expectedStage = $this->nextPathStage($expectedStage);
        }

        return redirect($expectedStage);
    }

    public function registerPartnerSubmit(Request $request)
    {
        $this->validate($request, [
            'company_name' => [
                'required',
                'string',
                'max:255'
            ],
            'phone_number' => [
                'required',
                'string',
                'max:20',
                'regex:/^\+?([ -]?\d+)+|\(\d+\)([ -]\d+)$/'
            ],
            'address' => [
                'required',
                'string',
                'max:255'
            ],
            'ktp_pict_link' => [
                'mimes:jpeg,jpg,png,gif,bmp,svg',
                'required',
                'max:25000'
            ],
            'npwp_pict_link' => [
                'mimes:jpeg,jpg,png,gif,bmp,svg',
                'required',
                'max:25000'
            ],
        ]);

        $expectedStage = $this->redirectPath();

        if ($expectedStage == route('register.partner.page')) {
            
            $user = auth()->user();
            $file_path_prefix = '/img/partner/';

            $partner = new Partner;
            $partner->company_name = $request->company_name;
            $partner->phone_number = $request->phone_number;
            $partner->address = $request->address;
            $partner->ktp_pict_link = FileHelper::saveResizedImageToPublic($request->file('ktp_pict_link'), $file_path_prefix . 'ktp');
            $partner->npwp_pict_link = FileHelper::saveResizedImageToPublic($request->file('npwp_pict_link'), $file_path_prefix . 'npwp');
            
            $user->partner()->save($partner);
            
            // TO DO: Should be false for only phase 1
            $user->is_active = true;
            $user->save();

            $expectedStage = $this->nextPathStage($expectedStage);
        }

        return redirect($expectedStage);
    }
    
    public function registerCustomerSubmit(Request $request)
    {
        $this->validate($request, [
            'company_name' => [
                'required',
                'string',
                'max:255'
            ],
            'phone_number' => [
                'required',
                'string',
                'max:20',
                'regex:/^\+?([ -]?\d+)+|\(\d+\)([ -]\d+)$/'
            ],
        ]);

        $expectedStage = $this->redirectPath();

        if ($expectedStage == route('register.customer.page')) {

            $user = auth()->user();

            $customer = new Customer;
            $customer->company_name = $request->company_name;
            $customer->phone_number = $request->phone_number;

            $user->customer()->save($customer);

            $expectedStage = $this->nextPathStage($expectedStage);
        }

        return redirect($expectedStage);
    }
    
    public function registerProjectSubmit(Request $request)
    {
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

        $expectedStage = $this->redirectPath();

        if ($expectedStage == route('register.customer.project.page')) {

            $user = auth()->user();

            $project = new Project;
            $project->name = $request->name;
            $project->address = $request->address;
            $project->count = $request->count;
            $project->status = ProjectStatusConstant::OPEN;
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

            // TO DO: Should be false for only phase 1
            $user->is_active = true;
            $user->save();

            $expectedStage = $this->nextPathStage($expectedStage);
        }
    
        return redirect($expectedStage);
    }

}
