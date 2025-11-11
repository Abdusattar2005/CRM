<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\StatisticsController;

Route::post('/tickets', [TicketController::class,'store']);
Route::get('/tickets/statistics', [StatisticsController::class,'index']);

Route::middleware(['auth','role:manager|admin'])->group(function() {
    Route::get('/tickets', [TicketController::class,'index']);
    Route::get('/tickets/{ticket}', [TicketController::class,'show']);
    Route::patch('/tickets/{ticket}/status', [TicketController::class,'updateStatus']);
});
