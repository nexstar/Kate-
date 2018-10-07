<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\appwebuserelempush;

class ReServeNotifi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $Push;

    public function __construct($bbsid, array $userids, $title )
    {
        $this->Push = new appwebuserelempush($bbsid, $userids, $title);
    }

    public function handle()
    {
        $this->Push->greenpet_notifi();
    }
}
