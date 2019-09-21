<?php

namespace App\Http\Controllers;

use App\Helpers\AuthHelper;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

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
     * @return Factory|View
     */
    public function index()
    {
        $user = AuthHelper::getAuthUser();

        $teams = $user->teams;

        return view('root', compact('user', 'teams'));
    }
}
