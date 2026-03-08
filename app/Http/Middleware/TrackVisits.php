<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->is('admin/*') && ! $request->is('livewire/*')) {
            \App\Models\Visit::firstOrCreate(
                [
                    'ip_hash' => hash('sha256', $request->ip() . config('app.key')),
                    'visited_at' => now()->toDateString(),
                ],
                [
                    'user_agent' => substr((string) $request->userAgent(), 0, 255),
                    'url' => substr($request->fullUrl(), 0, 255),
                ]
            );
        }

        return $next($request);
    }
}
