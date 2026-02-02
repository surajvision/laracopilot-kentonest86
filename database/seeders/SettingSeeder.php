<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'site_name',
                'value' => 'TaskFlow Platform',
                'type' => 'text',
                'description' => 'The name of the website'
            ],
            [
                'key' => 'site_email',
                'value' => 'contact@taskflow.com',
                'type' => 'email',
                'description' => 'Primary contact email address'
            ],
            [
                'key' => 'site_phone',
                'value' => '+1 (555) 123-4567',
                'type' => 'text',
                'description' => 'Primary contact phone number'
            ],
            [
                'key' => 'min_points_withdrawal',
                'value' => '1000',
                'type' => 'number',
                'description' => 'Minimum points required for withdrawal'
            ],
            [
                'key' => 'points_to_currency_rate',
                'value' => '100',
                'type' => 'number',
                'description' => 'Points needed to equal $1'
            ],
            [
                'key' => 'enable_kyc',
                'value' => 'true',
                'type' => 'boolean',
                'description' => 'Enable KYC verification requirement'
            ],
            [
                'key' => 'max_daily_tasks',
                'value' => '10',
                'type' => 'number',
                'description' => 'Maximum tasks a user can complete per day'
            ],
            [
                'key' => 'maintenance_mode',
                'value' => 'false',
                'type' => 'boolean',
                'description' => 'Enable maintenance mode for the site'
            ],
            [
                'key' => 'welcome_message',
                'value' => 'Welcome to TaskFlow! Complete tasks and earn rewards.',
                'type' => 'textarea',
                'description' => 'Welcome message displayed on homepage'
            ],
            [
                'key' => 'admin_notification_email',
                'value' => 'admin@taskflow.com',
                'type' => 'email',
                'description' => 'Email for admin notifications'
            ]
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}