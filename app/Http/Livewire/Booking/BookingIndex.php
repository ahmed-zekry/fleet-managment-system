<?php

namespace App\Http\Livewire\Booking;

use App\Models\Booking;
use Livewire\Component;

class BookingIndex extends Component
{
    public function render()
    {
        return view('livewire.booking.booking-index',[
            'bookings' => Booking::latest()
                ->with(['trip', 'seat', 'user', 'originCity', 'destinationCity'])
                ->paginate(25)
        ]);
    }
}
