<?php

namespace App\Http\Controllers;
use App\Service;
use App\House;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HouseController extends Controller
{

  public function index($data){
    $data = json_decode($data);
    $lat = $data->lat;
    $lng = $data->long;
    $radius = 50;    // 1km = 1radius
    $maxRooms = 10;
    $maxBeds = 10;

    $houses = House::select(
      DB::raw("*,
                              ( 6371 * acos( cos( radians(?) ) *
                                cos( radians( lat ) )
                                * cos( radians( lng ) - radians(?)
                                ) + sin( radians(?) ) *
                                sin( radians( lat ) ) )
                              ) AS distance"))
      ->having("distance", "<", "?")
      ->orderBy("distance")
      ->setBindings([$lat, $lng, $lat, $radius])
      ->paginate(25);
 
    $servicesList = Service::all();
    return view('houses-index',compact('houses', 'maxRooms', 'maxBeds', 'servicesList', 'lat', 'lng'));
  }

  public function show($id) 
  {
    $house = House::findOrFail($id);

    return view('show-house', compact('house'));
  }
}
