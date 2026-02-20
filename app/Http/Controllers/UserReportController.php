<?php

namespace App\Http\Controllers;

use App\Models\Report;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\PdfToImage\Pdf;

class UserReportController extends Controller
{
    /**
     * Display a listing of the resource.
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
}
