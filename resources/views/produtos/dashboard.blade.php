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

<a class="btn btn-primary" href="/product/create">Novo</a>
    
    <div class="col-md-10 offset-md-1 dashboard-items-container card p-2">
    
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Nº</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Token</th>
                    <th class="text-center" scope="col">Imagem</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
        
            <tbody>
                @foreach ($products as $product)
                    @php
                        $image = \App\Models\FotoProduto::where('id_produto', $product->id)->first();
                    @endphp
                    <tr>
                        <td scropt="row" class="align-middle">{{ $loop->index + 1 }}</td>
                        <td class="align-middle"><a href="/produto/{{ $product->id }}">{{ $product->title }}</a></td>
                        <td class="align-middle">{{ $product->description }}</td>
                        <td class="align-middle">{{ $product->preco }}</td>
                        <td class="align-middle">{{ $product->token_pagamento }}</td>
                        <td class="align-middle text-center"><img class="imgresult" src="/img/produtos/{{$image->path}}" alt=""></td>

                        <td class="d-flex align-middle">
                        <a style="margin-right: 5px;" href="/product/edit/{{ $product->id }}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon> Editar</a>

                        <form action="/product/{{ $product->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon>Deletar</button>
    
                        </form>
                        </td>
                    </tr>
                    
                @endforeach
    
    
            </tbody>
        </table>
    
    </div>
    

@endsection