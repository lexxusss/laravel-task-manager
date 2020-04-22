<?php

namespace App\Http\Controllers;

use App\Helpers\RequestsHelper;
use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var User|Authenticatable|null
     */
    protected $user;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = RequestsHelper::getAuthUser();

            View::share('user', $this->user);

            return $next($request);
        });
    }
}
