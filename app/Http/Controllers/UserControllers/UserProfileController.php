<?php

namespace App\Http\Controllers\UserControllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mandiprice;
use App\Models\Season;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class UserProfileController extends Controller{

    public function openDashboard() {
        $mandiprice = Mandiprice::paginate(10);
        $seasons = Season::get();

        return view('users.profile.dashboard')->with(['mandiprice'=>$mandiprice, 'seasons'=>$seasons]);
    }

    public function getProfile() {
        $user = User::find(Auth::user()->id);

        return view('users.profile.profile')->with(['user_details'=>$user]);
    }

    public function updateProfile(Request $request) {
        
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'area' => 'required',
            'image' => 'mimes:jpg,jpeg,png',
        ]);

        $user = User::find(Auth::guard('web')->user()->id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->area = $request->input('area');

        // if ($request->hasFile('image')) {
        //     @unlink('storage/app/' . $user->profile_image);
        //     $user->profile_image = $request->file('image')->store('public/images');
        // }

        if ($request->hasFile('image')) {
            $response = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $user->profile_image = $response;
        } else {
            $user->profile_image = "No Image";
        }

        $user->save();

        Alert::success('Info Saved', 'Your basic info is saved');

        return redirect()->route('dashboard');
    }


    public function getCropDetails(Request $request) {
        $season_name = $request->season;
        $season = Season::where(['season'=>$season_name])->get();
        
        // dd($season);
        return view('users.profile.season')->with(['season'=>$season]);
    }
    

}
