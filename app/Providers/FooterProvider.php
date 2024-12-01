<?php

namespace App\Providers;

use App\Models\Config;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class FooterProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('front.layout.footer', function ($view) {
            $configKey = [
                'address',
                'phone',
                'email',
                'facebook',
                'twitter',
                'instagram',
                'youtube',
                'footer'
            ];
            
            // Ambil data konfigurasi
            $config = Config::whereIn('name', $configKey)->pluck('value', 'name');
            $view->with('config', $config);
        });
    }
}