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
                        'image' => '/images/about/logo.svg'
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
                        ]
                    ]
                ]),
                'created_at' => '2024-09-24 20:25:36',
                'updated_at' => '2024-09-24 20:25:36'
            ],
            [
                'id' => '01j8kkdk3abh0a671dr5rqkshy',
                'name' => 'home',
                'content' => json_encode([
                    'hero_section' => [
                        'carousel' => [
                            [
                                'title' => 'Bantu anak kurang gizi',
                                'subtitle' => 'Yuk Bantu anak-anak di desa mendapatkan gizi yang pantas',
                                'image' => '/images/hero-bg.svg',
                                'button_link' => 'Bantu Sekarang'
                            ],
                            [
                                'title' => 'Darurat Gunung Lewotobi',
                                'subtitle' => 'Bersama membantu korban yang terdampak bencana alam ini',
                                'image' => '/images/hero/2.svg',
                                'button_link' => 'Bantu Sekarang'
                            ],
                            [
                                'title' => 'Banjir di Desa Rawajaya',
                                'subtitle' => 'Ayo tolong Bencana yang disebabkan limpasan air dari sungai Jakadenda',
                                'image' => '/images/hero/3.svg',
                                'button_link' => 'Bantu Sekarang'
                            ],
                            [
                                'title' => 'Tanah Longsor di Desa Kertajaya',
                                'subtitle' => 'Ayo buat transportasi lancar dari tanah longsor yang menimpa jalan',
                                'image' => '/images/hero/4.svg',
                                'button_link' => 'Bantu Sekarang'
                            ]
                        ]
                    ],
                    'about_section' => [
                        'title' => 'Kamu Adalah Harapan Lainnya',
                        'description' => '<span class="fw-bold">DonasiKita</span> meyakinkan Anda untuk menjadi bagian dari perubahan positif melalui platform donasi yang transparan, aman, dan terpercaya...',
                        'image' => '/images/content/about.svg'
                    ],
                    'quote_section' => [
                        'quote' => '"Sebaik-baik manusia adalah yang paling bermanfaat bagi orang lain."',
                        'author' => 'Rasulullah SAW',
                        'image' => '/images/quotes.svg'
                    ],
                    'faq_section' => [
                        'faq' => [
                            [
                                'questions' => 'Apa itu DonasiKita?',
                                'answers' => 'DonasiKita adalah platform digital yang memudahkan siapa saja untuk berdonasi dan berkontribusi dalam berbagai proyek kemanusiaan, seperti pendidikan, kesehatan, bencana alam, dan lainnya.'
                            ],
                            [
                                'questions' => 'Bagaimana cara membuat akun di DonasiKita?',
                                'answers' => 'Klik tombol "Daftar," isi data pribadi Anda, dan ikuti langkah-langkah pendaftaran yang sederhana.'
                            ],
                            [
                                'questions' => 'Bagaimana cara berdonasi di DonasiKita?',
                                'answers' => 'Anda bisa memilih proyek yang ingin didukung, klik tombol "Donasi Sekarang," masukkan jumlah donasi, dan pilih metode pembayaran yang tersedia.'
                            ],
                            [
                                'questions' => 'Apakah ada batas minimum untuk berdonasi?',
                                'answers' => 'Ya, batas minimum donasi adalah Rp10.000 untuk memudahkan semua orang berpartisipasi.'
                            ],
                            [
                                'questions' => 'Apakah DonasiKita aman?',
                                'answers' => 'Ya, DonasiKita menggunakan teknologi keamanan terbaru dan memastikan setiap donasi tercatat serta disalurkan sesuai tujuan.'
                            ]
                        ]
                    ]
                ]),  // Tambahkan data kosong untuk kolom content
                'created_at' => '2024-09-24 20:25:55',
                'updated_at' => '2024-09-24 20:25:55'
            ]
        ]);
    }
}
