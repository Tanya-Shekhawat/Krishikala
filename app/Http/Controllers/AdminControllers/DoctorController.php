<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class DoctorController extends Controller
{
    // See all the Station Officers
    function viewDoctor()
    {
        $doctors = Doctor::get();

        return view('admin.doctor.doctors')->with(['doctors' => $doctors]);
    }

    // Opne the Form to add a new Station Officer
    function manageDoctor()
    {
        return view('admin.doctor.managedoctor');
    }

    // Save the details of Station Officer 
    function saveDoctor(Request $request)
    {
        if ($request->id == 0) {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'qualifications' => 'required',
                'password' => 'required',
            ]);

            $add_doctor = new Doctor();

            $add_doctor->name = $request->name;
            $add_doctor->email = $request->email;
            $add_doctor->phone = $request->phone;
            $add_doctor->address = $request->address;
            $add_doctor->password = Hash::make($request->password);
            $add_doctor->qualifications = $request->qualifications;

            $add_doctor->save();

            Alert::success('Doctor Added', 'Doctor Data successfully Added');

            return redirect()->route('admin.doctors');
        } else {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'qualifications' => 'required',
            ]);

            $update_doctor = Doctor::find($request->id);

            $update_doctor->name = $request->name;
            $update_doctor->email = $request->email;
            $update_doctor->phone = $request->phone;
            $update_doctor->address = $request->address;
            $update_doctor->qualifications = $request->qualifications;

            $update_doctor->save();

            Alert::success('Doctor Updated', 'Doctor Data successfully Updated');

            return redirect()->route('admin.doctors');
        }
    }

    // Function to open the Update Form for Station Officer
    function updateDoctor(Request  $request)
    {
        $category_details = Doctor::find($request->id);

        return view('admin.doctor.managedoctor')->with(['category_details' => $category_details]);
    }
}
