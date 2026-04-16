<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\HealthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan list layanan kesehatan untuk booking
    public function index()
    {
        $services = HealthService::with('healthCenter')
            ->where('is_active', true)
            ->paginate(12);

        return view('bookings.index', compact('services'));
    }

    // Menampilkan form booking untuk service tertentu
    public function create(HealthService $service)
    {
        $healthCenter = $service->healthCenter;
        return view('bookings.create', compact('service', 'healthCenter'));
    }

    // Menyimpan booking baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'health_service_id' => 'required|exists:health_services,id',
            'appointment_date' => 'required|date|after:today',
            'notes' => 'nullable|string',
        ]);

        $service = HealthService::find($validated['health_service_id']);
        
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'health_service_id' => $service->id,
            'health_center_id' => $service->health_center_id,
            'appointment_date' => $validated['appointment_date'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ]);

        return redirect('/dashboard')
            ->with('success', 'Booking berhasil dibuat. Silakan tunggu konfirmasi dari puskesmas.');
    }

    // Menampilkan detail booking
    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        return view('bookings.show', compact('booking'));
    }

    // Menampilkan booking saya
    public function myBookings()
    {
        $bookings = Auth::user()
            ->bookings()
            ->with(['healthService', 'healthCenter'])
            ->latest()
            ->paginate(10);

        return view('bookings.my-bookings', compact('bookings'));
    }

    // Cancel booking
    public function cancel(Booking $booking)
    {
        $this->authorize('update', $booking);

        if (in_array($booking->status, ['pending', 'confirmed'])) {
            $booking->update(['status' => 'cancelled']);
            return back()->with('success', 'Booking dibatalkan.');
        }

        return back()->with('error', 'Booking tidak dapat dibatalkan.');
    }
}
