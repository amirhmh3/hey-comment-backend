<?php

namespace App\Traits;

trait ApiResponse
{

    protected function JSON($success = true, $data = [],$message = "درخواست با موفقیت انجام شد!", $statusCode = 200)
    {
        if (isset($data->original["success"]))
            return $data->original;
        return response()->json(["success" => $success, "data" => $data, "message" => $message, "status" => $statusCode]);
    }

//    protected function successResponse($data=[], $message = "درخواست شما با موفقیت انجام شد", $code = 200)
//    {
//        return response()->json([
//            'status' => $code,
//            'message' => $message,
//            'data' => $data,
//            'success' => true,
//        ], $code);
//    }
//
//    protected function errorResponse($message = null, $status, $trace = null, $code = null,$errors=[])
//    {
//
//        $errorData = [
//            'status' => $status,
//            'message' => $message,
//            'data' => null,
//            'success' => false,
//        ];
//        if ($trace != null) $errorData["trace"] = $trace;
//
//
//        if ($code !== null) $errorData["code"] = $code;
//        if (!empty($errors)) $errorData["errors"] = $errors;
//
//
//        return response()->json($errorData, $status);
//    }

}
