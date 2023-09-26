<?php

namespace App\Base;

class BaseCurl
{
    //$payload Just format Json
    //$payload = <<<JSON {"a":"b"}
    //JSON;
    public function init($url,$headerToken,$method,$payload)
    {
        $httpHeader=array(
            'Content-Type: application/json',
            'Accept: text/plain'
        );

        array_push($httpHeader,$headerToken);

//        dd($httpHeader);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => $httpHeader
        ));

        $response = curl_exec($curl);

        if ($response === false) {
            $error = curl_error($curl);
            return BaseResponse::JSON(false,$error);
            // Handle the error here, such as logging or displaying an error message.
        }

        dd($response);


        curl_close($curl);
//        $obj = json_decode($response);
//        if ($obj->status==1)
            return BaseResponse::JSON(true,$response);
//        else return BaseResponse::JSON(false,$obj->message);
    }
}
