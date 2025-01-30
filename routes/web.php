<?php

use App\Livewire\ExpenseForm;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/expense-form', ExpenseForm::class)->name('expense-form');
