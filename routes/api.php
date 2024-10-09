<?php


use App\Http\Controllers\Order\OrderIndexController;
use Illuminate\Support\Facades\Route;

Route::get('backoffice/orders', OrderIndexController::class);
