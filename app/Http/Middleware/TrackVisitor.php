<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next)
    {
        // Skip admin panel / api routes if you want
        if ($request->is('admin/*') || $request->is('dashboard') || $request->is('api/*')) {
            return $next($request);
        }

        $ip = $request->ip();
        $today = now()->toDateString();

        // Optional: a simple "name" (you can improve later)
        $name = $request->header('User-Agent') ? 'Guest' : null;

        Visitor::updateOrCreate(
            ['ip' => $ip, 'visit_date' => $today],
            [
                'name' => $name,
                'user_agent' => substr((string) $request->userAgent(), 0, 255),
            ]
        )->increment('visits');

        return $next($request);
    }
}
