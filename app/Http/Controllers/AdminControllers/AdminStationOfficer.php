<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Models\StationOfficer;
use App\Http\Controllers\Controller;
use App\Models\PoliceStation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AdminStationOfficer extends Controller
{
    // See all the Station Officers
    function viewStationOfficer()
    {
        $station_officer = StationOfficer::get();

        return view('admin.police.officer')->with(['station_officer' => $station_officer]);
    }

    // Opne the Form to add a new Station Officer
    function addStationOfficer()
    {
        $police_station = PoliceStation::get();
        return view('admin.police.manageofficer')->with(['police_station'=>$police_station]);
    }

    // Save the details of Station Officer 
    function saveStationOfficer(Request $request)
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

            $add_station_officer = new StationOfficer();

            $add_station_officer->name = $request->name;
            $add_station_officer->email = $request->email;

            if ($request->hasFile('image')) {
                $response = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
                $add_station_officer->image = $response;
            } else {
                $add_station_officer->image = "No Image";
            }

            $add_station_officer->password = Hash::make($request->password);
            $add_station_officer->phone = $request->phone;
            $add_station_officer->station_name = $request->station_name;
            $add_station_officer->station_address = $request->station_address;
            $add_station_officer->station_pincode = $request->station_pincode;
            $add_station_officer->post = $request->post;
            $add_station_officer->joining_date = Date('Y-m-d',strtotime($request->joining_date));

            $add_station_officer->save();

            Alert::success('Station Officer Details Added', 'Station Officer Details successfully Added');

            return redirect()->route('admin.officers');

        } 
        else 
        {
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

            $update_station_officer = StationOfficer::find($request->id);

            $update_station_officer->name = $request->name;
            $update_station_officer->email = $request->email;

            if ($request->hasFile('image')) {
                // Will delete the last inserted file from Cloud
                $result = Cloudinary::uploadApi()->destroy("$request->image");
                // Add new image file in Cloud
                $response = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
                $update_station_officer->image = $response;
            } else {
                $update_station_officer->image = "No Image";
            }

            $update_station_officer->password = Hash::make($request->password);
            $update_station_officer->phone = $request->phone;
            $update_station_officer->station_name = $request->station_name;
            $update_station_officer->station_address = $request->station_address;
            $update_station_officer->station_pincode = $request->station_pincode;
            $update_station_officer->post = $request->post;
            $update_station_officer->joining_date = Date('Y-m-d',strtotime($request->joining_date));

            $update_station_officer->save();

            Alert::success('Station Officer Details Updated', 'Station Officer Details successfully Updated');

            return redirect()->route('admin.officers');
        }
    }

    // Function to open the Update Form for Station Officer
    function updateStationOfficer(Request  $request)
    {
        $police_station = PoliceStation::get();
        $officer_details = StationOfficer::find($request->id);

        return view('admin.police.manageofficer')->with(['officer_details'=>$officer_details,'police_station'=>$police_station]);
    }
}
