<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BookingCreated;

class BookingController extends Controller
{
    public function index()
    {
        return Auth::user()->bookings;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'booking_date' => 'required|date',
        ]);

        $booking = Auth::user()->bookings()->create($validated);

        // Send notification
        Auth::user()->notify(new BookingCreated($booking));

        return response()->json($booking, 201);
    }

    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        return $booking;
    }

    public function update(Request $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'booking_date' => 'required|date',
        ]);

        $booking->update($validated);

        return response()->json($booking);
    }

    public function destroy(Booking $booking)
    {
        $this->authorize('delete', $booking);
        $booking->delete();

        return response()->json(null, 204);
    }
}
