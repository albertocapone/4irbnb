<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\House;

class StatsController extends Controller
{
    public function index($house_id) {
        $house = House::findOrFail($house_id);
        $views = $house->views;
        $messages = $house->messages;

        return view('stats-index', compact('views', 'messages'));
    }
}
