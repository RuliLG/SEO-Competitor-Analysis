<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait HasUuid {
    public static function bootHasUuid()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }
}
