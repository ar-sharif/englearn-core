<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait UUID
{
    /**
     * Boot the trait.
     *
     * @return void
     */
    public static function bootUUID()
    {
        static::creating(function (Model $model) {
            if (is_null($model->uuid)) {
                $model->uuid = \Str::uuid();
            }
        });
    }
}
