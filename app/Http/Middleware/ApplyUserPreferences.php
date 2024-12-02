<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Symfony\Component\HttpFoundation\Response;

use function PHPSTORM_META\map;

class ApplyUserPreferences
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locales = ['en', 'ar'];
        $locale = Auth::user()?->profile->locale;
        if (!$locale) {
            $user_langueges = array_map(function ($value) {
                if (Str::contains($value, ';q=')) {
                    return substr($value, 0, strpos($value, ';q='));
                }
                return $value;
            }, explode(',', $request->header('accept-language')));
            foreach ($user_langueges as $lang) {
                // dd(in_array($lang,$locales));
                if (in_array($lang, $locales)) {
                    $locale = $lang;
                    break;
                }
            }
            if (!$locale) {
                $locale = LaravelLocalization::getCurrentLocale();
            }
        }
        // if ($locale && (LaravelLocalization::getCurrentLocale() != $locale)) {
        //     $locale = LaravelLocalization::getCurrentLocale();
        // }
        LaravelLocalization::setLocale($locale);
        return $next($request);
    }
}
