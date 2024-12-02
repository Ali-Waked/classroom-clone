<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MarkNotificationRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd('hi');
        $id = $request->query('notify');
        $user = $request->user();
        if($id && $user) {
            $notify = $user->unreadNotifications()->find($id);
            $notify->markAsRead();
        }
        return $next($request);
    }
}
