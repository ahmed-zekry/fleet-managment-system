<?php

namespace App\Actions\FleetManagement;

use App\Models\Trip;

class GetAvailableTripForOriginDistinationAction
{
    public function __invoke(int $originCityId, int $destinationCityId): array
    {
        $availableTrips = [];

        $trips = Trip::selectRaw('trips.id, ct1.city_order as trip_start, ct2.city_order as trip_end')
            ->join('city_trip as ct1', 'trips.id', '=', 'ct1.trip_id')
            ->join('city_trip as ct2', 'trips.id', '=', 'ct2.trip_id')
            ->where('ct1.city_id', $originCityId)
            ->where('ct2.city_id', $destinationCityId)
            ->whereRaw('ct1.city_order < ct2.city_order')
            ->distinct()
            ->with('cities')
            ->get();

        foreach($trips as $trip) {
            $availableTrips[] = [
                'trip_id' => $trip->id,
                'trip_route_cities' => $trip->cities->filter(function($item) use ($trip) {
                    return $item->pivot->city_order >= $trip->trip_start && $item->pivot->city_order <= $trip->trip_end;
                })->pluck('id')->toArray()
            ];
        }

        return $availableTrips;
    }
}
