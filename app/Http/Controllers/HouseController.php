<?php

namespace App\Http\Controllers;
use App\Service;
use App\House;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HouseController extends Controller
{
  public function create()
  {
    $services=Service::all();
    return view("house-create",compact('services'));
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      "title" => 'required|string',
      "description" => 'required|string',
      "rooms" => 'required|min:1|max:10|integer',
      "beds" => 'required|min:1|max:20|integer',
      "bathrooms" => 'required|min:1|max:10|integer',
      "sqm" => 'required|min:5|integer',
      "img_url" => 'required',
      "address" => 'required',
      "lat" => 'required',
      "long" => 'required',
      "services" => 'required|array'
    ]);

    $house = new House;
    $id = Auth::user()->id;

    $house['user_id'] = $id;
    $house['title'] = $validatedData["title"];
    $house['description'] = $validatedData["description"];
    $house['rooms'] = $validatedData["rooms"];
    $house['beds'] = $validatedData["beds"];
    $house['address'] = $validatedData["address"];
    $house['bathrooms'] = $validatedData["bathrooms"];
    $house['sqm'] = $validatedData["sqm"];
    $house['img_url'] = $validatedData["img_url"];
    $house['lat'] = $validatedData["lat"];
    $house['lng'] = $validatedData["long"];
    $house['visibility'] = 1;
    $house->save();

    $house->services()->sync($validatedData["services"]);

  }

  public function index($data){
    $data = json_decode($data);
    $lat = $data->lat;
    $lng = $data->long;
    $radius = 600;

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
      ->get();

    return view('houses-index',compact('houses'));
  }

  public function show($id) 
  {
    $house = House::findOrFail($id);

    return view('show-house', compact('house'));
  }
}
