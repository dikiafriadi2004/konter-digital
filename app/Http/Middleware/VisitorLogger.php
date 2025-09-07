<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Cms\Visitor;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class VisitorLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $agent = new Agent();
        $ip = $request->ip();

        // Ambil data lokasi dari ip-api
        $geo = Http::get("http://ip-api.com/json/{$ip}?fields=country,regionName,city,status")->json();

        $location = '-';
        if (!empty($geo) && ($geo['status'] ?? '') === 'success') {
            $location = ($geo['city'] ?? '-') . ', ' . ($geo['regionName'] ?? '-') . ', ' . ($geo['country'] ?? '-');
        }

        // Simpan ke DB
        Visitor::create([
            'ip'       => $ip,
            'browser'  => $agent->browser(),
            'platform' => $agent->platform(),
            'device'   => $agent->device() ?: 'Desktop',
            'location' => $location,
            'page'     => $request->path(), // contoh: "home", "blog/slug"
        ]);

        return $next($request);
    }
}
