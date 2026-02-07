<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\AboutSetting;
use App\Models\ContactSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

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
        // View::composer('*', function ($view) {
        //     $settings = Cache::remember(
        //         'about_settings',
        //         now()->addHours(12),
        //         function () {
        //             return AboutSetting::firstOrCreate(['id' => 1], []);
        //         }
        //     );
        //     $view->with('aboutSettings', $settings);
        // });

        View::composer('*', function ($view) {

            $aboutSettings = Cache::remember(
                'about_settings',
                now()->addHours(12),
                fn () => AboutSetting::firstOrCreate(['id' => 1], [])
            );

            $contactSettings = Cache::remember(
                'contact_settings',
                now()->addHours(12),
                fn () => ContactSetting::firstOrCreate(['id' => 1], [])
            );

            $view->with([
                'aboutSettings'   => $aboutSettings,
                'contactSettings' => $contactSettings,
            ]);
        });

    }
}
