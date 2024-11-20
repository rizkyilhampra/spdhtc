<?php

use App\Console\Commands\RecachingCities;
use App\Console\Commands\RecachingProvinces;
use Illuminate\Support\Facades\Schedule;

Schedule::command(RecachingProvinces::class)
    ->daily()
    ->timezone('Asia/Makassar');

Schedule::command(RecachingCities::class)
    ->daily()
    ->timezone('Asia/Makassar');
