<html lang="pt-br">

@extends('layouts.main')


@section('content')

    <style>

        #cont {
            padding-top: 150px;
        }
        #navbartop {
            background-color: black !important;  
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
        .dashboard-items-container th {
            width: 25%;
        }

        .dashboard-items-container form {
            display: inline-block;

        }

        .btn-primary {
            margin: 10px 8%;        

        }

    </style>

<div id="cont"></div>
    
@if(session('msg'))
<p class="msg">{{ session('msg') }}</p>
@endif

    @foreach ($pedidos as $pedido)
        <div class="col-md-10 offset-md-1 dashboard-items-container card p-2">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Pedido</th>
                        <th scope="col">{{ $pedido->id }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scropt="row" class="align-middle">Produto </td>
                        <td scropt="row" class="align-middle">{{$pedido->produto->title}}</td>
                    </tr>
                    <tr>
                        <td scropt="row" class="align-middle">Preço </td>
                        <td scropt="row" class="align-middle">{{'R$'.number_format($pedido->produto->preco, 2, ',', '.')}}</td>
                    </tr>
                    <tr>
                        <td scropt="row" class="align-middle">Status </td>
                        <td scropt="row" class="align-middle">{{$pedido->status}}</td>
                    </tr>
                    <tr>
                        <td scropt="row" class="align-middle">Data Pedido</td>
                        <td scropt="row" class="align-middle">{{$pedido->created_at}}</td>
                    </tr>
                    <tr>
                        <td scropt="row" class="align-middle">
                            @if($pedido->status == 'Aguardando Pagamento')
                                <script src="https://www.mercadopago.com.br/integrations/v1/web-payment-checkout.js"
                                data-preference-id="{{$pedido->produto->token_pagamento}}" data-source="button">
                                </script>
                                <a href="/analizar/pagamento/aprovado/{{$pedido->id}}" class="btn btn-success edit-btn">Já Paguei</a>
                            @endif
                        </td>
                        <td scropt="row" style="text-align: end">
                            @if($pedido->status != 'Cancelado' && $pedido->status != 'Entregue')
                                <a href="/cancela/pedido/{{$pedido->id}}" style="margin-right: 5px;" class="btn btn-danger edit-btn"> Cancelar Pedido</a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
    @endforeach


    <script>

        function autorizarPedido($id){




        }


    </script>
    
@endsection