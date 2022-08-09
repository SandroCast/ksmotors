<html lang="pt-br">

@extends('layouts.main')


@section('content')

    <style>
        #banner {
            width: 100%;
            
        }
        #search-container {
            padding: 20px;
            background-image: linear-gradient(#E8F1FA, #ecf0f5);
        }
        #propaganda {
            padding: 0px 20px;
            background-color: black;
            color: white;
        }
        .col-md-3 {
            display: inline-block;
            margin-left: -3px;
            padding: 5px;
        }
        .col-md-12 {
            padding: 10px;
        }
        .imgresult {
            height: 200px !important;
            width: 100% !important;
            object-fit: cover !important;

        }
        .btn-primary{
            width: 85px;

        }
        .opc {
            font-size: 20px;
            padding: 0px 5px;
            float: right;
            line-height: 30px;
            margin: 0;
        }


        @media(max-width: 768px) {
            .col-md-3{
                display: inline;

            }

        }
    </style>

    <img id="banner" src="img/banner.jpg" alt="banner">

    <div id="search-container" class="col-md-12">
        <form action="/" method="GET">
            <input type="text" id="search" name="search" class="form-control" placeholder="Buscar...">
        </form>
    </div>

    <div id="propaganda">
        <p>Anúncios...</p>
        <p>Filamentos 3DPrintEvolution</p>
    </div>

    <div id="iten-container" class="col-md-12">
        @foreach ($products as $product)
            <div class="col-md-3">
                <div class="card col-md-12" id="{{$product->id}}">
                    @php
                        $fotos = \App\Models\FotoProduto::where('id_produto', $product->id)->get();
                    @endphp

                    {{--  <!-- Carousel container -->  --}}
                    <div id="my-pics{{$product->id}}" class="carousel slide" data-ride="carousel">

                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            @for($i = 0; $i < count($fotos); $i++)
                                <li data-target="#my-pics{{$product->id}}" data-slide-to="{{$i}}" class="indicadores @if($i == 0) {{'active'}} @endif"></li>
                            @endfor

                        </ol>
                        
                        <!-- Content -->
                        <div class="carousel-inner" role="listbox">
                        
                            @php $cont = 0; @endphp
                            <!-- Slide 1 -->
                            @foreach ($fotos as $foto)

                                <div class="item @if($cont < 1) {{'active'}} @endif">
                                    <img src="/img/produtos/{{$foto->path}}" class="imgresult img-thumbnail"  alt="">
                                </div>

                                @php $cont ++; @endphp
                            @endforeach

                        </div>
                        
                        <!-- Previous/Next controls -->
                        <a class="left carousel-control" href="#my-pics{{$product->id}}" role="button" data-slide="prev">
                            <span class="icon-prev" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="right carousel-control" href="#my-pics{{$product->id}}" role="button" data-slide="next">
                            <span class="icon-next" aria-hidden="true"></span>
                            <span class="sr-only">Próximo</span>
                        </a>
                        
                    </div>
                    {{--  <!-- Carousel container -->  --}}
       
                    <h5 class="card-title">{{ $product->title }}</h5>
                    <h5 style="color: rgb(0, 126, 84);" class="card-title">{{'R$'.number_format($product->preco, 2, ',', '.')}}</h5>
                    <p><i class="fa fa-thumbs-up" aria-hidden="true"></i> {{ count($product->users) }}</p>
                    <div>

                        <a id="id" class="btn btn-primary" href="/produto/{{$product->id}}">Mais</a>

                        @auth
                        @php $usua = $favoritos->where('product_id', $product->id)->first(); @endphp
                        @endauth
                        @if($user && $usua)
                        <a href="" onclick="event.preventDefault();"><i style="color: #0d6efd;" class="fa fa-heart opc" aria-hidden="true"></i></a>
                        <h3 class="opc" style="display: inline">|</h3>
                        @else
                        <form class="opc" action="/product/favorite/{{ $product->id }}" method="post">
                        @csrf
                        <a href="/product/favorite/{{ $product->id }}" onclick="event.preventDefault(); this.closest('form').submit();"><i class="fa fa-heart-o opc" aria-hidden="true"></i></a>
                        <h3 class="opc" style="display: inline">|</h3>
                        </form>

                        @endif

                        
                        @auth
                        @php $usu = $product->users->where('id', $user->id)->first(); @endphp
                        @endauth
                        @if($user && $usu)

                            <a href="" onclick="event.preventDefault();"><i class="fa fa-thumbs-up opc" aria-hidden="true"></i></a>
                        @else
                            <form class="opc" action="/product/join/{{ $product->id }}" method="post">
                                @csrf
                                <a href="/product/join/{{ $product->id }}" onclick="event.preventDefault(); this.closest('form').submit();"><i class="fa fa-thumbs-o-up opc" aria-hidden="true"></i></a>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection