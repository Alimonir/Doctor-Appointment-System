<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('Before Session Check', [
            'session_locale' => Session::get('locale'),
            'app_locale' => App::getLocale(),
        ]);

        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }

        Log::info('After Setting Locale', [
            'session_locale' => Session::get('locale'),
            'app_locale' => App::getLocale(),
        ]);
        return $next($request);
    }
}
