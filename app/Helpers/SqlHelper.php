<?php

namespace App\Helpers;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class SqlHelper
{
    public static function countOfGroup(Builder $query)
    {
        $sqlQuery = self::getSqlQueryString($query);
        $dbRaw = DB::raw(self::getCountQueryString($sqlQuery));

        $count = DB::select($dbRaw);

        return $count[0]->total;
    }

    public static function getCountQueryString($sqlQuery)
    {
        return "select count(*) as total from ($sqlQuery) as count";
    }

    public static function getSqlQueryString($query)
    {
        $bindings = [];
        foreach ($query->getBindings() as $binding) {
            array_push($bindings, "\"$binding\"");
        }

        return str_replace_array('?', $bindings, $query->toSql());
    }
}
