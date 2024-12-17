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
                ->paginate(9), // 9 item per halaman
        ]);
    }

    public function show($slug)
    {
        $article = Blog::with('category', 'user')->whereSlug($slug)->firstOrFail();
        $article->increment('views');
        
        // Generate keywords dari deskripsi
        $keywords = $this->generateKeywords($article->content);

        return view('front.blog.show', [
            'page_title' => $article->title,
            'article' => $article,
            'keywords' => $keywords
        ]);
    }

    function generateKeywords($description, $limit = 10)
    {
        // Hilangkan karakter spesial
        $description = strtolower(preg_replace('/[^\p{L}\p{N}\s]/u', '', $description));

        // Pisahkan kata-kata
        $words = explode(' ', $description);

        // Hilangkan kata-kata umum (stop words)
        $stopWords = ['dan', 'atau', 'yang', 'di', 'ke', 'dari', 'ini', 'itu', 'adalah', 'sebagai', 'dengan', 'untuk'];
        $filteredWords = array_filter($words, function ($word) use ($stopWords) {
            return !in_array($word, $stopWords) && strlen($word) > 2;
        });

        // Hitung frekuensi kata
        $wordCounts = array_count_values($filteredWords);

        // Urutkan berdasarkan frekuensi
        arsort($wordCounts);

        // Ambil kata-kata paling sering muncul
        $keywords = array_keys(array_slice($wordCounts, 0, $limit, true));

        // Gabungkan menjadi string keyword
        return implode(', ', $keywords);
    }
}
