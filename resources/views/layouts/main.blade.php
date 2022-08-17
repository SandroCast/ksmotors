<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <link rel="shortcut icon" href="/img/logo.jpg" type="image/x-icon" />

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
                

        {{--  <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">  --}}

        //extends o form de mensagens para outra view

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
                        <li><a href="/">Home</a></li>
                        {{--  <li><a href="#">Sobre</a></li>  --}}
                        <li><a href="#">Quem Somos</a></li>
                        <li><a href="#">Contato</a></li>
                        <li><a data-toggle="modal" data-target="#flipFlop" href="">Chat<i id="notificacao" class="fa fa-circle" aria-hidden="true"><span id="numeroNotify">1</span></i></a></li>
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
                                        <ul id="resultadoJson">
                                            {{--  //resultado json lista conversas  --}}
                                            {{--  <span class="ml-2 w-2 h-2 bg-blue-500 rounded-full"></span>  --}}
                                        </ul>

                                    </div>

                                    <!----- box message ----->
                                    <div class="w-8/12 flex flex-col justify-between">

                                        <!----- message ----->
                                        <div class="w-full p-6 flex flex-col overflow-y-scroll">
                                            <div class="w-full mb-3 message">
                                                <p class="inline-block p-2 rounded-md" style="max-width: 75%;">
                                                    {{--  {{ message.content }}  --}}
                                                </p>
                                                {{--  <span class="block mt-1 text-xs text-gray-500">{{ message.created_at }}</span>  --}}
                                            </div>

                                            
                                        </div>

                                        <!--- form --->
                                        <div class="w-full bg-gray-200 bg-opacity-25 p-6 border-t border-gray-200">
                                            <form >
                                                <div class="flex rounded-md overflow-hidden border border-gray-300">
                                                    <input type="text" class="flex-1 px-4 py-2 text-lx focus:outline-none border-none">
                                                    <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2">Enviar</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        {{--  wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww  --}}
                        </div>
                    </div>
                </div>
            </div>


            <input id="usuarioLogado" type="hidden" value="{{$user->id}}">
            <script>

                document.addEventListener('DOMContentLoaded', () => {

                    function ajaxon(){

                        var id_user = $("#usuarioLogado").val();
                    
                        $.ajax({
                            url: '/api/mensagens/'+id_user,
                            //data: {
                            //    id_user: id_user
                            //},
                            dataType: 'json',
                            success: function(result) {
                    
                                var linha = '';
                    
                                if (result && result.length > 0) {
                    
                                    $.each(result, function(index, val) {

                                        linha += '<li class="p-6 text-gray-600 leading-7 font-semibold border-b border-gray-200 hover:bg-gray-200 hover:bg-opacity-50 hover:cursor-pointer">';
                                        linha += '<p style="font-size: 15px" class="flex items-center">'+val.name.split(" ")[0]+'</p>';
                                        linha += '</li>';

                                    });
                                    //console.log(result[0].name);

                                }

                                //$("#modalItemRecebido #itens").css('display', 'inline');
                                //$("#modalItemRecebido #item").css('display', 'none');
                                $("#resultadoJson").html(linha);
                    
                                //console.log(result[0].name);
                            }
                        });
                        

                    }
            
                    setInterval(function(){ajaxon();}, 5000);

                })
                    
            </script>

            <footer id="footer">

            </footer>

            @endauth
        </main>

        @endif


        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    </body>
</html>