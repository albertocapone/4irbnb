@if($comesFromIndex)
 <div class="side-home-btns">
    <a onclick="history.back()"><li>TORNA ALLA RICERCA</li></a>
</div>
@endif
@auth
    @if(Auth::id() == $house->user_id)
        <div class="side-home-btns">
            <a href= "{{route('show-personal', $house->id)}}"><li>GESTISCI IL TUO APPARTAMENTO</li></a>
        </div>
    @endif
@endauth
