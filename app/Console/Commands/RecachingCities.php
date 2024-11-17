<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\BerandaController;
use Illuminate\Console\Command;

class RecachingCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recache cities data for chart from RajaOngkir API to local cache';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        (new BerandaController())->chartCity();

        $this->info('Cities data has been recached!');
    }
}
