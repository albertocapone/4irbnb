<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\House;
use App\User;
use App\Ad;
use Braintree;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function transaction($house_id){

      $gateway = new Braintree\Gateway([
       'environment' => config('services.braintree.environment'),
       'merchantId' => config('services.braintree.merchantId'),
       'publicKey' => config('services.braintree.publicKey'),
       'privateKey' => config('services.braintree.privateKey')
     ]);

     $token = $gateway->ClientToken()->generate();
     $ads = Ad::all();
     return view("ad-payment",compact('token','ads','house_id'));
    }

    public function checkout(Request $request, $house_id){

      $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
      ]);
      // if (isset($_POST['amount']))
      // {
      //   $amount = $_POST['amount']
      // }
      // $customer_id = House::findOrFail($id);
      $amount = $request -> input('amount');
      // $amount = $request->amount;
      // $user = User::findOrFail($id);
      // $amount = $ad->id;
      $nonce = $request->payment_method_nonce;
      // dd($house_id);
      $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'customer' => [
            'id' => Auth::user()->id,
            'firstName' => Auth::user()->name,
            'lastName' => Auth::user()->last_name,
            'email' => Auth::user()->email,
        ],
        // 'customer_id' => $customer_id,
        'options' => [
            'submitForSettlement' => true
        ],
      ]);
      if ($result->success) {
        $transaction = $result->transaction;
        // header("Location: transaction.php?id=" . $transaction->id);
        if ($amount==2.99) {
          $ad_id = 1;
        }elseif ($amount==5.99) {
          $ad_id = 2;
        }elseif ($amount==9.99) {
          $ad_id = 3;
        }
        $ad = Ad::findOrFail($ad_id);
        $duration = $ad->duration;
        $provaduration = (string)$duration/24;
        $ending_date = date('Y-m-d H:i:s',strtotime('+'.$provaduration.'days'));

        $house = House::findOrFail($house_id);
        $house->ads()->attach($ad_id,['transaction_code'=>$transaction->id,'ending_date'=>$ending_date]);


        return view('welcome')->withSuccess('IT WORKS!'. $transaction->id);
      } else {
        $errorString = "";

        foreach ($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }

        // $_SESSION["errors"] = $errorString;
        // header("Location: index.php");
        return back()->withErrors('An error occurred with the message: '.$result->message);
        }

    }
}