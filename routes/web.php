<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\EmployeesController;
use App\Models\Department;
use App\Models\Employee;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::get('dashboard', [EmployeesController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

//Department Routes - CRUD operations
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/departments', [DepartmentsController::class, 'index'])->name('departments.index');
    Route::post('/departments', [DepartmentsController::class, 'store'])->name('departments.store');
    Route::get('/departments/{department}/edit', [DepartmentsController::class, 'edit'])->name('departments.edit');
    Route::put('/departments/{department}', [DepartmentsController::class, 'update'])->name('departments.update');
    Route::delete('/departments/{department}', [DepartmentsController::class, 'destroy'])->name('departments.destroy');
});

//Employee Routes - CRUD operations
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/employees', [EmployeesController::class, 'index'])->name('employees.index');
    Route::post('/employees', [EmployeesController::class, 'store'])->name('employees.store');
    Route::get('/employees/{employee}/edit', [EmployeesController::class, 'edit'])->name('employees.edit'); 
    Route::put('/employees/{employee}', [EmployeesController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{employee}', [EmployeesController::class, 'destroy'])->name('employees.destroy');
    Route::get('/employees/export', [EmployeesController::class, 'exportPDF'])->name('employees.export');

    Route::get('/employees/trash', [EmployeesController::class, 'trash'])->name('employees.trash');
    Route::post('/employees/{id}/restore', [EmployeesController::class, 'restore'])->name('employees.restore');
    Route::delete('/employees/{id}/force-delete', [EmployeesController::class, 'forceDelete'])->name('employees.force-delete');
});
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
