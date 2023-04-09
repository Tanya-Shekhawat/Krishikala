<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
    // Function to delete the data from DATABASE
    function deleteData(Request $request)
    {
        echo DB::table($request->table)->where('id',$request->id)->delete();
    }
}
