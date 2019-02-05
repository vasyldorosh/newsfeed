<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\AbstractRepoInterface;

class AbstractRepo implements AbstractRepoInterface
{
    protected $model;

    public function __construct(string $model)
    {
        $this->model = "App\\Models\\$model";
    }

    public function findOrFail($id)
    {
        return $this->model::findOrfail($id);
    }

    public function paginate()
    {
        return $this->model::paginate();
    }
}
