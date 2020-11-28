<?php

namespace App\Http\Controllers;

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
     * Show the inbox.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $expectedStage = RedirectionHelper::routeBasedOnRegistrationStage(route('home.customer.inbox.all'));
        if ($expectedStage == route('home.customer.inbox.all')) {
            $user = auth()->user();
            $customer = $user->customer()->first();
            $inboxes = $customer->inboxes()->orderBy('created_at', 'desc')->get();
            $role = "CLIENT";

            return view('pages.customer.inbox', get_defined_vars());
        }
        return redirect($expectedStage);
    }
}