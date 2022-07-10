<?php

namespace App\Jobs;

use App\Models\Analysis;
use App\Models\Whois;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Iodev\Whois\Factory;

class FetchWhois implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public Analysis $analysis,
    ) {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $whois = Factory::get()->createWhois();
        $info = $whois->loadDomainInfo($this->analysis->domain);
        if (is_null($info)) {
            return;
        }

        $record = Whois::create([
            'domain' => $this->analysis->domain,
            'registrar' => $info->registrar,
            'nameservers' => $info->nameServers,
            'expires_at' => new Carbon($info->expirationDate),
            'last_updated_at' => new Carbon($info->updatedDate),
            'status' => empty($info->states) ? null : $info->states[0],
        ]);

        $this->analysis->update([
            'whois_id' => $record->id,
        ]);
    }
}
