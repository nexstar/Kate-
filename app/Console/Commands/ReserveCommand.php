<?php

namespace App\Console\Commands;

use App\GreenPetSingleNotifi;
use App\Jobs\ReServeNotifi;
use Illuminate\Console\Command;
use Illuminate\Contracts\Logging\Log;

class ReserveCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Reserve:notifi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reserve Notifi';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ReserveSingle = GreenPetSingleNotifi::where('reservemdh','<>','null')->orderBy('created_at','desc')->get();
//        ReServeNotifi::dispatch('','','');
    }
}
