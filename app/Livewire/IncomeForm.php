<?php

namespace App\Livewire;

use Illuminate\Support\Carbon;
use App\Models\Income;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class IncomeForm extends Component
{
    public $sources;
    public $source_id;
    public $incomes, $description, $amount, $date, $income_id;
    public $totalIncomes;

    public function render()
    {
        $this->sources = Category::where('user_id', Auth::id())->get();
        $this->incomes = Income::where('user_id', Auth::id())->get();
        $this->totalIncomes = Income::where('user_id', Auth::id())->sum('amount');

        return view('livewire.income-form');
    }

    public function create()
    {
        $this->validate([
            'description' => 'required',
            'amount' => 'required|numeric',
            'source_id' => 'required|exists:sources,id',
        ]);

        Income::create([
            'user_id' => Auth::id(),
            'description' => $this->description,
            'amount' => $this->amount,
            'source_id' => $this->source_id,
            'date' => Carbon::now()->toDateString(),
        ]);

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $Income = Income::where('user_id', Auth::id())->findOrFail($id);
        $this->income_id = $id;
        $this->description = $Income->description;
        $this->amount = $Income->amount;
        $this->source_id = $Income->source_id; // Populate source_id
        $this->date = $Income->date;
    }

    public function update()
    {
        $this->validate([
            'description' => 'required',
            'amount' => 'required|numeric',
            'source_id' => 'required|exists:sources,id',
        ]);

        $Income = Income::where('user_id', Auth::id())->findOrFail($this->Income_id);
        $Income->update([
            'description' => $this->description,
            'amount' => $this->amount,
            'source_id' => $this->source_id,
            'date' => $this->date,
        ]);

        $this->resetInputFields();
    }

    public function delete($id)
    {
        Income::where('user_id', Auth::id())->where('id', $id)->delete();
    }

    private function resetInputFields()
    {
        $this->description = '';
        $this->amount = '';
        $this->source_id = ''; // Reset source_id
        $this->date = '';
        $this->income_id = null;
    }

    public function setTodayDate()
    {
        $this->date = Carbon::now()->toDateString();
    }
}
