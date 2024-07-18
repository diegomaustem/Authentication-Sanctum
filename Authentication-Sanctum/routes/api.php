<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login']);

Route::get('getUsers', [UserController::class, 'getUsers']);
Route::get('getUser/{user}', [UserController::class, 'getUser']);

Route::get('getInvoices', [InvoiceController::class, 'getInvoices']);
Route::get('getInvoice/{invoice}', [InvoiceController::class, 'getInvoice']);
Route::post('createInvoice', [InvoiceController::class, 'createInvoice']);
Route::put('updateInvoice/{invoice}', [InvoiceController::class, 'updateInvoice']);
Route::delete('deleteInvoice/{invoice}', [InvoiceController::class, 'deleteInvoice']);
