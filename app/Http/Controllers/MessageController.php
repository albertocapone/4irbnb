<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\House;
use App\Message;
class MessageController extends Controller
{
    public function store(Request $request, $house_id){

      $validatedData = $request->validate([
        'email' => 'required|string',
        'text' => 'required|string|max:255'
      ]);

      $message = new Message;
      $message['house_id'] = $house_id;
      $message['email'] = $validatedData['email'];
      $message['text'] = $validatedData['text'];
      $message->save();
      return redirect()->route('show-house',$house_id);
    }

    public function index($house_id) { 
      $house  = House::findOrFail($house_id);
      $messages  = $house->messages;
      return view('msg-index', compact('messages'));
    }
}
