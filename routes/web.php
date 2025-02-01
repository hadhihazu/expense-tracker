<?php

use App\Livewire\BudgetForm;
use App\Livewire\IncomeForm;
use App\Livewire\ExpenseForm;
use App\Livewire\CategoryManager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Livewire\PieChart;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/expenses', ExpenseForm::class)->name('expenses');
    Route::get('/incomes', IncomeForm::class)->name('incomes');
    Route::get('/categories', CategoryManager::class)->name('categories');
    Route::get('/budgets', BudgetForm::class)->name('budgets');
    Route::get('/pie-charts', PieChart::class)->name('pie-charts');
});

require __DIR__ . '/auth.php';
