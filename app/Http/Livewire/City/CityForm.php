<?php

namespace App\Http\Livewire\City;

use App\Models\City;
use App\Data\CityData;
use Livewire\Component;

class CityForm extends Component
{
    public $name;
    public $city;

    public $rules = [
        'name' => 'required|unique:cities'
    ];

    public function mount()
    {
        if(request()->segment(3)) {
            $this->city = City::findOrFail(request()->segment(3));
            $this->name = $this->city->name;
            $this->rules['name'] = 'required|unique:cities,name,' . $this->city->id;
        }
    }

    public function save()
    {
        $data = $this->validate();

        if($this->city) {
            $this->city->update(CityData::from($data)->toArray());
        } else {
            City::create(CityData::from($data)->toArray());
        }

        session()->flash('successMsg', __('City data has been saved.'));
        return redirect('/city');
    }

    public function render()
    {
        return view('livewire.city.city-form');
    }
}
