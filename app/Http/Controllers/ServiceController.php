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
    public function store(Request $request, Service $service)
    {
        //
        $request->validate([
            'name' => 'required|string',
            'contact' => 'required|integer',
            'message' => 'required|string',
        ]);

        $phone = $request->contact; // Assume email input is used for phone number
    
        if (strpos($phone, '08') === 0) {
            $phone = '628' . substr($phone, 2);
        } elseif (strpos($phone, '+628') === 0) {
            $phone = '628' . substr($phone, 1);
        }

        Service::create([
            'name' => $request->name,
            'contact' => $phone,
            'message' => $request->message,
        ]);

        $serviceNotificationData = new Request([
            'name' => $service->name,
            'contact' => $service->contact,
        ]);

        $this->sendServiceNotification($serviceNotificationData);

        return redirect()->route('home')->with('success', 'Pesan berhasil dikirim!');
    }

    public function sendServiceNotification(Request $request)
    {
        $messages = "Assalamu alaikum *" . $request->name . "*" . PHP_EOL . PHP_EOL .
            "Terima kasih sudah menghubungi customer service kami via website, 
            saat ini admin kami sedang meninjau kendala yang anda alami, mohon ditunggu 😇" . PHP_EOL . PHP_EOL .

            "Wassalamu’alaikum wr. wb." . PHP_EOL . PHP_EOL .

            "Salam," . PHP_EOL .
            "SMART171";
        $number = $request->contact;
        $token = 'bz4HsTMiybc2ChGXUQ1V';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 0,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('target' => $number ,'message' => $messages),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $token
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
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
