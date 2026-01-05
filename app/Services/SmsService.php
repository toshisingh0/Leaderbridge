<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class SmsService
{
    public function sendSMS($mobile, $message)
    {
        $response = Http::withHeaders([
            'authorization' => env('SMS_API_KEY'),
            'Content-Type'  => 'application/json',
        ])->post(env('FAST2SMS_URL'), [
            'route'   => 'q',           // q = promotional (free)
            'message' => $message,
            'numbers' => $mobile,
        ]);

        return $response->json();
    }
}
