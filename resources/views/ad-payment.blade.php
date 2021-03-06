@extends('layouts.layout-base')

@section('caching')
  <script type="text/javascript" >
    function preventBack(){window.history.forward();}
      setTimeout("preventBack()", 0);
      window.onunload=function(){null};
  </script>
@endsection

@section('content')
  <div class="fullwidthads">
  <main>
    <div  class="payment">
      <h5>Promuovi il tuo appartamento</h5>
      <form method="post" id="payment-form" action="{{ route('checkout',$house_id) }}">
          @csrf
          <section>
              <label for="amount"></label>
              <span class="input-label">Scegli la tariffa:</span>
                <select style="width: 120px" name="amount" id="amount">
                  @foreach ($ads as $ad)
                    <option  value="{{$ad->price/100}}">{{$ad->price/100}}&euro; - {{$ad->duration}}h</option>
                  @endforeach
                </select>

              <div class="bt-drop-in-wrapper">
                  <div id="bt-dropin"></div>
              </div>
          </section>
          <input id="nonce" name="payment_method_nonce" type="hidden" />
          <button class="button" type="submit"><span>ESEGUI IL PAGAMENTO</span></button>
      </form>
    </div>
    @if (count($errors) > 0) <div class=""> <ul> @foreach ( $errors ->all() as $error) <li>{{$error}}</li> @endforeach </ul> </div> @endif
  </main>
</div>


{{---------------------------------- SCRIPT ----------------------------------}}

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
              document.querySelectorAll("button[type=submit]")[0].disabled = true;
              document.querySelector('#nonce').value = payload.nonce;
              form.submit();
            });
          });
        });
    </script>

@endsection
