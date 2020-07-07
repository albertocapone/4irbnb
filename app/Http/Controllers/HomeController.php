<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\House;
use App\Ad;
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
      $houses = House::where('user_id','=',$id)->get();


      return view('home',compact('houses'));
    }
    public function show($id){
      $house = House::findOrFail($id);
      $messages = $house->messages;
      $views = $house->views;
      $ads = Ad::all();
      return view('show-personal',compact('messages','views','ads'));
    }
    public function edit($id){
      $services=Service::all();

      return view('edit-personal',compact('services'));
    }
    public function update(Request $request, $id){

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
        "services" => 'required|array',
        "visibility" => 'boolean'
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
      $house['long'] = $validatedData["long"];
      $house['visibility'] = $validateData['visibility'];
      $house->save();

      $house->services()->sync($validatedData["services"]);

    }
}
