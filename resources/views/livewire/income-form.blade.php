<div class="p-2">
    <div class="max-w-7xl mx-auto px-2 lg:px-8">
        <div class="flex gap-2">
            <!-- Income Form -->
            <div class="w-1/3 bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <form wire:submit.prevent="{{ $income_id ? 'update' : 'create' }}" class="mb-6">
                    <div class="mb-4">
                        <div class="mb-4">
                            <x-input-label for="description">Description</x-input-label>
                            <x-text-input type="text" id="description" wire:model="description" class="mt-1 w-full"></x-text-input>
                            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label for="amount">Amount</x-input-label>
                            <x-text-input type="number" id="amount" wire:model="amount" step="0.01" class="mt-1 w-full"></x-text-input>
                            @error('amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label for="source">Source</x-input-label>
                            <x-select class="mt-1 w-full" wire:model="source_id" id="source">
                                <option value="">Select a source</option>
                                @foreach ($sources as $source)
                                    <option value="{{ $source->id }}">{{ $source->name }}</option>
                                @endforeach
                            </x-select>
                            @error('source_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label for="date">Date</x-input-label>
                            <div class="flex items-center space-x-2">
                                <x-text-input class="mt-1 w-full" type="date" id="date" wire:model="date"></x-text-input>
                                <x-secondary-button type="button" wire:click="setTodayDate">
                                    Today
                                </x-secondary-button>
                            </div>
                            @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <x-primary-button type="submit">
                        {{ $income_id ? 'Update income' : 'Add income' }}
                    </x-primary-button>
                </form>
            </div>

            <!-- Right Section: Total Income (Top) + Income List (Bottom) -->
            <div class="w-2/3 flex flex-col gap-2">
                <!-- Total Income (Top) -->
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <div class="flex justify-between items-center">
                        <x-input-label class="text-gray-700 dark:text-gray-300">Total Incomes</x-input-label>
                        <h3 class="text-xl font-bold text-gray-700 dark:text-gray-300">RM {{ number_format($totalIncomes, 2) }}</h3>
                    </div>
                </div>

                <!-- Income List (Bottom) -->
                <div class="flex-grow bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 overflow-auto">
                    <table class="table min-w-full">
                        <thead>
                            <tr class="text-bold text-gray-700 dark:text-gray-300">
                                <th class="py-2 px-4 border-b">Description</th>
                                <th class="py-2 px-4 border-b">Amount</th>
                                <th class="py-2 px-4 border-b">Source</th>
                                <th class="py-2 px-4 border-b">Date</th>
                                <th class="py-2 px-4 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($incomes as $income)
                                <tr class="text-center">
                                    <td class="py-2 px-4 w-48 text-center text-gray-700 dark:text-gray-300 border-b border-gray-700">{{ $income->description }}</td>
                                    <td class="py-2 px-4 text-center text-gray-700 dark:text-gray-300 border-b border-gray-700">RM {{ number_format($income->amount, 2) }}</td>
                                    <td class="py-2 px-4 text-center text-gray-700 dark:text-gray-300 border-b border-gray-700">{{ $income->source->name }}</td>
                                    <td class="py-2 px-4 text-center text-gray-700 dark:text-gray-300 border-b border-gray-700">{{ $income->date }}</td>
                                    <td class="py-2 px-4 text-center border-b border-gray-700">
                                        <x-primary-button wire:click="edit({{ $income->id }})">Edit</x-primary-button>
                                        <x-danger-button wire:click="delete({{ $income->id }})" class="ml-2">Delete</x-danger-button>
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
