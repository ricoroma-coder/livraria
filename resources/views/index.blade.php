@extends('layout.main')

@section('title', 'Estante Virtual - Index')
@section('content')

<div class="row w-100 text-center ml-auto mr-auto border border-dark" style="height: 50px;" id="presentRow">
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

<div class="container pt-4 pb-4">

    <div class="row h-auto mb-4">
        <div class="col-sm h-100">

            <p class="title">Destaques</p>

            @component('components.carousel')
            @endcomponent

        </div>
        <div class="col-sm h-100">
            
            <p class="title">Nossos livros</p>
            
            <div class="card border-dark position-relative" id="cardCadastroLivro">
                <img class="card-img-top w-100" src="{{ asset('img/bg-image.jpg') }}" alt="ImgCadLivro">
                <div class="card-body w-100 text-center">
                    <p class="card-text text-left">Consulte nossa grande biblioteca de livros disponíveis na loja</p>
                    <a href="#" class="btn btn-primary">Consultar</a>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="row w-100 m-0 pb-4 mt-4 position-relative" style="height: auto;">
    <p class="title text-warning">Livros mais acessados</p>
    <div class="bg-image w-100 h-100 position-absolute" style="z-index: -1;background-size:inherit;"></div>
    <div class="bg-dark w-100 h-100 position-absolute" style="z-index: 0; opacity:0.5;"></div>

    <div class="card-deck h-auto w-auto mr-auto ml-auto">
        <div class="card h-auto p-1 ml-auto mr-auto" style="max-width: 30.7%">
            <img src="{{ asset('img/livro1.jpg') }}" class="card-img-top h-50" alt="...">
            <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
        </div>
        <div class="card h-auto p-1 ml-auto mr-auto" style="max-width: 30.7%">
            <img src="{{ asset('img/livro2.jpg') }}" class="card-img-top h-50" alt="...">
            <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
        </div>
        <div class="card h-auto p-1 ml-auto mr-auto" style="max-width: 30.7%">
            <img src="{{ asset('img/livro3.jpg') }}" class="card-img-top h-50" alt="...">
            <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
        </div>
        <div class="w-100 m-1"></div>
        <div class="card h-auto p-1 ml-auto mr-auto" style="max-width: 30.7%">
            <img src="{{ asset('img/livro1.jpg') }}" class="card-img-top h-50" alt="...">
            <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
        </div>
        <div class="card h-auto p-1 ml-auto mr-auto" style="max-width: 30.7%">
            <img src="{{ asset('img/livro2.jpg') }}" class="card-img-top h-50" alt="...">
            <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
        </div>
        <div class="card h-auto p-1 ml-auto mr-auto" style="max-width: 30.7%">
            <img src="{{ asset('img/livro3.jpg') }}" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
        </div>
    </div> 
</div>

<div class="row w-100 m-0 mt-4 pb-4">

    @component('components.hall', ['content' => [['name'=> 'Machado de Assis', 'sales' => 100],['name'=> 'Eça de Queiroz', 'sales' => 200],['name'=> 'Henrique Roma', 'sales' => 300]]])
    @endcomponent

</div>

@endsection