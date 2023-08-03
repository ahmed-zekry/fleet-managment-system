<?php

namespace App\Http\Livewire\Bus;

use App\Models\Bus;
use Livewire\Component;

class BusIndex extends Component
{
    public function render()
    {
        return view('livewire.bus.bus-index', [
            'buses' => Bus::orderBy('id', 'desc')->paginate(15)
        ]);
    }
}
