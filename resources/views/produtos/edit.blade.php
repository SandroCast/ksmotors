<html lang="pt-br">

@extends('layouts.main')

    <style>

        #cont {
            padding-top: 100px;
        }
        .msg {
            background-color: #D4EDDA;
            color: #155724;
            border: 1px solid #C3E6CB;
            width: 100%;
            margin-bottom: 15px;
            text-align: center;
            padding: 10px;
        }
        #navbartop {
            background-color: black;  
        }
        #product-create-container {
            padding-top: 20px;
        }
        .form-group {

            margin-top: 15px;
        }
        .btn-primary {
            margin-top: 15px;
        }
        .imgresult {
            height: 200px !important;
            width: 100% !important;
            object-fit: cover !important;

        }
    </style>

@section('content')

    <div id="cont"></div>
    
    @if(session('msg'))
    <p class="msg">{{ session('msg') }}</p>
    @endif

    <div id="product-create-container" class="col-md-6 offset-md-3">
        <h1>Editando: {{ $product->title }}</h1>
        <h5>URL Processando Pagamento:<br>
            /teste/{{$product->id}}</h5>
        <h5>URL Pagamento Finalizado:<br>
            /teste2/{{$product->id}}</h5>
        <form action="/product/update/{{ $product->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="image">Imagem do Produto:</label>
                <input type="file" name="image[]" id="image" class="from-control-file" multiple>
                <div class="text-center m-3">

                    @php
                        $fotos = \App\Models\FotoProduto::where('id_produto', $product->id)->get();
                    @endphp

                    {{--  <!-- Carousel container -->  --}}
                    <div id="my-pics" class="carousel slide" data-ride="carousel">

                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            @for($i = 0; $i < count($fotos); $i++)
                                <li data-target="#my-pics" data-slide-to="{{$i}}" class="indicadores @if($i == 0) {{'active'}} @endif"></li>
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
                        <a class="left carousel-control" href="#my-pics" role="button" data-slide="prev">
                            <span class="icon-prev" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="right carousel-control" href="#my-pics" role="button" data-slide="next">
                            <span class="icon-next" aria-hidden="true"></span>
                            <span class="sr-only">Próximo</span>
                        </a>
                        
                    </div>
                    {{--  <!-- Carousel container -->  --}}

                </div>
            </div>
            <div class="form-group">
                <label for="title">Titulo do Produto:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Nome do produto" value="{{ $product->title }}" required>
            </div>
            <div class="form-group">
                <label for="title">Descrição do Produto:</label>
                <textarea name="description" id="description" class="form-control" placeholder="Fale um pouco sobre o deu produto" required>{{ $product->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="title">Preço do Produto:</label>
                <input type="text" class="form-control" id="preco" name="preco" placeholder="Qual o valor do produto?" value="{{ $product->preco }}" required>
            </div>
            <div class="form-group">
                <label for="title">Token ID Butão de Pagamento:</label>
                <input type="text" class="form-control" id="token_pagamento" name="token_pagamento" placeholder="Token Pagamento" value="{{ $product->token_pagamento }}" required>
            </div>
            <input type="submit" class="btn btn-primary" value="Guardar">
        </form>
    </div>

@endsection