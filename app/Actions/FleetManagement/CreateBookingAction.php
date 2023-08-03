<?php

namespace App\Actions\FleetManagement;

use App\Data\BookingData;
use App\Models\Booking;

class CreateBookingAction
{
    public function __invoke(BookingData $bookingData): Booking
    {
        return Booking::create( $bookingData->toArray() );
    }
}
