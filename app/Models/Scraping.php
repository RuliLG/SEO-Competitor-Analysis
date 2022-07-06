<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scraping extends Model
{
    use HasFactory;

    protected $fillable = [
        'analysis_id',
        'url',
        'html',
        'text',
        'status',
    ];
}
