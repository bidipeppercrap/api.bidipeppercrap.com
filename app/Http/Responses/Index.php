<?php

namespace App\Http\Responses;

use Illuminate\Http\Response;

class Index extends Response
{
    public static function response($count, $skip, $take, $data) {
        $results = [
            'pageSize' => $take,
            'totalPage' => ceil($count / $take),
            'currentPage' => floor($skip / $take) + 1,
            'data' => $data
        ];

        return $results;
    }
}
