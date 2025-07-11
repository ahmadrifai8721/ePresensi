<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Absen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Setting::first("presensiStatus")->presensiStatus) {
            # code...
            return $next($request);
        } else {
            // dd(url()->current());
            if (url()->current() == url('api/*')) {
                return response()->json([
                    'status' => false,
                    'message' => 'Absen Sedang Di tutup',
                ], 403);
            } else {

                return abort(403, "Absen Sedang Di tutup");
            }
        }
    }
}
