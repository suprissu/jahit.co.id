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
}