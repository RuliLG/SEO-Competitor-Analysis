<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{
    use HasFactory;
    use HasUuid;

    protected $fillable = [
        'uuid',
        'url',
        'email',
    ];

    protected $casts = [
        'competitors' => 'array',
    ];
}
