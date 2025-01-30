<div>
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
            <div class="bg-white p-6 rounded-lg w-full max-w-md">
                <h2 class="text-xl font-bold mb-4">{{ $category_id ? 'Edit Category' : 'Add Category' }}</h2>

                <form wire:submit.prevent="{{ $category_id ? 'update' : 'create' }}">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                        <input wire:model="name" type="text" id="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="button" wire:click="resetInputFields" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancel</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>

    <!-- Display categories in a table -->
    <div class="mt-6">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $category->name }}</td>
                        <td class="py-2 px-4 border-b">
                            <button wire:click="edit({{ $category->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                            <button wire:click="delete({{ $category->id }})" class="bg-red-500 text-white px-2 py-1 rounded ml-2">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
