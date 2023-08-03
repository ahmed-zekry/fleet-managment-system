<?php

namespace App\Actions\FleetManagement;

use App\Models\Seat;
use Illuminate\Support\Collection;

class GetAvailableSeatsForOriginDestinationAction
{
    private GetAvailableTripForOriginDistinationAction $getAvailableTripForOriginDistination;
    private int $originCityId;
    private int $destinationCityId;
    private array $availableTrips;

    public function __construct(int $originCityId, int $destinationCityId)
    {
        $this->originCityId = $originCityId;
        $this->destinationCityId = $destinationCityId;
        $this->getAvailableTripForOriginDistination = new GetAvailableTripForOriginDistinationAction();
    }

    public function __invoke(): Collection
    {
        $this->availableTrips = ($this->getAvailableTripForOriginDistination)($this->originCityId, $this->destinationCityId);

        $seats = collect();

        foreach($this->availableTrips as $trip) {
            $tripRouteCities = $trip['trip_route_cities'];
            $tripRouteCitiesWithoutDestination = $trip['trip_route_cities'];

            count($tripRouteCitiesWithoutDestination) > 1 ? array_pop($tripRouteCitiesWithoutDestination) : $tripRouteCitiesWithoutDestination;

            $tripSeats = $this->findSeats($trip['trip_id'], $tripRouteCities, $tripRouteCitiesWithoutDestination);

            $seats = $seats->merge($tripSeats);
        }

        return $seats;
    }

    private function findSeats(int $tripId, array $tripRouteCities, array $tripRouteCitiesWithoutDestination)
    {
        return Seat::selectRaw('seats.id as seat_id, seats.seat_number, seats.trip_id, trips.bus_id, trips.trip_number')
            ->join('trips', 'trips.id', 'seats.trip_id')
            ->where('seats.trip_id', $tripId)
            ->whereNotIn('seats.id', function ($query) use ($tripRouteCities, $tripRouteCitiesWithoutDestination) {
                $query->select('seat_id')
                    ->from('bookings')
                    ->whereIn('origin_city_id', $tripRouteCitiesWithoutDestination);
                    foreach($tripRouteCities as $cid){
                        $query->orWhereJsonContains('intermediate_cities', $cid);
                    }
            })->get();
    }
}
