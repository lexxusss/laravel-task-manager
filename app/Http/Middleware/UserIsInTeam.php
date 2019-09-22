<?php

namespace App\Http\Middleware;

use App\Helpers\RequestsHelper;
use Closure;
use Illuminate\Http\Request;

class UserIsInTeam
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
        $user = RequestsHelper::getAuthUser();
        $team = RequestsHelper::getTeamFromRoute();

        if (!$user->isInTeam($team)) {
            return redirect()->back()->with('error', "You are not a member of that team: \"$team->name\"");
        }

        return $next($request);
    }
}
