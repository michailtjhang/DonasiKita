<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pages')->insert([
            [
                'id' => '01j8kkd0j357ddxkdq75etr7q2',
                'name' => 'about',
                'content' => json_encode([
                    'hero_section' => [
                        'title' => 'About Page',
                        'subtitle' => 'Halaman About Us DonasiKita Foundation menjelaskan misi kami sebagai platform donasi yang aman, transparan, dan berdampak, serta memperkenalkan tim yang bekerja di baliknya.'
                    ],
                    'company_section' => [
                        'name' => 'DonasiKita Foundation',
                        'description' => 'DonasiKita Foundation adalah organisasi nirlaba yang bertujuan mempermudah proses donasi bagi masyarakat dengan menyediakan platform aman dan transparan. Kami mendukung berbagai kampanye kemanusiaan dan sosial, membantu para donatur memberikan dampak positif bagi yang membutuhkan di seluruh Indonesia dan dunia.',
                        'logo' => '/images/about/logo.svg'
                    ],
                    'founder_section' => [
                        'name' => 'Rian Pratama',
                        'position' => 'Founder & CEO',
                        'image' => '/images/about/leader.svg'
                    ],
                    'team_section' => [
                        [
                            'name' => 'Lestari Dewi',
                            'position' => 'Chief Operating Officer',
                            'image' => '/images/about/lestari.svg'
                        ],
                        [
                            'name' => 'Andi Wijaya',
                            'position' => 'Chief Financial Officer',
                            'image' => '/images/about/andi.svg'
                        ],
                        [
                            'name' => 'Maya Puspita',
                            'position' => 'Head of Marketing',
                            'image' => '/images/about/leader.svg'
                        ],
                        [
                            'name' => 'Ridwan Santoso',
                            'position' => 'Head of Partnerships',
                            'image' => '/images/about/ridwan.svg'
                        ],
                        [
                            'name' => 'Fitri Rahmawati',
                            'position' => 'Head of Community',
                            'image' => '/images/about/fitri.svg'
                        ],
                        [
                            'name' => 'Dika Saputra',
                            'position' => 'Head of Technology',
                            'image' => '/images/about/dika.svg'
                        ],
                        [
                            'name' => 'Nina Amalia',
                            'position' => 'Head of Communications',
                            'image' => '/images/about/nina.svg'
                        ]
                    ]
                ]),
                'created_at' => '2024-09-24 20:25:36',
                'updated_at' => '2024-09-24 20:25:36'
            ],
            [
                'id' => '01j8kkdk3abh0a671dr5rqkshy',
                'name' => 'home',
                'content' => json_encode([]),  // Tambahkan data kosong untuk kolom content
                'created_at' => '2024-09-24 20:25:55',
                'updated_at' => '2024-09-24 20:25:55'
            ]
        ]);
    }
}
