<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class TripData extends Data
{
    public function __construct(
        public string $trip_number,
        public int $bus_id
    ) {}
}
