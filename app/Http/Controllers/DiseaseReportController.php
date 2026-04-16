<?php

namespace App\Http\Controllers;

use App\Models\DiseaseReport;
use App\Models\HealthCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiseaseReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan monitoring penyakit masyarakat
    public function index()
    {
        $reports = DiseaseReport::with(['user', 'healthCenter'])
            ->latest()
            ->paginate(15);

        // Statistics
        $totalReports = DiseaseReport::count();
        $activeReports = DiseaseReport::whereIn('status', ['reported', 'being_monitored'])->count();
        $severeCases = DiseaseReport::where('severity', 'severe')->count();

        return view('disease-monitoring.index', compact('reports', 'totalReports', 'activeReports', 'severeCases'));
    }

    // Form pelaporan penyakit baru
    public function create()
    {
        $healthCenters = HealthCenter::where('is_active', true)->get();
        return view('disease-monitoring.create', compact('healthCenters'));
    }

    // Menyimpan laporan penyakit baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'disease_name' => 'required|string|max:100',
            'symptom_start_date' => 'required|date|before_or_equal:today',
            'symptoms' => 'required|string',
            'severity' => 'required|in:mild,moderate,severe',
            'location_description' => 'required|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'health_center_id' => 'nullable|exists:health_centers,id',
        ]);

        DiseaseReport::create([
            'user_id' => Auth::id(),
            'disease_name' => $validated['disease_name'],
            'symptom_start_date' => $validated['symptom_start_date'],
            'symptoms' => $validated['symptoms'],
            'severity' => $validated['severity'],
            'location_description' => $validated['location_description'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'health_center_id' => $validated['health_center_id'],
            'status' => 'reported',
        ]);

        return redirect('/disease-monitoring')
            ->with('success', 'Laporan penyakit berhasil dikirim. Terima kasih sudah berkontribusi untuk kesehatan masyarakat.');
    }

    // Menampilkan detail laporan
    public function show(DiseaseReport $diseaseReport)
    {
        return view('disease-monitoring.show', compact('diseaseReport'));
    }

    // Laporan penyakit saya
    public function myReports()
    {
        $reports = Auth::user()
            ->diseaseReports()
            ->with(['healthCenter'])
            ->latest()
            ->paginate(10);

        return view('disease-monitoring.my-reports', compact('reports'));
    }

    // Statistik penyakit
    public function statistics()
    {
        $diseaseStats = DiseaseReport::selectRaw('disease_name, COUNT(*) as count')
            ->groupBy('disease_name')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        $severityStats = DiseaseReport::selectRaw('severity, COUNT(*) as count')
            ->groupBy('severity')
            ->get();

        return view('disease-monitoring.statistics', compact('diseaseStats', 'severityStats'));
    }
}
