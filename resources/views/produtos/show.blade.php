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
            height: 500px !important;
            width: 100% !important;
            object-fit: cover !important;
        }
        .mini_imgresult{
            height: 50px !important;
            width: 100% !important;
            object-fit: cover !important;
        }
        .active > .img-fluid{
            border: solid 2px #225A7E;
            opacity : 1 !important;
        }
        .fot{
            border: none;
            margin-left: 5px;
            margin-right: 5px;
        }
        #textDetalhe{
            border: 1px solid #E5E5E5;
            border-radius: 10px;
            padding: 10px;
        }

    </style>

@section('content')



    <!-- MDB -->
    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.js"
    ></script>



    <div id="cont"></div>
    
    @if(session('msg'))
    <p class="msg">{{ session('msg') }}</p>
    @endif

    <div id="product-create-container" class="card col-md-10 offset-md-1 d-block" style="padding-bottom: 10px; display: inline;">


        <div class="col-md-7" style="z-index: 0; margin-bottom: 100px;">

            {{--  <!-- Carousel wrapper -->  --}}
            <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-mdb-ride="carousel">
                {{--  <!-- Slides -->  --}}
                <div class="carousel-inner mb-5">
                    @php $cont = 0; @endphp
                    @foreach ($fotos as $foto)
                        <div class="carousel-item @if($cont < 1) {{'active'}} @endif">
                        <img src="/img/produtos/{{$foto->path}}" class="d-block imgresult" alt="..." />
                        </div>
                        @php $cont ++; @endphp
                    @endforeach
                </div>
                {{--  <!-- Slides -->  --}}
                
                {{--  <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleIndicators"
                    data-mdb-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleIndicators"
                    data-mdb-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>  --}}
                {{--  <!-- Controls -->  --}}
                
                {{--  <!-- Thumbnails -->  --}}
                <div class="carousel-indicators" style="margin-bottom: -80px;">

                    @php $i = 0; @endphp
                    @foreach ($fotos as $foto)
                        <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="{{$i}}" class="fot @if($i == 0) {{'active'}} aria-current="true" @endif"
                        @if($i == 0) aria-current="true" @endif aria-label="Slide {{$i + 1}}" style="width: 100px;">
                        <img style="opacity: 0.7;" class="d-block w-100 img-fluid mini_imgresult" src="/img/produtos/{{$foto->path}}"/>
                        </button>
                        @php $i ++; @endphp
                    @endforeach

                </div>
                {{--  <!-- Thumbnails -->  --}}
            </div>
            {{--  <!-- Carousel wrapper -->  --}}


        </div>

        <div id="textDetalhe" class="offset-md-7" style="z-index: 0;">

            <p style="color: #999">503 vendidos</p>
            <h3>{{$produto->title}}</h3>
            <h5>{{$produto->description}}</h5>
            <h1>{{'R$'.number_format($produto->preco, 2, ',', '.')}}</h1>

            <br>

            <form action="" method="POST">
                @csrf
                <button class="btn-manual-center-success">Combinar entrega</button>
            </form>
            
            {{--  <script src="https://www.mercadopago.com.br/integrations/v1/web-payment-checkout.js"
                data-preference-id="{{$produto->token_pagamento}}" data-source="button">
            </script>  --}}

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    $(".mercadopago-button").html('Comprar');
                })
            </script>


        </div>



    </div>


@endsection