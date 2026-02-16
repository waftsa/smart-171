<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Donatur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonaturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $donaturs = Donatur::latest()->paginate(25);

        // Kembalikan view dengan data
        return view('admin.donaturs.index', compact('donaturs'));
    }

    public function filter(Request $request)
    {
        $search = $request->query('search');
        $sortBy = $request->query('sort_by');

        // Query dasar
        $query = Donatur::query()->latest();

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
            } elseif ($sortBy == 'pending') {
                $query->where('is_paid', false);
            } elseif ($sortBy == 'paid') {
                $query->where('is_paid', true);
            } elseif ($sortBy == 'proof') {
                $query->where('proof', null);
            }
        }

        // Paginate hasil query
        $donaturs = $query->paginate(25);

        return view('admin.donaturs.filter', compact('donaturs'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Donatur $donatur, Donation $donation)
    {
        //
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Donatur $donatur)
    {
        //
        return view('admin.donaturs.show', compact('donatur'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donatur $donatur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donatur $donatur, Donation $donation)
    {
        //
        DB::transaction(function () use ($donatur, $donation){
            $donatur->update([
                'is_paid' => true
            ]);

            if($donation->totalReachedAmount() >= $donation->target_amount)
                $donation->update([
                    'has_finished' => true
                ]);
            
        });

        return redirect()->route('admin.donaturs.show', $donatur);
    }

    public function undoUpdate(Request $request, Donatur $donatur, Donation $donation)
    {
        //
        DB::transaction(function () use ($donatur, $donation){
            $donatur->update([
                'is_paid' => false
            ]);

            if($donation->totalReachedAmount() >= $donation->target_amount)
                $donation->update([
                    'has_finished' => true
                ]);
            
        });

        return redirect()->route('admin.donaturs.show', $donatur);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donatur $donatur)
    {
        //
        $donatur->delete();
        return redirect()->route('admin.donaturs.index');
    }
}
