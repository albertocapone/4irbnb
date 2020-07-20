<?php

namespace App\Http\Controllers;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Carbon;
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
    if(! ($request->has('title') )) {
      abort(403);
    }

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
    $visibilityState = ($house['visibility'] == 0) ? "Mostra" : "Nascondi";

    if (!$userOwnsIt) {
      abort(403);
    }

    $messages = $house->messages;
    $views = $house->views;
    $ads = Ad::all();
    $house_ads = $house->ads()->where('ending_date', '>=', Carbon::now())->get();
    // dd($house_ads);
    $endingDate = null;
    foreach($house_ads as $ad){
      // dd($ad->pivot);
     $endingDate = $ad->pivot->ending_date;
     $endingDate = Carbon::parse(Carbon::createFromFormat('Y-m-d H:i:s', $endingDate, 'UTC')
        ->setTimezone('Europe/Rome'))->format('d-m-Y H:i:s');
    }

    // dd($endingDate);
    $panelIsVisible = 'promo-off';
    if (count($house_ads)) {
      $panelIsVisible = 'promo-on';
    }
    return view('show-personal', compact('messages', 'views', 'ads', 'house', 'visibilityState','panelIsVisible', 'endingDate'));
  }


  public function edit($id)
  {
    $house = House::findOrFail($id);
    $userId = Auth::user()->id;
    $userOwnsIt = ($house['user_id'] == $userId) ? true : false;

    if (!$userOwnsIt) {
      abort(403);
    }
    $services = Service::all();
    return view('edit-personal', compact('services', 'house'));
  }



  public function update(Request $request, $id)
  {
    if (!($request->has('title'))) {
      abort(403);
    }

    $validatedData = $request->validate([
      "title" => 'required|string',
      "description" => 'required|string',
      "rooms" => 'required|min:1|max:10|integer',
      "beds" => 'required|min:1|max:20|integer',
      "bathrooms" => 'required|min:1|max:10|integer',
      "sqm" => 'required|min:5|integer',
      "house_img" => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      "address" => 'required',
      "lat" => 'required',
      "long" => 'required',
      "services" => 'required'
    ]);

    $house = House::findOrFail($id);

    if(request()->has('house_img')) {
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
    }

    $house['title'] = $validatedData["title"];
    $house['description'] = $validatedData["description"];
    $house['rooms'] = $validatedData["rooms"];
    $house['beds'] = $validatedData["beds"];
    $house['bathrooms'] = $validatedData["bathrooms"];
    $house['sqm'] = $validatedData["sqm"];
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
      abort(403);
    }

    $house->delete();
    return redirect()->route('home');
  }

  public function setVisibility($id){

    $house = House::findOrFail($id);

    $userId = Auth::user()->id;
    $userOwnsIt = ($house['user_id'] == $userId) ? true : false;

    if (!$userOwnsIt) {
      abort(403);
    }

    $house['visibility'] = ($house['visibility'] == 0) ? 1 : 0;
    $house->save();
    $visibilityState = ($house['visibility'] == 0) ? "<h3>Mostra</h3>" : "<h3>Nascondi</h3>";
    return $visibilityState;
  }
}
