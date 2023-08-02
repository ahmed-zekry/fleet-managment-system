<div class="bg-white rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
    <form wire:submit.prevent="save">
        <div class="-mx-3 mb-6">
            <div class="px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                    {{ __('Plate Number') }}
                </label>
                <input wire:model="plate_number" class="@error('plate_number') order-2 border-rose-600 @enderror block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" type="text" placeholder="">
                @error('plate_number')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                    {{ __('Number of Seats') }}
                </label>
                <input wire:model="number_of_seats" class="@error('number_of_seats') order-2 border-rose-600 @enderror block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" type="text" placeholder="">
                @error('number_of_seats')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="items-center justify-end text-right sm:px-6">
                <x-button wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-button>
            </div>
        </div>
    </form>
</div>
