<?php


namespace App\Helpers;


use App\Model\Team;
use App\User;
use Illuminate\Contracts\Auth\Authenticatable;

class RequestsHelper
{
    /**
     * @return Authenticatable|User|null
     */
    public static function getAuthUser()
    {
        return auth()->user();
    }

    /**
     * @return Team|null|object
     */
    public static function getTeamFromRoute()
    {
        return request()->route('team');
    }

    /**
     * @return Team|null|object
     */
    public static function getUserTeamFromRoute()
    {
        return request()->route('userTeam');
    }
}
