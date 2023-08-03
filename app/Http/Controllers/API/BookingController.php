<?php

namespace App\Http\Controllers\API;

use App\Actions\FleetManagement\CreateBookingAction;
use App\Actions\FleetManagement\GetAvailableSeatsForOriginDestinationAction;
use App\Data\BookingData;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookSeatRequest;
use App\Http\Requests\FindAvailableSeatsRequest;

class BookingController extends Controller
{
    public function findAvailableSeats(FindAvailableSeatsRequest $request)
    {
        $availableSeats = (new GetAvailableSeatsForOriginDestinationAction($request->origin_city_id, $request->destination_city_id))();
        $data = $availableSeats->count() ? ['available_seats' => $availableSeats] : [];
        $message = $availableSeats->count() ? __('There is ' . $availableSeats->count() . ' seats available for provided origin and destination') : __('There is no seats available for provided origin and destination');

        return response()->json([
            'data' => $data,
            'message' => $message
        ], $availableSeats->count() ? 200 : 422);
    }

    public function bookTripSeat(BookSeatRequest $request)
    {
        if( $this->tripSeatBooked($request->seat_id, $request->origin_city_id, $request->destination_city_id) ){
            return response()->json([
                'data' => [],
                'message' => __('Sorry this seat already booked')
            ], 422);
        }

        $request->merge(['user_id' => $request->user()->id]);
        $bookingData = BookingData::from($request->all());

        $booking = (new CreateBookingAction())($bookingData);

        return response()->json([
            'data' => [
                'booking' => $booking
            ],
            'message' => __('Congratuations, your seat has been bookd. Have a nice trip :)')
        ]);
    }

    private function tripSeatBooked($seatId, $originCityId, $destinationCityId){
        $availableSeats = (new GetAvailableSeatsForOriginDestinationAction($originCityId, $destinationCityId))();

        $exists = $availableSeats->filter(function($item) use ($seatId){
            return $item->seat_id == $seatId;
        });

        return count($exists) ? false : true;
    }
}
