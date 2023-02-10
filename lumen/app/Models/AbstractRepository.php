<?php

namespace App\Models;

abstract class AbstractRepository
{
    protected string $model;

    public function __construct(string $modelFqn)
    {
        $this->model = $modelFqn;
    }

    abstract public function findOne();

    abstract public function findMany();
}
