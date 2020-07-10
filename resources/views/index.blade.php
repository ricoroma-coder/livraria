@extends('layout.main')

@section('title', 'Minha Estante - Index')
@section('content')

<div class="container">

    <div class="row"  style="height: 450px;">
        <div class="col-sm h-100">

            <p class="title">Destaques</p>

            @component('components.carousel')
            @endcomponent

        </div>
        <div class="col-sm h-100">
            
            <p class="title">Novos Livros</p>
            
            <div class="card border-dark position-relative" id="cardCadastroLivro">
                <img class="card-img-top w-100" src="{{ asset('img/bg-image.jpg') }}" alt="ImgCadLivro">
                <div class="card-body w-100">
                    <p class="card-text">Registre seu livro favorito em nossa base de dados e compartilhe sua leitura conosco!</p>
                    <a href="#" class="btn btn-primary">Ir</a>
                </div>
            </div>

        </div>
    </div>
    
</div>

@endsection