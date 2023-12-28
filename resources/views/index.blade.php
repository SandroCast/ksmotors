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

        .card {
            width: 18rem;
            display: inline-block;
            margin-right: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd; /* Adicione uma borda para destacar os cards */
            border-radius: 8px; /* Borda arredondada */
            overflow: hidden; /* Para esconder qualquer conteúdo que ultrapasse o card */
            transition: transform 0.3s ease; /* Adiciona uma transição suave de transformação */
        }

        .card:hover {
            transform: scale(1.03); /* Efeito de escala ao passar o mouse */
        }

        /* Estilização da barra de rolagem */
        .card-container::-webkit-scrollbar {
            width: 12px;
        }

        .card-container::-webkit-scrollbar-thumb {
            background-color: #888;
            border-radius: 6px;
            transition: background-color 0.3s ease; /* Adiciona uma transição suave para a cor de fundo da barra de rolagem */
        }

        .card-container:hover::-webkit-scrollbar-thumb {
            background-color: #ddd; /* Altera a cor de fundo da barra de rolagem ao passar o mouse sobre o contêiner */
        }

        h1{
            color:#444;
            margin-left: 20px;
        }

    </style>

    <div style="max-width: 2000px;">

        <img src="/img/banner-home.png" alt="" style="width: 100%;">
    
        <br>
        <h1>Baterias</h1>
    
        <div class="card-container" id="cardContainer">
            <div class="card" style="width: 18rem;">
                <img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQnhpBqiKzRi_yASoZ_Jmouqq2KcBxLWopJbBqmngFa0JA_DCchOGjhMUSnnXqKLuI54QiWerAbOO4KPMxorQKm1J8ASFd8J0I8E9CSm_WWJv1twkurvE21&usqp=CAE" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQnhpBqiKzRi_yASoZ_Jmouqq2KcBxLWopJbBqmngFa0JA_DCchOGjhMUSnnXqKLuI54QiWerAbOO4KPMxorQKm1J8ASFd8J0I8E9CSm_WWJv1twkurvE21&usqp=CAE" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQnhpBqiKzRi_yASoZ_Jmouqq2KcBxLWopJbBqmngFa0JA_DCchOGjhMUSnnXqKLuI54QiWerAbOO4KPMxorQKm1J8ASFd8J0I8E9CSm_WWJv1twkurvE21&usqp=CAE" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQnhpBqiKzRi_yASoZ_Jmouqq2KcBxLWopJbBqmngFa0JA_DCchOGjhMUSnnXqKLuI54QiWerAbOO4KPMxorQKm1J8ASFd8J0I8E9CSm_WWJv1twkurvE21&usqp=CAE" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQnhpBqiKzRi_yASoZ_Jmouqq2KcBxLWopJbBqmngFa0JA_DCchOGjhMUSnnXqKLuI54QiWerAbOO4KPMxorQKm1J8ASFd8J0I8E9CSm_WWJv1twkurvE21&usqp=CAE" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQnhpBqiKzRi_yASoZ_Jmouqq2KcBxLWopJbBqmngFa0JA_DCchOGjhMUSnnXqKLuI54QiWerAbOO4KPMxorQKm1J8ASFd8J0I8E9CSm_WWJv1twkurvE21&usqp=CAE" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQnhpBqiKzRi_yASoZ_Jmouqq2KcBxLWopJbBqmngFa0JA_DCchOGjhMUSnnXqKLuI54QiWerAbOO4KPMxorQKm1J8ASFd8J0I8E9CSm_WWJv1twkurvE21&usqp=CAE" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>


        



    </div>



    <script>

        let isMouseDown = false;
        let startX;
        let scrollLeft;

        const cardContainer = document.getElementById('cardContainer');

        cardContainer.addEventListener('mousedown', (e) => {
            isMouseDown = true;
            startX = e.pageX - cardContainer.offsetLeft;
            scrollLeft = cardContainer.scrollLeft;
        });

        cardContainer.addEventListener('mouseleave', () => {
            isMouseDown = false;
        });

        cardContainer.addEventListener('mouseup', () => {
            isMouseDown = false;
        });

        cardContainer.addEventListener('mousemove', (e) => {
            if (!isMouseDown) return;
            e.preventDefault();
            const x = e.pageX - cardContainer.offsetLeft;
            const walk = (x - startX) * 1; // Ajuste conforme necessário para a sensibilidade de rolagem
            cardContainer.scrollLeft = scrollLeft - walk;
        });

    </script>


@endsection