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
    
    <div class="col-md-10 offset-md-1 dashboard-items-container card p-2">
    
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">{{'#'}}</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nível ADM</th>
                    <th class="text-center" scope="col">Foto Perfil</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
        
            <tbody>
                @foreach ($users as $userr)
                    <tr>
                        <td scropt="row" class="align-middle">{{ $userr->id }}</td>
                        <td class="align-middle">{{$userr->name}}</td>
                        <td class="align-middle">{{ $userr->email }}</td>
                        <td class="align-middle">{{ $userr->adms }}</td>
                        <td class="align-middle"><img style="max-height: 50px;" @if($userr->profile_photo_path != null) src="/img/{{ $userr->profile_photo_path }}" @else src="{{ $userr->profile_photo_url }}" @endif alt=""></td>
                        <td class="d-flex align-middle">
                            <form action="/usuarios/promover/{{$userr->id}}" method="POST">
                                @csrf
                                <button style="margin-right: 5px;" class="btn btn-info edit-btn"><ion-icon name="arrow-up-outline"></ion-icon> Promover</button>
                            </form>
                            <form action="/usuarios/rebaixar/{{$userr->id}}" method="POST">
                                @csrf
                                <button style="margin-right: 5px;" class="btn btn-danger edit-btn"><ion-icon name="arrow-down-outline"></ion-icon> Rebaixar</button>
                            </form>
                        </td>
                    </tr>
                    
                @endforeach
    
    
            </tbody>
        </table>
    
    </div>
    

@endsection