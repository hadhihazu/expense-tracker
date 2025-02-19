<?php

use App\Livewire\BudgetForm;
use App\Livewire\IncomeForm;
use App\Livewire\ExpenseForm;
use App\Livewire\CategoryManager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Livewire\PieChart;
use App\Livewire\StatsChart;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/budget-page', function () {
    return view('budget-page');
})->middleware(['auth', 'verified'])->name('budget-page');

Route::get('/category-page', function () {
    return view('category-page');
})->middleware(['auth', 'verified'])->name('category-page');

Route::get('/expense-page', function () {
    return view('expense-page');
})->middleware(['auth', 'verified'])->name('expense-page');

Route::get('/income-page', function () {
    return view('income-page');
})->middleware(['auth', 'verified'])->name('income-page');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    Route::get('/expenses', ExpenseForm::class)->name('expenses');
    Route::get('/incomes', IncomeForm::class)->name('incomes');
    Route::get('/categories', CategoryManager::class)->name('categories');
    Route::get('/budgets', BudgetForm::class)->name('budgets');
    // Route::get('/pie-charts', StatsChart::class)->name('pie-charts');
});

require __DIR__ . '/auth.php';
