<?php

namespace App\Console\Commands;

use App\Http\Controllers\KotaProvinsiController;
use Illuminate\Console\Command;

class RecachingProvinces extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:provinces';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recache provinces data from RajaOngkir API to local cache';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        (new KotaProvinsiController())->indexProvince();
    }
}
