<?php

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use App\Service;
use App\House;
use App\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class HouseController extends Controller
{
  public function index(Request $request){

    $roomsInputValue = 1;
    $bedsInputValue = 1;
    $servicesFilter = [];

    //screma sempre per distanza
    $address = $request->address;
    $lat = $request->lat;
    $lng = $request->lng;
    $radius = ($request->radius === null) ? 20 : $request->radius;   // 1km = 1radius
    $houses = House::select(
      DB::raw("*,
                              ( 6371 * acos( cos( radians(?) ) *
                                cos( radians( lat ) )
                                * cos( radians( lng ) - radians(?)
                                ) + sin( radians(?) ) *
                                sin( radians( lat ) ) )
                              ) AS distance"), 'rooms', 'beds')
      ->having("distance", "<", "?")
      ->orderBy("distance")
      ->setBindings([$lat, $lng, $lat, $radius])
      ->get();

      //scrematura visibility
      $houses = $houses->where('visibility', '=', 1);

      if (request()->has('rooms')) {
        $houses = $houses->where('rooms', '>=', $request->rooms);
        $roomsInputValue = $request->rooms;
      }

      if (request()->has('beds')) {
        $houses = $houses->where('beds', '>=', $request->beds);
        $bedsInputValue = $request->beds;
      }

      if(request()->has('services')) {
        $servicesFilter = $request->services;
        foreach ($houses as $index => $house) {
          $houseServicesIds = $house->services->pluck('id')->all();
          foreach($servicesFilter as $filter){
            if(!(in_array($filter, $houseServicesIds))) {
              $houses->forget($index);
            }
         }
        }
      }

      $promoHouses = [];
      foreach ($houses as $house) {
        $house_ads = $house->ads()->whereDate('ending_date', '>', date('Y-m-d H:i:s'))->get();
        if (count($house_ads)) {
          $promoHouses[] = $house;
        }
      }
      // dd($promoHouses);
     

        $houses = $houses->paginate(25)->appends([
          'rooms'=>request('rooms'),
          'beds' => request('beds'),
          'radius' => request('radius'),
          'lat' => request('lat'),
          'lng' => request('lng'),
          'address' => request('address'),
          'services' => request('services'),
          ]);

    $servicesList = Service::all();

    return view('houses-index', compact('houses', 'promoHouses', 'servicesList', 'servicesFilter', 'address', 'lat', 'lng', 'roomsInputValue', 'bedsInputValue', 'radius'));
  }

  public function show(Request $request, $id)
  {
    $comesFromIndex = (strpos(url()->previous(), 'houses-index')) > 0;

    $clientIP = $request->ip();
    $now = date('Y-m-d H:i:s');
    $from = date('Y-m-d H:i:s', strtotime("-1 days"));
    // dd($from, $now);
    $DBviews = View::where('house_id','=', $id)
                  ->where('ip_address', '=', $clientIP)
                  ->whereBetween('created_at', [$from, $now])
                  ->get();
    // dd($DBviews);
    if(!count($DBviews)){
      $view = new View;
      $view['house_id'] = $id;
      $view['ip_address'] = $clientIP;
      $view->save();
    }

    $house = House::findOrFail($id);

    return view('show-house', compact('house', 'comesFromIndex'));

  }
}
