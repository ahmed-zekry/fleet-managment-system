<div class="bg-white rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
    <form wire:submit.prevent="save">
        <div class="-mx-3 mb-6">
            <div class="px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                    {{ __('Trip Number') }}
                </label>
                <input wire:model="trip_number" class="@error('trip_number') order-2 border-rose-600 @enderror block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" type="text" placeholder="">
                @error('trip_number')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                    {{ __('Bus') }}
                </label>
                <select wire:model="bus_id" class="@error('bus_id') order-2 border-rose-600 @enderror block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name">
                    <option value="">Select Bus</option>
                    @foreach($buses as $bus)
                    <option value="{{ $bus->id }}">{{ $bus->plate_number }}</option>
                    @endforeach
                </select>
                @error('bus_id')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <hr class="my-2">

            <div class="px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                    {{ __('Add city to the trip route') }}
                </label>
                <select wire:model="city_id" class="@error('city_id') order-2 border-rose-600 @enderror block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" wire:change="addCityToTripRoute">
                    <option value="">Select City</option>
                    @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
                @error('city_id')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="px-3 mb-6 md:mb-0">
                <ul wire:sortable="updateRouteSourting">
                    @foreach ($trip_route_cities as $route_city)
                        <li wire:sortable.item="{{ $route_city['city_id'] }}" wire:key="city-{{ $route_city['city_id'] }}">
                            <h4 wire:sortable.handle>{{ $route_city['name'] }} - {{ $route_city['city_order'] }}</h4>
                            <a href="#" wire:click="removeCityFromRoute({{ $route_city['city_id'] }})">Remove</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="items-center justify-end text-right sm:px-6">
                <x-button wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-button>
            </div>
        </div>
    </form>
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
@endpush
