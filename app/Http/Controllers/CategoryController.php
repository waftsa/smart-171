<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //
        $categories = Category::orderBy('type', 'asc')->get();
        // Kembalikan view dengan data
        return view('admin.categories.index', compact('categories'));
    }
    
    public function filter(Request $request){
        $search = $request->query('search');
        $sortBy = $request->query('sort_by');

        // Query dasar
        $query = Category::query();

        // Filter berdasarkan search
        if ($search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('about', 'like', "%$search%");
        }

        // Filter berdasarkan sort_by
        if ($sortBy) {
            if ($sortBy == 'newest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($sortBy == 'oldest') {
                $query->orderBy('created_at', 'asc');
            } elseif ($sortBy == 'articles') {
                $query->where('type' =='articles');
            } elseif ($sortBy == 'donations') {
                $query->where('type' == 'donations');
            }
        }

        // Paginate hasil query
        $categories = $query->paginate();

        // Kembalikan view dengan data
        return view('admin.categories.index', compact('categories'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validasi input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'icon' => 'required|image|mimes:png,jpg,jpeg|max:2048', // Maksimal ukuran 2MB
    ]);

    $iconUrl = null;
    $iconPublicId = null;

    if ($request->hasFile('icon')) {
        $uploadedFile = $request->file('icon');

        // Upload ke Cloudinary
        $uploadResult = Cloudinary::upload($uploadedFile->getRealPath(), [
            'folder' => 'categories/icons'
        ]);

        // Dapatkan URL gambar & Public ID
        $iconUrl = $uploadResult->getSecurePath();
        $iconPublicId = $uploadResult->getPublicId();
    }

    // Buat slug berdasarkan nama kategori
    $validated['slug'] = Str::slug($validated['name'], '-') . '-' . Str::random(5);

    // Simpan ikon jika ada file diunggah
    if ($request->hasFile('icon')) {
        $validated['icon'] = $request->file('icon')->store('category_icons', 'public');
    }

    // Simpan data ke dalam database
    Category::create([
        'name' => $validated['name'],
        'slug' => Str::slug($validated['name']),
        'type' => $validated['type'],
        'icon' => $iconUrl,
        'icon_public_id' => $iconPublicId,
    ]);

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        return view('admin.categories.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);
    
        // Perbarui slug jika ada perubahan category
        if ($request->has('name') && $request->name != $category->name) {
            $validated['slug'] = Str::slug($validated['name'], '-') . '-' . Str::random(5);
        }
    
        if ($request->hasFile('icon')) {
            // Hapus gambar lama jika ada
            if ($category->icon_public_id) {
                Cloudinary::destroy($category->icon_public_id);
            }

            // Upload gambar baru
            $uploadedFile = $request->file('icon');
            $uploadResult = Cloudinary::upload($uploadedFile->getRealPath(), [
                'folder' => 'categories/icons'
            ]);

            $category->icon = $uploadResult->getSecurePath();
            $category->icon_public_id = $uploadResult->getPublicId(); // Simpan Public ID
        }

        $category->name = $validated['name'];
        $category->type = $validated['type'];
        // Update kategori
        $category->save();
    
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->icon_public_id) {
            Cloudinary::destroy($category->icon_public_id);
        }
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Donation deleted successfully!');
    }
}
