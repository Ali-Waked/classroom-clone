<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasActiveSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if ($user) {
            $subscriptions = $user->subscriptions()->where('expires_at', '>=', now())->exists();
            if (!$subscriptions) {
                return to_route('plans')->with('info',__('Please Renew Your Subscription'));
            }
        }
        return $next($request);
    }
}
