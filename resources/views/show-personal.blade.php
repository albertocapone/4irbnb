
@extends('layouts.layout-sidebar')

@section('sidebar')
  @include('components.sidebar-home')
@endsection

@section('main-content')
  <div class="features-container flex-container property-features">

    <div class="title-container flex-container">
      <h1 class="property-title">{{$house->title}}
        <div class="visibility-tag" data-visibility="{{($house->visibility == 0) ? 'hidden' : 'visible'}}">
          <h5>Nascosto</h5>
        </div>
      </h1>
    </div>

    <div class="box fullwidth flex-container">
      <a href= "{{route('show-house', $house->id)}}">
        <div class="overlay flex-container">
          <h3>Vedi Scheda Pubblica</h3>
        </div>
      </a>
    </div>

    <div class="box messaggi flex-container">
      <a href="{{route('msg-index', $house->id)}}">
        <div class="overlay flex-container">
          <h3>Messaggi</h3>
        </div>
      </a>
    </div>

    <div class="box promuovi flex-container {{$panelIsVisible}}">
      @if ($endingDate === null)
        <a href="{{route('ad-payment', $house->id)}}">
          <div class="overlay flex-container">
            <h3>Promuovi</h3>
          </div>
        </a>
      @elseif ($endingDate !== null)
        <h4 id="promo">Promo attiva fino a {{$endingDate}} </h4>
      @endif
    </div>

    <div class="box statistiche flex-container">
      <a href="{{route('stats-index', $house->id)}}">
        <div class="overlay flex-container">
         <h3>Statistiche</h3>
        </div>
      </a>
    </div>

    <div class="box bottoni flex-container">
      <a class="edit flex-container" href="{{route('edit-personal', $house->id)}}"> <h3>Modifica</h3> </a>
      <a id="setVisibility" class="flex-container" data-house="{{$house->id}}" data-visibility="{{($house->visibility == 0) ? 'hidden' : 'visible'}}" ><h3>{{$visibilityState}}</h3></a>
      <a class="delete flex-container" href="{{route('delete-personal', $house->id)}}"><h3>Elimina</h3></a>
    </div>

  </div>
  <script>
    function checkVisibilityState(){
      var state = $('#setVisibility').data('visibility');
      if (state == 'hidden') {
        $('#setVisibility').addClass('hidden');
        $('.visibility-tag').show();
      } else if (state == 'visible') {
        $('#setVisibility').addClass('visible');
        $('.visibility-tag').hide();
      };
    }

    checkVisibilityState();



    $('#setVisibility').click(function(){
      var visibilityButton = $('#visibilityButton');
      $.get('/set-personal-visibility/' + $('#setVisibility').data('house'), function(visibilityState){
        $('#setVisibility').html(visibilityState);
      });
    });


    $('#setVisibility').click(function(){
      var state = $('#setVisibility').hasClass('hidden');
      if (state) {
        $('#setVisibility').removeClass('hidden');
        $('#setVisibility').addClass('visible');
        $('.visibility-tag').fadeOut();
      } else {
        $('#setVisibility').removeClass('visible');
        $('#setVisibility').addClass('hidden');
        $('.visibility-tag').fadeIn();
      }
    });

    $('.promuovi').click(function(){

      jQuery.fn.shake = function(interval,distance,times){
         interval = typeof interval == "undefined" ? 100 : interval;
         distance = typeof distance == "undefined" ? 10 : distance;
         times = typeof times == "undefined" ? 3 : times;
         var jTarget = $(this);
         jTarget.css('position','relative');
         for(var iter=0;iter<(times+1);iter++){
            jTarget.animate({ left: ((iter%2==0 ? distance : distance*-1))}, interval);
         }
         return jTarget.animate({ left: 0},interval);
      }
      console.log('cazz!');
      $('#promo').shake(100,10,5);
    });

  </script>

@endsection
