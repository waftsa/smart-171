<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class UserArticleController extends Controller
{
    //
    public function index()
    {
        // Artikel terbaru tanpa filter
        $articles = Article::where('status', true)->latest()->get();

        // Ambil kategori untuk sidebar atau dropdown
        $categories = Category::where('type', 'articles')->get();

        return view('articles.index', compact('articles', 'categories'));
    }

    public function filter(Request $request)
    {
        $search = $request->query('search');
        // $sortBy = $request->query('sort_by');
        $sortBy = $request->query('sort_by', 'newest');
        $categoryId = $request->query('category');
    
        // Query dasar
        $query = Article::query();
        $query = Article::with('category');
    
        // Filter berdasarkan search
        if ($search) {
            $query->where('title', 'like', "%$search%")
                  ->orWhere('content', 'like', "%$search%");
        }
    
        // Filter berdasarkan kategori
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }
    
        // Filter berdasarkan sort_by
        if ($sortBy) {
            if ($sortBy == 'newest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($sortBy == 'oldest') {
                $query->orderBy('created_at', 'asc');
            }
        }
    
        // Paginate hasil query
        $articles = $query->paginate();
    
        // Ambil kategori
        $categories = Category::where('type', 'articles')->get();
    
        return view('articles.filter', compact('articles', 'categories', 'search', 'sortBy', 'categoryId'));
    }
    

    public function show(Article $article)

    {
        $latestArticles = Article::latest()->take(3)->get();

        // Menampilkan halaman detail untuk dokumentasi tertentu
        return view('articles.show', compact('article', 'latestArticles'));
    }
}
 