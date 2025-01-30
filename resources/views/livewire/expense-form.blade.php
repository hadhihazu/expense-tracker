<div class="mt-10 p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-semibold mb-4">Expense Tracker</h2>
    <div class="d-flex justify-content-between row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card">
                <div class="card-body">
                    <!-- Expense Form -->
                    <form wire:submit.prevent="{{ $expense_id ? 'update' : 'create' }}" class="mb-6 w-50">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="description" class="block font-medium">Description</label>
                                <input type="text" id="description" wire:model="description" class="w-full border-gray-300 rounded-lg p-2">
                                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="amount" class="block font-medium">Amount</label>
                                <input type="number" id="amount" wire:model="amount" step="0.01" class="w-full border-gray-300 rounded-lg p-2">
                                @error('amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                                <select wire:model="category_id" id="category" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                    <option value="">Select a category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="date" class="block font-medium">Date</label>
                                <div class="flex items-center space-x-2">
                                    <input type="date" id="date" wire:model="date" class="w-full border-gray-300 rounded-lg p-2">
                                    <button type="button" wire:click="setTodayDate" class="bg-blue-500 text-white px-3 py-1 rounded-md">
                                        Today
                                    </button>
                                </div>
                                @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg">
                            {{ $expense_id ? 'Update Expense' : 'Add Expense' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <!-- Expenses List -->
                    <table class="w-50 border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 p-2">Description</th>
                                <th class="border border-gray-300 p-2">Amount</th>
                                <th class="border border-gray-300 p-2">Category</th>
                                <th class="border border-gray-300 p-2">Date</th>
                                <th class="border border-gray-300 p-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expenses as $expense)
                                <tr class="text-cente">
                                    <td class="border border-gray-300 p-2">{{ $expense->description }}</td>
                                    <td class="border border-gray-300 p-2">RM {{ number_format($expense->amount, 2) }}</td>
                                    <td class="border border-gray-300 p-2">{{ $expense->category->name }}</td>
                                    <td class="border border-gray-300 p-2">{{ $expense->date }}</td>
                                    <td class="border border-gray-300 p-2">
                                        <button wire:click="edit({{ $expense->id }})" class="bg-yellow-500 text-white px-3 py-1 rounded-md">Edit</button>
                                        <button wire:click="delete({{ $expense->id }})" class="bg-red-500 text-white px-3 py-1 rounded-md ml-2">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Display the total expenses -->
                    <div class="mt-4 p-4 bg-gray-100 rounded">
                        <strong>Total Expenses:</strong> RM {{ number_format($totalExpenses, 2) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
