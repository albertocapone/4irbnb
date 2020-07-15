<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\House;
use App\Message;
use App\View;
use Illuminate\Support\Carbon;

class StatsController extends Controller
{
    public function index($house_id) {

        $now = date('Y-m-d H:i:s');
        $from = date('Y-m-d H:i:s', strtotime("-31 days"));
        // dd($from, $now);

        $lastMonthViews = View::where('house_id', '=', $house_id)
                                ->whereBetween('created_at', [$from, $now])
                                ->get();

        $lastMonthMessages = Message::where('house_id', '=', $house_id)
                                    ->whereBetween('created_at', [$from, $now])
                                    ->get();

        $house = House::findOrFail($house_id);
        
        return view('stats-index', compact('lastMonthViews','lastMonthMessages', 'house'));
    }

    public function get(Request $request) {
        
        $house_id = $request->house_id;
        $searchedDate = explode("-", $request->date);
        

        $searchedViews = View::where('house_id', '=', $house_id)
            ->whereMonth('created_at', '=', $searchedDate[1])
            ->whereYear('created_at', '=', $searchedDate[0])
            ->get();
        
        $searchedMessages = Message::where('house_id', '=', $house_id)
            ->whereMonth('created_at', '=', $searchedDate[1])
            ->whereYear('created_at', '=', $searchedDate[0])
            ->get();

        $data = [
            "searchedViews" => $searchedViews,
            "searchedMessages" => $searchedMessages,
        ];

        $data = json_encode($data);
        
        return $data;
    }
}
