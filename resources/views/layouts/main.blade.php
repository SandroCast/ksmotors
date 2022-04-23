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

        <!-- CSS da aplicação -->
        <link rel="stylesheet" href="/css/style_layouts.css">
        <script src="/js/script.js"></script>
    </head>

    <body onload="srl(@if(session('click'))
    {{session('click')}}
    @endif)">
        <header id="main-header">

            <!-- Cabeçalho -->
            <nav id="navbartop">

                <nav id="partesuperior">
                    <a href="/"><strong>3D</strong>PrintEvolution</a>
                    @auth
                        <a onclick="event.preventDefault(); conf_mini()" href="#" ><img class="imgperfil" style="float: right; font-size: 15px; border-radius: 50%; margin: 5px 10px;" src="" alt="Perfil"></a>
                        <div class="card col-md-12" id="config">

                            <img class="imgconfig" style="border-radius: 50%; margin: 5px 35px;" src="img/usuarios/sandrocastro.jpg" alt="Perfil">
                            <ul>
                                <li><a href="/user/profile">Meu Perfil</a></li>
                                <li><a href="/product/favorite">Favoritos</a></li>
                                <li><a href="#">Meus Pedidos</a></li>
                                @if($user->id < 4)
                                <li><a href="/product/dashboard">Produtos</a></li>
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
                        <li><a href="#">Sobre</a></li>
                        <li><a href="#">Quem Somos</a></li>
                        <li><a href="#">Contato</a></li>
                        
                    </ul>
                </nav>

            </nav>


        </header>

        <main id="conteudo">
            @yield('content')
        </main>

        <footer id="footer">

        </footer>

        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    </body>
</html>