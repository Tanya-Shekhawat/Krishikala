<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class GeneralController extends Controller
{
    // Function to delete the data from DATABASE
    function deleteData(Request $request)
    {
        echo DB::table($request->table)->where('id', $request->id)->delete();
    }

    // Function to chnage Status
    function changeStatus(Request $request)
    {
        echo DB::table($request->table)->where('id', $request->row_id)->update([$request->column => $request->status]);
    }

    // Function to open the About Page
    function aboutPage()
    {
        return view('about');
    }

    function contactPage()
    {
        return view('contact');
    }

    // Save contact details
    function addContact(Request $request) {
        $contact = new Contact();
        if(isset(Auth::user()->id)) {
            $contact->unique_id = Auth::user()->id;
        } else {
            $contact->unique_id = rand(1000, 9999);
        }
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->message = $request->message;

        $contact->save();

        Alert::success('Information saved', 'Information data successfully Added');
        return redirect()->back();
    }

    function cropmanual()
    {
        return view('users.usermanual.cropmanual');
    }

    function fertilizermanual()
    {
        return view('users.usermanual.fertilizermanual');
    }

    function diseasemanual()
    {
        return view('users.usermanual.diseasemanual');
    }

    function loginregistermanual()
    {
        return view('users.usermanual.loginregistermanual');
    }

}
