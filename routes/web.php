<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\PythonController;
use App\Http\Controllers\SigmaController;

// Company Profile
Route::get('/', [LandingController::class, 'index'])->name('index');

// Auth
Route::controller(LoginController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/signUp', 'signUp')->name('signUp');
    Route::get('/login', 'login')->name('login');
    Route::post('/signIn', 'signIn')->name('signIn');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});

Route::middleware(['auth', 'auth.session'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');

    // Calculator
    Route::get('/calculator', [CalculatorController::class, 'index'])->name('calculator.index');
    Route::get('/calculator/create', [CalculatorController::class, 'create'])->name('calculator.create');
    Route::post('/calculator/store', [CalculatorController::class, 'store'])->name('calculator.store');

    // Calculator Result
    Route::get('/calculator/show/{id}', [CalculatorController::class, 'show'])->name('calculator.show');
    Route::get('/calculator/about/{id}', [CalculatorController::class, 'about'])->name('calculator.about');
    Route::get('/calculator/help/{id}', [CalculatorController::class, 'help'])->name('calculator.help');
    Route::get('/calculator/profile/{id}', [CalculatorController::class, 'profile'])->name('calculator.profile');
    Route::get('/calculator/history/{id}', [CalculatorController::class, 'history'])->name('calculator.history');

    Route::get('/calculator/sigma', [SigmaController::class, 'index'])->name('sigma.index');
    Route::post('/calculator/store', [SigmaController::class, 'store'])->name('sigma.store');
    // Library
    Route::get('/operation', [OperationController::class, 'index'])->name('operation.index');

    // Python
    Route::post('/generate-plot-equation', [PythonController::class, 'generatePlotEquation'])->name('generatePlotEquation');
    // Route::get('/generate-plot-equation', [PythonController::class, 'generatePlotEquation'])->name('generatePlotEquation');
    Route::post('/get-value', [PythonController::class, 'getValue'])->name('getValue');
    Route::post('/generate-plot', [PythonController::class, 'generatePlot'])->name('generatePlot');
    // Route::get('/generate-graph', [PythonController::class, 'generateGraph'])->name('generateGraph');
    // Route::get('/generate-plot/{arg1}/{arg2}', [PythonController::class, 'generatePlot'])->name('generatePlot');
});
