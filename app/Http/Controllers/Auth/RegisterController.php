<?php

namespace App\Http\Controllers\Auth;

use App\Constant\RoleConstant;
use App\Helper\RedirectionHelper;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
                    // TO DO : change to error template
                    return abort(403, 'Unauthorized action.');
                }
                break;
            case route('register.customer.page'):
                return route('register.customer.project.page');
                break;
            case route('register.customer.project.page'):
                if ($user->is_active == true) {
                    return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
                } else {
                    // TO DO : change to error template
                    return abort(403, 'Unauthorized action.');    
                }
                break;
            case route('register.partner.page'):
                if ($user->is_active == true) {
                    return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
                } else {
                    // TO DO : change to error template
                    return abort(403, 'Unauthorized action.');    
                }
                break;
            default:
                return $this->redirectTo();
        }
    }
        ]);
    }
}
