<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\House;
use App\Message;
class MessageController extends Controller
{
    public function store(Request $request, $house_id){

      if(! ($request->has('text') )) {
        abort(403);
      }

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
      $house = House::findOrFail($house_id);
      $userId = Auth::user()->id;
      $userOwnsIt = ($house['user_id'] == $userId) ? true : false;
      if (!$userOwnsIt) {
        abort(403);
      }

      $messages = $house->messages()->orderBy('created_at', 'desc')->paginate(10);
      return view('msg-index', compact('messages'));
    }
}
