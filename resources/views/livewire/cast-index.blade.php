<section class="container p-6 mx-auto font-mono">
    <div class="flex justify-end w-full p-2 mb-4">

        <form class="flex p-2 m-2 space-x-4 bg-white rounded-md shadow">
            <div class="flex items-center p-1">
                <label for="tmdb_id_g" class="block mr-4 text-sm font-medium text-gray-700">Cast Tmdb Id</label>
                <div class="relative rounded-md shadow-sm">
                    <input wire:model="castTMDBId" id="tmdb_id_g" name="tmdb_id_g"
                        class="px-3 py-2 border border-gray-300 rounded" placeholder="Cast ID" />
                </div>
            </div>
            <div class="p-1">
                <button type="button" wire:click="generateCast"
                    class="inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md hover:bg-green-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-green-700 disabled:opacity-50">
                    <span>{{ __('Generate') }}</span>
                </button>
            </div>
        </form>
    </div>
    <div class="w-full mb-8 overflow-auto rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="font-semibold tracking-wide text-left text-gray-900 uppercase bg-gray-100 border-b border-gray-600 text-md">
                        <th class="px-4 py-3">{{ __('Name') }}</th>
                        <th class="px-4 py-3">{{ __('Slug') }}</th>
                        <th class="px-4 py-3">{{ _('Post') }}</th>
                        <th class="px-4 py-3">{{ __('Manage') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse ($casts as $cast)
                    <tr class="text-gray-700">
                        <td class="px-4 py-3 border">{{ $cast->name }}</td>
                        <td class="px-4 py-3 font-semibold border text-ms">{{ $cast->slug }}</td>
                        <td class="px-4 py-3 text-xs border">
                            <img class="w-12 h-12 rounded" src="https://image.tmdb.org/t/p/w500/{{ $cast->poster_path }}">
                        </td>
                        <td class="px-4 py-3 text-sm border">
                            <x-button primary wire:click='showEditModal({{ $cast->id }})'>{{ __('Edit') }}</x-button>
                            <x-button danger wire:click='delete({{ $cast->id }})'>{{ __('Delete') }}</x-button>
                        </td>
                    </tr>
                    @empty
                    <tr class="text-gray-700"><td colspan="5" class="text-center">{{ __('No records found!') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
            {{ $casts->links() }}
        </div>
    </div>
    <x-dialog-modal wire:model='showCastModal'>
        <x-slot name="title">{{ __('Update Cast') }}</x-slot>

        <x-slot name="content">
            <x-form-modal submit='#'>
                <x-slot name='form'>
                    <div class="w-full sm:col-span-4">
                        <x-label for="castName" value="{{ __('Cast Name') }}" />
                        <x-input id="castName" type="text" autofocus wire:model='castName'/>
                        <x-input-error for="castName" class="mt-2" />
                    </div>
                    <div class="w-full sm:col-span-4">
                        <x-label for="castPosterPath" value="{{ __('Cast Poster') }}" />
                        <x-input id="castPosterPath" type="text" autofocus wire:model='castPosterPath'/>
                        <x-input-error for="castPosterPath" class="mt-2" />
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
