<?php

namespace App\Http\service;

use App\Http\Controllers\BaseController;
use App\Traits\ApiResponse;

class Service
{
    use ApiResponse;
    public $repository;

    public function setRepository($repository)
    {
        $this->repository=$repository;
    }


}
