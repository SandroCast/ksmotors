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
    </style>

@section('content')

    <div id="cont"></div>
    
    @if(session('msg'))
    <p class="msg">{{ session('msg') }}</p>
    @endif

    <div id="product-create-container" class="col-md-6 offset-md-3">
        <h1>Anunciar um novo produto</h1>
        <form action="/" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">Imagem do Produto:</label>
                <input type="file" name="image" id="image" class="from-control-file" required>
            </div>
            <div class="form-group">
                <label for="title">Titulo do Produto:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Nome do produto" required>
            </div>
            <div class="form-group">
                <label for="title">Descrição do Produto:</label>
                <textarea name="description" id="description" class="form-control" placeholder="Fale um pouco sobre o deu produto" required></textarea>
            </div>
            <div class="form-group">
                <label for="title">Preço do Produto:</label>
                <input type="number" class="form-control" id="preco" name="preco" placeholder="Qual o valor do produto?" required>
            </div>
            <input type="submit" class="btn btn-primary" value="Adicionar Produto">
        </form>
    </div>

@endsection