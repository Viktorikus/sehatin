<?php

namespace App\Http\Controllers;

use App\Models\EnvironmentalHealthReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EnvironmentalHealthReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan daftar laporan kesehatan lingkungan
    public function index()
    {
        $reports = EnvironmentalHealthReport::with('user')
            ->latest()
            ->paginate(15);

        $categories = ['air', 'sanitasi', 'sampah', 'polusi', 'lainnya'];

        return view('environmental-reports.index', compact('reports', 'categories'));
    }

    // Form untuk membuat laporan baru
    public function create()
    {
        $categories = ['air', 'sanitasi', 'sampah', 'polusi', 'lainnya'];
        return view('environmental-reports.create', compact('categories'));
    }

    // Menyimpan laporan lingkungan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'category' => 'required|in:air,sanitasi,sampah,polusi,lainnya',
            'severity' => 'required|in:normal,warning,critical',
            'location_address' => 'required|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $validated;

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('environmental-reports', 'public');
        }

        $data['user_id'] = Auth::id();
        $data['status'] = 'submitted';

        EnvironmentalHealthReport::create($data);

        return redirect('/environmental-reports')
            ->with('success', 'Laporan kesehatan lingkungan berhasil dikirim. Kami akan segera meninjau.');
    }

    // Menampilkan detail laporan
    public function show(EnvironmentalHealthReport $environmentalReport)
    {
        return view('environmental-reports.show', compact('environmentalReport'));
    }

    // Laporan saya
    public function myReports()
    {
        $reports = Auth::user()
            ->environmentalReports()
            ->latest()
            ->paginate(10);

        return view('environmental-reports.my-reports', compact('reports'));
    }

    // Unduh laporan saya
    public function edit(EnvironmentalHealthReport $environmentalReport)
    {
        $this->authorize('update', $environmentalReport);

        $categories = ['air', 'sanitasi', 'sampah', 'polusi', 'lainnya'];
        return view('environmental-reports.edit', compact('environmentalReport', 'categories'));
    }

    public function update(Request $request, EnvironmentalHealthReport $environmentalReport)
    {
        $this->authorize('update', $environmentalReport);

        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'category' => 'required|in:air,sanitasi,sampah,polusi,lainnya',
            'severity' => 'required|in:normal,warning,critical',
            'location_address' => 'required|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($environmentalReport->image_path) {
                Storage::disk('public')->delete($environmentalReport->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('environmental-reports', 'public');
        }

        $environmentalReport->update($validated);

        return redirect('/environmental-reports/my-reports')
            ->with('success', 'Laporan berhasil diperbarui.');
    }

    // Dashboard laporan
    public function dashboard()
    {
        $totalReports = EnvironmentalHealthReport::count();
        $criticalReports = EnvironmentalHealthReport::where('severity', 'critical')->count();
        $resolvedReports = EnvironmentalHealthReport::where('status', 'resolved')->count();

        $categoryStats = EnvironmentalHealthReport::selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->get();

        return view('environmental-reports.dashboard', compact('totalReports', 'criticalReports', 'resolvedReports', 'categoryStats'));
    }
}
