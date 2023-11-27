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

    Route::controller(CalculatorController::class)->group(function() {
        // Calculator
        Route::get('/calculator', 'index')->name('calculator.index');
        Route::get('/calculator/create', 'create')->name('calculator.create');
        Route::post('/calculator/store', 'store')->name('calculator.store');

        // Calculator Result
        Route::get('/calculator/show/{id}', 'show')->name('calculator.show');
        Route::get('/calculator/about/{id}', 'about')->name('calculator.about');
        Route::get('/calculator/help/{id}', 'help')->name('calculator.help');
        Route::get('/calculator/profile/{id}', 'profile')->name('calculator.profile');
        Route::get('/calculator/history/{id}', 'history')->name('calculator.history');

        Route::get('/calculator/sigma', 'sigma')->name('calculator.sigma');
        Route::get('/calculator/graph', 'graph')->name('calculator.graph');
        Route::post('/calculator/sigmaStore', 'store')->name('calculator.sigmaStore');
    });

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
