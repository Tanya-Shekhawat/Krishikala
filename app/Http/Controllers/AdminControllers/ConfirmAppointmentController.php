<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\ConfirmAppointment;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ConfirmAppointmentController extends Controller
{

    function saveConfirmationDetails(Request $request)
    {
        $appointments = Appointment::find($request->id);
        if($request->confirm == 1){
            $appointments->stat = 1;
        } else{
            $appointments->stat = 0;
        }

        $conf_appoint = new ConfirmAppointment();

        $conf_appoint->appointment_id = $request->id;
        $conf_appoint->name = $request->name;
        $conf_appoint->diseasename = $request->category;
        $conf_appoint->doctor_name = "Amit";

        Alert::success('Appointment Confirmed', 'Appointment booked successfully');

        $conf_appoint->save();

        return redirect()->route('admin.appointments');

    }



}
