<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <link rel="shortcut icon" href="/img/logo.jpg" type="image/x-icon" />

        <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">

        <!-- Fa fa-tachometer -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Fonte do Google -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <!-- CSS Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
                


        <!-- CSS da aplicação -->
        <link rel="stylesheet" href="/css/style_layouts.css">
        <script src="/js/script.js"></script>

        <style>
            #notificacao{
                position: relative;
                font-size: 17px;
                color: deepskyblue;
                left: -5px;
                top: -10px;
            }
            #numeroNotify{
                position: relative;
                top: -2px;
                left: -10px;
                color: white;
                font-size: 12px;
                
                
            }

                
            .me {
                opacity: 25;
                background-color:#EBF0FF;
                margin-right: 5px;
            }
            .to {
                opacity: 25;
                background-color:#F4F4F8;
            }
    
        </style>


    </head>

    <body onload="srl(@if(session('click'))
    {{session('click')}}
    @endif)">

        {{--  verificação do email  --}}

            @if(isset($user) && $user->email_verificado == null)
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
                <img id="imgfundoinit" src="/img/fundo.png" alt="">

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
                            $tentativas = 3 - $user->erro_verificacao;
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
            @else
        {{--  verificação do email  --}}

        <header id="main-header">

            <!-- Cabeçalho -->
            <nav id="navbartop">

                <nav id="partesuperior">
                    <a href="/"><strong>3D</strong>PrintEvolution</a>
                    @auth
                        <a onclick="event.preventDefault(); conf_mini()" href="#" ><img class="imgperfil" style="float: right; font-size: 15px; border-radius: 50%; margin: 5px 10px;" @if(Auth::user()->profile_photo_path != null) src="/storage/{{ Auth::user()->profile_photo_path }}" @else src="{{ $user->profile_photo_url }}" @endif alt="Perfil"></a>
                        <div class="card col-md-12" id="config">

                            <img class="imgconfig" style="border-radius: 50%; margin: 5px 35px;" @if(Auth::user()->profile_photo_path != null) src="/storage/{{ Auth::user()->profile_photo_path }}" @else src="{{ $user->profile_photo_url }}" @endif alt="Perfil">
                            <ul>
                                <li><a href="/user/profile">Meu Perfil</a></li>
                                <li><a href="/favorito">Favoritos</a></li>
                                <li><a href="#">Meus Pedidos</a></li>
                                @if($user->adms > 0)
                                <li><a href="/produtos">Produtos</a></li>
                                @endif
                                @if($user->adms > 1)
                                <li><a href="/usuarios">Usuários</a></li>
                                @endif
                                <li>
                                    <form action="/logout" method="POST">
                                        @csrf
                                        <a href="/logout" onclick="event.preventDefault(); this.closest('form').submit();">Sair</a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endauth
                    @guest
                        <a style="float: right; font-size: 15px;" href="/login">Entrar</a>
                    @endguest
                </nav>
                <nav id="menu">
                    <ul>
                        <li><a style="margin-left: 50px;" href="/">Home</a></li>
                        {{--  <li><a href="#">Sobre</a></li>  --}}
                        {{--  <li><a href="#">Quem Somos</a></li>  --}}
                        <li><a href="#">Contato</a></li>
                        @auth
                        <li><a data-toggle="modal" data-target="#flipFlop" href="" onclick="visualizaMensagem()">Chat<i id="notificacao" style="display: none" class="fa fa-circle" aria-hidden="true"><span id="numeroNotify">1</span></i></a></li>
                        @endauth
                    </ul>
                </nav>

            </nav>

        </header>

        <main id="conteudo">
            @yield('content')

            @auth
            {{--  <!-- The modal -->  --}}
            <div class="modal fade" id="flipFlop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="form-group m-0">
                            {{--  eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee  --}}
                            <div class="max-w-7xl mx-auto sm:px-6 px-0">
                                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex" style="min-height: 400px; max-height: 400px;">


                                    <!----- list users ----->
                                    <div class="w-4/12 bg-gray-200 bg-opacity-25 border-r border-gray-200 overflow-y-scroll">
                                        <ul id="resultadoJson" class="px-0">
                                            {{--  //resultado json lista conversas  --}}
                                            {{--  <span class="ml-2 w-2 h-2 bg-blue-500 rounded-full"></span>  --}}
                                        </ul>

                                    </div>

                                    <!----- box message ----->
                                    <div class="w-8/12 flex flex-col justify-between">

                                        <!----- nome ----->
                                        <div class="w-full bg-gray-500 border border-gray-300 bg-opacity-25 p-3 pl-5 text-xl text-gray-600 leading-7 font-semibold flex">
                                            <label class="m-0" for="" id="msgAbertaNome">
                                                {{--  resultado Nome --}}
                                            </label>
                    
                                        </div>

                                        <!----- message ----->
                                        <div class="w-full p-6 flex flex-col overflow-y-scroll" id="resultadoJsonMensagens">
                                            {{--  resultado  --}}
                                        </div>

                                        <!--- form --->
                                        <div id="foenme" style="display: none" class="w-full bg-gray-200 bg-opacity-25 p-6 border-t border-gray-200">
                                            <div class="flex rounded-md overflow-hidden border border-gray-300">
                                                <input id="conteudoEnviarMensagem" type="text" class="w-5 flex-1 px-4 py-2 text-lx focus:outline-none border-none">
                                                <button id="btnEnviarMensagem" type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2">Enviar</button>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        {{--  wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww  --}}
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="" id="usuarioLogado" value="{{$user->id}}">

            <script>

                document.addEventListener('DOMContentLoaded', () => {

                    var num = 0;
                    var qtdeContato = 0;
                    var qtdeMensagem = 0;
                    var cont = 0;
                    function ajaxon(){

                        var user_logado = $("#usuarioLogado").val();

                        $.ajax({
                            url: '/api/mensagens',
                            //data: {
                            //    id_user: id_user
                            //},
                            dataType: 'json',
                            success: function(result) {
                    
                                var linha = '';

                                if (result.conversas && result.conversas.length > 0) {
                    
                                    $.each(result.conversas, function(index, val) {

                                        linha += '<a style="text-decoration: none;" href="" onclick="event.preventDefault(); carregaConversa('+val.split(" ")[0]+')">';
                                        linha += '<li class="p-6 text-gray-600 leading-7 font-semibold border-b border-gray-200 hover:bg-gray-200 hover:bg-opacity-50 hover:cursor-pointer">';
                                        linha += '<p style="font-size: 15px" class="flex items-center my-0">'+val.split(" ")[1]+'</p>';
                                        linha += '</li>';
                                        linha += '</a>';

                                    });
                                //    console.log(result.conversas);   .split(" ")[0]

                                }

                                //$("#modalItemRecebido #itens").css('display', 'inline');
                                //$("#modalItemRecebido #item").css('display', 'none');
                                if(result.conversas.length != qtdeContato){
                                    $("#resultadoJson").html(linha);
                                }

                                var linha2 = '';

                                if(result.conversaAberta && result.conversaAberta.length > 0){

                                    if($("#foenme").css('display') == 'none'){
                                        $("#foenme").css('display', 'block');
                                    }

                                    $.each(result.conversaAberta, function(index, vall) {

                                        if(vall.from == user_logado){
                                            var t_right = 'text-right';
                                            var me_to = 'me';
                                            var mx = 'mx-5';
                                        }else{
                                            var t_right = '';
                                            var me_to = 'to';
                                            var mx = '';
                                        }

                                        
                                        linha2 += '<div class="w-full mb-3 message '+t_right+'">';

                                        linha2 += '<p class="inline-block p-2 rounded-md '+me_to+'" style="max-width: 90%;">';
                                        linha2 += vall.content;

                                        linha2 += '</p>';

                                        if(vall.from == user_logado && vall.visa == 2){
                                        linha2 += '<img class="inline-block" style="max-width: 75%;" src="/ico/visualizado.ico" alt="profile Pic" height="15" width="15">';
                                        }
                                        if(vall.from == user_logado && vall.visa == 1){
                                        linha2 += '<img class="inline-block" style="max-width: 75%;" src="/ico/entregue.ico" alt="profile Pic" height="15" width="15">';
                                        }
                                        if(vall.from == user_logado && vall.visa == 0){
                                        linha2 += '<img class="inline-block" style="max-width: 75%;" src="/ico/enviado.ico" alt="profile Pic" height="15" width="15">';
                                        }

                                        linha2 += '<span class="block mt-1 '+mx+' text-xs text-gray-500" style="font-size: 11px">'+vall.created_at+'</span>';

                                        linha2 += '</div>';
                                        

                                        //console.log(result.conversaAbertaNome);

                                    });


                                }

                                if(result.naoVisualizada > 0){
                                    if($("#notificacao").css('display') == 'none'){
                                        $("#notificacao").css('display', 'inline');
                                    }
                                }else{
                                    if($("#notificacao").css('display') == 'inline'){
                                    $("#notificacao").css('display', 'none');
                                    }
                                }

                                if(result.conversaAberta.length != qtdeMensagem){
                                    $("#msgAbertaNome").html(result.conversaAbertaNome);
                                    $("#resultadoJsonMensagens").html(linha2);
                                }
                        
                                if(document.querySelectorAll('.message').length != num){
                                    document.querySelectorAll('.message:last-child')[0].scrollIntoView();
                                }
                                if(cont < 1){
                                    document.querySelectorAll('.message:last-child')[0].scrollIntoView();
                                    cont ++;
                                }
                                $("#conteudoEnviarMensagem").focus();

                                qtdeContato = result.conversas.length;
                                qtdeMensagem = result.conversaAberta.length;

                            }
                        });
                        
                        num = document.querySelectorAll('.message').length;

                        //console.log(num);
                    }
            
                    setInterval(function(){ajaxon();}, 1000);

                })


                function carregaConversa($id){
                    $.ajax({
                        url: '/api/carrega/mensagem/'+$id,
                
                    });

                }

                function visualizaMensagem(){
                    $.ajax({
                        url: '/api/visualiza/mensagem',
                
                    });

                }

                $("#btnEnviarMensagem").click(function(event) {
                    event.preventDefault();

                    var conteudoMensagem = $("#conteudoEnviarMensagem").val();

                    $.ajax({
                        url: '/api/envia/mensagem',
                        data: {
                            conteudoMensagem: conteudoMensagem
                        },
                
                    });

                    $("#conteudoEnviarMensagem").val("");
                    $("#conteudoEnviarMensagem").focus();

                });

                var inputEle = document.getElementById('conteudoEnviarMensagem');
                inputEle.addEventListener('keyup', function(e){

                    var key = e.which || e.keyCode;
                    if (key == 13) { // codigo da tecla enter
                        
                        var conteudoMensagem = $("#conteudoEnviarMensagem").val();
                        $.ajax({
                            url: '/api/envia/mensagem',
                            data: {
                                conteudoMensagem: conteudoMensagem
                            },
                    
                        });

                        $("#conteudoEnviarMensagem").val("");
                        $("#conteudoEnviarMensagem").focus();

                    }
                });






                    
            </script>

            <footer id="footer">

            </footer>

            @endauth
        </main>

        @endif


        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    </body>
</html>