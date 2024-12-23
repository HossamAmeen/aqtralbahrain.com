<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if(Session::get('locale') != null)
        // {
        //     App::setLocale(Session::get('locale'));
        // }else
        // {
        //     Session::put('locale','en');
        //     App::setLocale(Session::get('locale'));
        // }
        App::setLocale('ar');
        
        return $next($request);
    }
}
