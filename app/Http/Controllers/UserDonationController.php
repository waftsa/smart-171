<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Donation;
use App\Models\Donatur;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class UserDonationController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->query('search');
        $sortBy = $request->query('sort_by');

        // Query dasar
        $query = Donation::query();

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
            } 
        }

        // Paginate hasil query
        $donations = $query->paginate();
    
            
        // Ambil semua donasi yang aktif
    $donations = Donation::with('user')->where('is_active', true)->paginate();

    // Menghitung total donasi dan persentase untuk setiap donasi
    foreach ($donations as $donation) {
        // Menghitung total donasi yang telah terkumpul
        $donation->totalDonations = $donation->totalReachedAmount();
        $donation->percentage = $donation->target_amount > 0
            ? min(($donation->totalDonations / $donation->target_amount) * 100, 100) // Pastikan tidak lebih dari 100
            : 0; // Jika target_amount 0, set persentase ke 0
    }

    

    $categories = Category::where('type', 'donations')->get();

    return view('donations.index', compact('donations', 'categories'));
    }

    public function show(Donation $donation)
    {
        // Menampilkan halaman detail untuk dokumentasi tertentu
        $totalDonations = $donation->totalReachedAmount();
        $goalReached = $totalDonations >= $donation->target_amount;

        $percentage = ($totalDonations / $donation->target_amount) * 100;
        if ($percentage > 100) {
            $percentage = 100;
        }

        // // For anonym = true and notes is not empty
        // $anonimDonaturs = $donation->donaturs()
        // ->where('anonim', true)
        // ->whereNotNull('notes')
        // ->get();

        // // For anonym = false or null, and notes is not empty
        // $nonAnonimDonaturs = $donation->donaturs()
        // ->where(function($query) {
        //     $query->where('anonim', null)
        //         ->orWhereNull('anonim');
        // })
        // ->whereNotNull('notes')
        // ->get();

        $donaturs = Donatur::where('donation_id', $donation->id)
            ->where('payment_status', 'success') // Tambahkan filter status sukses
            ->orderBy('created_at', 'desc')
            ->get();


        return view('donations.show', compact('donation', 'goalReached', 'percentage', 'totalDonations', 'donaturs'));
    }

    public function category(Category $category)
    {

        // $category = Category::findOrFail($id);

        $donations = Donation::where('category_id', $category->id)->get();

        foreach ($donations as $donation) {
            // Menghitung total donasi yang telah terkumpul
            $donation->totalDonations = $donation->totalReachedAmount();
            $donation->percentage = $donation->target_amount > 0
                ? min(($donation->totalDonations / $donation->target_amount) * 100, 100) // Pastikan tidak lebih dari 100
                : 0; // Jika target_amount 0, set persentase ke 0
        }

        return view('donations.category', compact( 'category','donations'));
    }
    

    public function showDonate(Donation $donation){
        $totalDonations = $donation->totalReachedAmount();
        $goalReached = $totalDonations >= $donation->target_amount;

        $percentage = ($totalDonations / $donation->target_amount) * 100;
        if ($percentage > 100) {
            $percentage = 100;
        }

        return view('donations.donate', compact('donation', 'goalReached', 'percentage', 'totalDonations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255', // Assume this is for the phone number
            'total_amount' => 'required|integer|min:10000',
            'payment_method' => 'required',
            'notes' => 'nullable|string',
            'anonim' => 'nullable',
            'donation_id' => 'required|integer|exists:donations,id',
        ]);
    
        // Transform the phone number
        $phone = $request->email; // Assume email input is used for phone number
        if (strpos($phone, '08') === 0) {
            $phone = '628' . substr($phone, 2);
        } elseif (strpos($phone, '+628') === 0) {
            $phone = '628' . substr($phone, 1);
        }
    
        // Ambil data donation berdasarkan ID
        $donation = Donation::findOrFail($request->donation_id);
    
        $code = $donation->code;
        $totalAmount = $request->total_amount;
    
        if (!$totalAmount || $totalAmount < 10000) {
            return redirect()->back()->withErrors(['total_amount' => 'Nominal harus minimal Rp 10.000.']);
        } else {
            $totalAmount = $totalAmount + $code;
        }
    
        // Simpan data donasi
        $donatur = Donatur::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name . '-' . time()),
            'email' => $phone, // Save the transformed phone number
            'total_amount' => $totalAmount,
            'notes' => $request->notes,
            'donation_id' => $request->donation_id,
            'payment_method' => $request->payment_method,
            'anonim' => $request->anonim,
            'payment_status' => 'pending',
             // Set is_paid ke false untuk verifikasi admin
        ]);

        return redirect()->route('donations.confirmation', [
            'donation' => $donation->slug, 
            'donatur' => $donatur->slug, 
        ]);

    
        // Set your Merchant Server Key
        // \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        // \Midtrans\Config::$isSanitized = config('midtrans.isSanitized');
        // \Midtrans\Config::$is3ds = config('midtrans.is3ds');
    
        // $params = [
        //     'transaction_details' => [
        //         'order_id' => 'DON-' . $donatur->id,
        //         'gross_amount' => $donatur->total_amount,
        //     ],
        //     'customer_details' => [
        //         'first_name' => $donatur->name,
        //         'phone' => $phone, // Use the transformed phone number
        //     ],
        // ];
    
        // $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
    
        // return redirect($paymentUrl);
    }
    

    public function showConfirmation(Donation $donation, Donatur $donatur) 
    {
        return view('donations.confirmation', compact('donation', 'donatur'));
    }
    
    public function submitConfirmation(Request $request, Donation $donation, Donatur $donatur)
    {
        $request->validate([
            'proof' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);
    
        if ($request->hasFile('proof')) {
            $uploadedFile = $request->file('proof');
    
            $uploadResult = Cloudinary::upload($uploadedFile->getRealPath(), [
                'folder' => 'donatur/proofs'
            ]);

            $anonim = (bool) $request->anonim;
            // Langsung update data tanpa harus menyimpan satu per satu
            $donatur->update([
                'proof' => $uploadResult->getSecurePath(),
                'proof_public_id' => $uploadResult->getPublicId(),
                'payment_status' => 'success',
            ]);

        }

        $notificationData = new Request([
            'name' => $donatur->name,
            'email' => $donatur->email,
            'total_amount' => $donatur->total_amount,
            'payment_method' => $donatur->payment_method,
            'donation' => $donatur->donation
        ]);

        $this->sendSucessNotification($notificationData);
    
        return redirect()->route('donations.success', [
            'donation' => $donation->slug, 
            'donatur' => $donatur->slug, 
        ]);
    }
    
    public function success(Donation $donation, Donatur $donatur)
    {
        return view('donations.success', compact('donation', 'donatur'));
    }  

    public function sendSucessNotification(Request $request)
    {
        $messages = "Assalamu alaikum *" . $request->name . "*" . PHP_EOL . PHP_EOL .
            "Donasi kamu sebesar Rp *" . number_format($request->total_amount, 0, ',', '.') . "* sudah kami terima dan akan disalurkan oleh SMART171 kepada yg bersangkutan." . PHP_EOL . PHP_EOL .
            "Total Pembayaran: Rp *" . number_format($request->total_amount, 0, ',', '.') . "*" . PHP_EOL .
            "Metode Pembayaran: *" . $request->payment_method . "*" . PHP_EOL .
            "Donasi untuk *" . $request->donation->name . "*" . PHP_EOL . PHP_EOL .

            "Jazakumullah khoir semoga Allah menberkahi rizqi *" . $request->name . "*" . PHP_EOL . PHP_EOL .
            "Untuk penyaluran bantuan dapat dilihat pada link berikut" . PHP_EOL .
            "smart171.org/documentations" . PHP_EOL .
            "Untuk keberlanjutan penyaluran bantuan pada program yang berjalan kemungkinan akan kami kabari selanjutnya ya, kak." . PHP_EOL . PHP_EOL .

            "Wassalamu’alaikum wr. wb." . PHP_EOL . PHP_EOL .

            "Salam," . PHP_EOL .
            "SMART171";
        $number = $request->email;
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

    public function sendPaymentNotification(Request $request)
    {
        $messages = "Assalamu alaikum *" . $request->name . "*" . PHP_EOL . PHP_EOL .
            "Donasi kamu sebesar Rp *" . number_format($request->total_amount, 0, ',', '.') . "* sudah kami terima dan akan disalurkan oleh SMART171 kepada yg bersangkutan." . PHP_EOL . PHP_EOL .
            "Total Pembayaran: Rp *" . number_format($request->total_amount, 0, ',', '.') . "*" . PHP_EOL .
            "Metode Pembayaran: *" . $request->payment_method . "*" . PHP_EOL .
            "Donasi untuk *" . $request->donation->name . "*" . PHP_EOL . PHP_EOL .

            "Jazakumullah khoir semoga Allah menberkahi rizqi *" . $request->name . "*" . PHP_EOL . PHP_EOL .
            "Untuk penyaluran bantuan dapat dilihat pada link berikut" . PHP_EOL .
            "smart171.org/documentations" . PHP_EOL .
            "Untuk keberlanjutan penyaluran bantuan pada program yang berjalan kemungkinan akan kami kabari selanjutnya ya, kak." . PHP_EOL . PHP_EOL .

            "Wassalamu’alaikum wr. wb." . PHP_EOL . PHP_EOL .

            "Salam," . PHP_EOL .
            "SMART171";
        $number = $request->email;
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

}
