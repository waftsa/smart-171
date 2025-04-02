<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Documentation;
use Illuminate\Http\Request;

class UserDocumentationController extends Controller
{
    //
    public function index()
    {
        $categories = Category::where('type', 'documentations')
                    ->with(['documentations' => function ($query) {
                        $query->where('status', true)->latest();
                    }])->get();
        // Kembalikan view dengan data
        return view('documentations.index', compact('categories'));
    }

    // public function filter(Request $request){
    //     $search = $request->query('search');
    //     $sortBy = $request->query('sort_by');

    //     // Query dasar
    //     $query = Documentation::query();

    //     // Filter berdasarkan search
    //     if ($search) {
    //         $query->where('title', 'like', "%$search%")
    //                 ->orWhere('caption', 'like', "%$search%");
    //     }

    //     // Filter berdasarkan sort_by
    //     if ($sortBy) {
    //         if ($sortBy == 'newest') {
    //             $query->orderBy('created_at', 'desc');
    //         } elseif ($sortBy == 'oldest') {
    //             $query->orderBy('created_at', 'asc');
    //         } 
    //     }

    //     // Paginate hasil query
    //     $documentations = $query->paginate();

    //     // Kembalikan view dengan data
    //     return view('documentations.index', compact('documentations'));
    // }

    public function show($id)
    {
        // Menampilkan halaman detail untuk dokumentasi tertentu

    $documentation = Documentation::findOrFail($id);
    $category = $documentation->category; // Mengambil kategori yang relevan
    
    // Controller
    $documentations = $category->documentations()->where('status', true)->latest()->get();

    $categories = Category::where('type', 'documentations')
    ->with(['documentations' => function ($query) {
        $query->where('status', true)->latest();
    }])->get();

    return view('documentations.show', compact('documentation', 'documentations', 'category', 'categories'));
    }
}
