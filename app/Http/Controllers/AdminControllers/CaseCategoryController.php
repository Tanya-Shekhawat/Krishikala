<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\CaseCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CaseCategoryController extends Controller
{
    // See all the Station Officers
    function viewCaseCategory ()
    {
        $case_category = CaseCategory::get();

        return view('admin.casecategory.casecate')->with(['case_category' => $case_category]);
    }

    // Opne the Form to add a new Station Officer
    function manageCaseCategory()
    {
        return view('admin.casecategory.managecategory');
    }

    // Save the details of Station Officer 
    function saveCaseCategory(Request $request)
    {
        if ($request->id == 0) {
            $request->validate([
                'cate_name' => 'required',
            ]);

            $add_station_officer = new CaseCategory();

            $add_station_officer->cate_name = $request->cate_name;

            $add_station_officer->save();

            Alert::success('Case Category Details Added', 'Case Category Details successfully Added');

            return redirect()->route('admin.casecate');
        } else {
            $request->validate([
                'cate_name' => 'required',
            ]);

            $update_station_officer = CaseCategory::find($request->id);

            $update_station_officer->cate_name = $request->cate_name;

            $update_station_officer->save();

            Alert::success('Case Category Details Updated', 'Case Category Details successfully Updated');

            return redirect()->route('admin.casecate');
        }
    }

    // Function to open the Update Form for Station Officer
    function updateCaseCategory (Request  $request)
    {
        $category_details = CaseCategory::find($request->id);

        return view('admin.casecategory.managecategory')->with(['category_details' => $category_details]);
    }
}
