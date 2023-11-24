<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Season;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class SeasonController extends Controller
{
    function viewSeaons()
    {
        $seasons = Season::get();

        return view('admin.season.season')->with(['seasons' => $seasons]);
    }

    public function manageSeason()
    {
        return view('admin.season.manageseason');
    }

    public function saveSeason(Request $request)
    {
        if ($request->id == 0) {
            $request->validate([
                'season' => 'required',
                'crops' => 'required',
            ]);
            
            $crops_arr = explode(',', $request->crops);
            $add_season = new Season();

            $add_season->season = $request->season;
            $add_season->crops = json_encode($crops_arr);

            $add_season->save();

            Alert::success('Season Crop Added', 'Season Crop Data successfully Added');

            return redirect()->route('admin.seasons');
        } else {
            $request->validate([
                'season' => 'required',
                'crops' => 'required',
            ]);

            $crops_arr = explode(',', $request->crops);
            $update_season = Season::find($request->id);

            $update_season->season = $request->season;
            $update_season->crops = json_encode($crops_arr);

            $update_season->save();

            Alert::success('Season Crop Updated', 'Season Crop Data successfully Updated');

            return redirect()->route('admin.seasons');
        }
    }

    public function editSeason(Request $request)
    {

        $seasons = Season::find($request->id);
        return view('admin.season.manageseason')->with(['seasons' => $seasons]);
    }
}
