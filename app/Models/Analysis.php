<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Analysis extends Model
{
    use HasFactory;
    use HasUuid;

    protected $fillable = [
        'uuid',
        'url',
        'email',
        'location',
        'language',
        'whois_id',
    ];

    protected $casts = [
        'competitors' => 'array',
    ];

    public function domain(): Attribute
    {
        $domain = parse_url($this->url, PHP_URL_HOST);
        if (Str::startsWith($domain, 'www.')) {
            $domain = Str::after($domain, 'www.');
        }

        return Attribute::make(
            get: fn () => $domain,
        );
    }

    public function whois()
    {
        return $this->belongsTo(Whois::class);
    }
}
