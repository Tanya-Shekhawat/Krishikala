<?php

namespace App\Http\Controllers\UserControllers;

use App\Models\Seasoncrop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cropexpenses;
use App\Models\Mandiprice;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SeasoncropController extends Controller
{
    public function saveSeasonCrop(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'season' => 'required',
            'crops' => 'required',
            'area' => 'required',
            'cropamount' => 'required',
        ]);

        $season = new Seasoncrop();

        $season->user_id = $request->input('user_id');
        $season->season = $request->input('season');
        $season->crops = $request->input('crops');
        $season->area = $request->input('area');
        $season->fertilizer = $request->input('fertilizer');
        $season->cropamount = $request->input('cropamount');
        $season->expense = $request->input('expense');

        $season->save();

        Alert::success('Details Saved', 'Your are being saved');

        return redirect()->route('dashboard');
    }

    public function getSeasonCropDetails()
    {
        $seasoncropdetails = Seasoncrop::where(['user_id' => Auth::user()->id])->get();

        return view('users.profile.seasoncrop')->with(['seasoncropdetails' => $seasoncropdetails]);
    }

    public function calculateTotalRevenueAndProfit($mandiPrices, $totalPrices)
    {
        $totalRevenue = 0;
        $totalProfit = 0;

        foreach ($mandiPrices as $mandiPrice) {
            $date = $mandiPrice['date'];

            if (array_key_exists($date, $totalPrices)) {
                // Multiply the cropprice with 10
                $cropPrice = $mandiPrice['cropprice'] * 10;
                $totalRevenue += $cropPrice;

                // Calculate profit (profit = total price - mandi price)
                $profit = ($totalPrices[$date] - $cropPrice);
                $totalProfit += $profit;
            }
        }

        return ['totalRevenue' => $totalRevenue, 'totalProfit' => $totalProfit, 'date' => $date];
    }

    public function getUserCropDetails(Request $request)
    {
        $seasoncrop = Seasoncrop::find($request->id);
        $mandiprice = Mandiprice::get();
        $expenses = Cropexpenses::where(['crop_id' => $request->id])->get();

        $status = false;

        $mandicropprice = 0;
        foreach ($mandiprice as $item) {
            if (strtolower($item->cropname) == strtolower($seasoncrop->crops)) {
                $status = true;
                $mandicropprice = $item->cropprice;
            }
        }

        $profit_status = 0;
        $totalPrice = 0;
        $result = [];
        if ($status == true) {
            foreach ($expenses as $entry) {
                $date = $entry['date'];
                $totalPrice = $entry['fertilizer_price'] + $entry['seed_price'] + $entry['labour_price'] + $entry['harvesting_price'];

                if (array_key_exists($date, $result)) {
                    $result[$date] += $totalPrice;
                } else {
                    $result[$date] = $totalPrice;
                }
            }

            $total = array_sum($result);
            // $result1 = $this->calculateTotalRevenueAndProfit($mandiprice, $result);

            // echo "<pre>";
            // print_r($total);
            // echo "</pre>";
            // die;

            $revenue = ($seasoncrop->cropamount) * ($mandicropprice);
            $profit = $revenue - $total;

            if ($profit < 0) {
                $profit_status = -1;
            } else {
                $profit_status = 1;
            }

            return view('users.profile.cropdetails')
                ->with([
                    'revenue' => $revenue, 'con_profit' => $profit, 'profit_status' => $profit_status,
                    'seasoncrop' => $seasoncrop, 'expenses' => $expenses
                ]);
        } else {
            Alert::error("No Crop Exist in Mandi", "The current crop price is unavailable");
            return redirect()->back();
        }
    }

    // Add Crop Expenses
    public function cropExpense(Request $request)
    {
        $crop_id = $request->id;

        $seasoncropdetails = Seasoncrop::find($crop_id);
        $user_id = $seasoncropdetails->user_id;

        return view('users.profile.cropexpense')->with(['seasoncropdetails' => $seasoncropdetails]);
    }

    public function addCropExpenses(Request $request)
    {
        $cropexpense = new Cropexpenses();

        $cropexpense->user_id = $request->user_id;
        $cropexpense->crop_id = $request->crop_id;
        $cropexpense->fertilizer_price = $request->fertilizer_price;
        $cropexpense->seed_price = $request->seed_price;
        $cropexpense->labour_price = $request->labour_price;
        $cropexpense->harvesting_price = $request->harvesting_price;
        $cropexpense->date = $request->date;

        $cropexpense->save();

        Alert::success("Expenses Added", "Crop Expenses Added successfully");

        return redirect()->route('user.mycrops');
    }

    public function getExpenseCharts(Request $request) {
        $expenses = Cropexpenses::where(['user_id' => $request->user_id])->get();
        $total_expenses = array();
        
        $total_expenses[0] = $expenses->sum('fertilizer_price');
        $total_expenses[1] = $expenses->sum('seed_price');
        $total_expenses[2] = $expenses->sum('labour_price');
        $total_expenses[3] = $expenses->sum('harvesting_price');
        // dd($total_expenses);

        return $total_expenses;
    }

}
