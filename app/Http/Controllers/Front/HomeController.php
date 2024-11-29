<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Config;

class HomeController extends Controller
{
    public function home()
    {
        return view('front.home.home');
    }
    public function about()
    {
        return view('front.about.about');
    }
    public function donation()
    {
        $donations =
            [
                [
                    'title' => 'Bantu Pendidikan Anak Pedalaman',
                    'category' => 'Yayasan Anak Nusantara',
                    'target' => 'Rp 50.000.000',
                    'collected' => 'Rp 5.550.000',
                    'donors' => '285 Donatur',
                    'daysLeft' => '50 Hari Lagi',
                    'img' => '/images/donate/1.svg'
                ],
                [
                    'title' => 'Aksi Bencana Alam untuk Korban Gempa',
                    'category' => 'Komunitas Peduli Sesama',
                    'target' => 'Rp 100.000.000',
                    'collected' => 'Rp 10.050.000',
                    'donors' => '598 Donatur',
                    'daysLeft' => '41 Hari Lagi',
                    'img' => '/images/donate/2.svg'
                ],
                [
                    'title' => 'Bantuan Kemanusiaan untuk Palestina',
                    'category' => 'Yayasan Peduli Palestina',
                    'target' => 'Rp 200.000.000',
                    'collected' => 'Rp 70.000.000',
                    'donors' => '1.088 Donatur',
                    'daysLeft' => '57 Hari Lagi',
                    'img' => '/images/donate/3.svg'
                ],
                [
                    'title' => 'Renovasi Masjid di Pelosok Negeri',
                    'category' => 'Yayasan Cahaya Iman',
                    'target' => 'Rp 150.000.000',
                    'collected' => 'Rp 37.500.000',
                    'donors' => '320 Donatur',
                    'daysLeft' => '32 Hari Lagi',
                    'img' => '/images/donate/4.svg'
                ],
                [
                    'title' => 'Operasi Gratis untuk Penderita Bibir Sumbing',
                    'category' => 'Komunitas Senyuman Baru',
                    'target' => 'Rp 400.000.000',
                    'collected' => 'Rp 100.000.000',
                    'donors' => '190 Donatur',
                    'daysLeft' => '44 Hari Lagi',
                    'img' => '/images/donate/5.svg'
                ],
                [
                    'title' => 'Bantu Petani Lokal di Masa Sulit',
                    'category' => 'Lembaga Petani Sejahtera',
                    'target' => 'Rp 120.000.000',
                    'collected' => 'Rp 30.000.000',
                    'donors' => '160 Donatur',
                    'daysLeft' => '30 Hari Lagi',
                    'img' => '/images/donate/6.svg'
                ],
                [
                    'title' => 'Kursi Roda untuk Penyandang Disabilitas',
                    'category' => 'Yayasan Sahabat Difabel',
                    'target' => 'Rp 50.000.000',
                    'collected' => 'Rp 12.500.000',
                    'donors' => '50 Donatur',
                    'daysLeft' => '28 Hari Lagi',
                    'img' => '/images/donate/7.svg'
                ],
                [
                    'title' => 'Air Bersih untuk Daerah Terdampak Kekeringan',
                    'category' => 'Lembaga Air untuk Kehidupan',
                    'target' => 'Rp 300.000.000',
                    'collected' => 'Rp 75.000.000',
                    'donors' => '300 Donatur',
                    'daysLeft' => '40 Hari Lagi',
                    'img' => '/images/donate/8.svg'
                ],
                [
                    'title' => 'Makanan untuk Anak Yatim',
                    'category' => 'Komunitas Kasih Anak Yatim',
                    'target' => 'Rp 100.000.000',
                    'collected' => 'Rp 25.000.000',
                    'donors' => '92 Donatur',
                    'daysLeft' => '22 Hari Lagi',
                    'img' => '/images/donate/9.svg'
                ],
                [
                    'title' => 'Bantu Pendidikan Anak Pedalaman',
                    'category' => 'Yayasan Anak Nusantara',
                    'target' => 'Rp 50.000.000',
                    'collected' => 'Rp 5.550.000',
                    'donors' => '285 Donatur',
                    'daysLeft' => '50 Hari Lagi',
                    'img' => '/images/donate/1.svg'
                ],
                [
                    'title' => 'Aksi Bencana Alam untuk Korban Gempa',
                    'category' => 'Komunitas Peduli Sesama',
                    'target' => 'Rp 100.000.000',
                    'collected' => 'Rp 10.050.000',
                    'donors' => '598 Donatur',
                    'daysLeft' => '41 Hari Lagi',
                    'img' => '/images/donate/2.svg'
                ],
                [
                    'title' => 'Bantuan Kemanusiaan untuk Palestina',
                    'category' => 'Yayasan Peduli Palestina',
                    'target' => 'Rp 200.000.000',
                    'collected' => 'Rp 70.000.000',
                    'donors' => '1.088 Donatur',
                    'daysLeft' => '57 Hari Lagi',
                    'img' => '/images/donate/3.svg'
                ],
                [
                    'title' => 'Renovasi Masjid di Pelosok Negeri',
                    'category' => 'Yayasan Cahaya Iman',
                    'target' => 'Rp 150.000.000',
                    'collected' => 'Rp 37.500.000',
                    'donors' => '320 Donatur',
                    'daysLeft' => '32 Hari Lagi',
                    'img' => '/images/donate/4.svg'
                ],
                [
                    'title' => 'Operasi Gratis untuk Penderita Bibir Sumbing',
                    'category' => 'Komunitas Senyuman Baru',
                    'target' => 'Rp 400.000.000',
                    'collected' => 'Rp 100.000.000',
                    'donors' => '190 Donatur',
                    'daysLeft' => '44 Hari Lagi',
                    'img' => '/images/donate/5.svg'
                ],
                [
                    'title' => 'Bantu Petani Lokal di Masa Sulit',
                    'category' => 'Lembaga Petani Sejahtera',
                    'target' => 'Rp 120.000.000',
                    'collected' => 'Rp 30.000.000',
                    'donors' => '160 Donatur',
                    'daysLeft' => '30 Hari Lagi',
                    'img' => '/images/donate/6.svg'
                ],
                [
                    'title' => 'Kursi Roda untuk Penyandang Disabilitas',
                    'category' => 'Yayasan Sahabat Difabel',
                    'target' => 'Rp 50.000.000',
                    'collected' => 'Rp 12.500.000',
                    'donors' => '50 Donatur',
                    'daysLeft' => '28 Hari Lagi',
                    'img' => '/images/donate/7.svg'
                ],
                [
                    'title' => 'Air Bersih untuk Daerah Terdampak Kekeringan',
                    'category' => 'Lembaga Air untuk Kehidupan',
                    'target' => 'Rp 300.000.000',
                    'collected' => 'Rp 75.000.000',
                    'donors' => '300 Donatur',
                    'daysLeft' => '40 Hari Lagi',
                    'img' => '/images/donate/8.svg'
                ],
                [
                    'title' => 'Makanan untuk Anak Yatim',
                    'category' => 'Komunitas Kasih Anak Yatim',
                    'target' => 'Rp 100.000.000',
                    'collected' => 'Rp 25.000.000',
                    'donors' => '92 Donatur',
                    'daysLeft' => '22 Hari Lagi',
                    'img' => '/images/donate/9.svg'
                ]
            ];
        foreach ($donations as &$donation) {
            $donation['target'] = (int) str_replace(['Rp', '.', ','], '', $donation['target']);
            $donation['collected'] = (int) str_replace(['Rp', '.', ','], '', $donation['collected']);
        }

        return view('front.donation.donation', compact('donations'));
    }
    public function detail_event()
    {
        return view('front.detail_event.detail_event');
    }
    public function event_category_all()
    {
        return view('front.event_category_all.event_category_all');
    }
    public function event_category_specific()
    {
        return view('front.event_category_specific.event_category_specific');
    }
    public function detail_donation()
    {
        return view('front.detail_donation.detail_donation');
    }
    public function blog_categories_specific()
    {
        return view('front.blog_categories.blog_categories_specific');
    }
    public function transfer_guest()
    {
        return view('front.payment_transfer.transfer_guest');
    }
    public function transfer_login()
    {
        return view('front.payment_transfer.transfer_login');
    }
    public function confirmationtransfer()
    {
        return view('front.payment_transfer.confirmationtransfer');
    }
}
