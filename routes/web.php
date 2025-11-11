<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WidgetController;
use App\Http\Controllers\Admin\TicketAdminController;

Route::get('/widget', [WidgetController::class,'index'])->name('widget.index');

Route::middleware(['auth','role:manager|admin'])->prefix('admin')->group(function() {
    Route::get('tickets', [TicketAdminController::class,'index'])->name('admin.tickets.index');
    Route::get('tickets/{ticket}', [TicketAdminController::class,'show'])->name('admin.tickets.show');
    Route::post('tickets/{ticket}/status', [TicketAdminController::class,'updateStatus'])->name('admin.tickets.updateStatus');
});
