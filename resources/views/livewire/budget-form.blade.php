<div class="p-2">
    <div class="max-w-7xl mx-auto px-2 lg:px-8">
        <div class="p-6 mb-2 rounded-lg bg-white dark:bg-gray-800 shadow-sm">
            <!-- Success Message -->
            @if (session()->has('message'))
                <div class="p-2 bg-green-500 text-white rounded mb-4">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Month Tabs -->
            <div class="text-center flex items-center space-x-2 overflow-x-auto">
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
        </div>

        <div class="p-6 rounded-lg bg-white dark:bg-gray-800 shadow-sm">
            <!-- Budget Form -->
            <div class="flex justify-center items-center w-full">
                @if($month_id)
                    <form wire:submit.prevent="save" class="w-full max-w-lg">
                        <div class="flex flex-col items-center space-y-4">
                            @foreach($categories as $category)
                                <div class="flex items-center space-x-4 w-full">
                                    <label class="font-medium w-1/3 text-gray-700 dark:text-gray-300 text-center">
                                        {{ $category->name }}
                                    </label>
                                    <input
                                        wire:model="budgets.{{ $category->id }}"
                                        class="w-2/3 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
                                        {{ $isEditing ? '' : 'disabled' }}
                                    />
                                    @if($isEditing && isset($budgets[$category->id]))
                                        <x-danger-button
                                            type="button"
                                            wire:click="deleteBudget({{ $category->id }})"
                                            class="px-3 py-1"
                                        >
                                            ✕
                                        </x-danger-button>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-center space-x-4 mt-6">
                            @if($isEditing)
                                <x-secondary-button type="button" wire:click="cancelEdit">
                                    Cancel
                                </x-secondary-button>
                                <x-primary-button type="submit">
                                    Save
                                </x-primary-button>
                            @else
                                <x-primary-button type="button" wire:click="edit">
                                    Edit
                                </x-primary-button>
                            @endif
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
