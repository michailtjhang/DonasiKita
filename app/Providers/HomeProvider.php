<?php

namespace App\Providers;

use App\Models\Config;
use App\Models\Pages;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class HomeProvider extends ServiceProvider
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
        // View Config In Home 
        View::composer('front.home.home', function ($view) {
            $configKey = [
                'title_home',
                'caption',
                'subtitle_home',
                'heading_home',
                'description_heading_home',
                'quotes_home_section',
                'author_quotes_home_section',
                'meta_title',
                'meta_description',
                'meta_keywords',
            ];

            $page = Pages::where('name', 'home')->firstOrFail();
            $content = json_decode($page->content, true);
            
            // Ambil data konfigurasi
            $config = Config::whereIn('name', $configKey)->pluck('value', 'name');

            $view->with('config', $config);
            $view->with('content', $content);
        });
    }
}
