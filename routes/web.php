<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\Categories\ExpenseController as ExpenseCategoriesController;
use App\Http\Controllers\Categories\IncomeController as IncomeCategoriesController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('register');
});

require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('chirps', ChirpController::class)
    ->only(['index', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::resource('expense-categories', ExpenseCategoriesController::class);
    Route::resource('income-categories', IncomeCategoriesController::class);
    Route::resource('expenses', ExpenseController::class);
    Route::resource('incomes', IncomeController::class);
});

Route::middleware(HandlePrecognitiveRequests::class)->group(function () {
    Route::post('chirps/store', [ChirpController::class, 'store'])->name('chirps.store');
});

