<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReleaseRequest;
use App\Http\Requests\UpdateReleaseRequest;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\Category;
use App\Models\Release;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReleaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $search = $request->query('search');
        $sortBy = $request->query('sort_by');

        // Query dasar
        $query = Release::query();

        // Filter berdasarkan search
        if ($search) {
            $query->where('title', 'like', "%$search%")
                ->orWhere('content', 'like', "%$search%");
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
        $releases = $query->paginate(15);

        // Kembalikan view dengan data
        return view('admin.releases.index', compact('releases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();

        return view('admin.releases.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReleaseRequest $request)
    {
        //
        $validated = $request->validated();

        $coverUrl = null;
        $coverPublicId = null;

        if ($request->hasFile('cover')) {
            $uploadedFile = $request->file('cover');

            // Upload ke Cloudinary
            $uploadResult = Cloudinary::upload($uploadedFile->getRealPath(), [
                'folder' => 'releases/covers'
            ]);

            // Dapatkan URL gambar & Public ID
            $coverUrl = $uploadResult->getSecurePath();
            $coverPublicId = $uploadResult->getPublicId();
        }

        Release::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'summary' => $validated['summary'],
            'content' => $validated['content'],
            'cover' => $coverUrl,
            'cover_public_id' => $coverPublicId,
            'status' => false, // Default ke draft
            'slider' => $request->input('slider', false),
            'user_id' => Auth::id(),
            'category_id' => $request->input('category_id', false),
        ]);

        return redirect()->route('admin.releases.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Release $release)
    {
        //
        return view('admin.releases.show', compact('release'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Release $release)
    {
        //
        $categories = Category::all();

        return view('admin.releases.edit', compact('release', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReleaseRequest $request, Release $release)
    {
        //
        $validated = $request->validated(); // Validasi data
        
        // Generate slug if name is updated
        if ($request->has('title') && $request->title != $release->title) {
            $validated['slug'] = Str::slug($validated['title'], '-') . '-' . Str::random(5);
        }

        if ($request->hasFile('cover')) {
            // Hapus gambar lama jika ada
            if ($release->cover_public_id) {
                Cloudinary::destroy($release->cover_public_id);
            }

            // Upload gambar baru
            $uploadedFile = $request->file('cover');
            $uploadResult = Cloudinary::upload($uploadedFile->getRealPath(), [
                'folder' => 'releases/covers'
            ]);

            $release->cover = $uploadResult->getSecurePath();
            $release->cover_public_id = $uploadResult->getPublicId(); // Simpan Public ID
        }

        // Update judul dan caption
        $release->title = $validated['title'];
        $release->slug = Str::slug($validated['title']);
        $release->summary = $validated['summary'];
        $release->content = $validated['content'];
        $release->slider = $request->input('slider', false);
        $release->category_id = $request->input('category_id', false);

        $release->save(); // Simpan perubahan

        return redirect()->route('admin.releases.index');
    }

    public function publish(Release $release)
    {
        $release->update(['status' => true]);

        return redirect()->route('admin.releases.show', $release);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Release $release)
    {
        //

        if ($release->cover_public_id) {
            Cloudinary::destroy($release->cover_public_id);
        }

        $release->delete();
        return redirect()->route('admin.releases.index');   
    }
}
