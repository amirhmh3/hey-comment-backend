<?php

namespace App\Base;

class BaseResponse
{
    public static function JSON($success = true, $message = null, $statusCode = 200)
    {
        if (isset($message->original["success"]))
            return $message->original;
        return response()->json(["success" => $success, "message" => $message, "status" => $statusCode]);
    }
}
