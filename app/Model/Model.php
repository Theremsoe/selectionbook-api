<?php

namespace App\Model;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;

class Model extends EloquentModel
{
    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = DateTimeInterface::RFC3339_EXTENDED;

    public function getTable(): string
    {
        return $this->table ?? Str::snake(Str::singular(class_basename($this)));
    }
}
