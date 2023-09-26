<?php

namespace App\Http\service\api\v1;

use App\Base\BaseResponse;
use App\Http\service\Service;
use Illuminate\Support\Facades\Validator;

class QuestionService extends Service
{

    public function getStore()
    {
        return $this->repository->getStore();
    }

    public function setSeenStore($param)
    {
        $roll = [
            'store_id' => ['required']
        ];
        $validate = Validator::make($param, $roll);
        if ($validate->fails()) {
            return BaseResponse::JSON(true,$validate->errors(),401);
        }
        return $this->repository->setSeenStore();
    }

    public function store($param)
    {
        $roll = [
            'full_name' => ['required'],
            'name' => ['required'],
            'description' => ['required'],
            'address' => ['required'],
            'registration_number' => ['required'],
            'kala_name' => ['required'],
            'user_name' => ['required'],
            'store_type' => ['required'],
            'longitude' => ['required'],
            'latitude' => ['required']
        ];
        $validate = Validator::make($param, $roll);
        if ($validate->fails()) {
            return BaseResponse::JSON(true,$validate->errors(),401);
        }

        return $this->repository->store($param);
    }

    public function storeStatus($param)
    {
        return $this->repository->storeStatus($param);
    }

    public function show($id)
    {
        return $this->repository->show($id);
    }




}
