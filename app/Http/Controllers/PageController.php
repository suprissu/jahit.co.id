<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function homepage(Request $request)
    {
        return view('pages.homepage', get_defined_vars());
    }

    public function aboutpage(Request $request)
    {
        return view('pages.aboutpage', get_defined_vars());
    }

    public function choicePage(Request $request)
    {
        return view('pages.choicePage', get_defined_vars());
    }

    public function userLoginPage(Request $request)
    {
        return view('pages.userLoginPage', get_defined_vars());
    }

    public function userRegisterPage(Request $request)
    {
        return view('pages.userRegisterPage', get_defined_vars());
    }

    public function userCustomerRegisterPage(Request $request)
    {
        return view('pages.userCustomerRegisterPage', get_defined_vars());
    }
    
    public function userCustomerAddProjectPage(Request $request)
    {
        return view('pages.userCustomerAddProjectPage', get_defined_vars());
    }
    public function userCustomerProjectPage(Request $request)
    {
        return view('pages.userCustomerProjectPage', get_defined_vars());
    }

    public function userPartnerRegisterPage(Request $request)
    {
        return view('pages.userPartnerRegisterPage', get_defined_vars());
    }
    public function notfound(Request $request)
    {
        return view('layouts._customPage', get_defined_vars());
    }
}