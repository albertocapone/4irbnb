@extends('layouts.layout-base')
@section('content')
  <div  class="payment">
      <form method="post" id="payment-form" action="{{ route('checkout',$house_id) }}">
          @csrf
          <section>
              <label for="amount">
                  <span class="input-label">Prezzo</span>
                    <select name="amount" id="amount">
                      @foreach ($ads as $ad)
                        <option value="{{$ad->price/100}}">{{$ad->price/100}}&euro;</option>
                      @endforeach
                    </select>
                  </div>
              </label>

              <div class="bt-drop-in-wrapper">
                  <div id="bt-dropin"></div>
              </div>
          </section>
          <input id="nonce" name="payment_method_nonce" type="hidden" />
          <button class="button" type="submit"><span>Test Transaction</span></button>
      </form>
  </div>
  <script>
        var house_id = $('.payment').data('house')
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";
        braintree.dropin.create({
          authorization: client_token,
          selector: '#bt-dropin',
          paypal: {
            flow: 'vault'
          }
        }, function (createErr, instance) {
          if (createErr) {
            console.log('Create Error', createErr);
            return;
          }
          form.addEventListener('submit', function (event) {
            event.preventDefault();
            instance.requestPaymentMethod(function (err, payload) {
              if (err) {
                console.log('Request Payment Method Error', err);
                return;
              }
              // Add the nonce to the form and submit
              document.querySelector('#nonce').value = payload.nonce;
              form.submit();
            });
          });
        });
    </script>
@endsection
