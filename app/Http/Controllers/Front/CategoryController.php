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
    public function index()
    {
        $categories = Category::with('thumbnail')->latest()->paginate(6);

        return view('front.category.index', [
            'categories' => $categories,
        ]);
    }

    public function show($slugCategory)
    {
        return view('front.category.show', [
            'page_title' => 'Category ' . $slugCategory,
            'articles' => Blog::with('category')->whereHas('category', function ($q) use ($slugCategory) {
                $q->where('slug', $slugCategory)
                    ->where('status', 1);
            })->latest()->paginate(6),
            'events' => Event::with('category', 'thumbnail', 'location', 'detailEvent')->whereHas('category', function ($q) use ($slugCategory) {
                $q->where('slug', $slugCategory);
            })->latest()->paginate(6),
            'categories' => $slugCategory
        ]);
    }
}
