<?php

namespace App\Actions\FleetManagement;

use App\Data\BookingData;
use App\Models\Booking;

class CreateBookingAction
{
    public function __invoke(BookingData $bookingData): Booking
    {
        $data = $bookingData->toArray();

        $data['intermediate_cities'] = (new GetTripIntermediateCitiesAction())($data['trip_id'], $data['origin_city_id'], $data['destination_city_id']);

        return Booking::create( $data );
    }
}
