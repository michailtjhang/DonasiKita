<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Config::insert([
            [
                'name' => 'logo',
                'value' => 'logo.png'
            ],
            [
                'name' => 'website_name',
                'value' => 'DonasiKita'
            ],
            [
                'name' => 'meta_title',
                'value' => 'DonasiKita'
            ],
            [
                'name' => 'meta_description',
                'value' => 'DonasiKita is a simple system with Laravel and Bootstrap.'
            ],
            [
                'name' => 'meta_keywords',
                'value' => 'DonasiKita, Laravel, Bootstrap'
            ],
            [
                'name' => 'address',
                'value' => 'Jl. Contoh No. 123, Contoh, Contoh, Contoh'
            ],
            [
                'name' => 'phone',
                'value' => '+6281234567890'
            ],
            [
                'name' => 'email',
                'value' => 'QW8kA@example.com'
            ],
            [
                'name' => 'facebook',
                'value' => 'https://facebook.com'
            ],
            [
                'name' => 'twitter',
                'value' => 'https://twitter.com'
            ],
            [
                'name' => 'instagram',
                'value' => 'https://instagram.com'
            ],
            [
                'name' => 'youtube',
                'value' => 'https://youtube.com'
            ],
            [
                'name' => 'footer',
                'value' => 'DonasiKita and Donasi Kita are trademarks of DonasiKita in Indonesia. @2023 DonasiKita. All rights reserved.'
            ]
        ]);
    }
}