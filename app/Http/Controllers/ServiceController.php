<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
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
    public function store(Request $request, Service $service)
    {
        //
        $request->validate([
            'name' => 'required|string',
            'contact' => 'required|string',
            'message' => 'required|string',
        ]);

        $phone = $request->contact; // Assume email input is used for phone number
    
        if (strpos($phone, '08') === 0) {
            $phone = '628' . substr($phone, 2);
        } elseif (strpos($phone, '+628') === 0) {
            $phone = '628' . substr($phone, 1);
        }

        $newService = Service::create([
            'name' => $request->name,
            'contact' => $phone,
            'message' => $request->message,
        ]);

        $this->sendServiceNotification($newService);

        return redirect()->route('home')->with('success', 'Pesan berhasil dikirim!');
    }

    public function sendServiceNotification($service)
    {
        $adminNumber = '6287738474424';
        $token = 'nUfewDACZgfTMstmQyvv';

        $messages = "🔔 *Notifikasi Website SMART171*\n\n".
                    "👤 Nama: {$service->name}\n".
                    "📞 No HP: {$service->contact}\n".
                    "✉️ Pesan: {$service->message}";

        $response = Http::withHeaders([
            'Authorization' => $token
        ])->post('https://api.fonnte.com/send', [
            'target' => $adminNumber,
            'message' => $messages
        ]);

        \Log::info('Fonnte Response: '.$response->body());
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
