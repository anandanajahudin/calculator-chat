<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\OperationController;

Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/index', [DashboardController::class, 'index'])->name('index');

Route::get('/calculator', [CalculatorController::class, 'index'])->name('calculator.index');
Route::get('/calculator/create', [CalculatorController::class, 'create'])->name('calculator.create');
Route::post('/calculator/store', [CalculatorController::class, 'store'])->name('calculator.store');

// Calculator Result
Route::get('/calculator/show/{id}', [CalculatorController::class, 'show'])->name('calculator.show');
Route::get('/calculator/about/{id}', [CalculatorController::class, 'about'])->name('calculator.about');
Route::get('/calculator/help/{id}', [CalculatorController::class, 'help'])->name('calculator.help');
Route::get('/calculator/profile/{id}', [CalculatorController::class, 'profile'])->name('calculator.profile');
Route::get('/calculator/history', [CalculatorController::class, 'history'])->name('calculator.history');

// Library
Route::get('/operation', [OperationController::class, 'index'])->name('operation.index');