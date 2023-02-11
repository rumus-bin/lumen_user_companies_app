<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class ProjectDataModel extends Model
{
    public const ID = 'id';

    abstract public function getTableName(): string;
}
