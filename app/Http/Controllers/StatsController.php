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

        $allViews = count(View::where('house_id', '=', $house_id)->get());

        $allMessages = count(Message::where('house_id', '=', $house_id)->get());

        $house = House::findOrFail($house_id);
        
        return view('stats-index', compact('allViews', 'allMessages', 'house'));
    }

    public function get(Request $request) {
        
        $house_id = $request->house_id;
        $searchedDate = $request->date;
       
        $viewsPerMonth = [];
        for ($m = 1; $m <= 12; $m++) {
            $searchedViews = View::where('house_id', '=', $house_id)
            ->whereMonth('created_at', '=', $m)
            ->whereYear('created_at', '=', $searchedDate)
            ->get();
            $viewsPerMonth[] = count($searchedViews);
        }

        $messagesPerMonth = [];
        for ($m = 1; $m <= 12; $m++) {
            $searchedMessaages = Message::where('house_id', '=', $house_id)
            ->whereMonth('created_at', '=', $m)
            ->whereYear('created_at', '=', $searchedDate)
            ->get();
            $messagesPerMonth[] = count($searchedMessaages);
        }

        $data = [
            "viewsPerMonth" => $viewsPerMonth,
            "messagesPerMonth" => $messagesPerMonth
        ];

        $data = json_encode($data);
        
        return $data;
    }
}
