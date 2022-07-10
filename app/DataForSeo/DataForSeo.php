<?php

namespace App\DataForSeo;

use App\DataForSeo\Traits\RequestsCompetitors;
use Illuminate\Support\Facades\Http;

class DataForSeo {
    use RequestsCompetitors;

    private function client()
    {
        return Http::withBasicAuth(
            config('services.dataforseo.username'),
            config('services.dataforseo.password')
        );
    }
}
