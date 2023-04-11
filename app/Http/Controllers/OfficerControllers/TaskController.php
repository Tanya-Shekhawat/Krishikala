<?php

namespace App\Http\Controllers\OfficerControllers;

use App\Models\Task;
use App\Models\User;
use App\Models\CaseCategory;
use Illuminate\Http\Request;
use App\Models\StationOfficer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class TaskController extends Controller
{
    // Show all the registered Policeman in that particular Police Station
    function showAllTasks()
    {
        $tasks = Task::get();

        return view('officer.tasks.alltasks')->with(['tasks' => $tasks]);
    }

    // Open the Page for opening the Add Staff Form
    function openTasks()
    {
        $task_category = CaseCategory::where(['status' => 1])->get();
        $station_details = StationOfficer::where(['id' => Auth::guard('officer')->user()->id])->first();
        $user = User::where(['station_name'=>getStationNameById($station_details->station_name,'name')])->get();

        return view('officer.tasks.managetask')->with(['task_category' => $task_category,
            'station_details'=>$station_details, 'staff'=>$user]);
    }

    // Save the details of a Staff Memeber 
    function saveTasks(Request $request)
    {
        if ($request->id == 0) {
            $request->validate([
                'station_name' => 'required',
                'case_category' => 'required',
                'assigned_to' => 'required',
                'assigned_by' => 'required',
                'assigned_date' => 'required',
                'case_location' => 'required',
            ]);

            $add_task = new Task();

            $add_task->station_name = $request->station_name;
            $add_task->case_category = $request->case_category;
            $add_task->assigned_to = json_encode($request->assigned_to);
            $add_task->assigned_by = $request->assigned_by;
            $add_task->assigned_date = Date('Y-m-d', strtotime($request->assigned_date));
            $add_task->case_location = $request->case_location;
            $add_task->case_description = $request->case_description;
            $add_task->feedback = $request->feedback;

            $add_task->save();

            Alert::success('New Task Added', 'New Task successfully Added');

            return redirect()->route('officer.tasks');
        } else {
            $request->validate([
                'station_name' => 'required',
                'case_category' => 'required',
                'assigned_to' => 'required',
                'assigned_by' => 'required',
                'assigned_date' => 'required',
                'case_location' => 'required',
            ]);

            $update_task = Task::find($request->id);

            $update_task->station_name = $request->station_name;
            $update_task->case_category = $request->case_category;
            $update_task->assigned_to = json_encode($request->assigned_to);
            $update_task->assigned_by = $request->assigned_by;
            $update_task->assigned_date = Date('Y-m-d', strtotime($request->assigned_date));
            $update_task->case_location = $request->case_location;
            $update_task->case_description = $request->case_description;
            $update_task->feedback = $request->feedback;

            $update_task->save();

            Alert::success('Task Updated', 'Task successfully Updated');

            return redirect()->route('officer.tasks');
        }
    }

    // Updates the Station Staff Details
    function updateTask(Request $request)
    {
        $task_category = CaseCategory::where(['status' => 1])->get();
        $station_details = StationOfficer::where(['id' => Auth::guard('officer')->user()->id])->first();
        $user = User::where(['station_name'=>getStationNameById($station_details->station_name,'name')])->get();
        $task_details = Task::find($request->id);

        return view('officer.tasks.managetask')->with(['task_details' => $task_details,
            'task_category'=>$task_category, 'staff'=>$user]);
    }
}
