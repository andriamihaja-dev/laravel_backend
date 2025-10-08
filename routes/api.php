<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\RefundController;

Route::apiResource('customers', CustomerController::class);
Route::apiResource('payments', PaymentController::class);
Route::apiResource('refunds', RefundController::class);
