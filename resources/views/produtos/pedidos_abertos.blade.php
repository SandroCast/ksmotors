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
                        <td scropt="row" class="align-middle">Cliente </td>
                        <td scropt="row" class="align-middle">{{$pedido->user->name}}</td>
                    </tr>
                    <tr>
                        <td scropt="row" class="align-middle">Status </td>
                        <td scropt="row" class="align-middle">{{$pedido->status}}</td>
                    </tr>
                    <tr>
                        <td scropt="row" class="align-middle">Data </td>
                        <td scropt="row" class="align-middle">{{$pedido->created_at}}</td>
                    </tr>
                    <tr>
                        <td scropt="row" class="align-middle">
                            @if($pedido->status == 'Em análise')
                                <a href="/autoriza/pedido/{{$pedido->id}}" style="margin-right: 5px;" class="btn btn-info edit-btn"><ion-icon name="thumbs-up"></ion-icon> Autorizar Compra</a>
                            @endif
                        </td>
                        <td scropt="row" style="text-align: end">
                            @if($pedido->status != 'Cancelado' && $pedido->status != 'Entregue')
                                <a href="/cancela/pedido/{{$pedido->id}}" style="margin-right: 5px;" class="btn btn-danger edit-btn"><ion-icon name="close"></ion-icon> Cancelar Pedido</a>
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