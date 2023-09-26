<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\BaseController;
use App\Http\repository\api\v1\QuestionRepository;
use App\Http\service\api\v1\QuestionService;
use Illuminate\Http\Request;

class QuestionController extends BaseController
{
    public function __construct(Request $request, QuestionService $service, QuestionRepository $repository)
    {
        parent::__construct($request, $service, $repository);
        $service->setRepository($repository);
        $this->service = $service;
        $this->repository = $repository;
    }


}
