<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\House;
use App\Ad;
use App\Service;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $id = Auth::user()->id;
    $houses = House::where('user_id', '=', $id)->get();


    return view('home', compact('houses'));
  }

  public function create()
  {
    $services = Service::all();
    return view("house-create", compact('services'));
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

  public function show($id)
  {
    $house = House::findOrFail($id);
    $userId = Auth::user()->id;
    $userOwnsIt = ($house['user_id'] == $userId) ? true : false;

    if (!$userOwnsIt) {
      return redirect()->route('home');
    }

    $messages = $house->messages;
    $views = $house->views;
    $ads = Ad::all();
    return view('show-personal', compact('messages', 'views', 'ads', 'house'));
  }


  public function edit($id)
  {
    $house = House::findOrFail($id);
    $userId = Auth::user()->id;
    $userOwnsIt = ($house['user_id'] == $userId) ? true : false;

    if (!$userOwnsIt) {
      return redirect()->route('home');
    }
    $services = Service::all();
    return view('edit-personal', compact('services', 'house'));
  }



  public function update(Request $request, $id)
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

    $house = House::findOrFail($id);

    $house['title'] = $validatedData["title"];
    $house['description'] = $validatedData["description"];
    $house['rooms'] = $validatedData["rooms"];
    $house['beds'] = $validatedData["beds"];
    $house['bathrooms'] = $validatedData["bathrooms"];
    $house['sqm'] = $validatedData["sqm"];
    $house['img_url'] = $validatedData["img_url"];
    $house['address'] = $validatedData["address"];
    $house['lat'] = $validatedData["lat"];
    $house['lng'] = $validatedData["long"];
    $house->save();

    $house->services()->sync($validatedData["services"]);

    return response()->json([
      'name' => "success"
    ]);
  }

  public function delete($id)
  {
    $house = House::findOrFail($id);
    $userId = Auth::user()->id;
    $userOwnsIt = ($house['user_id'] == $userId) ? true : false;

    if (!$userOwnsIt) {
      return redirect()->route('home');
    }
    $house->delete();
    return redirect()->route('home');
  }
}
