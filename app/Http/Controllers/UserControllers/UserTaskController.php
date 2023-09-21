<?php

namespace App\Http\Controllers\UserControllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\UserTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Redis;
use RealRashid\SweetAlert\Facades\Alert;

class UserTaskController extends Controller
{
    // get all the tasks assigned to User
    function getAssignedTask()
    {
        $completed_task = [];
        $tasks = Task::where(['status' => 'Completed'])->get();
        foreach ($tasks as $item) {
            foreach (json_decode($item->assigned_to) as $items) {
                if ($items == Auth::user()->id) {
                    array_push($completed_task, $item->id);
                }
            }
        }

        $incompleted_task = [];
        $tasks = Task::where(['status' => 'NotCompleted'])->get();
        foreach ($tasks as $item) {
            foreach (json_decode($item->assigned_to) as $items) {
                if ($items == Auth::user()->id) {
                    array_push($incompleted_task, $item->id);
                }
            }
        }

        return view('users.tasks.alltasks')->with(['completed_task' => $completed_task, 'incompleted_task' => $incompleted_task]);
    }

    // Opens the update Form Page
    function openUpdateFormPage(Request $request)
    {
        $task_details = Task::find($request->id);

        return view('users.tasks.updatetask')->with(['task_details' => $task_details]);
    }

    // Save the updated details of the User about his tasks
    function saveUserStatus(Request $request)
    {
        $request->validate([
            'completed_date' => 'required',
            'case_location' => 'required',
        ]);

        $update_task = Task::find($request->id);

        $update_task->status = $request->status;
        $update_task->completed_date = Date('Y-m-d', strtotime($request->completed_date));
        $update_task->user_message = $request->staff_message;

        $update_task->save();

        Alert::success('Task Updated', 'Task successfully Updated');

        return redirect()->route('user.mytasks');
    }

    // Get the Users Location
    function getLocationData()
    {
        $comp_arr = [];
        $completed_task = UserTime::where(['assigned_to' => Auth::user()->id])->get();

        foreach ($completed_task as $item) {
            $time = explode('-', $item->time_slot);

            if (date('Y-m-d') == $item->assigned_date) {
                array_push($comp_arr, $completed_task);
            }
        }
        // dd($comp_arr);
        $incompleted_task = UserTime::where(['assigned_to' => Auth::user()->id])->get();

        return view('users.tasks.alllocations')->with(['completed_task' => $completed_task, 'incompleted_task' => $incompleted_task]);
    }

    // Open Appointment
    function openAppointmentForm()
    {
        return view('users.bookappointment');
    }

    // Open Appointment
    function opentimeSlotForm()
    {
        return view('users.timeslot');
    }

    // Save the User Form
    public function saveUserApppointment(Request $req)
    {

        $req->validate([
            'name' => 'required',
            'gmail' => 'required','unique',
            'phone' => 'required',
            'gender' => 'required',
            'agegroup' => 'required',
            'timeslot' => 'required',
            'place' => 'required',
        ]);

        $save_appoint = new Appointment();
        $save_appoint->fname =  $req->name;
        $save_appoint->phone =  $req->phone;
        $save_appoint->gmail =  $req->gmail;
        $save_appoint->gender =  $req->gender;
        $save_appoint->agegroup =  $req->agegroup;
        $save_appoint->timeslot =  $req->timeslot;
        $save_appoint->date =  date("Y/m/d");
        $save_appoint->stat =  0;
        $save_appoint->place =  $req->place;
        $save_appoint->category =  "Typhoid";
        $save_appoint->caseby =  "By User";

        $save_appoint->save();

        Alert::success('Appointment Booked', 'Your appointment has been booked successfully');

        return redirect()->back()->with(['save_message' => "Appointment Booked Successfully"]);
    }
}
