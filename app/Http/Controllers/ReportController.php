<?php

namespace App\Http\Controllers;

use App\Models\Report;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\PdfToImage\Pdf;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $sortBy = $request->query('sort_by');

        $query = Report::query();

        if ($search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('code', 'like', "%$search%");
        }

        if ($sortBy) {
            if ($sortBy == 'newest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($sortBy == 'oldest') {
                $query->orderBy('created_at', 'asc');
            }
        }

        $reports = $query->paginate(15);

        return view('admin.reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.reports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'file_path' => 'required|mimes:pdf'
        ]);

        $slug = Str::slug($request->name);
        $token = Str::random(40);

        $path = $request->file('file_path')->store('reports', 'public');

        Report::create([
            'name' => $request->name,
            'code' => $request->code,
            'slug' => $slug,
            'token' => $token,
            'file_path' => $path
        ]);

        return redirect()->route('admin.reports.index');
        }

    /**
     * Show the form for editing the specified resource.
     */
    public function showFlipbook($slug, $token)
    {
        $report = Report::where('slug', $slug)
            ->where('token', $token)
            ->firstOrFail();

        return view('reports.flipbook', compact('report'));
    }

    public function showPdf($slug, $token)
    {
        $report = Report::where('slug', $slug)
            ->where('token', $token)
            ->firstOrFail();

        return view('reports.pdf', compact('report'));
    }
    

    public function show(Report $report)
    {
        //
        return view('admin.reports.show', compact('report'));
    }

    public function edit(Report $report)
    {
        return view('admin.reports.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        $validated = $request->validated();

        // Generate slug if name is updated
        if ($request->has('title') && $request->title != $report->title) {
            $validated['slug'] = Str::slug($validated['title'], '-') . '-' . Str::random(5);
        }

        if ($request->hasFile('file')) {
            // Hapus gambar lama jika ada
            if ($report->cover_public_id) {
                Cloudinary::destroy($report->cover_public_id);
            }

            // Upload gambar baru
            $uploadedFile = $request->file('file');
            $uploadResult = Cloudinary::upload($uploadedFile->getRealPath(), [
                'folder' => 'reports/covers'
            ]);

            $report->file = $uploadResult->getSecurePath();
            $report->cover_public_id = $uploadResult->getPublicId(); // Simpan Public ID
        }

        $report->title = $validated['title'];
        $report->slug = Str::slug($validated['title']);
        $report->summary = $validated['summary'];
        $report->content = $validated['content'];
        $report->slider = $request->input('slider', false);
        $report->category_id = $request->input('category_id', false);

        $report->save();

        return redirect()->route('admin.reports.index');
    }

    public function publish(Report $report)
    {
        $report->update(['status' => true]);
        return redirect()->route('admin.reports.show', $report);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        if ($report->cover_public_id) {
            Cloudinary::destroy($report->cover_public_id);
        }

        $report->delete();
        return redirect()->route('admin.reports.index');
    }
}
