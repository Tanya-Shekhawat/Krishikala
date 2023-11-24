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

    public function confirmAppointment(Request $request)
    {
        $appoint_id = $request->id;

        $appointments = Appointment::find($appoint_id);
        $apyment_done = "Not Done";

        if($appointments->payment_status == "Paid"){
            $apyment_done = "Done";
        }
        return view('admin.doctor.confirmappointment')->with(['appointments'=>$appointments, 'payment_done'=>$apyment_done]);
    }


}
