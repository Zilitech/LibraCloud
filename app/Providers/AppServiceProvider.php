<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use App\Models\EmailSetting;

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
        // --------------------------
        // 1️⃣ Load Email Settings
        // --------------------------
        if (Schema::hasTable('email_settings')) {
            $emailSettings = EmailSetting::first();

            if ($emailSettings) {
                Config::set('mail.mailers.smtp.transport', strtolower($emailSettings->email_engine) ?: 'smtp');
                Config::set('mail.mailers.smtp.host', $emailSettings->smtp_server ?: '127.0.0.1');
                Config::set('mail.mailers.smtp.port', $emailSettings->smtp_port ?: 587);
                Config::set('mail.mailers.smtp.encryption', strtolower($emailSettings->smtp_security) === 'off' ? null : strtolower($emailSettings->smtp_security));
                Config::set('mail.mailers.smtp.username', $emailSettings->smtp_username);
                Config::set('mail.mailers.smtp.password', $emailSettings->smtp_password);
                Config::set('mail.from.address', $emailSettings->mail_from_address ?: 'hello@example.com');
                Config::set('mail.from.name', $emailSettings->mail_from_name ?: config('app.name'));
            }
        }

        // --------------------------
        // 2️⃣ Load General Settings
        // --------------------------
        $generalSettings = null;
        if (Schema::hasTable('general_settings')) {
            $generalSettings = DB::table('general_settings')->first();
        }

        // Provide default values if no settings found
        if (!$generalSettings) {
            $generalSettings = (object)[
                'site_name' => config('app.name', 'LibraCloud'),
                'logo' => 'images/default-logo.png',
                'background_image' => 'images/default-bg.jpg',
            ];
        }

        // Share settings globally with all views
        View::share('settings', $generalSettings);
    }
}
