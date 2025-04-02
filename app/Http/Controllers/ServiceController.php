<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('service.contact-us');
    }

    public function view()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
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
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string',
            'contact' => 'required|string',
            'message' => 'required|string',
        ]);

        Service::create([
            'name' => $request->name,
            'contact' => $request->contact,
            'message' => $request->message,
        ]);

        return redirect()->route('home')->with('success', 'Pesan berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
        return view('admin.services.show', compact('service'));    
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
        $service->delete(); // Hapus data dari database
        return redirect()->route('admin.services.index')->with('success', 'Service berhasil dihapus.');
    }
}
