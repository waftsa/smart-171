<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Donatur;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
// use Twilio\Rest\Client;

class MidtransController extends Controller
{
    //
    public function callback(Request $request){
        $serverKey = config('midtrans.serverKey');
        $hashKey = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if($hashKey !== $request->signature_key){
            return response()->json(['messege' => 'Invalid signature key'], 403);
        }

        $donaturStatus = $request->transaction_status;
        $orderId = str_replace('DON-', '', $request->order_id);
        $donatur = Donatur::where('id', $orderId)->first();

        if(!$donatur){
            return response()->json(['messege' => 'Transaction not found'], 404);
        }


        switch($donaturStatus){
            case 'capture' :
                if($request->payment_type == 'credit card'){
                    if($request->fraud_status == 'challenge'){
                        $donatur->update(['payment_status' => 'pending']);
                    } else {
                        $donatur->update(['payment_status' => 'success']);
                    }
                }
                break;
            case 'settlement' : 
                $donatur->update(['payment_status' => 'success']);

                $notificationData = new Request([
                    'name' => $donatur->name,
                    'email' => $donatur->email,
                    'total_amount' => $donatur->total_amount,
                    'payment_type' => $request->payment_type,
                    'donation' => $donatur->donation
                ]);
    
                $this->sendNotification($notificationData);
                // $twilio->messages
                //     ->create(
                //         "whatsapp:+" . $donatur->email, // to
                //         array(
                //             "from" => "whatsapp:+14155238886",
                //             "body" => $messages
                //         )
                //     );

                break;
            case 'pending' : 
                $donatur->update(['payment_status' => 'pending']);
                break;
            case 'deny' : 
                $donatur->update(['payment_status' => 'failed']);
                break;
            case 'expire' : 
                $donatur->update(['payment_status' => 'expired']);
                break;
            case 'cancel' : 
                $donatur->update(['payment_status' => 'canceled']);
                break;
            default:
                $donatur->hash_update(['payment_status' => 'unknown']);
                break;
        }

        return response()->json(['messege' => 'Callback received successfully']);
    }

    public function sendNotification(Request $request)
    {
        $messages = "Assalamu alaikum *" . $request->name . "*" . PHP_EOL . PHP_EOL .
            "Donasi kamu sebesar Rp *" . number_format($request->total_amount, 0, ',', '.') . "* sudah kami terima dan akan disalurkan oleh SMART171 kepada yg bersangkutan." . PHP_EOL . PHP_EOL .
            "Total Pembayaran: Rp *" . number_format($request->total_amount, 0, ',', '.') . "*" . PHP_EOL .
            "Metode Pembayaran: *" . $request->payment_type . "*" . PHP_EOL .
            "Donasi untuk *" . $request->donation->name . "*" . PHP_EOL . PHP_EOL .

            "Jazakumullah khoir semoga Allah menberkahi rizqi *" . $request->name . "*" . PHP_EOL . PHP_EOL .
            "Untuk penyaluran bantuan dapat dilihat pada link berikut" . PHP_EOL .
            "(Link)" . PHP_EOL .
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
