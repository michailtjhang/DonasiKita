<?php

namespace App\Providers;

use App\Models\Config;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class SideWidgetProvider extends ServiceProvider
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
        View::composer('front.layout.side_widgetBlog', function ($view) {
            $categories = Category::latest()->get();

            $popular_articles = Blog::whereStatus(1)->orderBy('views', 'desc')->take(3)->get();

            $view->with('popular_articles', $popular_articles);
            $view->with('categories', $categories);
        });

        View::composer('front.layout.navigation', function ($view) {
            $categories = Category::latest()->take(3)->get();
            $view->with('categori_navbar', $categories);
        });
    }
}