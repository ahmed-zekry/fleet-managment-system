<div class="bg-white rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
    @if($error_msg)
    <div class="m-3 flex bg-red-100 rounded-lg p-4 text-sm text-red-700" role="alert" id="alertDiv">
        <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <div>
            <span class="font-bold">Error alert!</span> {{ $error_msg }}
        </div>
    </div>
    @endif
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
                <div id="tasks" class="my-5" wire:sortable="updateRouteSourting">
                    @foreach ($trip_route_cities as $route_city)
                    <div wire:sortable.item="{{ $route_city['city_id'] }}" wire:key="city-{{ $route_city['city_id'] }}" class="flex justify-between items-center border-b border-slate-200 py-3 px-2 border-l-4  border-l-transparent">
                        <div class="inline-flex items-center space-x-2">
                            <div>
                                {{ $route_city['city_order'] }} -
                            </div>
                            <div wire:sortable.handle class="text-grey-darker font-bold hover:cursor-pointer">{{ $route_city['name'] }}</div>
                        </div>
                        <div>
                            <a href="#" wire:click="removeCityFromRoute({{ $route_city['city_id'] }})">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-rose-500 hover:text-rose-800 hover:cursor-pointer">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                              </svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="px-3 mb-6 md:mb-0 text-xs text-gray-500">
                    <i>Click on the city name and drag to change the trip route order.</i>
                </div>
                {{-- <ul class="list-outside" wire:sortable="updateRouteSourting">
                    @foreach ($trip_route_cities as $route_city)
                        <li wire:sortable.item="{{ $route_city['city_id'] }}" wire:key="city-{{ $route_city['city_id'] }}">
                            <h4 wire:sortable.handle>{{ $route_city['name'] }} - {{ $route_city['city_order'] }}</h4>
                            <a href="#" wire:click="removeCityFromRoute({{ $route_city['city_id'] }})">Remove</a>
                        </li>
                    @endforeach
                </ul> --}}
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
