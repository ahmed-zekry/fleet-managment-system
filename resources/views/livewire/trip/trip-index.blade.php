<div>
    <div class="bg-white rounded my-6">
        <x-link-button link="/trip/create" text="Add new trip" />
        @if(count($trips))
        <table class="min-w-max w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Trip Number</th>
                    <th class="py-3 px-6 text-left">Trip Route</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach($trips as $trip)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="font-medium">{{ $trip->trip_number }}</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="font-medium">{{ implode(', ', $trip->cities->pluck('name')->toArray()) }}</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <x-action-edit-icon link="/trip/edit/{{$trip->id}}" />
                            <x-action-delete-icon link="/trip/delete/{{$trip->id}}" />
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="flex bg-yellow-100 rounded-lg p-4 mb-4 text-sm text-yellow-700 m-3" role="alert">
            <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <div>
                {{ __('No data found') }}
            </div>
        </div>
        @endif
        <div class="m-2">
        {{ $trips->links() }}
        </div>
    </div>
</div>
