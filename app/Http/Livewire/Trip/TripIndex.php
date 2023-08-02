<?php

namespace App\Http\Livewire\Trip;

use App\Models\Trip;
use Livewire\Component;

class TripIndex extends Component
{
    public function render()
    {
        return view('livewire.trip.trip-index', [
            'trips' => Trip::orderBy('id', 'desc')->with('cities')->paginate(10)
        ]);
    }
}
