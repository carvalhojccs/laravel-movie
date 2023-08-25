<section class="container p-6 mx-auto font-mono">
    <div class="flex justify-end w-full p-2 mb-4">

        <form class="flex p-2 m-2 space-x-4 bg-white rounded-md shadow">

            <div class="p-1">
                <button type="button" wire:click="generateGenresMovie"
                    class="inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md hover:bg-green-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-green-700 disabled:opacity-50">
                    <span>{{ __('Generate Movies Genre') }}</span>
                </button>
            </div>
            <div class="p-1">
                <button type="button" wire:click="generateGenresTv"
                    class="inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md hover:bg-green-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-green-700 disabled:opacity-50">
                    <span>{{ __('Generate Tvs Genre') }}</span>
                </button>
            </div>
        </form>
    </div>
    <div class="w-full mb-8 overflow-auto rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="font-semibold tracking-wide text-left text-gray-900 uppercase bg-gray-100 border-b border-gray-600 text-md">
                        <th class="px-4 py-3">{{ __('Title') }}</th>
                        <th class="px-4 py-3">{{ __('Slug') }}</th>
                        <th class="px-4 py-3">{{ __('Manage') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse ($genres as $genre)
                    <tr class="text-gray-700">
                        <td class="px-4 py-3 border">{{ $genre->title }}</td>
                        <td class="px-4 py-3 font-semibold border text-ms">{{ $genre->slug }}</td>
                        <td class="px-4 py-3 text-sm border">
                            <x-button primary wire:click='showEditModal({{ $genre->id }})'>{{ __('Edit') }}</x-button>
                            <x-button danger wire:click='delete({{ $genre->id }})'>{{ __('Delete') }}</x-button>
                        </td>
                    </tr>
                    @empty
                    <tr class="text-gray-700"><td colspan="5" class="text-center">{{ __('No records found!') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
            {{ $genres->links() }}
        </div>
    </div>
    <x-dialog-modal wire:model='showModal'>
        <x-slot name="title">{{ __('Update Genre') }}</x-slot>

        <x-slot name="content">
            <x-form-modal submit='#'>
                <x-slot name='form'>
                    <div class="w-full sm:col-span-4">
                        <x-label for="genreTitle" value="{{ __('Genre Title') }}" />
                        <x-input id="genreTitle" type="text" autofocus wire:model='genreTitle'/>
                        <x-input-error for="genreTitle" class="mt-2" />
                    </div>
                </x-slot>
            </x-form-section>
        </x-slot>
        <x-slot name="footer">
            <x-button danger wire:click='closeModal'>{{ __('Cancel') }}</x-button>
            <x-button wire:click='update'>{{ __('Update') }}</x-button>
        </x-slot>
    </x-dialog-modal>
</section>
