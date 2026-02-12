<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $sortBy = $request->query('sort_by');

        $query = Article::query();

        if ($search) {
            $query->where('title', 'like', "%$search%")
                ->orWhere('content', 'like', "%$search%");
        }

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

        $articles = $query->paginate(5);

        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $validated = $request->validated();
        // $coverUrl = null;
        // $coverPublicId = null;

        // if ($request->hasFile('cover')) {
        //     $uploadedFile = $request->file('cover');

        //     // Upload ke Cloudinary
        //     $uploadResult = Cloudinary::upload($uploadedFile->getRealPath(), [
        //         'folder' => 'articles/covers'
        //     ]);

        //     // Dapatkan URL gambar & Public ID
        //     $coverUrl = $uploadResult->getSecurePath();
        //     $coverPublicId = $uploadResult->getPublicId();
        // }
        $coverPath = $request->file('cover')->store('articles', 'public');

        Article::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'summary' => $validated['summary'],
            'content' => $validated['content'],
            'cover' => $coverPath,
            'cover_public_id' => $coverPath, // Simpan Public ID
            'status' => false,
            'slider' => $request->input('slider', false),
            'user_id' => Auth::id(),
            'category_id' => $request->input('category_id', false),
        ]);

        return redirect()->route('admin.articles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */

     public function show(Article $article)
    {
        //
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $validated = $request->validated();

        // Generate slug if name is updated
        if ($request->has('title') && $request->title != $article->title) {
            $validated['slug'] = Str::slug($validated['title'], '-') . '-' . Str::random(5);
        }

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('articles', 'public');
            $article->cover = $coverPath; // Update cover jika file baru diupload
            $article->cover_public_id = $coverPath;
        }

        // if ($request->hasFile('cover')) {
        //     // Hapus gambar lama jika ada
        //     if ($article->cover_public_id) {
        //         Cloudinary::destroy($article->cover_public_id);
        //     }

        //     // Upload gambar baru
        //     $uploadedFile = $request->file('cover');
        //     $uploadResult = Cloudinary::upload($uploadedFile->getRealPath(), [
        //         'folder' => 'articles/covers'
        //     ]);

            // $article->cover = $uploadResult->getSecurePath();
        //     $article->cover_public_id = $uploadResult->getPublicId(); // Simpan Public ID
        // }

        $article->title = $validated['title'];
        $article->slug = Str::slug($validated['title']);
        $article->summary = $validated['summary'];
        $article->content = $validated['content'];
        $article->slider = $request->input('slider', false);
        $article->category_id = $request->input('category_id', false);

        $article->save();

        return redirect()->route('admin.articles.index');
    }

    public function publish(Article $article)
    {
        $article->update(['status' => true]);
        return redirect()->route('admin.articles.show', $article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
    // 1️⃣ Hapus di Cloudinary (jika ada)
    if ($article->cover_public_id && !str_starts_with($article->cover_public_id, 'articles/')) {
        Cloudinary::destroy($article->cover_public_id);
    }

    // 2️⃣ Hapus file lokal (jika ada)
    if ($article->cover && Storage::disk('public')->exists($article->cover)) {
        Storage::disk('public')->delete($article->cover);
    }

    // 3️⃣ Hapus data artikel
    $article->delete();

    return redirect()->route('admin.articles.index');

    }
}
