<?php

namespace App\Http\repository;

class Repository
{
    public $model;
    public function __construct($model)
    {
        $this->model=$model;
    }

    public function index($param)
    {
        return $this->model::all()->toArray();
    }

    public function store($param)
    {
        return $this->model->create($param);
    }

    public function show($id)
    {
        return $this->model::find($id);
    }

    public function update($param, $id)
    {
        $model=$this->model::find($id);
        return $model->update($param);
    }


    public function destroy($id)
    {
        $model=$this->model::find($id);
        return $model->delete();
    }

}
