<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Set locale dari session - PAKSAKAN setiap request
        if (Session::has('locale')) {
            $locale = Session::get('locale');
            App::setLocale($locale);

            // Debug: log ke file
            \Log::info('AppServiceProvider - Setting locale to: ' . $locale);
        }
    }

    public function register()
    {
        //
    }
}
