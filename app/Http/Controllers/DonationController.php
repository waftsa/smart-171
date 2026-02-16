<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreDonationRequest;
use App\Http\Requests\UpdateDonationRequest;
use App\Models\Category;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class DonationController extends Controller
{
    /**
     * Display a listing of the donations.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $sortBy = $request->query('sort_by');

        // Query dasar
        $query = Donation::query()->latest();

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
            } elseif ($sortBy == 'published') {
                $query->where('status', true);
            } elseif ($sortBy == 'draft') {
                $query->where('status', false);
            }
        }

        // Paginate hasil query
        $donations = $query->paginate(15);

        // Kembalikan view dengan data
        return view('admin.donations.index', compact('donations'));
    }

    /**
     * Show the form for creating a new donation.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.donations.create', compact('categories'));
    }

    /**
     * Store a newly created donation in storage.
     */
    public function store(StoreDonationRequest $request)
    {
        $validated = $request->validated();

        $thumbnailPath = $request->file('thumbnail')->store('donations', 'public');

        Donation::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'about' => $validated['about'],
            'target_amount' => $validated['target_amount'],
            'rekening' => $request->input('rekening', false),
            'code' => $validated['code'],
            'thumbnail_text' => $validated['thumbnail_text'],
            'thumbnail' => $thumbnailPath,
            'thumbnail_public_id' => $thumbnailPath,
            'has_finished' => false, 
            'is_active' => false, 
            'slider' => $request->input('slider', false),
            'user_id' => Auth::id(),
            'category_id' => $request->input('category_id', false),
        ]);
        

        return redirect()->route('admin.donations.index')->with('success', 'Donation created successfully!');
    }

    public function show(Donation $donation)
    {
        $totalDonations = $donation->totalReachedAmount();
        $goalReached = $totalDonations >= $donation->target_amount;

        $percentage = ($totalDonations / $donation->target_amount) * 100;
        if ($percentage > 100) {
            $percentage = 100;
        }

        return view('admin.donations.show', compact('donation', 'goalReached', 'percentage', 'totalDonations'));
    }


    /**
     * Show the form for editing the specified donation.
     */
    public function edit(Donation $donation)
    {
        $categories = Category::all();

        return view('admin.donations.edit', compact('donation', 'categories'));
    }

    /**
     * Update the specified donation in storage.
     */
    public function update(UpdateDonationRequest $request, Donation $donation)
    {
        $validated = $request->validated();

        // Generate slug if name is updated
        if ($request->has('name') && $request->name != $donation->name) {
            $validated['slug'] = Str::slug($validated['name'], '-') . '-' . Str::random(5);
        }

        if ($request->hasFile('thumbnail')) {
            $coverPath = $request->file('thumbnail')->store('donations', 'public');
            $donation->thumbnail = $coverPath; // Update thumbnail jika file baru diupload
            $donation->thumbnail_public_id = $coverPath;
        }

        // if ($request->hasFile('thumbnail')) {
        //     // Hapus gambar lama jika ada
        //     if ($donation->thumbnail_public_id) {
        //         Cloudinary::destroy($donation->thumbnail_public_id);
        //     }

        //     // Upload gambar baru
        //     $uploadedFile = $request->file('thumbnail');
        //     $uploadResult = Cloudinary::upload($uploadedFile->getRealPath(), [
        //         'folder' => 'donations/thumbnails'
        //     ]);

        //     $donation->thumbnail = $uploadResult->getSecurePath();
        //     $donation->thumbnail_public_id = $uploadResult->getPublicId(); // Simpan Public ID
        // }

        $donation->name = $validated['name'];
        $donation->slug = Str::slug($validated['name']);
        $donation->about = $validated['about'];
        $donation->code = $validated['code'];
        $donation->thumbnail_text = $validated['thumbnail_text'];
        $donation->target_amount = $validated['target_amount'];
        $donation->slider = $request->input('slider', false); 
        $donation->category_id = $request->input('category_id', false); 
        $donation->rekening = $request->input('rekening', false);


        $donation->save();

        return redirect()->route('admin.donations.index')->with('success', 'Donation updated successfully!');
    }

    public function publish(Donation $donation)
    {
        $donation->update(['is_active' => true]);

        return redirect()->route('admin.donations.show', $donation);
    }

    /**
     * Remove the specified donation from storage.
     */
    public function destroy(Donation $donation)
    {
        if ($donation->thumbnail_public_id) {
            Cloudinary::destroy($donation->thumbnail_public_id);
        }

         if ($donation->cover && Storage::disk('public')->exists($donation->cover)) {
        Storage::disk('public')->delete($donation->cover);
        }

        $donation->delete();

        return redirect()->route('admin.donations.index')->with('success', 'Donation deleted successfully!');
    }
}
