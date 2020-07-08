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
    $house['long'] = $validatedData["long"];
    $house['visibility'] = 1;
    $house->save();

    $house->services()->sync($validatedData["services"]);
    // return redirect()->route('welcome');
  }
  public function index($data){
    $data =json_decode($data);
    // $data = json_encode($data);
    // $value = $data->value;
    $lat = $data->lat;
    $lng = $data->long;
    $radius = 300;
    // $unit = ($unit === 'km') ? 6378.10 : 3963.17;
    $houses = DB::table('houses');
    $houses->select(DB::raw("*, (6378.10 * acos(cos(radians(?)) * cos(radians(lat))
                                 * cos(radians(long) - radians(?)) + sin(radians(?))
                                 * sin(radians(lat)))) AS distance"))
    ->having('distance', '<', '?')
    ->orderBy('distance')
    ->setBindings(array($lat, $lng, $lat, $radius))
    ->get();
    // $houses = DB::table('houses')
    //     ->select(DB::raw("id, title, description, lat, long,
    //                  ( 6371 * acos( cos( radians(?) ) *
    //                    cos( radians( lat ) )
    //                    * cos( radians( long ) - radians(?)
    //                    ) + sin( radians(?) ) *
    //                    sin( radians( lat ) ) )
    //                  ) AS distance", [$lat, $lng, $lat]))
    //     ->where('visibility', '=', 1)
    //     ->having("distance", "<", 300)
    //     ->orderBy("distance",'asc')
    //     ->offset(0)
    //     ->limit(20)
    //     ->get();
    //
        dd($houses);
    return view('houses-index',compact('houses'));

  }
}
