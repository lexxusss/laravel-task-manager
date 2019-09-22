<?php

namespace App\Http\Middleware;

use App\Helpers\RequestsHelper;
use Closure;
use Illuminate\Http\Request;

class UserIsAdminOfTeam
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($team = RequestsHelper::getTeamFromRoute()) {
            $user = RequestsHelper::getAuthUser();

            if (!$user->isInTeam($team)) {
                return redirect()->back()->with('error', "You are not a member of that team: \"$team->name\"");
            }
            if (!$user->isAdminOfTeam($team)) {
                return redirect()->back()->with('error', "You have not allowed to administrate that team: \"$team->name\"");
            }
        }

        return $next($request);
    }
}
