<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class BusData extends Data
{
    public function __construct(
        public string $plate_number,
        public int $number_of_seats
    ) {}
}
