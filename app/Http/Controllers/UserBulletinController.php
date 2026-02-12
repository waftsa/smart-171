<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBulletinRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Bulletin;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserBulletinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Artikel terbaru tanpa filter
        $bulletins = Bulletin::latest()->paginate(12);

        return view('bulletins.index', compact('bulletins'));
    }

    public function filter(Request $request)
    {
        $search = $request->query('search');
        // $sortBy = $request->query('sort_by');
        $sortBy = $request->query('sort_by', 'newest');
        $categoryId = $request->query('category');
    
        // Query dasar
        $query = Bulletin::query();
        $query = Bulletin::with('category');
    
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
        $bulletins = $query->paginate();

    
        return view('bulletins.filter', compact('bulletins', 'search', 'sortBy', 'categoryId'));
    }
    

    public function show(Bulletin $bulletin)

    {
        $latestBulletins = Bulletin::latest()->take(3)->get();

        // Menampilkan halaman detail untuk dokumentasi tertentu
        return view('bulletins.show', compact('bulletin', 'latestBulletins'));
    }
}

