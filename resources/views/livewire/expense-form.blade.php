<div class="p-2">
    <div class="max-w-7xl mx-auto px-2 lg:px-8">
        <div class="flex gap-2">
            <!-- Expense Form -->
            <div class="w-1/3 bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <form wire:submit.prevent="{{ $expense_id ? 'update' : 'create' }}" class="mb-6">
                    <div class="mb-4">
                        <div class="mb-4">
                            <x-input-label for="description">Description</x-input-label>
                            <x-text-input type="text" id="description" wire:model="description" class="w-full mt-1"></x-text-input>
                            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label for="amount">Amount</x-input-label>
                            <x-text-input type="number" id="amount" wire:model="amount" step="0.01" class="w-full mt-1"></x-text-input>
                            @error('amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label for="category" class="block text-sm font-medium text-gray-700">Category</x-input-label>
                            <x-select wire:model="category_id" id="category" class="w-full mt-1 border border-gray-300 rounded-md shadow-sm">
                                <option value="">Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </x-select>
                            @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label for="date">Date</x-input-label>
                            <div class="flex items-center space-x-2">
                                <x-text-input type="date" id="date" wire:model="date" class="w-full mt-1"></x-text-input>
                                <x-secondary-button type="button" wire:click="setTodayDate">
                                    Today
                                </x-secondary-button>
                            </div>
                            @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <x-primary-button type="submit">
                        {{ $expense_id ? 'Update Expense' : 'Add Expense' }}
                    </x-primary-button>
                </form>
            </div>

            <div class="w-2/3 flex flex-col gap-2">
                <!-- Display the total expenses -->
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <div class="flex justify-between items-center">
                        <x-input-label class="text-gray-700 dark:text-gray-300">Total Expenses</x-input-label>
                        <h3 class="text-xl font-bold text-gray-700 dark:text-gray-300">RM {{ number_format($totalExpenses, 2) }}</h3>
                    </div>
                </div>

                <!-- Expenses List -->
                <div class="flex-grow bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 overflow-auto">
                    <table class="table min-w-full mt-1">
                        <thead>
                            <tr class="text-bold text-gray-700 dark:text-gray-300">
                                <th class="py-2 px-4 border-b">Description</th>
                                <th class="py-2 px-4 border-b">Amount</th>
                                <th class="py-2 px-4 border-b">Category</th>
                                <th class="py-2 px-4 border-b">Date</th>
                                <th class="py-2 px-4 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expenses as $expense)
                                <tr class="text-cente">
                                    <td class="py-2 px-4 w-48 text-center text-gray-700 dark:text-gray-300 border-b border-gray-700">{{ $expense->description }}</td>
                                    <td class="py-2 px-4 text-center text-gray-700 dark:text-gray-300 border-b border-gray-700">RM {{ number_format($expense->amount, 2) }}</td>
                                    <td class="py-2 px-4 text-center text-gray-700 dark:text-gray-300 border-b border-gray-700">{{ $expense->category->name }}</td>
                                    <td class="py-2 px-4 text-center text-gray-700 dark:text-gray-300 border-b border-gray-700">{{ $expense->date }}</td>
                                    <td class="py-2 px-4 text-center text-gray-700 dark:text-gray-300 border-b border-gray-700">
                                        <x-primary-button wire:click="edit({{ $expense->id }})" class="bg-yellow-500 text-white px-3 py-1 rounded-md">Edit</x-primary-button>
                                        <x-danger-button wire:click="delete({{ $expense->id }})" class="bg-red-500 text-white px-3 py-1 rounded-md ml-2">Delete</x-danger-button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
