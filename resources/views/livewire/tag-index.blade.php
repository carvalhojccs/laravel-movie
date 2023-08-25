<section class="container p-6 mx-auto font-mono">
    <div class="flex justify-end w-full p-2 mb-4">
        <x-button wire:click='showCreateModal'>{{ __('Create Tag') }}</x-button>
    </div>
    <div class="w-full mb-8 overflow-auto rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="font-semibold tracking-wide text-left text-gray-900 uppercase bg-gray-100 border-b border-gray-600 text-md">
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Slug</th>
                        <th class="px-4 py-3">Manage</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse ($tags as $tag)
                    <tr class="text-gray-700">
                        <td class="px-4 py-3 border">{{ $tag->tag_name }}</td>
                        <td class="px-4 py-3 font-semibold border text-ms">{{ $tag->slug }}</td>
                        <td class="px-4 py-3 text-sm border">
                            <x-button primary wire:click='showEditModal({{ $tag->id }})'>{{ __('Edit') }}</x-button>
                            <x-button danger wire:click='delete({{ $tag->id }})'>{{ __('Delete') }}</x-button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td>
                            Nenhum registro encontrado!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <x-dialog-modal wire:model='showTagModal'>
        @if ($tag_id)
        <x-slot name="title">{{ __('Update Tag') }}</x-slot>
        @else
        <x-slot name="title">{{ __('Create Tag') }}</x-slot>
        @endif

        <x-slot name="content">
            <x-form-modal submit='#'>
                <x-slot name='form'>
                    <div class="w-full sm:col-span-4">
                        <x-label for="name" value="{{ __('Tag Name') }}" />
                        <x-input id="name" type="text" autofocus wire:model='name'/>
                        <x-input-error for="name" class="mt-2" />
                    </div>
                </x-slot>
            </x-form-section>
        </x-slot>
        <x-slot name="footer">
            <x-button danger wire:click='closeTagModal'>{{ __('Cancel') }}</x-button>
            @if ($tag_id)
            <x-button wire:click='update'>{{ __('Update') }}</x-button>
            @else
            <x-button wire:click='create'>{{ __('Create') }}</x-button>
            @endif
        </x-slot>
    </x-dialog-modal>
</section>
