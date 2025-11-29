<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class MailHelper
{
    public static function applyEmailSettings()
    {
        $settings = DB::table('email_settings')->first();

        // Check if settings exist and required fields are not null
        if (!$settings || !$settings->smtp_server || !$settings->smtp_username || !$settings->smtp_password) {
            throw new \Exception("SMTP settings are incomplete. Please configure host, username, and password.");
        }

        // Apply SMTP settings dynamically
        config([
            'mail.mailers.smtp.transport' => 'smtp',
            'mail.mailers.smtp.host' => $settings->smtp_server,
            'mail.mailers.smtp.port' => $settings->smtp_port ?? 465,
            'mail.mailers.smtp.encryption' => $settings->smtp_security ?? 'ssl',
            'mail.mailers.smtp.username' => $settings->smtp_username,
            'mail.mailers.smtp.password' => $settings->smtp_password,
            'mail.from.address' => $settings->mail_from_address ?? $settings->smtp_username,
            'mail.from.name' => $settings->mail_from_name ?? 'Library Cloud',
        ]);
    }
}
