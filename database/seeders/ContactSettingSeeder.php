<?php

namespace Database\Seeders;

use App\Models\ContactSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSettingSeeder extends Seeder
{
    public function run(): void
    {
        ContactSetting::updateOrCreate(
            ['id' => 1],
            [
                'page_meta' => [
                    'kicker' => 'CONTACT_PROTOCOL',
                    'heading' => 'CONTACT_INTERFACE',
                ],
                'contact_cards' => [
                    'email' => 'sutradhar019@gmail.com',
                    'phone' => '+880 1928040976',
                    'location' => 'Dhaka, Bangladesh',
                    'timezone' => 'BST (UTC+6)',
                    'github' => 'https://github.com/bappa0409',
                ],
                'social_links' => [
                    'linkedin' => 'https://www.linkedin.com/in/bappa-sutradhar-94261b160',
                    'facebook' => 'https://www.facebook.com/bappa040976',
                    'whatsapp' => 'https://wa.me/8801928040976',
                    'telegram' => 'https://t.me/bappa0409',
                ],
            ]
        );
    }
}
