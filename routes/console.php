<?php

use Illuminate\Support\Facades\Schedule;
use App\Http\Controllers\XController;

// X synchronization is intentionally opt-in. Configure the bearer token first.
Schedule::call(function () {
    app(XController::class)->sync();
})->name('sync-x-posts')->everyFifteenMinutes()->withoutOverlapping();
