<?php

namespace App\DataForSeo\Traits;

use App\Models\Analysis;
use App\Models\Competitor;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait RequestsCompetitors {
    public function requestCompetitors(Analysis $analysis)
    {
        $postData = [
            [
                'target' => $analysis->domain,
                'language_name' => $analysis->language,
                'location_code' => $analysis->location,
                'item_types' => ['organic'],
                'limit' => 10,
                'exclude_top_domains' => true,
                'intersecting_domains' => $analysis->competitors ? array_slice($analysis->competitors, 0, 20) : [],
            ],
        ];

        $response = $this
            ->client()
            ->post(config('services.dataforseo.endpoint') . '/dataforseo_labs/google/competitors_domain/live', $postData)
            ->throw()
            ->json();
        $result = $response['tasks'][0]['result'][0]['items'];

        $data = [];
        foreach ($result as $item) {
            $domain = Str::startsWith($item['domain'], 'www.') ? Str::after($item['domain'], 'www.') : $item['domain'];
            $data[] = [
                'analysis_id' => $analysis->id,
                'domain' => $item['domain'],
                'is_competitor' => $domain !== $analysis->domain,
                'avg_position' => $item['avg_position'],
                'pos_1' => Arr::get($item, 'full_domain_metrics.organic.pos_1', 0),
                'pos_2_3' => Arr::get($item, 'full_domain_metrics.organic.pos_2_3', 0),
                'pos_4_10' => Arr::get($item, 'full_domain_metrics.organic.pos_4_10', 0),
                'pos_11_20' => Arr::get($item, 'full_domain_metrics.organic.pos_11_20', 0),
                'pos_21_30' => Arr::get($item, 'full_domain_metrics.organic.pos_21_30', 0),
                'pos_31_40' => Arr::get($item, 'full_domain_metrics.organic.pos_31_40', 0),
                'pos_41_50' => Arr::get($item, 'full_domain_metrics.organic.pos_41_50', 0),
                'pos_51_60' => Arr::get($item, 'full_domain_metrics.organic.pos_51_60', 0),
                'pos_61_70' => Arr::get($item, 'full_domain_metrics.organic.pos_61_70', 0),
                'pos_71_80' => Arr::get($item, 'full_domain_metrics.organic.pos_71_80', 0),
                'pos_81_90' => Arr::get($item, 'full_domain_metrics.organic.pos_81_90', 0),
                'pos_91_100' => Arr::get($item, 'full_domain_metrics.organic.pos_91_100', 0),
                'etv' => Arr::get($item, 'full_domain_metrics.organic.etv', 0),
                'impressions_etv' => Arr::get($item, 'full_domain_metrics.organic.impressions_etv', 0),
                'count' => Arr::get($item, 'full_domain_metrics.organic.count', 0),
                'is_new' => Arr::get($item, 'full_domain_metrics.organic.is_new', 0),
                'is_up' => Arr::get($item, 'full_domain_metrics.organic.is_up', 0),
                'is_down' => Arr::get($item, 'full_domain_metrics.organic.is_down', 0),
                'is_lost' => Arr::get($item, 'full_domain_metrics.organic.is_lost', 0),
            ];
        }

        Competitor::upsert($data, ['analysis_id', 'domain'], array_diff(array_keys($data[0]), ['analysis_id', 'domain']));
    }
}
