<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use App\House;
use App\Ad;
use App\Service;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
  
  use UploadTrait;

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
      "house_img" => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
      "address" => 'required',
      "lat" => 'required',
      "long" => 'required',
      "services" => 'required'
    ]);

    $house = new House;
    $id = Auth::user()->id;

      // Get image file
      $image = $request->file('house_img');
      // Make a image name based on user name and current timestamp
      $name = Str::slug($request->input('title')) . '_' . time();
      // Define folder path
      $folder = '/uploads/images/';
      // Make a file path where image will be stored [ folder path + file name + file extension]
      $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
      // Upload image
      $this->uploadOne($image, $folder, 'public', $name);
      // Set house house_image path in database to filePath
      $house->house_img = $filePath;


    $house['user_id'] = $id;
    $house['title'] = $validatedData["title"];
    $house['description'] = $validatedData["description"];
    $house['rooms'] = $validatedData["rooms"];
    $house['beds'] = $validatedData["beds"];
    $house['address'] = $validatedData["address"];
    $house['bathrooms'] = $validatedData["bathrooms"];
    $house['sqm'] = $validatedData["sqm"];
    $house['lat'] = $validatedData["lat"];
    $house['lng'] = $validatedData["long"];
    $house['visibility'] = 1;
    $house->save();

    $house->services()->sync(explode(",", $validatedData["services"]));
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
      "house_img" => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
      "address" => 'required',
      "lat" => 'required',
      "long" => 'required',
      "services" => 'required'
    ]);

    $house = House::findOrFail($id);

    // Get image file
    $image = $request->file('house_img');
    // Make a image name based on user name and current timestamp
    $name = Str::slug($request->input('title')) . '_' . time();
    // Define folder path
    $folder = '/uploads/images/';
    // Make a file path where image will be stored [ folder path + file name + file extension]
    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
    // Upload image
    $this->uploadOne($image, $folder, 'public', $name);
    // Set house house_image path in database to filePath
    $house->house_img = $filePath;

    $house['title'] = $validatedData["title"];
    $house['description'] = $validatedData["description"];
    $house['rooms'] = $validatedData["rooms"];
    $house['beds'] = $validatedData["beds"];
    $house['bathrooms'] = $validatedData["bathrooms"];
    $house['sqm'] = $validatedData["sqm"];
    // $house['house_img'] = $validatedData["house_img"];
    $house['address'] = $validatedData["address"];
    $house['lat'] = $validatedData["lat"];
    $house['lng'] = $validatedData["long"];
    $house->save();

    $house->services()->sync(explode(",", $validatedData["services"]));
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
