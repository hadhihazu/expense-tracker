<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Budget;
use App\Models\Month;
use App\Models\Category;
use Carbon\Carbon;

class BudgetForm extends Component
{
    public $month_id;
    public $budgets = [];
    public $categories = [];
    public $months = [];
    public $isEditing = false;

    public function mount()
    {
        $this->months = Month::all();
        $this->categories = Category::where('user_id', Auth::id())->get();

        // Automatically set the default month to the current month
        $currentMonth = Carbon::now()->month;
        $this->month_id = Month::where('name', Carbon::now()->format('F'))->value('id');

        // Load budget data for the current month
        $this->loadBudgets();
    }

    public function selectMonth($monthId)
    {
        $this->month_id = $monthId;
        $this->loadBudgets();
    }

    public function loadBudgets()
    {
        $existingBudgets = Budget::where('user_id', Auth::id())
            ->where('month_id', $this->month_id)
            ->get();

        if ($existingBudgets->isNotEmpty()) {
            foreach ($existingBudgets as $budget) {
                $this->budgets[$budget->category_id] = $budget->amount;
            }
            $this->isEditing = false; // Start in view mode
        } else {
            $this->budgets = [];
            $this->isEditing = true; // Allow input for new budgets
        }
    }

    public function save()
    {
        $this->validate([
            'month_id' => 'required|exists:months,id',
            'budgets' => 'required|array',
            'budgets.*' => 'numeric|min:0',
        ]);

        foreach ($this->budgets as $category_id => $amount) {
            Budget::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'month_id' => $this->month_id,
                    'category_id' => $category_id,
                ],
                [
                    'amount' => $amount,
                ]
            );
        }

        $this->isEditing = false; // Switch back to view mode
        session()->flash('message', 'Budget saved successfully!');
    }

    public function edit()
    {
        $this->isEditing = true;
    }

    public function deleteBudget($category_id)
    {
        Budget::where('user_id', Auth::id())
            ->where('month_id', $this->month_id)
            ->where('category_id', $category_id)
            ->delete();

        unset($this->budgets[$category_id]); // Remove from UI
    }

    public function render()
    {
        return view('livewire.budget-form');
    }
}
