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
                'logo',
                'name',
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

        View::composer([
            'front.about.about',
            'front.blog.index',
            'front.category.indexBlog',
            'front.category.indexEvent',
            'front.category.showEvent',
            'front.category.showBlog',
            'front.event.index',
            'front.donation.index',
        ], function ($view) {
            $configKey = [
                'logo',
                'name',
                'meta_title',
                'meta_description',
                'meta_keywords',
            ];

            // Ambil data konfigurasi
            $config = Config::whereIn('name', $configKey)->pluck('value', 'name');

            $view->with('config', $config);
        });

        View::composer('front.about.about', function ($view) {
            $page = Pages::where('name', 'about')->firstOrFail();
            $content = json_decode($page->content, true);

            $view->with('content', $content);
        });
    }
}
