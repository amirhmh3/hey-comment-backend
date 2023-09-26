<?php

namespace App\Http\repository\api\v1;

use App\Events\RequestToStoreEvent;
use App\Http\repository\Repository;
use App\Models\Chanels;
use App\Models\chat;
use App\Models\CurrentStoreStatus;
use App\Models\KalaStore;
use App\Models\pv;
use App\Models\pvchats;
use App\Models\question;
use App\Models\RequestStore;
use App\Models\store;
use App\Models\StoreSeen;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuestionRepository extends Repository
{
    public $model;

    public function __construct(question $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }


}
