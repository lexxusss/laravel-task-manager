<?php

namespace App\Http\Controllers;

use App\Helpers\RequestsHelper;
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
        parent::__construct();

        $this->middleware('auth');
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $teams = $this->user->teams;

        return view('home', compact('teams'));
    }
}
