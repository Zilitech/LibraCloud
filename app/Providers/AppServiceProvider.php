<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

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
    $settings = null;

    // Run this only if table exists (prevents migration/composer errors)
    if (Schema::hasTable('general_settings')) {
        $settings = DB::table('general_settings')->first();
    }

    

    // Provide default values if no settings found OR table doesn’t exist yet
    if (!$settings) {
        $settings = (object) [
            'site_name' => 'My Website',
            'logo' => 'images/default-logo.png',
            'background_image' => 'images/default-bg.jpg',
        ];
    }

    // Share settings globally with all views
    View::share('settings', $settings);
}



}
