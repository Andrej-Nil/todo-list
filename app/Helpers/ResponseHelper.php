<?php

namespace App\Helpers;

class ResponseHelper
{
    public static function getError($message) {
        return [
            'status'=>'error',
            'data'=>[
                'message'=>$message
            ]
        ];
    }
}
