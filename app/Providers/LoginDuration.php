<?php

namespace App\Providers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class LoginDuration extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.admin.app', function ($view) {
            $view->with('loginDuration', Controller::LoginDuration());
        });
    }
}
