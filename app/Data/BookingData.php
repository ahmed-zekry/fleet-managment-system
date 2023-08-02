<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class BookingData extends Data
{
    public function __construct(
        public int $trip_id,
        public int $seat_id,
        public int $origin_city_id,
        public int $destination_city_id,
        public ?array $intermediate_cities
    ) {}
}
