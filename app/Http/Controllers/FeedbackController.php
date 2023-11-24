<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class FeedbackController extends Controller
{
    public function openFeedbackPage()
    {
        return view('feedback');
    }

    public function saveFeedbackForm(Request $request)
    {
        if (isset(Auth::user()->id)) {
            $request->validate([
                'name' => 'required',
                'image' => 'required',
                'message1' => 'required',
            ]);

            $feedback = new Feedback();

            $feedback->user_id = Auth::user()->id;
            $feedback->name = $request->name;
            $feedback->feedback = $request->message1;
            $feedback->date = date('Y-m-d');

            // if ($request->hasFile('image')) {
            //     @unlink('storage/app/' . $user->profile_image);
            //     $user->profile_image = $request->file('image')->store('public/images');
            // }

            if ($request->hasFile('image')) {
                $response = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
                $feedback->profile_image = $response;
            } else {
                $feedback->profile_image = "No Image";
            }

            $feedback->save();

            Alert::success('Feedback Added', 'Feedback Data successfully Added');

            return redirect()->back();
        } else {
            Alert::error('Please Login', 'Please Login to add Feedback');
            return redirect()->route('login');
        }
    }

    public function getAllFeedback() {
        $feedback = Feedback::get();

        return view('admin.mandi.feedback')->with(['feedback'=>$feedback]);
    }

    public function manageFeedback() {
        return view('admin.mandi.managefeedback');
    }

}
