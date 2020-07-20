@if($comesFromIndex)
<div class="side-home-btns"></div>
<a onclick="history.back()"><li>TORNA ALLA RICERCA</li></a>
@endif
@auth
    @if(Auth::id() == $house->user_id)
        <div class="side-home-btns"></div>
        <a href= "{{route('show-personal', $house->id)}}"><li>GESTISCI IL TUO APPARTAMENTO</li></a>
    @endif
@endauth
