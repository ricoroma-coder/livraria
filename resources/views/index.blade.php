{{--  extending main layout  --}}
@extends('layout.main')

{{--  export title  --}}
@section('title', 'Estante Virtual - Index')

{{--  export content to main layout  --}}
@section('content')

{{--  customized row presentation  --}}
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

{{--  container carousel  --}}

<div class="container pt-4 pb-4">

    {{--  grid system - 2 Columns  --}}
    <div class="row h-auto mb-4">
        {{--  col-1  --}}
        <div class="col-sm h-100">

            <p class="title">Destaques</p>

            {{--  import component carousel  --}}
            @component('components.carousel')
            @endcomponent

        </div>
        {{--  col-2  --}}
        <div class="col-sm h-100">
            
            <p class="title">Nossos livros</p>
            
            <div class="card border-dark position-relative" id="cardCadastroLivro">
                <img class="card-img-top w-100" src="{{ asset('img/bg-image.jpg') }}" alt="ImgCadLivro">
                <div class="card-body w-100 text-center">
                    <p class="card-text text-left">Consulte nossa grande biblioteca de livros disponíveis na loja</p>
                    <a href="{{ route('books') }}" class="btn btn-primary">Consultar</a>
                </div>
            </div>

        </div>
    </div>
</div>

{{--  row best books  --}}

<div class="row w-100 m-0 pb-4 mt-4 position-relative" style="height: auto;">
    <p class="title text-warning">Livros mais acessados</p>
    <div class="bg-image w-100 h-100 position-absolute" style="z-index: -1;background-size:inherit;"></div>
    <div class="bg-dark w-100 h-100 position-absolute" style="z-index: 0; opacity:0.5;"></div>

    <div class="card-deck h-auto w-auto mr-auto ml-auto">

        @php
            $count = 0;
        @endphp

        @foreach ($clicks as $value)

            @php
                $count++;
            @endphp

            <div class="card h-auto p-1 ml-auto mr-auto mt-2" style="min-height:350px;max-width: 30.7%">
                <img src="{{ asset('img/books/'.$value->id.'/thumb.jpg') }}" class="card-img-top h-50" alt="{{ $value->name }}">
                <div class="card-body h-50">
                    <div class="h-100">
                        <div class="row m-0 h-25">
                            <h5 class="card-title">{{ $value->name }}</h5>
                        </div>

                        <div class="row m-0 h-50">

                            @if (isset($value->description) && !empty($value->description))

                                <div class="m-0 overflow-hidden mh-100 position-relative">
                                    <p class="card-text">{{ $value->description }}</p>
                                    <div class="position-absolute" style="bottom:0;right:0;">
                                        <a href="#" class="btn btn-sm border border-dark bg-light">Leia mais...</a>
                                    </div>
                                </div>

                            @else

                                <div class="m-0 overflow-hidden mh-100 position-relative">
                                    <p class="card-text">Esse livro foi registrado sem nenhuma descrição</p>
                                </div>

                            @endif

                        </div>

                        <div class="row m-0 pt-auto h-25 w-100">
                            <div class="row m-0 w-100">
                                <a href="#" class="btn btn-primary btn-sm h-auto mt-auto ml-auto">Acessar</a>
                            </div>

                            <div class="row m-0 w-100">
                                <p class="card-text update-field mt-auto ml-auto"></p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            @if ($count == 3)
                
                <div class="w-100"></div>

            @endif
            
        @endforeach

    </div> 
</div>

{{--  Row hall writers  --}}

<div class="row w-100 m-0 mt-4 pb-4">

    {{--  import component hall  --}}
    @component('components.hall', ['content' => [['name'=> 'Machado de Assis', 'sales' => 100],['name'=> 'Eça de Queiroz', 'sales' => 200],['name'=> 'Henrique Roma', 'sales' => 300]], 'title' => 'Escritores'])
    @endcomponent

</div>

{{--  Row all writers  --}}

<div class="row w-100 m-0 mb-0 mt-4 h-auto position-relative">
    <div class="jumbotron w-100 h-auto mb-0 bg-transparent text-light position-relative">
        <div class="bg-std bg-writers"></div>
        <div class="bg-std bg-dark" style="opacity: 0.5; z-index: -1;"></div>
        <h1 class="display-3 text-warning font-weight-bold">Autores</h1>
        <p class="lead font-weight-bold">Confira a lista completa dos autores disponíveis em nossa loja clicando no botão.</p>
        <div class="h-auto text-center">
            <a class="btn btn-primary btn-lg mt-4 font-weight-bold" href="{{ route('writers') }}" role="button">Acesse</a>
        </div>
    </div>
</div>

{{--  Row best ranked publishing companies  --}}
    {{--  import component rank  --}}
    {{--  parameters = content e title 
    content = [
        [
            'name' => {value},
            'books' => {count(books)},
            'rate' => {rate}
        ],
        ...
    ]
    title = string title  --}}
    @component('components.rank', ['content' => [['name'=> 'Saraiva', 'books' => 200, 'rate' => 1],['name'=> 'Autografia', 'books' => 200, 'rate' => 2],['name'=> 'HarperCollins', 'books' => 200, 'rate' => 3],['name'=> 'Henrique Roma', 'books' => 200, 'rate' => 4]], 'title' => 'Editoras'])
    @endcomponent

    {{--  import component bg  --}}
    @component('components.bg')
    @endcomponent

@endsection