<div class="p-6 max-w-lg mx-auto bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold mb-4">Manage Your Budget</h2>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="p-2 bg-green-500 text-white rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Month Tabs -->
    <div class="flex mb-4 space-x-2 overflow-x-auto">
        @foreach($months as $month)
            <button wire:click="selectMonth({{ $month->id }})"
                class="px-4 py-2 rounded {{ $month_id == $month->id ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">
                {{ $month->name }}
            </button>
        @endforeach
    </div>

    <!-- Budget Form -->
    @if($month_id)
        <form wire:submit.prevent="save">
            @foreach($categories as $category)
                <div class="mb-3 flex items-center space-x-2">
                    <label class="block font-medium w-1/2">{{ $category->name }}</label>
                    <input
                        type="number"
                        wire:model="budgets.{{ $category->id }}"
                        class="w-full border p-2 rounded text-gray-700"
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
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">
                        Save
                    </button>
                @else
                    <button type="button" wire:click="edit" class="px-4 py-2 bg-blue-500 text-white rounded">
                        Edit
                    </button>
                @endif
            </div>
        </form>
    @endif
</div>
