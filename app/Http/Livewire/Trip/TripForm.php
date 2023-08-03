<?php

namespace App\Http\Livewire\Trip;

use Exception;
use App\Models\Bus;
use App\Models\City;
use App\Models\Seat;
use App\Models\Trip;
use App\Data\TripData;
use App\Models\Booking;
use Livewire\Component;

class TripForm extends Component
{
    public $trip_number;
    public $bus_id;
    public $buses = [];
    public $trip;
    public $trip_route_cities;
    public $cities;
    public $city_id;
    public $error_msg = '';

    public $rules = [
        'trip_number' => 'required|unique:trips,trip_number',
        'bus_id' => 'required|integer',
    ];

    public function mount()
    {
        $this->buses = Bus::all();
        $this->cities = City::OrderBy('name', 'asc')->get();
        $this->trip_route_cities = collect();

        if(request()->segment(3)) {
            $this->trip = Trip::findOrFail(request()->segment(3));
            $this->trip_number = $this->trip->trip_number;
            $this->bus_id = $this->trip->bus_id;
            $this->setTripRouteCities();
            $this->rules['trip_number'] = 'required|unique:trips,trip_number,' . $this->trip->id;
        }
    }

    public function updated($property)
    {
        if($property == 'bus_id' && $this->tripDoesntHaveBookings() === false) {
            $this->error_msg = 'You can not change the trip route because the trip alread has bookings.';
            $this->bus_id = $this->trip->bus_id;
            return false;
        }
    }

    public function save()
    {
        $data = $this->validate();

        if($this->trip_route_cities->count() < 2) {
            $this->error_msg = 'You must add at lease 2 cities to the trip route';
            return false;
        }

        if($this->trip) {
            $this->trip->update(TripData::from($data)->toArray());
            $this->trip->cities()->detach();
        } else {
            $this->trip = Trip::create(TripData::from($data)->toArray());
        }

        $this->trip->cities()->attach($this->attachRouteCities());

        if( $this->tripAvailableSeatsDoesntMatchBusNumberOfSeats() &&
            $this->tripDoesntHaveBookings() ) {
                $this->addTripBusSeats();
        }

        session()->flash('successMsg', __('Trip data has been saved.'));
        return redirect('/trip');
    }

    public function tripAvailableSeatsDoesntMatchBusNumberOfSeats()
    {
        return $this->trip->bus->number_of_seats > $this->trip->seats()->count();
    }

    public function tripDoesntHaveBookings()
    {
        if(!$this->trip){
            return true;
        }

        return Booking::where('trip_id', $this->trip->id)->count() == 0 ? true : false;
    }

    public function addTripBusSeats()
    {
        $this->trip->seats()->delete();

        for($i=1; $i<=$this->trip->bus->number_of_seats; $i++){
            $this->trip->seats()->save(
                Seat::create([
                    'trip_id' => $this->trip->id,
                    'seat_number' => $this->generateUniqueNumber()
                ])
            );
        }
    }

    public function setTripRouteCities()
    {
        foreach($this->trip->cities as $city){
            $this->trip_route_cities->push([
                'city_id' => $city->id,
                'city_order' => $city->pivot->city_order,
                'name' => $city->name
            ]);
        }
    }

    public function attachRouteCities()
    {
        $cities = [];
        foreach($this->trip_route_cities as $city){
            $cities[$city['city_id']] = [ 'city_order' => $city['city_order'] ];
        }

        return $cities;
    }

    public function getCityName($city_id)
    {
        $city = $this->cities->filter(function($item, $key) use ($city_id){
            return $item->id == $city_id;
        });

        return $city->name;
    }

    public function addCityToTripRoute()
    {
        if($this->tripDoesntHaveBookings() === false) {
            $this->error_msg = 'You can not change the trip route because the trip alread has bookings.';
            return false;
        }

        if($this->city_id && !$this->cityExistsOnTheRoute($this->city_id)){
            $city = $this->findSelectedCity($this->city_id);

            $item = [
                'city_id' => $this->city_id,
                'city_order' => count($this->trip_route_cities) + 1,
                'name' => $city->name
            ];

            $this->trip_route_cities->push($item);
            $this->city_id = '';
        }else{
            $this->city_id = '';
        }
    }

    public function cityExistsOnTheRoute($city_id)
    {
        return count( $this->trip_route_cities->filter(function($item, $key) use ($city_id){
            return (int) $item['city_id'] == (int) $city_id;
        }) );
    }

    public function updateRouteSourting($route_list)
    {
        if($this->tripDoesntHaveBookings() === false) {
            $this->error_msg = 'You can not change the trip route because the trip alread has bookings.';
            return false;
        }

        $new_collection = Collect();

        foreach($route_list as $k => $list_item){
            $ordered_item = $this->trip_route_cities->filter(function($i) use ($list_item){
                return (int) $i['city_id'] == (int) $list_item['value'];
            })->first();
            $ordered_item['city_order'] = $k+1;
            $new_collection->push($ordered_item);
        }

        $this->trip_route_cities = $new_collection;
    }

    public function removeCityFromRoute($city_id)
    {
        $this->trip_route_cities->filter(function($item, $key) use ($city_id){
            if((int) $item['city_id'] == (int) $city_id){
                $this->trip_route_cities->forget($key);
            }
        });
    }

    public function findSelectedCity($city_id)
    {
        return $this->cities->filter(function (City $item) use ($city_id) {
            return $item->id == $city_id;
        })->first();
    }

    public function generateUniqueNumber($lenght = 5) {
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $lenght);
    }

    public function render()
    {
        return view('livewire.trip.trip-form');
    }
}
