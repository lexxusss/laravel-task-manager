<?php


namespace App\Helpers;


use App\User;
use Illuminate\Contracts\Auth\Authenticatable;

class AuthHelper
{
    /**
     * @return Authenticatable|User|null
     */
    public static function getAuthUser()
    {
        return auth()->user();
    }
}
