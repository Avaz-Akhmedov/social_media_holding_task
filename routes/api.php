<?php

use App\Http\Controllers\DummyJsonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/dummy-json',DummyJsonController::class);
