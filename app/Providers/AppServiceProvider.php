<?php

namespace App\Providers;

use App\Models\Cms\Menu;
use App\Models\Cms\Setting;
use App\Models\Cms\Visitor;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            // Ambil semua menu utama (beserta child)
            $menus = Menu::whereNull('parent_id')
                ->orderBy('order')
                ->with('children')
                ->get();

            // Ambil pengaturan site
            $setting = Setting::first();

            // --- Visitor Logger ---
            try {
                if (!request()->is('cms/*')) {
                    $ip = request()->ip();
                    $today = now()->toDateString(); // YYYY-MM-DD
                    $agent = new Agent();

                    // Cari visitor hari ini
                    $visitor = Visitor::where('ip', $ip)
                        ->where('visit_date', $today)
                        ->first();

                    if ($visitor) {
                        // Sudah ada -> tambah hit_count
                        $visitor->increment('hit_count');
                    } else {
                        // Lokasi via API
                        $location = 'Unknown';
                        if (in_array($ip, ['127.0.0.1', '::1'])) {
                            $location = 'Localhost';
                        } else {
                            try {
                                $geo = Http::timeout(5)->get(
                                    "http://ip-api.com/json/{$ip}?fields=country,regionName,city,status"
                                )->json();

                                if (!empty($geo) && ($geo['status'] ?? '') === 'success') {
                                    $city    = $geo['city'] ?? '-';
                                    $region  = $geo['regionName'] ?? '-';
                                    $country = $geo['country'] ?? '-';
                                    $location = "{$city}, {$region}, {$country}";
                                }
                            } catch (\Exception $e) {
                                Log::warning("GeoIP lookup failed: " . $e->getMessage());
                            }
                        }

                        // Simpan visitor baru
                        Visitor::create([
                            'ip'         => $ip,
                            'browser'    => $agent->browser(),
                            'platform'   => $agent->platform(),
                            'device'     => $agent->device() ?: 'Desktop',
                            'location'   => $location,
                            'page'       => request()->path(),
                            'hit_count'  => 1,
                            'visit_date' => $today, // <--- pastikan diisi
                        ]);
                    }
                }
            } catch (\Exception $e) {
                Log::error('VisitorLogger error: ' . $e->getMessage());
            }

            // Share ke semua view
            $view->with([
                'menus'   => $menus,
                'setting' => $setting,
            ]);
        });
    }
}
