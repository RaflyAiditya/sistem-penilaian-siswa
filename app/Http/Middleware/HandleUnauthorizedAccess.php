<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleUnauthorizedAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $response = $next($request);
            
            if ($response->getStatusCode() === 403) {
                if ($request->ajax()) {
                    return response()->json([
                        'error' => 'Anda tidak memiliki akses ke halaman tersebut!'
                    ], 403);
                }
                return redirect()->back()->with('unauthorized', 'Anda tidak memiliki akses ke halaman tersebut!');
            }
            
            return $response;
        } catch (\Spatie\Permission\Exceptions\UnauthorizedException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => 'Anda tidak memiliki akses ke halaman tersebut!'
                ], 403);
            }
            return redirect()->back()->with('unauthorized', 'Anda tidak memiliki akses ke halaman tersebut!');
        }
    }
}
