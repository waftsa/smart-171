<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentationRequest;
use App\Http\Requests\UpdateDocumentationRequest;
use App\Models\Category;
use App\Models\Documentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class DocumentationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil parameter search dan sort_by dari query string
    $search = $request->query('search');
    $sortBy = $request->query('sort_by');

    // Query dasar
    $query = Documentation::query()->latest();

    // Filter berdasarkan search
    if ($search) {
        $query->where('title', 'like', "%$search%")
              ->orWhere('caption', 'like', "%$search%");
    }

    // Filter berdasarkan sort_by
    if ($sortBy) {
        if ($sortBy == 'newest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sortBy == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sortBy == 'published') {
            $query->where('status', true);
        } elseif ($sortBy == 'draft') {
            $query->where('status', false);
        }
    }

    // Paginate hasil query
    $documentations = $query->paginate(15);

    // Kembalikan view dengan data
    return view('admin.documentations.index', compact('documentations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.documentations.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocumentationRequest $request)
    {
        $validated = $request->validated();

        
        // Buat dokumentasi baru
        Documentation::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'caption' => $validated['caption'],
            'youtube' => $validated['youtube'],    
            'slider' => $request->input('slider', false), // Mengambil nilai status dari form, default false jika tidak diisi
            'category_id' => $request->input('category_id', false), // Mengambil nilai status dari form, default false jika tidak diisi
            'status' => false,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('admin.documentations.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Documentation $documentation)
    {
        // Cek apakah ada URL YouTube dan ubah ke format embed jika perlu
    // if ($documentation->youtube) {
    //     // Jika URL masih dalam format biasa (contoh: https://www.youtube.com/watch?v=VIDEO_ID)
    //         $documentation->youtube = preg_replace(
    //             '/watch\?v=([a-zA-Z0-9_-]+)/', 
    //             'embed/$1', 
    //             $documentation->youtube
    //         );
    //     }
        
        return view('admin.documentations.show', compact('documentation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Documentation $documentation)
    {
        $categories = Category::all();

        return view('admin.documentations.edit', compact('documentation', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentationRequest $request, Documentation $documentation)
    {
        $validated = $request->validated();

        $data = [
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'caption' => $validated['caption'],
            'status' => $request->input('status', false), // Mengambil nilai status dari form, default false jika tidak diisi
            'slider' => $request->input('slider', false), // Mengambil nilai status dari form, default false jika tidak diisi
            'category_id' => $request->input('category_id', false), // Mengambil nilai status dari form, default false jika tidak diisi
        ];

        if ($request->filled('youtube')) {
            $data['youtube'] = $validated['youtube'];
        }

        // Update dokumentasi
        $documentation->update($data);

        return redirect()->route('admin.documentations.index');
    }

    public function publish(Documentation $documentation)
    {
        $documentation->update(['status' => true]);

        return redirect()->route('admin.documentations.show', $documentation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documentation $documentation)
    {
        $documentation->delete();
        return redirect()->route('admin.documentations.index')->with('success', 'Documentation deleted successfully.');
    }
}
