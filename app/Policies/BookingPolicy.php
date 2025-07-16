<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;

class BookingPolicy
{
    /**
     * Determine whether the user can view any bookings.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Allow the user to view their own booking.
     */
    public function view(User $user, Booking $booking): bool
    {
        return $user->id === $booking->user_id;
    }

    /**
     * Prevent anyone from creating bookings via policy (handled elsewhere).
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Allow the user to update their own booking.
     */
    public function update(User $user, Booking $booking): bool
    {
        return $user->id === $booking->user_id;
    }

    /**
     * Allow the user to delete their own booking.
     */
    public function delete(User $user, Booking $booking): bool
    {
        return $user->id === $booking->user_id;
    }

    /**
     * Prevent restoring bookings.
     */
    public function restore(User $user, Booking $booking): bool
    {
        return false;
    }

    /**
     * Prevent force deleting bookings.
     */
    public function forceDelete(User $user, Booking $booking): bool
    {
        return false;
    }
}
