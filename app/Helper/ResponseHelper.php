<?php

namespace App\Helper;
use Illuminate\Http\JsonResponse;

class ResponseHelper {
    public static function Out($msg, $data, $code){
        return response()->json(['msg'=>$msg, 'data'=>$data], $code);
    }
}