<?php

namespace App\Livewire;

use App\Models\Expense;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ExpenseForm extends Component
{
    public $categories;
    public $category_id;
    public $expenses, $description, $amount, $category, $date, $expense_id;
    public $totalExpenses;

    public function render()
    {
        $this->categories = Category::where('user_id', Auth::id())->get();
        $this->expenses = Expense::where('user_id', Auth::id())->get();
        $this->totalExpenses = Expense::where('user_id', Auth::id())->sum('amount');
        return view('livewire.expense-form');
    }

    public function create()
    {
        $this->validate([
            'description' => 'required',
            'amount' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        Expense::create([
            'user_id' => Auth::id(),
            'description' => $this->description,
            'amount' => $this->amount,
            'category_id' => $this->category_id,
            'date' => Carbon::now()->toDateString(),
        ]);

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $expense = Expense::where('user_id', Auth::id())->findOrFail($id);
        $this->expense_id = $id;
        $this->description = $expense->description;
        $this->amount = $expense->amount;
        $this->category_id = $expense->category_id; // Populate category_id
        $this->date = $expense->date;
    }

    public function update()
    {
        $this->validate([
            'description' => 'required',
            'amount' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $expense = Expense::where('user_id', Auth::id())->findOrFail($this->expense_id);
        $expense->update([
            'description' => $this->description,
            'amount' => $this->amount,
            'category_id' => $this->category_id,
            'date' => $this->date,
        ]);

        $this->resetInputFields();
    }

    public function delete($id)
    {
        Expense::where('user_id', Auth::id())->where('id', $id)->delete();
    }

    private function resetInputFields()
    {
        $this->description = '';
        $this->amount = '';
        $this->category_id = ''; // Reset category_id
        $this->date = '';
        $this->expense_id = null;
    }

    public function setTodayDate()
    {
        $this->date = Carbon::now()->toDateString();
    }
}
