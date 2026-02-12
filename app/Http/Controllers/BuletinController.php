<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBulletinRequest;
use App\Http\Requests\UpdateBulletinRequest;
use App\Models\Bulletin;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\PdfToImage\Pdf;

class BuletinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $sortBy = $request->query('sort_by');

        $query = Bulletin::query();

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

        $bulletins = $query->paginate(15);

        return view('admin.bulletins.index', compact('bulletins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bulletins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBulletinRequest $request)
    {

    $validated = $request->validated();

    if($request->hasFile('file')){
        $pdf = $request->file('file');

        $pdfPath = $request->file('file')->store('bulletins', 'public');

        // $thumbnailName = pathinfo($pdf->hashName(), PATHINFO_FILENAME) . '.jpg';
        // $thumbnailPath = 'bulletins/thumbnails/' . $thumbnailName;

        // $pdfToImage = new Pdf(storage_path('app/public/' . $pdfPath));
        // $pdfToImage->setPage(1)
        //         ->setOutputFormat('jpg')
        //         ->saveImage(storage_path('app/public/' . $thumbnailPath));
        
        
        Bulletin::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']), 
            'publisher' => $validated['publisher'],
            'file' => $pdfPath,
            // 'cover' => $thumbnailPath,
            // 'file_public_id' => $coverPath,
        ]);
    }


    // cloudinary 
    //     $fileUrl = null;
    //     $filePublicId = null;

    //     if ($request->hasFile('file')) {
    //     $uploadedFile = $request->file('file');

    //     $originalName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);

    //     $uploadResult = (new UploadApi())->upload(
    //         $uploadedFile->getRealPath(),
    //         [
    //             'folder' => 'bulletins/files',
    //             'resource_type' => 'auto',
    //             'type' => 'upload', 
    //             'public_id' => $originalName,
    //             'format' => 'pdf',
    //             'use_filename' => true,
    //             'unique_filename' => true,
    //         ]
    //     );

    //     $fileUrl = $uploadResult['secure_url'];
    //     $filePublicId = $uploadResult['public_id'];
    // }

        

    return redirect()->route('admin.bulletins.index');
    }

    /**
     * Show the form for editing the specified resource.
     */

     public function show(Bulletin $bulletin)
    {
        //
        return view('admin.bulletins.show', compact('bulletin'));
    }

    public function edit(Bulletin $bulletin)
    {
        return view('admin.bulletins.edit', compact('bulletin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBulletinRequest $request, Bulletin $bulletin)
    {
        $validated = $request->validated();

        // Generate slug if name is updated
        if ($request->has('title') && $request->title != $bulletin->title) {
            $validated['slug'] = Str::slug($validated['title'], '-') . '-' . Str::random(5);
        }

        if ($request->hasFile('file')) {
            // Hapus gambar lama jika ada
            if ($bulletin->cover_public_id) {
                Cloudinary::destroy($bulletin->cover_public_id);
            }

            // Upload gambar baru
            $uploadedFile = $request->file('file');
            $uploadResult = Cloudinary::upload($uploadedFile->getRealPath(), [
                'folder' => 'bulletins/covers'
            ]);

            $bulletin->file = $uploadResult->getSecurePath();
            $bulletin->cover_public_id = $uploadResult->getPublicId(); // Simpan Public ID
        }

        $bulletin->title = $validated['title'];
        $bulletin->slug = Str::slug($validated['title']);
        $bulletin->summary = $validated['summary'];
        $bulletin->content = $validated['content'];
        $bulletin->slider = $request->input('slider', false);
        $bulletin->category_id = $request->input('category_id', false);

        $bulletin->save();

        return redirect()->route('admin.bulletins.index');
    }

    public function publish(Bulletin $bulletin)
    {
        $bulletin->update(['status' => true]);
        return redirect()->route('admin.bulletins.show', $bulletin);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bulletin $bulletin)
    {
        if ($bulletin->cover_public_id) {
            Cloudinary::destroy($bulletin->cover_public_id);
        }

        $bulletin->delete();
        return redirect()->route('admin.bulletins.index');
    }
}
