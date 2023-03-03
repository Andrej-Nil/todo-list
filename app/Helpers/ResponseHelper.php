<?php

namespace App\Helpers;

class ResponseHelper
{
    public static function getError($message, $status) {
        return [
            'status'=>'error',
            'data'=>[
                'status'=>$status,
                'message'=>$message
            ]
        ];
    }
}
