<div id="disclaimer" style="position: absolute;top: 50%;left: 50%;width: 250px;height: 350px;padding: 30px;/* margin: auto auto; */border: 1px solid red;background-color: lightgoldenrodyellow;color: red;transform: translate(-50%, -50%);text-align: center;border-radius: 15px;font-weight: 900; z-index: 5;">
    <p>
    Questo sito esiste a scopo puramente dimostrativo.
    <br>
    Non inserire dati sensibili!
    </p>
    <button id="close-disclaimer" type="button" style="position: absolute; top: 5px; right: 5px; color: red; font-size: 20px; background-color: lightgoldenrodyellow; border: none;">
        <i class="fas fa-times"></i>
    </button>
    <script>
        $('#close-disclaimer').click(function(){
            $('#disclaimer').hide();
        });
    </script>
</div>