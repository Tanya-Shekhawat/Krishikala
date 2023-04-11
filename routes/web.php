<?php

use App\Http\Controllers\AdminControllers\{AdminStationOfficer, CaseCategoryController, PoliceStationController};
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\OfficerControllers\OfficerStaffController;
use App\Http\Controllers\OfficerControllers\TaskController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route for Home Page
Route::get('/', function () {
    return view('welcome');
});

// Routes for Normal User with Authentication Setup
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Routes for Officers with Authentication Setup
Route::get('officer/dashboard', function () {
    return view('officer.dashboard');
})->middleware(['auth:officer', 'verified'])->name('officer.dashboard');

Route::middleware('auth:officer')->group(function () {
    Route::get('officer/profile', [ProfileController::class, 'edit'])->name('officer.profile.edit');
    Route::patch('officer/profile', [ProfileController::class, 'updateAdmin'])->name('officer.profile.update');
    Route::delete('officer/profile', [ProfileController::class, 'destroy'])->name('officer.profile.destroy');
});

require __DIR__ . '/officerauth.php';

// Routes for Admin with Authentication Setup
Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

Route::middleware('auth:admin')->group(function () {
    Route::get('admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('admin/profile', [ProfileController::class, 'updateAdmin'])->name('admin.profile.update');
    Route::delete('admin/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
});

require __DIR__ . '/adminauth.php';

// For deleting the data from DB
Route::get('/delete', [GeneralController::class, 'deleteData'])->name('delete');
Route::post('/status', [GeneralController::class, 'changeStatus'])->name('status');

// Admin Previliages Routes STARTS
Route::group(['middleware' => ['auth:admin', 'verified'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

    // Routes for Police Station 
    Route::get('/allstations', [PoliceStationController::class, 'viewAllStation'])->name('allstations');
    Route::get('/manageallstations', [PoliceStationController::class, 'addAllStation'])->name('manageallstations');
    Route::post('/savestation', [PoliceStationController::class, 'saveAllStation'])->name('savestation');
    Route::get('/manageallstations/edit', [PoliceStationController::class, 'updateAllStation'])->name('manageallstations.edit');


    // Routes for CRUD of Station Officer
    Route::get('/officers', [AdminStationOfficer::class, 'viewStationOfficer'])->name('officers');
    Route::get('/manageofficers', [AdminStationOfficer::class, 'addStationOfficer'])->name('manageofficers');
    Route::post('/saveofficer', [AdminStationOfficer::class, 'saveStationOfficer'])->name('saveofficer');
    Route::get('/manageofficers/edit', [AdminStationOfficer::class, 'updateStationOfficer'])->name('manageofficers.edit');

    Route::get('/policepersonnels', [AdminStationOfficer::class, 'viewStationOfficer'])->name('policepersonnels');
    Route::get('/managepolicepersonnels', [AdminStationOfficer::class, 'viewStationOfficer'])->name('managepolicepersonnels');

    // Routes for Case Category
    Route::get('/casecate', [CaseCategoryController::class, 'viewCaseCategory'])->name('casecate');
    Route::get('/managecasecate', [CaseCategoryController::class, 'manageCaseCategory'])->name('managecasecate');
    Route::post('/savecasecate', [CaseCategoryController::class, 'saveCaseCategory'])->name('savecasecate');
    Route::get('/managecasecate/edit', [CaseCategoryController::class, 'updateCaseCategory'])->name('managecasecate.edit');
});
// Admin Previliages Routes ENDS


// OFFICERS Previliages Routes STARTS
Route::group(['middleware' => ['auth:officer', 'verified'], 'prefix' => 'officer', 'as' => 'officer.'], function () {

    // Routes to get all the Police Staff Memeber details 
    Route::get('/allstaff', [OfficerStaffController::class, 'showAllPoliceStaff'])->name('allstaff');
    Route::get('/addstaffmember', [OfficerStaffController::class, 'openStaffMember'])->name('addstaffmember');
    Route::post('/savestaff', [OfficerStaffController::class, 'saveStaffMember'])->name('savestaff');
    Route::get('/managestaff/edit', [OfficerStaffController::class, 'updateStationStaff'])->name('managestaff.edit');

    // Routes for tasks
    Route::get('/tasks', [TaskController::class, 'showAllTasks'])->name('tasks');
    Route::get('/addtasks', [TaskController::class, 'openTasks'])->name('addtasks');
    Route::post('/savetasks', [TaskController::class, 'saveTasks'])->name('savetasks');
    Route::get('/managetask/edit', [TaskController::class, 'updateTask'])->name('managetask.edit');


});
// OFFICERS Previliages Routes STARTSOFFICERS


// USERS Previliages Routes STARTS
Route::group(['middleware' => ['auth:user', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {

    

});
// USERS Previliages Routes STARTSUSERS