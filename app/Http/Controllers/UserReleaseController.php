<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Release;
use Illuminate\Http\Request;

class UserReleaseController extends Controller
{
    //
    public function index()
    {
        // Artikel terbaru tanpa filter
        $releases = Release::where('status', true)->latest()->get();

        // Ambil kategori untuk sidebar atau dropdown
        $categories = Category::where('type', 'releases')->get();

        return view('releases.index', compact('releases', 'categories'));
    }

    public function filter(Request $request)
    {
        $search = $request->query('search');
        // $sortBy = $request->query('sort_by');
        $sortBy = $request->query('sort_by', 'newest');
        $categoryId = $request->query('category');
    
        // Query dasar
        $query = release::query();
        $query = release::with('category');
    
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
        $releases = $query->paginate();
    
        // Ambil kategori
        $categories = Category::where('type', 'releases')->get();
    
        return view('releases.filter', compact('releases', 'categories', 'search', 'sortBy', 'categoryId'));
    }
    

    public function show(Release $release)

    {
        $latestReleases = Release::latest()->take(3)->get();

        // Menampilkan halaman detail untuk dokumentasi tertentu
        return view('releases.show', compact('release', 'latestReleases'));
    }
}
 