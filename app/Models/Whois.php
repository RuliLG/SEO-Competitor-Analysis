<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whois extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'nameservers' => 'array',
    ];
}
