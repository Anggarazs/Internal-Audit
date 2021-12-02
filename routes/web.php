<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\FindingController;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auths.login');
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'postLogin']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'postRegister']);
Route::get('/register', [RegisterController::class, 'createDepartment']);



Route::middleware(['auth', 'role:auditor'])->group(function () {
    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Event Audit
    Route::get('/audit', [AuditController::class, 'index_audit']);
    Route::get('/view_detail_audit/{id}', [AuditController::class, 'view_detail_audit']);
    Route::get('/view_insert_audit', [AuditController::class, 'view_insert_audit']);
    Route::post('/insert_audit', [AuditController::class, 'insert_audit']);
    Route::get('/edit_audit/{id}', [AuditController::class, 'edit_audit']);
    Route::post('/edit_audit_process', [AuditController::class, 'edit_audit_process']);
    Route::get('/delete_audit/{id}', [AuditController::class, 'delete_audit']);

    // Account Management
    Route::get('/account', [AccountController::class, 'index_account']);
    Route::post('/insert_account', [AccountController::class, 'insert_account']);
    Route::get('/edit_account/{id}', [AccountController::class, 'edit_account']);
    Route::post('/edit_account_process', [AccountController::class, 'edit_account_process']);
    Route::get('/delete_account/{id}', [AccountController::class, 'delete_account']);

    // Item Audit
    Route::post('/insert_finding', [FindingController::class, 'insert_finding']);
    Route::post('/insert_root', [FindingController::class, 'insert_root']);
    Route::post('/insert_CA', [FindingController::class, 'insert_CA']);
    Route::get('/edit_finding/{id}', [FindingController::class, 'edit_finding']);
    Route::post('/edit_finding_process', [FindingController::class, 'edit_finding_process']);
    Route::get('/delete_finding/{id}', [FindingController::class, 'delete_finding']);
    Route::get('/data_tampil', [FindingController::class, 'data_tampil']);
    Route::get('/tampil_finding', [FindingController::class, 'tampil_finding']);
    Route::get('/tampil_finding_ca', [FindingController::class, 'tampil_finding_ca']);
    Route::get('/tampil_root_ca', [FindingController::class, 'tampil_root_ca']);
    Route::post('/approve_ca/{id}', [FindingController::class, 'approve_ca']);
    Route::post('/reject_ca_process/{id}', [FindingController::class, 'reject_ca_process']);
    Route::post('/follow_up_ca/{id}', [FindingController::class, 'follow_up_ca']);
});

Route::middleware(['auth'])->group(function () {
     // Item Audit
     Route::get('/finding', [FindingController::class, 'index_finding']);
     Route::post('/follow_up_ca/{id}', [FindingController::class, 'follow_up_ca']);
     
    
});







