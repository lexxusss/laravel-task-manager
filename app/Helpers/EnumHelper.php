<?php

namespace App\Helpers;


use Illuminate\Support\Collection;
use ReflectionClass;
use ReflectionException;

trait EnumHelper
{
    /**
     * @return Collection
     * @throws ReflectionException
     */
    public static function getConsts()
    {
        $oClass = new ReflectionClass(__CLASS__);

        return collect($oClass->getConstants());
    }
}
