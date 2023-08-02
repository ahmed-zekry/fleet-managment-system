<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class SeatData extends Data
{
    public function __construct(
        public int $trip_id,
        public string $seat_number
    ) {}
}
