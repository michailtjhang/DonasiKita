<?php

namespace App\Http\Controllers\Front;

use App\Models\Article;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;

class CategoryController extends Controller
{
    public function indexBlog()
    {
        $categories = Category::with('thumbnail')->latest()->paginate(6);

        return view('front.category.indexBlog', [
            'categories' => $categories,
        ]);
    }

    public function indexEvent()
    {
        $categories = Category::with('thumbnail')->latest()->paginate(6);

        return view('front.category.indexEvent', [
            'categories' => $categories,
        ]);
    }

    public function showBlog($slugCategory)
    {
        return view('front.category.showBlog', [
            'page_title' => 'Category ' . $slugCategory,
            'articles' => Blog::with('category')->whereHas('category', function ($q) use ($slugCategory) {
                $q->where('slug', $slugCategory)
                    ->where('status', 1);
            })->latest()->paginate(6),
            'categories' => $slugCategory
        ]);
    }

    public function showEvent($slugCategory)
    {
        return view('front.category.showEvent', [
            'page_title' => 'Category ' . $slugCategory,
            'events' => Event::with('category', 'thumbnail', 'location', 'detailEvent')->whereHas('category', function ($q) use ($slugCategory) {
                $q->where('slug', $slugCategory);
            })->latest()->paginate(6),
            'categories' => $slugCategory
        ]);
    }
}
