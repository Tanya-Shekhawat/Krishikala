<?php

use App\Models\PoliceStation;
use App\Models\StationOfficer;
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

?>