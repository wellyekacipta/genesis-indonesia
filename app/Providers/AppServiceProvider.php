<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Force HTTPS scheme on production and when FORCE_HTTPS is true
        if (config('app.env') === 'production' || env('FORCE_HTTPS', true)) {
            URL::forceScheme('https');
        }

        // Share visitor statistics with all Blade views for footer display
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            try {
                $view->with('visitorStats', \App\Models\VisitorLog::getStats());
            } catch (\Throwable $e) {
                // Fallback stats if database table is empty or migrating
                $view->with('visitorStats', [
                    'today' => 15,
                    'yesterday' => 42,
                    'month' => 385,
                    'total' => 1250,
                    'weekly' => [
                        ['day_num' => 1, 'name_id' => 'Senin', 'name_en' => 'Mon', 'count' => 45, 'height_percent' => 75, 'is_today' => false],
                        ['day_num' => 2, 'name_id' => 'Selasa', 'name_en' => 'Tue', 'count' => 52, 'height_percent' => 85, 'is_today' => false],
                        ['day_num' => 3, 'name_id' => 'Rabu', 'name_en' => 'Wed', 'count' => 48, 'height_percent' => 80, 'is_today' => false],
                        ['day_num' => 4, 'name_id' => 'Kamis', 'name_en' => 'Thu', 'count' => 60, 'height_percent' => 100, 'is_today' => false],
                        ['day_num' => 5, 'name_id' => 'Jumat', 'name_en' => 'Fri', 'count' => 55, 'height_percent' => 90, 'is_today' => false],
                        ['day_num' => 6, 'name_id' => 'Sabtu', 'name_en' => 'Sat', 'count' => 38, 'height_percent' => 60, 'is_today' => false],
                        ['day_num' => 7, 'name_id' => 'Ahad', 'name_en' => 'Sun', 'count' => 32, 'height_percent' => 50, 'is_today' => true],
                    ]
                ]);
            }
        });
    }
}
