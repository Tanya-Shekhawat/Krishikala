<?php

namespace App\Http\Controllers\UserControllers;

use App\Models\Task;
use Razorpay\Api\Api;
use App\Models\UserTime;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
            'gmail' => 'required', 'unique',
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

        session(['appoint_id' => $save_appoint->id]);
        session(['total_amount' => 60]);

        return redirect()->route('razorpay');
    }

    // Razorpay Integration Page
    function razorpayIntegration(Request $request)
    {
        $ids = $request->id;
        // $room_booking = Roombooking::find($ids);
        $total_amount = [];
        $booking_id = [];

        if (Session::has('appoint_id')) {
            $booking_id['appoint_id'] = Session::get('appoint_id');
        }

        return view('users.razorpay', with([$total_amount, $booking_id]));
    }

    // Payment Successfull Page
    function saveRazorpay(Request $request)
    {
        $booking_id = $request->booking_id;
        $save_payment = Appointment::find($booking_id);

        $input = $request->all();

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if (count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id']);

                $save_payment->transaction_id = $input['razorpay_payment_id'];
            } catch (\Exception $e) {
                return  $e->getMessage();
                return redirect()->back();
            }
        }

        $save_payment->payment_status = "Paid";

        $save_payment->save();

        Alert::success('Appointment Successfully completed', 'Appointment Successfully completed');

        session(['transaction_id' => $save_payment->transaction_id]);

        return redirect()->route('thankyou');
    }

    public function appointmentThankyou()
    {
        if(Session::has('transaction_id')){
            $transaction_id[] = Session::get('transaction_id');
        } else {
            $transaction_id[] = "12345o";
        }
        return view('users.thankyou')->with([$transaction_id]);
    }

    public function helpPage()
    {
        return view('help');
    }


}
