<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        return view('front.blog.index', [
            'page_title' => 'Articles & Blog',
            'articles' => Blog::with('category')
                ->filter(request(['keyword', 'category']))
                ->whereStatus(1)
                ->latest()
                ->paginate(8),
        ]);
    }

    public function show($slug)
    {
        $article = Blog::with('category', 'user')->whereSlug($slug)->firstOrFail();
        $article->increment('views');
        return view('front.blog.show', [
            'page_title' => $article->title,
            'article' => $article,
        ]);
    }
}
