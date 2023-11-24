<?php

use App\Models\User;
use App\Models\Feedback;
use App\Models\ConfirmAppointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\UserControllers\UserTaskController;
use App\Http\Controllers\UserControllers\SeasoncropController;
use App\Http\Controllers\UserControllers\UserProfileController;
use App\Http\Controllers\AdminControllers\{AdminStationOfficer, AppointmentController, ConfirmAppointmentController, MandipriceController, SeasonController};

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
    $feedback = Feedback::get();
    return view('welcome')->with(['feedback' => $feedback]);
})->name('/');

// Open Routes
Route::get('/about', [GeneralController::class, 'aboutPage'])->name('about');
Route::get('/contact', [GeneralController::class, 'contactPage'])->name('contact');
Route::post('/contact', [GeneralController::class, 'addContact'])->name('contact');


Route::get('/feedback', [FeedbackController::class, 'openFeedbackPage'])->name('feedback');
Route::post('/savefeedback', [FeedbackController::class, 'saveFeedbackForm'])->name('savefeedback');

// Routes for Normal User with Authentication Setup
Route::get('/dashboard', [UserProfileController::class, 'openDashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::group(['middleware' => ['auth:web', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {

    // Routes for Locations for User
    Route::get('/mylocations', [UserTaskController::class, 'getLocationData'])->name('mylocations');
    Route::get('/profile', [UserProfileController::class, 'getProfile'])->name('profile');
    Route::post('/saveprofile', [UserProfileController::class, 'updateProfile'])->name('saveprofile');
    Route::get('/getcrops', [UserProfileController::class, 'getCropDetails'])->name('getcrops');
    Route::post('/seasoncrop', [SeasoncropController::class, 'saveSeasonCrop'])->name('seasoncrop');
    Route::get('/mycrops', [SeasoncropController::class, 'getSeasonCropDetails'])->name('mycrops');
    Route::get('/cropdetails', [SeasoncropController::class, 'getUserCropDetails'])->name('cropdetails');
    Route::get('/cropexpenses', [SeasoncropController::class, 'cropExpense'])->name('cropexpenses');
    Route::post('/saveexpense', [SeasoncropController::class, 'addCropExpenses'])->name('saveexpense');
});
Route::get('/dashboard_charts', [SeasoncropController::class, 'getExpenseCharts'])->name('dashboard_charts');


// Routes for Admin
Route::get('admin/dashboard', function () {
    $users = User::get();
    $pending_users = User::where(['is_confirmed' => 0])->get();
    return view('admin.dashboard')->with(['user' => $users, 'pending_users' => $pending_users]);
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

    // Routes for Appointment
    Route::get('/appointments', [AppointmentController::class, 'viewAllAppointments'])->name('appointments');
    Route::get('/manageappointment', [AppointmentController::class, 'manageAppointment'])->name('manageappointment');
    Route::post('/savestation', [AppointmentController::class, 'saveAllStation'])->name('savestation');
    Route::get('/manageallstations/edit', [AppointmentController::class, 'updateAllStation'])->name('manageallstations.edit');
    Route::get('/confirmappointment', [AppointmentController::class, 'confirmAppointment'])->name('confirmappointment');
    Route::post('/saveconfirmappointment', [ConfirmAppointmentController::class, 'saveConfirmationDetails'])->name('saveconfirmappointment');
    Route::get('/recipt', [ConfirmAppointmentController::class, 'showRecipt'])->name('recipt');

    // Routes for Profile Details
    Route::get('/profile', [AdminStationOfficer::class, 'myProfile'])->name('profile');
    Route::post('/saveprofile', [AdminStationOfficer::class, 'saveProfileDetails'])->name('saveprofile');

    // Routes for Mandi Price
    Route::get('/mandiprice', [MandipriceController::class, 'viewMandiPrice'])->name('mandiprice');
    Route::get('/managemandiprice', [MandipriceController::class, 'manageMandiPrice'])->name('managemandiprice');
    Route::post('/savemandiprice', [MandipriceController::class, 'saveMandiPrice'])->name('savemandiprice');
    Route::get('/managemandiprice/edit', [MandipriceController::class, 'editMandiPrice'])->name('managemandiprice.edit');

    // Routes for Seasons
    Route::get('/seasons', [SeasonController::class, 'viewSeaons'])->name('seasons');
    Route::get('/manageseasons', [SeasonController::class, 'manageSeason'])->name('manageseasons');
    Route::post('/saveseasons', [SeasonController::class, 'saveSeason'])->name('saveseasons');
    Route::get('/manageseasons/edit', [SeasonController::class, 'editSeason'])->name('manageseasons.edit');

    // Routes for Feedback
    Route::get('/viewfeedback', [FeedbackController::class, 'getAllFeedback'])->name('viewfeedback');
    Route::get('/managefeedback', [FeedbackController::class, 'manageFeedback'])->name('managefeedback');
    Route::post('/savefeedback', [FeedbackController::class, 'saveFeedbackForm'])->name('savefeedback');
});


// Routes for Doctor with Authentication Setup
// Route::get('doctor/dashboard', function () {
//     $tasks = ConfirmAppointment::where(['doctor_name' => Auth::guard('doctor')->user()->name])->get();
//     $pateient_details = [];

//     foreach ($tasks as $items) {
//         array_push($pateient_details, getAppointmentDetails($items->appointment_id));
//     }

//     return view('doctor.dashboard')->with(['details' => $tasks]);
// })->middleware(['auth:doctor', 'verified'])->name('doctor.dashboard');

// Route::middleware('auth:doctor')->group(function () {
//     Route::get('officer/profile', [ProfileController::class, 'edit'])->name('officer.profile.edit');
//     Route::patch('officer/profile', [ProfileController::class, 'updateAdmin'])->name('officer.profile.update');
//     Route::delete('officer/profile', [ProfileController::class, 'destroy'])->name('officer.profile.destroy');
// });

// require __DIR__ . '/officerauth.php';

// Route::group(['middleware' => ['auth:doctor', 'verified'], 'prefix' => 'doctor', 'as' => 'doctor.'], function () {
// });


Route::get('recommendcrop', function () {
    return view('users.crop.crop');
})->name('recommendcrop');

Route::get('recommendfertilizer', function () {
    return view('users.crop.fertilizer');
})->name('recommendfertilizer');

Route::get('about', function () {
    return view('users.about');
})->name('about');

Route::get('contact', function () {
    return view('users.contact');
})->name('contact');

Route::get('usermanual', function () {
    return view('users.usermanual.usermanual');
})->name('usermanual');

Route::get('usermanual', function () {
    return view('users.usermanual.usermanual');
})->name('usermanual');

Route::get('cropmanual', [GeneralController::class, 'cropmanual'])->name('cropmanual');
Route::get('fertilizermanual', [GeneralController::class, 'fertilizermanual'])->name('fertilizermanual');
Route::get('diseasemanual', [GeneralController::class, 'diseasemanual'])->name('diseasemanual');
Route::get('loginregistermanual', [GeneralController::class, 'loginregistermanual'])->name('loginregistermanual');
