<?php

namespace App\Observers;

use App\Jobs\FetchCompetitors;
use App\Models\Analysis;

class AnalysisObserver
{
    /**
     * Handle the Analysis "created" event.
     *
     * @param  \App\Models\Analysis  $analysis
     * @return void
     */
    public function created(Analysis $analysis)
    {
        dispatch(new FetchCompetitors($analysis));
        // dispatch(new FetchWhois($analysis));
    }
}
