<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function viewAllAppointments()
    {
        $appointments = Appointment::get();

        return view('admin/appointments')->with(['appointments'=>$appointments]);
    }

    public function manageAppointment()
    {
        return view('admin/newappointment');
    }


}
