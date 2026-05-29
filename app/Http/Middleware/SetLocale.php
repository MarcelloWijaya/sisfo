<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // Cek session dulu
        if (Session::has('locale')) {
            $locale = Session::get('locale');
            App::setLocale($locale);
        }
        // Jika tidak ada, cek request parameter
        elseif ($request->has('locale')) {
            $locale = $request->get('locale');
            if (in_array($locale, ['en', 'id'])) {
                Session::put('locale', $locale);
                App::setLocale($locale);
            }
        }

        // Force set jika masih kosong
        if (!App::getLocale()) {
            App::setLocale('en');
        }

        return $next($request);
    }
}
