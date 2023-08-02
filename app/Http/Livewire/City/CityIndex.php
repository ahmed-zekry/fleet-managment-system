<?php

namespace App\Http\Livewire\City;

use App\Models\City;
use Livewire\Component;
use Livewire\WithPagination;

class CityIndex extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.city.city-index', [
            'cities' => City::orderBy('name')->paginate(10)
        ]);
    }
}
