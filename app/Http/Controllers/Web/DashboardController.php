<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\FollowUp;


class DashboardController extends Controller
{
   public function index()
    {
        $todayFollowUps = FollowUp::where('is_done', 0)
            ->where('follow_up_at', '<=', now())
            ->with('lead')
            ->get();

        return view('dashboard', compact('todayFollowUps')); // ✅ Pass to Blade
    }

}
