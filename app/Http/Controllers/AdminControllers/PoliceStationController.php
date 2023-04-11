<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Models\PoliceStation;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PoliceStationController extends Controller
{
    // See all the Station Officers
    function viewAllStation()
    {
        $police_station = PoliceStation::get();

        return view('admin.stations.stations')->with(['police_station' => $police_station]);
    }

    // Opne the Form to add a new Station Officer
    function addAllStation()
    {
        return view('admin.stations.managestations');
    }

    // Save the details of Station Officer 
    function saveAllStation(Request $request)
    {
        if ($request->id == 0) {
            $request->validate([
                'name' => 'required',
                'pincode' => 'required',
                'address' => 'required',
                'number' => 'required',
            ]);

            $add_station_officer = new PoliceStation();

            $add_station_officer->name = $request->name;
            $add_station_officer->number = $request->number;
            $add_station_officer->address = $request->address;
            $add_station_officer->pincode = $request->pincode;

            $add_station_officer->save();

            Alert::success('New Police Station Added', 'New Police Station successfully Added');

            return redirect()->route('admin.allstations');
        } else {
            $request->validate([
                'name' => 'required',
                'pincode' => 'required',
                'address' => 'required',
                'number' => 'required',
            ]);

            $update_station_officer = PoliceStation::find($request->id);

            $update_station_officer->name = $request->name;
            $update_station_officer->number = $request->number;
            $update_station_officer->address = $request->address;
            $update_station_officer->pincode = $request->pincode;

            $update_station_officer->save();

            Alert::success('Police Station Details Updated', 'Police Station Details successfully Updated');

            return redirect()->route('admin.allstations');
        }
    }

    // Function to open the Update Form for Station Officer
    function updateAllStation(Request  $request)
    {
        $station_details = PoliceStation::find($request->id);

        return view('admin.stations.managestations')->with(['station_details' => $station_details]);
    }
}
