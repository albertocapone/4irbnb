<?php

namespace App\Http\Controllers;
use App\Service;
use App\House;
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


      if ($request->rooms > 1) {
        $houses = $houses->where('rooms', '>=', $request->rooms);
        $roomsInputValue = $request->rooms;
      }
      
      
      if ($request->beds > 1) {
        $houses = $houses->where('beds', '>=', $request->beds);
        $bedsInputValue = $request->beds;
      }
    
      if(request()->has('services')) {
        $servicesFilter = $request->services;
        foreach ($houses as $house) {
          $houseServicesIds = $house->services->pluck('id')->all();
          foreach($servicesFilter as $filter){
            if( ! (in_array((int)$filter, $houseServicesIds) ) ) {
              $houses->forget($house->id);
            }
         }
        }
      }
        
        
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

    return view('houses-index', compact('houses', 'servicesList', 'servicesFilter', 'address', 'lat', 'lng', 'roomsInputValue', 'bedsInputValue', 'radius'));
  }

  public function show($id) 
  {
    $house = House::findOrFail($id);

    return view('show-house', compact('house'));
  }
}
