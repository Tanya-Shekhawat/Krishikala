<?php

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminControllers\{AdminStationOfficer, CaseCategoryController, AppointmentController};
use App\Http\Controllers\UserControllers\UserTaskController;
use App\Models\User;
use App\Models\StationOfficer;
use App\Models\Appointment;

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
})->name('/');

// Open Routes
Route::get('/about', [GeneralController::class, 'aboutPage'])->name('about');
Route::get('/contact', [GeneralController::class, 'contactPage'])->name('contact');


// Routes for Normal User with Authentication Setup
Route::get('/dashboard', function () {
    $arr = [];
    $tasks = Task::get();
    foreach ($tasks as $item) {
        foreach (json_decode($item->assigned_to) as $items) {
            if ($items == Auth::user()->id) {
                array_push($arr, $item->id);
            }
        }
    }
    // dd(count($arr));
    return view('dashboard')->with(['tasks' => $arr]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Routes for Officers with Authentication Setup
Route::get('officer/dashboard', function () {
    $tasks = Task::where(['assigned_by'=>Auth::guard('officer')->user()->name])->get();
    $user = User::where(['station_name'=>App\Models\PoliceStation::
        where(['id'=>Auth::guard('officer')->user()->station_name])->first()->name])->get();
    // $user = User::where(['station_name'=>])->get();
    $completed_task = 0;
    $incompleted_task = 0;
    // dd($user);

    foreach($tasks as $items){
        if($items->status == "Completed"){
            $completed_task++;
        }
        if($items->status == "NotCompleted"){
            $incompleted_task++;
        }
    }

    return view('officer.dashboard')->with(['completed_task'=>$completed_task,
        'tasks'=>$tasks, 'user'=>$user ]);
})->middleware(['auth:officer', 'verified'])->name('officer.dashboard');

Route::middleware('auth:officer')->group(function () {
    Route::get('officer/profile', [ProfileController::class, 'edit'])->name('officer.profile.edit');
    Route::patch('officer/profile', [ProfileController::class, 'updateAdmin'])->name('officer.profile.update');
    Route::delete('officer/profile', [ProfileController::class, 'destroy'])->name('officer.profile.destroy');
});

require __DIR__ . '/officerauth.php';

// Routes for Admin
Route::get('admin/dashboard', function () {
    $station_officers = StationOfficer::get();
    $users = User::get();
    $tasks = Task::get();
    $appointments = Appointment::get();
    $pending_appoin = Appointment::where(['stat'=>0])->get();
    $comp_tasks = Task::where(['status'=>"Completed"])->get();

    return view('admin.dashboard')->with(['station_officers'=>$station_officers, 'users'=>$users,
        'tasks'=>$tasks, 'comp_tasks'=>$comp_tasks, 'appointments' => $appointments, 'pending_appoin'=>$pending_appoin]);
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
    Route::get('/appointments', [AppointmentController::class, 'viewAllAppointments'])->name('appointments');
    Route::get('/manageappointment', [AppointmentController::class, 'manageAppointment'])->name('manageappointment');
    Route::post('/savestation', [AppointmentController::class, 'saveAllStation'])->name('savestation');
    Route::get('/manageallstations/edit', [AppointmentController::class, 'updateAllStation'])->name('manageallstations.edit');


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


Route::group(['middleware' => ['auth:officer', 'verified'], 'prefix' => 'officer', 'as' => 'officer.'], function () {

});


Route::group(['middleware' => ['auth:web', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {

    Route::get('/mytasks', [UserTaskController::class, 'getAssignedTask'])->name('mytasks');
    Route::get('updatetask', [UserTaskController::class, 'openUpdateFormPage'])->name('updatetask');
    Route::post('saveupdatetask', [UserTaskController::class, 'saveUserStatus'])->name('saveupdatetask');
    
    // Routes for Locations for User
    Route::get('/mylocations', [UserTaskController::class, 'getLocationData'])->name('mylocations');
 
});


Route::get('/bookappointment', [UserTaskController::class, 'openAppointmentForm'])->name('bookappointment');
Route::get('/timeslot', [UserTaskController::class, 'opentimeSlotForm'])->name('timeslot.php');
Route::post('/saveappointment', [UserTaskController::class, 'saveUserApppointment'])->name('saveappointment');