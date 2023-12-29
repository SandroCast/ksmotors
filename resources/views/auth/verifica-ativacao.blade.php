<style>
    html, body {
        overflow: hidden;
    }
    #imgfundoinit{
        width: 100%;
        height: 100%;
        display: flex;
        position: fixed;
        object-fit: cover;
    }

    #imgVerificaEmail{
        margin:0;
        padding:0;
        width: 100%;
        height: 100%;
        display: flex;
        position: fixed;
        opacity : 0.9;
        z-index: 2;
    }
    #formVerificaEmail{
        width: 300px;
        top:50%;
        left:50%;
        margin-left: -140px;
        margin-top: -140px;
        display: flex;
        z-index: 3;
        text-align: center;
        padding: 5px;
    }
    #time{
        color: red;
    }


</style>
{{-- <img id="imgfundoinit" src="/img/fundo.png" alt=""> --}}

<img id="imgVerificaEmail" src="/img/fundopreto.png" alt="">
<div id="formVerificaEmail" class="card col-md-5">
    <p>Enviamos um código em seu email. <br> Digite-o abaixo para continuar seu cadastro.</p>
    <form action="/cancela/cadastro" method="GET" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title"><b>CÓDIGO</b></label><br>
            <input id="inp1" onkeydown="digitar1()" autofocus style="width: 40px; text-align: center; display: inline;" type="text" class="form-control" name="codigo_1" maxlength="1" required>
            <input id="inp2" onkeydown="digitar2()" style="width: 40px; text-align: center; display: inline;" type="text" class="form-control" name="codigo_2" maxlength="1" required>
            <input id="inp3" onkeydown="digitar3()" style="width: 40px; text-align: center; display: inline;" type="text" class="form-control" name="codigo_3" maxlength="1" required>
            <input id="inp4" onkeydown="digitar4()" style="width: 40px; text-align: center; display: inline;" type="text" class="form-control" name="codigo_4" maxlength="1" required>
        </div>
        @php
            $tentativas = 3 - auth()->user()->erro_verificacao;
        @endphp
        <p style="color: green">Retam {{$tentativas}} tentativas</p>
        
        <p>Após a terceira verificação incorreta ou <br> fim do tempo de verificação, você será redirecionado para a home do site.</p>
        
        <p id="time"></p>

        <div class="form-group mt-4">
            <input type="submit" class="btn btn-primary pull-right" value="Verificar">
    </form>
    <form action="/cancela/cadastro" method="GET" enctype="multipart/form-data">
            <input type="submit" class="btn btn-danger pull-left" value="Cancelar">
        </div>
    </form>
    
    
</div>

@php
    $tempo = strtotime('now') - strtotime(Auth::user()->created_at);
@endphp

<span class="bg-red">

<script type="text/javascript">

    function digitar1() {
        var i1 = document.getElementById("inp1");
        var i2 = document.getElementById("inp2");
        if (i2.value.length == 0) {
            setTimeout( () => {
                if(i1.value.length == 0){
                    document.getElementById("inp1").focus();
                }else{
                    document.getElementById("inp2").focus();
                }
            }, 0)
        }
    }
    function digitar2() {
        var i2 = document.getElementById("inp2");
        var i3 = document.getElementById("inp3");
        if (i3.value.length == 0) {
            setTimeout( () => {
                if(i2.value.length == 0){
                    document.getElementById("inp2").focus();
                }else{
                    document.getElementById("inp3").focus();
                }
            }, 0)
        }
    }
    function digitar3() {
        var i3 = document.getElementById("inp3");
        var i4 = document.getElementById("inp4");
        if (i4.value.length == 0) {
            setTimeout( () => {
                if(i3.value.length == 0){
                    document.getElementById("inp3").focus();
                }else{
                    document.getElementById("inp4").focus();
                }
            }, 0)
        }
    }

    let tempo;
    tempo = @json($tempo)

    function ajax(){
        var req = new XMLHttpRequest();
        req.onreadystatechange = function(){
            if (req.readyState == 4 && req.status == 200) {
                document.getElementById('time').innerHTML = req.responseText;
            }
        }
        if(tempo >= 300){
            location.href = '/cancela/cadastro';
        }
        tempo = tempo + 1;
        req.open('GET', '/time/'+tempo, true);
        req.send();
    }
    setInterval(function(){ajax();}, 1000);

</script>