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
                'name' => 'title_home',
                'value' => 'Charity Platform'
            ],
            [
                'name' => 'caption',
                'value' => 'Bersama Kami Membangun, Bersama Kami Mengubah'
            ],
            [
                'name' => 'subtitle_home',
                'value' => 'Berbagai, Berkontribusi, Berubah.'
            ],
            [
                'name' => 'heading_home',
                'value' => 'Kamu Adalah Harapan Lainnya'
            ],
            [
                'name' => 'description_heading_home',
                'value' => 'DonasiKita meyakinkan Anda untuk menjadi bagian dari perubahan positif melalui platform donasi yang transparan, aman, dan terpercaya. Dengan menghubungkan donatur dengan beragam program bantuan, kami berkomitmen untuk memperkuat solidaritas sosial serta memberdayakan komunitas yang membutuhkan di seluruh Indonesia. Bersama, kita dapat menciptakan masa depan yang lebih peduli, inklusif, dan berdaya, di mana setiap kontribusi kecil membawa dampak besar bagi mereka yang membutuhkan uluran tangan kita.'
            ],
            [
                'name' => 'quotes_home_section',
                'value' => '"Sebaik-baik manusia adalah yang paling bermanfaat bagi orang lain."'
            ],
            [
                'name' => 'author_quotes_home_section',
                'value' => 'Rasulullah SAW'
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