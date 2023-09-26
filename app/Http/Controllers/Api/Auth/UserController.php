<?php

namespace App\Http\Controllers\Api\Auth;

use App\Base\BaseResponse;
use App\Base\SendSMS;
use App\Http\Controllers\Controller;
use App\Models\CodePhone;
use App\Models\CurrentStoreStatus;
use App\Models\PhoneCode;
use App\Models\store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function sendCode(Request $request)
    {
        $data = $request->all();
        $roll = [
            'phone' => ['required', " min:11","max:11"]
        ];
        $validate = Validator::make($data, $roll);
        if ($validate->fails()) {
            return response()->json(["success" => false, "message" => $validate->errors()], 401);
        }

        $sendSms = new SendSMS();
        return $sendSms->VeryFy($request["phone"]);
    }


    public function RegisterLogin(Request $request)
    {
        $data = $request->all();
        $roll = [
            'phone' => ['required', "digits:11"],
            'code' => ['required', "digits:6"]
        ];
        $validate = Validator::make($data, $roll);
        if ($validate->fails()) {
            return response()->json(["success" => false, "message" => $validate->errors()], 401);
        }

        $result = CodePhone::where("phone", $data["phone"])->where("code", $data["code"])->first();

//        dd();
        if (!is_null($result)) {

            $timeCode = $result["created_at"];
            if (strtotime(date("Y-m-d H:i:s")) - strtotime($timeCode) >= 120) {
               return BaseResponse::JSON(false, "کد منقضی شده لطفا کد جدید دریافت کنید");
            }

            $user = User::where('phone', $data["phone"])->first();

            if (!is_null($user)) {
                $token = $user->createToken('authToken')->accessToken;

                return BaseResponse::JSON(true, ["user" => $user, "token" => $token], 201);
            } else {
                $data["name"]="بدون نام";
                $userNew = User::create($data);
                $token = $userNew->createToken('authToken')->accessToken;
                return response()->json(["success" => true, "user" => $userNew, "token" => $token], 201);
            }
        }else return BaseResponse::JSON(false,"کد نامعتبر می باشد");


    }


}
