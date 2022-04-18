<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ParrainController;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
    });

Route::resource('/parrains', ParrainController::class)->only(['edit', 'update', 'destroy']);

Route::get('/exportcsv', [ParrainController::class, 'exportCsv'])->name('exportcsv');
Route::get('/exportExcel', [ParrainController::class, 'exportExcel'])->name('exportExcel');
Route::get('/exportPdf', [ParrainController::class, 'exportPdf'])->name('exportPdf');