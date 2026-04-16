<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\DiseaseReport;
use App\Models\EnvironmentalHealthReport;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $user = Auth::user();
        
        // User dashboard
        $upcomingBookings = Booking::where('user_id', $user->id)
            ->where('status', 'confirmed')
            ->where('appointment_date', '>=', now())
            ->orderBy('appointment_date')
            ->limit(5)
            ->get();

        $recentReports = DiseaseReport::where('user_id', $user->id)
            ->latest()
            ->limit(5)
            ->get();

        $myEnvironmentalReports = EnvironmentalHealthReport::where('user_id', $user->id)
            ->latest()
            ->limit(5)
            ->get();

        $totalBookings = Booking::where('user_id', $user->id)->count();
        $totalDiseaseReports = DiseaseReport::where('user_id', $user->id)->count();
        $totalEnvReports = EnvironmentalHealthReport::where('user_id', $user->id)->count();

        return view('dashboard', compact(
            'upcomingBookings',
            'recentReports',
            'myEnvironmentalReports',
            'totalBookings',
            'totalDiseaseReports',
            'totalEnvReports'
        ));
    }

    public function index()
    {
        return view('index');
    }
}
