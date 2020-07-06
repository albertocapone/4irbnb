<?php

namespace App\Http\Controllers;
use App\Service;
use App\House;
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
      // dd($request);
      $validatedData=$request->validate([

        "title"=>'required|string',
        "description"=>'required|string',
        "rooms"=>'required|min:1|max:10|integer',
        "beds"=>'required|min:1|max:20|integer',
        "bathrooms"=>'required|min:1|max:10|integer',
        "sqm"=>'required|min:5|integer',
        "img_url"=>'mimes:jpeg,bmp,png',
        "services"=>'required|array'
      ]);

      $house=new House;

      $house['title']=$validatedData["title"];
      $house['description']=$validatedData["description"];
      $house['rooms']=$validatedData["rooms"];
      $house['beds']=$validatedData["beds"];
      $house['bathrooms']=$validatedData["bathrooms"];
      $house['sqm']=$validatedData["sqm"];
      $house['img_url']=$validatedData["img_url"];

      $house->save();

      $house->services()->sync($validatedData["services"]);
      return redirect()->route('home');
    }
}
