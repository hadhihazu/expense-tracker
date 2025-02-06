<div class="p-2">
    <div class="max-w-7xl mx-auto px-2 lg:px-8">
        <div class="p-6 rounded-lg bg-white dark:bg-gray-800 shadow-sm">
            <h2 class="text-2xl font-semibold mb-4 text-gray-700 dark:text-gray-300">Manage Your Budget</h2>

            <!-- Success Message -->
            @if (session()->has('message'))
                <div class="p-2 bg-green-500 text-white rounded mb-4">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Month Tabs -->
            <div class="text-center flex items-center mb-4 space-x-2 overflow-x-auto">
                @foreach($months as $month)
                    @if ($month_id == $month->id)
                        <x-primary-button wire:click="selectMonth({{ $month->id }})" class="px-4 py-2 rounded">
                            {{ $month->name }}
                        </x-primary-button>
                    @else
                        <x-secondary-button wire:click="selectMonth({{ $month->id }})" class="px-4 py-2 rounded">
                            {{ $month->name }}
                        </x-secondary-button>
                    @endif
                @endforeach
            </div>

            <!-- Budget Form -->
            @if($month_id)
                <form wire:submit.prevent="save">
                    @foreach($categories as $category)
                        <div class="mb-3 flex items-center space-x-2">
                            <label class="block font-medium w-1/4 text-gray-700 dark:text-gray-300 text-center">{{ $category->name }}</label>
                            <input
                                type="number"
                                wire:model="budgets.{{ $category->id }}"
                                class="border p-2 rounded text-gray-700"
                                placeholder="Enter amount"
                                {{ $isEditing ? '' : 'disabled' }}
                            >
                            @if($isEditing && isset($budgets[$category->id]))
                                <button
                                    type="button"
                                    wire:click="deleteBudget({{ $category->id }})"
                                    class="px-3 py-1 bg-red-500 text-white rounded"
                                >
                                    ✕
                                </button>
                            @endif
                        </div>
                    @endforeach

                    <!-- Action Buttons -->
                    <div class="flex space-x-2 mt-4">
                        @if($isEditing)
                            <x-primary-button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">
                                Save
                            </x-primary-button>
                        @else
                            <x-primary-button type="button" wire:click="edit" class="px-4 py-2 bg-blue-500 text-white rounded">
                                Edit
                            </x-primary-button>
                        @endif
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
