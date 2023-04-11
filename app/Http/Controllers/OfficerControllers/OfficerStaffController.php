<?php

namespace App\Http\Controllers\OfficerControllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\StationOfficer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class OfficerStaffController extends Controller
{
    // Show all the registered Policeman in that particular Police Station
    function showAllPoliceStaff()
    {
        $user = User::paginate(10);

        return view('officer.staff.allstaff')->with(['staff_members' => $user]);
    }

    // Open the Page for opening the Add Staff Form
    function openStaffMember()
    {
        $station_details = StationOfficer::where(['id' => Auth::guard('officer')->user()->id])->first();
        return view('officer.staff.managestaff')->with(['station_details' => $station_details]);
    }

    // Save the details of a Staff Memeber 
    function saveStaffMember(Request $request)
    {
        if ($request->id == 0) {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'image' => 'required',
                'station_name' => 'required',
                'station_pincode' => 'required',
                'station_address' => 'required',
                'post' => 'required',
                'joining_date' => 'required',
            ]);

            $add_station_staff = new User();

            $add_station_staff->name = $request->name;
            $add_station_staff->email = $request->email;

            if ($request->hasFile('image')) {
                $response = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
                $add_station_staff->image = $response;
            } else {
                $add_station_staff->image = "No Image";
            }

            $add_station_staff->password = Hash::make($request->password);
            $add_station_staff->phone = $request->phone;
            $add_station_staff->station_name = $request->station_name;
            $add_station_staff->station_address = $request->station_address;
            $add_station_staff->station_pincode = $request->station_pincode;
            $add_station_staff->post = $request->post;
            $add_station_staff->joining_date = Date('Y-m-d', strtotime($request->joining_date));

            $add_station_staff->save();

            Alert::success('Station Staff Details Added', 'Station Staff Details successfully Added');

            return redirect()->route('officer.allstaff');
            
        } else {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'image' => 'required',
                'station_name' => 'required',
                'station_pincode' => 'required',
                'station_address' => 'required',
                'post' => 'required',
                'joining_date' => 'required',
            ]);

            $update_station_staff = User::find($request->id);

            $update_station_staff->name = $request->name;
            $update_station_staff->email = $request->email;

            if ($request->hasFile('image')) {
                // Will delete the last inserted file from Cloud
                $result = Cloudinary::uploadApi()->destroy("$request->image");
                // Add new image file in Cloud
                $response = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
                $update_station_staff->image = $response;
            } else {
                $update_station_staff->image = "No Image";
            }

            $update_station_staff->password = Hash::make($request->password);
            $update_station_staff->phone = $request->phone;
            $update_station_staff->station_name = $request->station_name;
            $update_station_staff->station_address = $request->station_address;
            $update_station_staff->station_pincode = $request->station_pincode;
            $update_station_staff->post = $request->post;
            $update_station_staff->joining_date = Date('Y-m-d', strtotime($request->joining_date));

            $update_station_staff->save();

            Alert::success('Station Staff Details Updated', 'Station Staff Details successfully Updated');

            return redirect()->route('officer.allstaff');
        }
    }

    // Updates the Station Staff Details
    function updateStationStaff(Request $request)
    {
        $staff_details = User::find($request->id);

        return view('officer.staff.managestaff')->with(['staff_details'=>$staff_details]);
    }


}
