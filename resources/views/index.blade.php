<html lang="pt-br">

@extends('layouts.main')


@section('content')

    <style>
        .card-container {
            position: relative;
            white-space: nowrap;
            overflow-x: auto;
            padding: 20px;
            margin-bottom: 20px; /* Espaço abaixo dos cards */
        }

        .cardContainer > .card {
            width: 18rem;
            display: inline-block;
            margin-right: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd; /* Adicione uma borda para destacar os cards */
            border-radius: 8px; /* Borda arredondada */
            overflow: hidden; /* Para esconder qualquer conteúdo que ultrapasse o card */
            transition: transform 0.3s ease; /* Adiciona uma transição suave de transformação */
            height: 380px;
        }

        .cardContainer > .card:hover {
            transform: scale(1.03); /* Efeito de escala ao passar o mouse */
        }

        /* Estilização da barra de rolagem */
        .card-container::-webkit-scrollbar {
            width: 12px;
            height: 5px;
        }

        .card-container::-webkit-scrollbar-thumb {
            background-color: #ECF0F5;
            border-radius: 6px;
            transition: background-color 0.3s ease; /* Adiciona uma transição suave para a cor de fundo da barra de rolagem */
        }

        .card-container:hover::-webkit-scrollbar-thumb {
            background-color: #ECF0F5; /* Altera a cor de fundo da barra de rolagem ao passar o mouse sobre o contêiner */
        }

        h1{
            color:#444;
            margin-left: 20px;
        }

        .card-img-top{
            width: 286px;
            height: 286px;
        }

        .card-img-top {
            width: 286px;
            height: 286px;
            object-fit: cover;
        }

    </style>

    <div style="max-width: 2000px;">

        <img src="/img/banner-home.png" alt="" style="width: 100%;">
    
        <br>
        <h1>Baterias</h1>
    
        <div class="card-container cardContainer">
            <div class="card" style="width: 18rem;">
                <img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQnhpBqiKzRi_yASoZ_Jmouqq2KcBxLWopJbBqmngFa0JA_DCchOGjhMUSnnXqKLuI54QiWerAbOO4KPMxorQKm1J8ASFd8J0I8E9CSm_WWJv1twkurvE21&usqp=CAE" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <span style=" font-size: 20px; font-weight: 600">R$ 500,00</span>
                    <span style="float:right">5 dispovível</span>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="https://a-static.mlcdn.com.br/450x450/bateria-6v-12ah-para-moto-eletrica-infantil-brinquedos-moto-eletrica-carrinho-eletrico-bandeirante-sec-power/manialaser/58310bae771b11ec86974201ac18503a/428948c79b723bfecc10327ed1fbcc41.jpeg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <span style=" font-size: 20px; font-weight: 600">R$ 500,00</span>
                    <span style="float:right">5 dispovível</span>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="https://a-static.mlcdn.com.br/450x450/bateria-unipower-6v-45ah-up645seg-moto-eletrica-carrinho-infantil-brinquedos/armazemsilvestre/957/b80665793674a5ae66966d8d8fc00b14.jpeg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <span style=" font-size: 20px; font-weight: 600">R$ 500,00</span>
                    <span style="float:right">5 dispovível</span>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQnhpBqiKzRi_yASoZ_Jmouqq2KcBxLWopJbBqmngFa0JA_DCchOGjhMUSnnXqKLuI54QiWerAbOO4KPMxorQKm1J8ASFd8J0I8E9CSm_WWJv1twkurvE21&usqp=CAE" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <span style=" font-size: 20px; font-weight: 600">R$ 500,00</span>
                    <span style="float:right">5 dispovível</span>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQnhpBqiKzRi_yASoZ_Jmouqq2KcBxLWopJbBqmngFa0JA_DCchOGjhMUSnnXqKLuI54QiWerAbOO4KPMxorQKm1J8ASFd8J0I8E9CSm_WWJv1twkurvE21&usqp=CAE" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <span style=" font-size: 20px; font-weight: 600">R$ 500,00</span>
                    <span style="float:right">5 dispovível</span>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQnhpBqiKzRi_yASoZ_Jmouqq2KcBxLWopJbBqmngFa0JA_DCchOGjhMUSnnXqKLuI54QiWerAbOO4KPMxorQKm1J8ASFd8J0I8E9CSm_WWJv1twkurvE21&usqp=CAE" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <span style=" font-size: 20px; font-weight: 600">R$ 500,00</span>
                    <span style="float:right">5 dispovível</span>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQnhpBqiKzRi_yASoZ_Jmouqq2KcBxLWopJbBqmngFa0JA_DCchOGjhMUSnnXqKLuI54QiWerAbOO4KPMxorQKm1J8ASFd8J0I8E9CSm_WWJv1twkurvE21&usqp=CAE" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <span style=" font-size: 20px; font-weight: 600">R$ 500,00</span>
                    <span style="float:right">5 dispovível</span>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQnhpBqiKzRi_yASoZ_Jmouqq2KcBxLWopJbBqmngFa0JA_DCchOGjhMUSnnXqKLuI54QiWerAbOO4KPMxorQKm1J8ASFd8J0I8E9CSm_WWJv1twkurvE21&usqp=CAE" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <span style=" font-size: 20px; font-weight: 600">R$ 500,00</span>
                    <span style="float:right">5 dispovível</span>
                </div>
            </div>



        </div>

        <h1>Lanternas</h1>
    
        <div class="card-container cardContainer">
            <div class="card" style="width: 18rem;">
                <img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQnhpBqiKzRi_yASoZ_Jmouqq2KcBxLWopJbBqmngFa0JA_DCchOGjhMUSnnXqKLuI54QiWerAbOO4KPMxorQKm1J8ASFd8J0I8E9CSm_WWJv1twkurvE21&usqp=CAE" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <span style=" font-size: 20px; font-weight: 600">R$ 500,00</span>
                    <span style="float:right">5 dispovível</span>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQnhpBqiKzRi_yASoZ_Jmouqq2KcBxLWopJbBqmngFa0JA_DCchOGjhMUSnnXqKLuI54QiWerAbOO4KPMxorQKm1J8ASFd8J0I8E9CSm_WWJv1twkurvE21&usqp=CAE" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <span style=" font-size: 20px; font-weight: 600">R$ 500,00</span>
                    <span style="float:right">5 dispovível</span>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQnhpBqiKzRi_yASoZ_Jmouqq2KcBxLWopJbBqmngFa0JA_DCchOGjhMUSnnXqKLuI54QiWerAbOO4KPMxorQKm1J8ASFd8J0I8E9CSm_WWJv1twkurvE21&usqp=CAE" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <span style=" font-size: 20px; font-weight: 600">R$ 500,00</span>
                    <span style="float:right">5 dispovível</span>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQnhpBqiKzRi_yASoZ_Jmouqq2KcBxLWopJbBqmngFa0JA_DCchOGjhMUSnnXqKLuI54QiWerAbOO4KPMxorQKm1J8ASFd8J0I8E9CSm_WWJv1twkurvE21&usqp=CAE" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <span style=" font-size: 20px; font-weight: 600">R$ 500,00</span>
                    <span style="float:right">5 dispovível</span>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQnhpBqiKzRi_yASoZ_Jmouqq2KcBxLWopJbBqmngFa0JA_DCchOGjhMUSnnXqKLuI54QiWerAbOO4KPMxorQKm1J8ASFd8J0I8E9CSm_WWJv1twkurvE21&usqp=CAE" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <span style=" font-size: 20px; font-weight: 600">R$ 500,00</span>
                    <span style="float:right">5 dispovível</span>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQnhpBqiKzRi_yASoZ_Jmouqq2KcBxLWopJbBqmngFa0JA_DCchOGjhMUSnnXqKLuI54QiWerAbOO4KPMxorQKm1J8ASFd8J0I8E9CSm_WWJv1twkurvE21&usqp=CAE" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <span style=" font-size: 20px; font-weight: 600">R$ 500,00</span>
                    <span style="float:right">5 dispovível</span>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQnhpBqiKzRi_yASoZ_Jmouqq2KcBxLWopJbBqmngFa0JA_DCchOGjhMUSnnXqKLuI54QiWerAbOO4KPMxorQKm1J8ASFd8J0I8E9CSm_WWJv1twkurvE21&usqp=CAE" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <span style=" font-size: 20px; font-weight: 600">R$ 500,00</span>
                    <span style="float:right">5 dispovível</span>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQnhpBqiKzRi_yASoZ_Jmouqq2KcBxLWopJbBqmngFa0JA_DCchOGjhMUSnnXqKLuI54QiWerAbOO4KPMxorQKm1J8ASFd8J0I8E9CSm_WWJv1twkurvE21&usqp=CAE" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <span style=" font-size: 20px; font-weight: 600">R$ 500,00</span>
                    <span style="float:right">5 dispovível</span>
                </div>
            </div>
        </div>
        



    </div>



    <script>

        document.addEventListener('DOMContentLoaded', function() {
            const cardContainers = document.querySelectorAll('.card-container');

            cardContainers.forEach(function(cardContainer) {
                let isMouseDown = false;
                let startX;
                let scrollLeft;

                cardContainer.addEventListener('mousedown', function(e) {
                    isMouseDown = true;
                    startX = e.pageX - cardContainer.offsetLeft;
                    scrollLeft = cardContainer.scrollLeft;
                });

                cardContainer.addEventListener('mouseleave', function() {
                    isMouseDown = false;
                });

                cardContainer.addEventListener('mouseup', function() {
                    isMouseDown = false;
                });

                cardContainer.addEventListener('mousemove', function(e) {
                    if (!isMouseDown) return;
                    e.preventDefault();
                    const x = e.pageX - cardContainer.offsetLeft;
                    const walk = (x - startX) * 1; // Ajuste conforme necessário para a sensibilidade de rolagem
                    cardContainer.scrollLeft = scrollLeft - walk;
                });
            });
        });


    </script>


@endsection