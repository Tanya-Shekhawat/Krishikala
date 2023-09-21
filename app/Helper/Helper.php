<?php

use App\Models\PoliceStation;
use App\Models\StationOfficer;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

function getStationNameById($id, $col_name)
{
    $station_name = PoliceStation::find($id);

    return $station_name->$col_name;

}

// Retuen the name of user by Id
function getInfoById($table_name, $id)
{
    $info = DB::table($table_name)->where(['id'=>$id])->get();

    return $info;
}

// Get the tasks details by ID
function getTaskById($id)
{
    $tasks = Task::where(['id'=>$id])->get();

    return $tasks;
}

// function to find Days Left
function findLeftDays($priorty, $assigned_date)
{
    if($priorty == "less")
    {
        date_default_timezone_set('Asia/Kolkata');
        $end_date = date('Y-m-d');
        $final_date = (strtotime($end_date) - strtotime($assigned_date));
        return 60 - ($final_date/86400)." Days Left to complete this Task";
    }
    if($priorty == "more")
    {
        date_default_timezone_set('Asia/Kolkata');
        $end_date = date('Y-m-d');
        $final_date = (strtotime($end_date) - strtotime($assigned_date));
        return (90 - ($final_date/86400))." Days Left to complete this Task";
    }
}

// Role and Permission
// Function for Role and Permission
// function accessRole($role_id, $col_name)
// {   
//     $accessrole = AccessRole::find($role_id);
//     if($accessrole->$col_name == 1){
//         return true;
//     }
//     return false;
// }


?>