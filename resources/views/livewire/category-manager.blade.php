<div class="p-2">
    <div class="max-w-7xl mx-auto px-2 lg:px-8">
        <div class="flex gap-2">
            <!-- Form Section -->
            <div class="bg-white dark:bg-gray-800 shadow-sm p-6 rounded-lg w-1/3">
                <h2 class="text-xl text-gray-700 dark:text-gray-300 font-bold mb-4">{{ $category_id ? 'Edit Category' : 'Add Category' }}</h2>

                <form wire:submit.prevent="{{ $category_id ? 'update' : 'create' }}">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category Name</label>
                        <input wire:model="name" type="text" id="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end">
                        <x-secondary-button type="button" wire:click="resetInputFields" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancel</x-secondary-button>
                        <x-primary-button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Table Section -->
            <div class="w-2/3 p-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-2 px-4 border-b">Name</th>
                            <th class="py-2 px-4 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td class="py-2 px-4 text-center text-gray-700 dark:text-gray-300 border-b">{{ $category->name }}</td>
                                <td class="py-2 px-4 text-center border-b">
                                    <x-primary-button wire:click="edit({{ $category->id }})">Edit</x-primary-button>
                                    <x-secondary-button wire:click="delete({{ $category->id }})" class="ml-2">Delete</x-secondary-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
