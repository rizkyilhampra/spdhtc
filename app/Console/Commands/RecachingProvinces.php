<?php

namespace App\Console\Commands;

use App\Http\Controllers\KotaProvinsiController;
use Illuminate\Console\Command;

class RecachingProvinces extends Command
{
    protected $signature = 'cache:provinces';

    protected $description = 'Recache provinces data for chart from 3rd party API';

    public function handle()
    {
        (new KotaProvinsiController)->indexProvince();
    }
}
