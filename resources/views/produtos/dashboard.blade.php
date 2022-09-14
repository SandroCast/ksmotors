<html lang="pt-br">

@extends('layouts.main')

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

        .imgresult {
            height: 50px !important;
            width: 100% !important;
            object-fit: cover !important;

        }

    </style>

@section('content')

<div id="cont"></div>
    
@if(session('msg'))
<p class="msg">{{ session('msg') }}</p>
@endif


<a style="margin: 10px 30px" class="btn btn-primary" href="/product/create">Novo</a><br>

    @foreach ($products as $product)

        @php
            $image = \App\Models\FotoProduto::where('id_produto', $product->id)->first();
        @endphp

        <div class="col-md-10 offset-md-1 dashboard-items-container card p-2">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">{{ $product->id }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scropt="row" class="align-middle">Titulo </td>
                        <td scropt="row" class="align-middle"><a href="/produto/{{ $product->id }}">{{ $product->title }}</a></td>
                    </tr>
                    <tr>
                        <td scropt="row" class="align-middle">Descrição </td>
                        <td scropt="row" class="align-middle">{{$product->description}}</td>
                    </tr>
                    <tr>
                        <td scropt="row" class="align-middle">Preço </td>
                        <td scropt="row" class="align-middle">{{$product->preco}}</td>
                    </tr>
                    <tr>
                        <td scropt="row" class="align-middle">Token </td>
                        <td scropt="row" class="align-middle">{{$product->token_pagamento}}</td>
                    </tr>
                    <tr>
                        <td scropt="row" class="align-middle">Imagem </td>
                        <td scropt="row" class="align-middle"><img class="imgresult" src="/img/produtos/{{$image->path}}" alt=""></td>
                    </tr>
                    <tr>
                        <td scropt="row" class="align-middle">
                            <a style="margin-right: 5px;" href="/product/edit/{{ $product->id }}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon> Editar</a>
                        </td>
                        <td scropt="row" style="text-align: end">
                            <form action="/product/{{ $product->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon>Deletar</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
    @endforeach
        
    

@endsection