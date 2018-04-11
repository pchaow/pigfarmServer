<?php
/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 3/31/2018
 * Time: 8:33 AM
 */

namespace App\Http\Services;

class BaseService
{

    protected $searchColumns = [];

    function bindQuerySearchColumns($query, $keyword)
    {
        $query->where(function ($query) use ($keyword) {

            if ($keyword == '') {
                return $query;
            }
            foreach ($this->searchColumns as $key => $opts) {
                if ($opts == "like") {
                    $query->orWhere($key, $opts, "%$keyword%");
                }
                $query->orWhere($key, $opts, $keyword);
            }
        });

        return $query;
    }

    function bindWith($query, array $with)
    {
        foreach ($with as $item) {
            $query->with($item);
        }
        return $query;
    }

}