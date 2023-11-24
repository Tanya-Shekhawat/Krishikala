<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Mandiprice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class MandipriceController extends Controller
{
    public function viewMandiPrice()
    {
        $mandiprice = Mandiprice::get();

        return view('admin.mandi.mandiprice')->with(['mandiprice' => $mandiprice]);
    }

    public function manageMandiPrice()
    {
        return view('admin.mandi.managemandi');
    }

    public function saveMandiPrice(Request $request)
    {
        if ($request->id == 0) {
            $request->validate([
                'cropname' => 'required',
                'cropprice' => 'required',
                'date' => 'required',
            ]);

            $add_mandi_price = new Mandiprice();

            $add_mandi_price->cropname = $request->cropname;
            $add_mandi_price->cropprice = $request->cropprice;
            $add_mandi_price->date = $request->date;

            $add_mandi_price->save();

            Alert::success('Mandi Price Added', 'Mandi Price Data successfully Added');

            return redirect()->route('admin.mandiprice');
        } else {
            $request->validate([
                'cropname' => 'required',
                'cropprice' => 'required',
                'date' => 'required',
            ]);

            $update_mandi_price = Mandiprice::find($request->id);

            $update_mandi_price->cropname = $request->cropname;
            $update_mandi_price->cropprice = $request->cropprice;
            $update_mandi_price->date = $request->date;

            $update_mandi_price->save();

            Alert::success('Mandi Price Updated', 'Mandi Price Data successfully Updated');

            return redirect()->route('admin.mandiprice');
        }
    }

    public function editMandiPrice(Request $request) {
        
        $crop_price = Mandiprice::find($request->id);
        return view('admin.mandi.managemandi')->with(['crop_price'=>$crop_price]);
    }

    
}
