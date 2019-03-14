<?php

namespace App\Http\Middleware;
use Closure;
class Cors {

    public function handle($request, Closure $next) {
        $allowedOrigins = ['*'];
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
        if (in_array($origin, $allowedOrigins)) {
            return $next($request)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', '*')
                ->header('Access-Control-Allow-Headers','*')
                ->header('Access-Control-Allow-Credentials',' true');
        }
        return $next($request);
    }
}
