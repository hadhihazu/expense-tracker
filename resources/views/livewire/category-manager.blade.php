<div class="p-2">
    <div class="max-w-7xl mx-auto px-2 lg:px-8">
        <div class="flex gap-2">
            <!-- Form Section -->
            <div class="bg-white dark:bg-zinc-800 shadow-sm p-6 rounded-lg w-1/3">

                <form wire:submit.prevent="{{ $category_id ? 'update' : 'create' }}">
                    <div class="mb-4">
                        <x-input-label for="name">Category Name</x-input-label>
                        <x-text-input wire:model="name" type="text" id="name" class="mt-1 w-full"/>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex">
                        <x-secondary-button type="button" wire:click="resetInputFields" class="mr-2">
                            Cancel
                        </x-secondary-button>
                        <x-primary-button type="submit">
                            Save
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Table Section -->
            <div class="table-responsive w-2/3 p-6 bg-white dark:bg-zinc-800 shadow-sm rounded-lg">
                <table class="table min-w-full">
                    <thead>
                        <tr class="text-bold text-zinc-700 dark:text-zinc-300">
                            <th class="py-2 px-4 border-b">Name</th>
                            <th class="py-2 px-4 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td class="py-2 px-4 text-center text-zinc-700 dark:text-zinc-300 border-b border-zinc-700">
                                    {{ $category->name }}
                                </td>
                                <td class="py-2 px-4 text-center border-b border-zinc-700">
                                    <x-primary-button wire:click="edit({{ $category->id }})">
                                        Edit
                                    </x-primary-button>
                                    <x-secondary-button wire:click="delete({{ $category->id }})" class="ml-2">
                                        Delete
                                    </x-secondary-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
