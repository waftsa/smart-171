<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBuletinRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Buletin;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BuletinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $sortBy = $request->query('sort_by');

        $query = Buletin::query();

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

        $buletins = $query->paginate(15);

        return view('admin.buletins.index', compact('buletins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.buletins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBuletinRequest $request)
    {

        $validated = $request->validated();

        $fileUrl = null;
        $filePublicId = null;

        if ($request->hasFile('file')) {
        $uploadedFile = $request->file('file');

        $originalName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);

        $uploadResult = (new UploadApi())->upload(
            $uploadedFile->getRealPath(),
            [
                'folder' => 'buletins/files',
                'resource_type' => 'auto',
                'type' => 'upload', 
                'public_id' => $originalName,
                'format' => 'pdf',
                'use_filename' => true,
                'unique_filename' => true,
            ]
        );

        $fileUrl = $uploadResult['secure_url'];
        $filePublicId = $uploadResult['public_id'];
    }

        Buletin::create([
            'title' => $validated['title'],
            'publisher' => $validated['publisher'],
            'file' => $fileUrl,
            'file_public_id' => $filePublicId,
            'status' => false,
        ]);

        return redirect()->route('admin.buletins.index');
        }

    /**
     * Show the form for editing the specified resource.
     */

     public function show(Buletin $buletin)
    {
        //
        return view('admin.buletins.show', compact('buletin'));
    }

    public function edit(Buletin $buletin)
    {
        return view('admin.buletins.edit', compact('buletin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Buletin $buletin)
    {
        $validated = $request->validated();

        // Generate slug if name is updated
        if ($request->has('title') && $request->title != $buletin->title) {
            $validated['slug'] = Str::slug($validated['title'], '-') . '-' . Str::random(5);
        }

        if ($request->hasFile('file')) {
            // Hapus gambar lama jika ada
            if ($buletin->cover_public_id) {
                Cloudinary::destroy($buletin->cover_public_id);
            }

            // Upload gambar baru
            $uploadedFile = $request->file('file');
            $uploadResult = Cloudinary::upload($uploadedFile->getRealPath(), [
                'folder' => 'buletins/covers'
            ]);

            $buletin->file = $uploadResult->getSecurePath();
            $buletin->cover_public_id = $uploadResult->getPublicId(); // Simpan Public ID
        }

        $buletin->title = $validated['title'];
        $buletin->slug = Str::slug($validated['title']);
        $buletin->summary = $validated['summary'];
        $buletin->content = $validated['content'];
        $buletin->slider = $request->input('slider', false);
        $buletin->category_id = $request->input('category_id', false);

        $buletin->save();

        return redirect()->route('admin.buletins.index');
    }

    public function publish(Buletin $buletin)
    {
        $buletin->update(['status' => true]);
        return redirect()->route('admin.buletins.show', $buletin);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buletin $buletin)
    {
        if ($buletin->cover_public_id) {
            Cloudinary::destroy($buletin->cover_public_id);
        }

        $buletin->delete();
        return redirect()->route('admin.buletins.index');
    }
}
