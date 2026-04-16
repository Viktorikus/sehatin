<?php

namespace App\Http\Controllers;

use App\Models\HealthCenter;
use Illuminate\Http\Request;

class HealthCenterController extends Controller
{
    // Menampilkan daftar puskesmas
    public function index()
    {
        $healthCenters = HealthCenter::where('is_active', true)
            ->with('services')
            ->paginate(12);

        return view('health-centers.index', compact('healthCenters'));
    }

    // Menampilkan detail puskesmas
    public function show(HealthCenter $healthCenter)
    {
        $services = $healthCenter->services()
            ->where('is_active', true)
            ->get();

        $workers = $healthCenter->workers()
            ->where('is_active', true)
            ->with('user')
            ->get();

        return view('health-centers.show', compact('healthCenter', 'services', 'workers'));
    }

    // Search puskesmas berdasarkan lokasi
    public function search(Request $request)
    {
        $query = HealthCenter::where('is_active', true);

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $healthCenters = $query->with('services')->paginate(12);

        return view('health-centers.search', compact('healthCenters'));
    }

    // Peta puskesmas
    public function map()
    {
        $healthCenters = HealthCenter::where('is_active', true)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        return view('health-centers.map', compact('healthCenters'));
    }
}
