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
            height: 200px;
            width: 100%;
            object-fit: cover;

        }
        .btn-primary{
            width: 85px;

        }
        .opc {
            font-size: 20px;
            padding: 0px 5px;
            float: right;
            line-height: 30px;
        }
        #space{
            height: 100px;
        }
        #favorite {
            color: #777;
            text-align: center;
            margin-top: 30vh;

        }
        .remov{
            text-decoration: none;
            color: red;
            font-size: 15px;
        }
        .remov:hover{
            font-weight: bold;
            font-size: 14px;   
            color: red;     
        }

        @media(max-width: 768px) {
            .col-md-3{
                display: inline;

            }

        }
    </style>
<div id="space"></div>

@if(count($produtos) > 0)

    <div id="iten-container" class="col-md-12">
        @foreach ($produtos as $produto)
            <div class="col-md-3">
                <div class="card col-md-12" id="">
                    <img class='imgresult  img-thumbnail' alt='Foto' src='/img/produtos/{{$produto->produto->image}}'>
       
                    <h5 class="card-title">{{$produto->produto->title}}</h5>
                    <h4 style="color: rgba(16, 185, 129);" class="card-title">{{'R$'.number_format($produto->produto->preco, 2, ',', '.')}}</h4>
                    <p><i class="fa fa-thumbs-up" aria-hidden="true"></i>{{ count($produto->produto->users) }}</p>
                    <div>

                        <a id="id" class="btn btn-primary" href="#">Mais</a>

                        <form class="opc" action="/product/favorite/remove/{{$produto->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <a class="remov" href="/product/favorite/remove/{{$produto->id}}" onclick="event.preventDefault(); this.closest('form').submit();">remover favorito</a>
                        </form>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else

<h1 id="favorite">Nada em favoritos</h1>

@endif



@endsection