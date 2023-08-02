<?php

namespace App\Http\Livewire\Bus;

use App\Data\BusData;
use App\Models\Bus;
use Livewire\Component;

class BusForm extends Component
{
    public $plate_number;
    public $number_of_seats;
    public $bus;

    public $rules = [
        'plate_number' => 'required|unique:buses,plate_number',
        'number_of_seats' => 'required|integer',
    ];

    public function mount()
    {
        if(request()->segment(3)) {
            $this->bus = Bus::findOrFail(request()->segment(3));
            $this->plate_number = $this->bus->plate_number;
            $this->number_of_seats = $this->bus->number_of_seats;
            $this->rules['plate_number'] = 'required|unique:buses,plate_number,' . $this->bus->id;
        }
    }

    public function save()
    {
        $data = $this->validate();

        if($this->bus) {
            $this->bus->update(BusData::from($data)->toArray());
        } else {
            Bus::create(BusData::from($data)->toArray());
        }

        session()->flash('successMsg', __('Bus data has been saved.'));
        return redirect('/bus');
    }

    public function render()
    {
        return view('livewire.bus.bus-form');
    }
}
