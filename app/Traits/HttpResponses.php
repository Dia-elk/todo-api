<?php

namespace App\Traits;

trait HttpResponses {

    protected function success($data , $message = null , $code = 200)
    {
        return response()->json([
            'statuts' => 'Request was successful .',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error($data , $message = null , $code)
    {
        return response()->json([
            'statuts' => 'Error has occurred...',
            'message' => $message,
            'data' => $data
        ], $code);
    }

}
