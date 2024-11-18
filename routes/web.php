<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GooglePageSpeedController;
use App\Http\Controllers\HistoryMetricsController;

Route::get('/', function () {
    return view('index');
});

Route::get('/pagespeed-metrics', [GooglePageSpeedController::class, 'getMetrics'])->name('metrics.get');
Route::get('/datatable', [HistoryMetricsController::class, 'datatable'])->name('metrics.datatable');
Route::post('/store-metrics', [HistoryMetricsController::class, 'storeMetrics'])->name('metrics.store');

