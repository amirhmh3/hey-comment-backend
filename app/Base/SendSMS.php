<?php

namespace App\Base;

use App\Models\CodePhone;
use function Symfony\Component\Translation\t;

class SendSMS
{
    public function VeryFy($phone)
    {
        $code = rand(000000, 999999);

        $result = CodePhone::select()->where("phone", $phone)->get()->toArray();
        if (count($result) > 0) {
            $timeCode = $result[0]["created_at"];
//            dd(strtotime(date("Y-m-d H:i:s")) - strtotime($timeCode));
            if (strtotime(date("Y-m-d H:i:s")) - strtotime($timeCode) >= 120) {
                $result=$this->sendCode($phone,$code);
//                if ($result->)
                CodePhone::where("phone", $phone)->delete();
                CodePhone::create(["code" => $code, "phone" => $phone]);
                return $result;
            }else return BaseResponse::JSON(false,"کد قبلا ارسال شده");
        } else {
            $result=$this->sendCode($phone, $code);
            CodePhone::create(["code" => $code, "phone" => $phone]);
            return $result;
        }


    }


    private function sendCode($phone, $code)
    {

        $payload = <<<JSON
{
    "mobile": "$phone",
    "templateId": 342180,
    "parameters": [
        {
            "name": "code",
            "value": "$code"
        }
    ]
}
JSON;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.sms.ir/v1/send/verify',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: text/plain',
                'x-api-key: aitf4xTAAgb6qeg0ukTRzby71KUpKLhcFAcBiybAiafbZFnO3YmT0eabC5zXe2q1'
            ),
        ));

        $response = curl_exec($curl);

        if ($response === false) {
            $error = curl_error($curl);
            return BaseResponse::JSON(false,$error);
            // Handle the error here, such as logging or displaying an error message.
        }


        curl_close($curl);
        $obj = json_decode($response);
        if ($obj->status==1)
        return BaseResponse::JSON(true,$response);
        else return BaseResponse::JSON(false,$obj->message);

    }


}
