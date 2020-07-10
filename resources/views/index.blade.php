@extends('layout.main')

@section('title', 'Minha Estante - Index')
@section('content')

<div class="row w-100 text-center ml-auto mr-auto mb-5 border border-dark" style="height: 50px;" id="presentRow">
    <div class="col-sm p-1 h-100">
        <img class="h-100 mb-1" src="{{ asset('img/computer.png') }}" alt="...">
        <h5 class="text-dark d-inline-block p-2 font-weight-bold font-italic">Consulta rápida</h5>
    </div>
    <div class="col-sm p-1 h-100">
        <img class="h-100 mb-1" src="{{ asset('img/book-keeper.png') }}" alt="...">
        <h5 class="text-dark d-inline-block p-2 font-weight-bold font-italic">Atendimento personalizado</h5>
    </div>
    <div class="col-sm p-1 h-100">
        <img class="h-100 mb-1" src="{{ asset('img/return-cart.png') }}" alt="..." />
        <h5 class="text-dark d-inline-block p-2 font-weight-bold font-italic">Facilidade no pagamento</h5>
    </div>
</div>

<div class="container">

    <div class="row"  style="height: 450px;">
        <div class="col-sm h-100">

            <p class="title">Destaques</p>

            @component('components.carousel')
            @endcomponent

        </div>
        <div class="col-sm h-100">
            
            <p class="title">Nossos livros</p>
            
            <div class="card border-dark position-relative" id="cardCadastroLivro">
                <img class="card-img-top w-100" src="{{ asset('img/bg-image.jpg') }}" alt="ImgCadLivro">
                <div class="card-body w-100">
                    <p class="card-text">Consulte nossa grande biblioteca de livros disponíveis na loja</p>
                    <a href="#" class="btn btn-primary">Ir</a>
                </div>
            </div>

        </div>
    </div>
    
</div>

@endsection