<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait UuidTrait {
    public static function booted()
    {
        static::creating(function(Model $model){
            $model->{$model->getKeyName()} = Str::uuid();
        });
    }
}
