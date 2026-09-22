<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\VisitorLog;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only log GET requests to frontend pages (exclude livewire/assets/admin panel calls if desired)
        if ($request->isMethod('GET') && !$request->ajax() && !$request->prefetch()) {
            try {
                $ip = $request->ip() ?: '127.0.0.1';
                $today = Carbon::today();
                $dayOfWeek = Carbon::now()->dayOfWeekIso; // 1 (Mon) to 7 (Sun)

                VisitorLog::firstOrCreate(
                    [
                        'ip_address' => $ip,
                        'visited_date' => $today->format('Y-m-d'),
                    ],
                    [
                        'day_of_week' => $dayOfWeek,
                    ]
                );
            } catch (\Throwable $e) {
                // Ignore any DB logging errors silently so page load is never interrupted
            }
        }

        return $response;
    }
}
