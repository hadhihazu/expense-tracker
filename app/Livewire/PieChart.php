<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Month;
use App\Models\Budget;
use App\Models\Income;
use App\Models\Expense;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PieChart extends Component
{
    public $pieChartData, $barChartData, $lineChartData, $doughnutChartData;
    public $totalExpenses, $totalIncomes, $totalTransactions;

    public function mount()
    {
        $this->byCategory();
        $this->byMonth();
        $this->bySource();
        $this->calculateTotals();
    }

    public function byCategory()
    {
        // Fetch expenses grouped by category (for Pie Chart)
        $expensesByCategory = Expense::where('user_id', Auth::id())
            ->selectRaw('category_id, SUM(amount) as total')
            ->groupBy('category_id')
            ->with('category')
            ->get();

        $this->pieChartData = [
            'labels' => $expensesByCategory->pluck('category.name'),
            'data' => $expensesByCategory->pluck('total'),
        ];
    }

    public function bySource()
    {
        // Fetch income grouped by source (for Doughnut Chart)
        $incomeBySource = Income::where('user_id', Auth::id())
            ->selectRaw('source_id, SUM(amount) as total')
            ->groupBy('source_id')
            ->with('source') // Ensure the source relation is loaded
            ->get();

        $this->doughnutChartData = [
            'labels' => $incomeBySource->pluck('source.name'),
            'data' => $incomeBySource->pluck('total'),
        ];
    }

    public function byMonth()
    {
        // Fetch expenses grouped by month
        $expensesByMonth = Expense::where('user_id', Auth::id())
            ->selectRaw('DATE_FORMAT(date, "%Y-%m") as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->pluck('total', 'month')
            ->toArray();

        // Fetch budgets grouped by month, ensuring `month.name` is properly accessed
        $budgetsByMonth = Budget::where('user_id', Auth::id())
            ->selectRaw('month_id, SUM(amount) as total')
            ->groupBy('month_id')
            ->with('month')
            ->get()
            ->mapWithKeys(function ($budget) {
                return [$budget->month->name => $budget->total];
            })
            ->toArray();

        // Get months from the database
        $months = Month::pluck('name', 'id');

        $expenseData = [];
        $budgetData = [];

        foreach ($months as $id => $name) {
            $monthIndex = str_pad($id, 2, '0', STR_PAD_LEFT); // Convert 1 -> "01"
            $formattedMonth = date('Y') . '-' . $monthIndex; // E.g., "2024-01"

            $expenseData[$formattedMonth] = $expensesByMonth[$formattedMonth] ?? 0;
            $budgetData[$formattedMonth] = $budgetsByMonth[$name] ?? 0;
        }

        // Assign data for Livewire view
        $this->barChartData = [
            'labels' => array_keys($expenseData),
            'expenses' => array_values($expenseData),
            'budgets' => array_values($budgetData),
        ];

        // Line Chart Data for Budget
        $this->lineChartData = [
            'labels' => array_keys($budgetData),
            'budgets' => array_values($budgetData),
        ];
    }

    public function calculateTotals()
    {
        $this->totalExpenses = Expense::where('user_id', Auth::id())->sum('amount');
        $this->totalIncomes = Income::where('user_id', Auth::id())->sum('amount');
        $this->totalTransactions = Expense::where('user_id', Auth::id())->count() +
            Income::where('user_id', Auth::id())->count();
    }

    public function render()
    {
        return view('livewire.pie-chart');
    }
}
