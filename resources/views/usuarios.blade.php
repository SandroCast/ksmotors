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

    @foreach ($users as $userr)

        <div class="col-md-10 offset-md-1 dashboard-items-container card p-2">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">{{ $userr->id }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scropt="row" class="align-middle">Nome </td>
                        <td scropt="row" class="align-middle">{{$userr->name}}</td>
                    </tr>
                    <tr>
                        <td scropt="row" class="align-middle">Email </td>
                        <td scropt="row" class="align-middle">{{$userr->email}}</td>
                    </tr>
                    <tr>
                        <td scropt="row" class="align-middle">Nível ADM </td>
                        <td scropt="row" class="align-middle">{{$userr->adms}}</td>
                    </tr>
                    <tr>
                        <td scropt="row" class="align-middle">Foto Perfil </td>
                        <td scropt="row" class="align-middle"><img style="max-height: 50px;" @if($userr->profile_photo_path != null) src="/img/{{ $userr->profile_photo_path }}" @else src="{{ $userr->profile_photo_url }}" @endif alt=""></td>
                    </tr>



                    <tr>
                        <td scropt="row" class="align-middle">
                            <form action="/usuarios/promover/{{$userr->id}}" method="POST">
                                @csrf
                                <button style="margin-right: 5px;" class="btn btn-info edit-btn"><ion-icon name="arrow-up-outline"></ion-icon> Promover</button>
                            </form>
                        </td>
                        <td scropt="row" style="text-align: end">
                            <form action="/usuarios/rebaixar/{{$userr->id}}" method="POST">
                                @csrf
                                <button style="margin-right: 5px;" class="btn btn-danger edit-btn"><ion-icon name="arrow-down-outline"></ion-icon> Rebaixar</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
    @endforeach
    

@endsection