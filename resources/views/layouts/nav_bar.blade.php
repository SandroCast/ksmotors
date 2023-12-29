<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container"> <!---container-fluid--->
      <a class="navbar-brand" href="#"><b>KS</b>motors</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">


          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Categorias
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Baterias</a></li>
              <li><a class="dropdown-item" href="#">Pneus</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Todas</a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>

        <div id="div-img-perfil" style="float: left; margin-left: 60px;">
          @auth

            <a id="link-abre-menu-perfil" href="#" style="text-decoration: none" onclick="alternarVisibilidade(event)">
              <div id="div-width-phone">
                <img src="/img/profile-photos/I4wXTJ0wPeLRJpwqXFIe6JezZfWMyGEuXRPQjrlI.jpg" style="width: 40px; display: inline" alt="" class="rounded-circle">
                <div id="div-nome-user" style="display: none; margin-left: 10px">sandrp de cas</div>
              </div>
            </a>

            <div id="config-perfil" class="card" hidden>

              <div style="display: flex; justify-content: center">
                <img src="/img/profile-photos/I4wXTJ0wPeLRJpwqXFIe6JezZfWMyGEuXRPQjrlI.jpg" style="width: 100px" alt="" class="rounded-circle">
              </div>

    
              <span style="margin-bottom: 10px">Sandro de Castro Parente</span>
            

              <form action="/logout" method="post">
                @csrf
                <a href="#" class="btn btn-primary" style="border: solid 1px #999; width: 65px; float: left;">Perfil</a>

                <button type="submit" class="btn btn-danger" style="border: solid 1px #999; width: 65px; float: right;">Sair</button>
              </form>

            </div>
          
          @else
            <a id="botao-entrar" href="/login" class="btn btn-default"><b>Entrar</b></a>
          @endauth
        </div>
        
      </div>
    </div>
  </nav>
