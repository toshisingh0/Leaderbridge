<?php

namespace App\Http\Controllers;

use App\Services\SmsService;
use Illuminate\Http\Request;

class SmsTestController extends Controller
{
    public function sendTestSMS(SmsService $smsService)
    {
        return $smsService->sendSMS(
            "9XXXXXXXXX",
            "Fast2SMS Laravel test"
        );
    }
}
