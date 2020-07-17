@extends('layout.dash_main')

@section('title', 'Index')
@section('content')

<div id="screen" class="close ml-auto">

    <div class="row m-0 w-100">
        @component('components.search', ['data' => 'books writers pub_companies'])
        @endcomponent
    </div>

    <div class="row m-0 w-100 p-0 mt-4">
        @component('components.navigation-dash')
        @endcomponent
    </div>

    {{--  dash books  --}}
    <div class="row w-100 m-0 mt-4 pb-4 inData">

        <div id="books" class="row m-0 col-md-12 d-flex flex-column">

            <div class="row m-0 col-md-12">
                <p class="title">Dashboard de livros</p>
            </div>

            <div class="row m-0 col-md-12 text-center">
                <div class="col-md-4">
                    <p class="w-100">Inseridos hoje:</p>
                </div>

                <div class="col-md-4">
                    <p class="w-100">Inseridos nesse mês:</p>
                </div>

                <div class="col-md-4 w-100">
                    <p class="w-100">Total:</p>
                </div>
            </div>

            <div class="row m-0 col-md-12 text-center">
                <div class="col-md-4">
                    <p class="text-primary font-weight-bold w-100">{{$count['books'][0]}}</p>
                </div>

                <div class="col-md-4">
                    <p class="text-primary font-weight-bold w-100">{{$count['books'][1]}}</p>
                </div>

                <div class="col-md-4">
                    <p class="text-primary font-weight-bold w-100">{{$count['books'][2]}}</p>
                </div>
            </div>
            {{--  copy start  --}}
            <div class="row m-0 col-md-12 mt-3">

                <div class="col-md-12 m-0 p-0">
                    <p class="title">Mais acessados</p>
                </div>

                <div class="row col-md-12 m-0 p-0">

                    {{--  open card-deck  --}}
                    <div class="card-deck h-auto w-100 flex-column">
                        

                        {{--  adding cards with $content  --}}
                        @foreach ($content['books'] as $value)

                            <div class="card mb-3 w-100 h-auto border-right border-dark bg-dark text-light p-1" style="max-height: 200px;">
                                <div class="row no-gutters h-100">
                                    <div class="col-md-4 h-100">
                                        <img src="{{(!empty($value->image)) ? $value->image : asset('storage/img/books/thumb-default.jpg')}}" class="card-img h-100" alt="{{$value->name}}">
                                    </div>
                                    <div class="col-md-8 h-100">
                                        <div class="card-body">
                                            <div class="row m-0 h-auto w-100">
                                                <div class="col-sm p-1 h-100">
                                                    <h4 class="card-title">{{$value->name}}</h4>
                                                </div>

                                                {{--  progress bar  --}}
                                                @php
                                                    $rate = ($value->rate/4)*100;
                                                    $status = [];
                                                    if ($rate == 0) {
                                                        $rate = 100;
                                                        $status = ['rate'=>'Sem classificação','bg'=>'bg-light text-dark'];
                                                    }
                                                    else if ($rate <= 25)
                                                        $status = ['rate'=>'Ruim','bg'=>'bg-danger'];
                                                    else if ($rate <= 50)
                                                        $status = ['rate'=>'Razoável','bg'=>'bg-warning'];
                                                    else if ($rate <= 75)
                                                        $status = ['rate'=>'Bom','bg'=>'bg-success'];
                                                    else
                                                        $status = ['rate'=>'Muito bom','bg'=>'bg-primary'];
                                                @endphp

                                                <div class="col-sm p-1 h-100 ml-auto pt-3">
                                                    <h5><span class="badge badge-secondary">Classificação média</span></h5>
                                                    <div class="progress" style="height: 1px;">
                                                        <div class="progress-bar {{$status['bg']}}" role="progressbar" style="width: {{$rate}}%;" aria-valuenow="{{$rate}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div class="progress mt-1" style="height: 20px;">
                                                        <div class="progress-bar {{$status['bg']}}" role="progressbar" style="width: {{$rate}}%;" aria-valuenow="{{$rate}}" aria-valuemin="0" aria-valuemax="100">
                                                            <strong class="font-weight-bold">{{$status['rate']}}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row m-0 h-auto">
                                                <a href="{{ route('dashBooks.show', $value->id) }}" class="btn btn-primary ml-auto">Saiba mais</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div> 

                </div>

                

            </div>
            {{--  copy end  --}}

            <div class="row col-md-12 m-0 mt-4">
                <div class="col-md-10 m-0 p-0 pt-1 text-center">
                    <p>Veja todos os registros clicando no botão</p>
                </div>

                <div class="col-md-2 m-0 p-0">
                    <a class="btn btn-primary" href="{{ route('dashBooks.index') }}">Ver todos</a>
                </div>
            </div>

        </div>
    
    </div>
    {{--  end dash books  --}}

    {{--  ============  --}}

    {{--  dash writers  --}}

    <div class="row w-100 m-0 mt-4 pb-4 navHidden">

        <div id="writers" class="row m-0 col-md-12 d-flex flex-column">

            <div class="row m-0 col-md-12">
                <p class="title">Dashboard de escritores</p>
            </div>

            <div class="row m-0 col-md-12 text-center">
                <div class="col-md-4">
                    <p class="w-100">Inseridos hoje:</p>
                </div>

                <div class="col-md-4">
                    <p class="w-100">Inseridos nesse mês:</p>
                </div>

                <div class="col-md-4 w-100">
                    <p class="w-100">Total:</p>
                </div>
            </div>

            <div class="row m-0 col-md-12 text-center">
                <div class="col-md-4">
                    <p class="text-primary font-weight-bold w-100">{{$count['writers'][0]}}</p>
                </div>

                <div class="col-md-4">
                    <p class="text-primary font-weight-bold w-100">{{$count['writers'][1]}}</p>
                </div>

                <div class="col-md-4">
                    <p class="text-primary font-weight-bold w-100">{{$count['writers'][2]}}</p>
                </div>
            </div>
            {{--  copy start  --}}
            <div class="row m-0 col-md-12 mt-3">

                <div class="col-md-12 m-0 p-0">
                    <p class="title">Mais acessados</p>
                </div>

                <div class="row col-md-12 m-0 p-0">

                    {{--  open card-deck  --}}
                    <div class="card-deck h-auto w-100 flex-column">
                        

                        {{--  adding cards with $content  --}}
                        @foreach ($content['writers'] as $value)

                            <div class="card mb-3 w-100 h-auto border-right border-dark bg-dark text-light p-1" style="max-height: 200px;">
                                <div class="row no-gutters h-100">
                                    <div class="col-md-4 h-100">
                                        <img src="{{(!empty($value->image)) ? $value->image : asset('storage/img/writers/thumb-default.jpg')}}" class="card-img h-100" alt="{{$value->name}}">
                                    </div>
                                    <div class="col-md-8 h-100">
                                        <div class="card-body">
                                            <div class="row m-0 h-auto w-100">
                                                <div class="col-sm p-1 h-100">
                                                    <h4 class="card-title">{{$value->name}}</h4>
                                                </div>

                                                {{--  progress bar  --}}
                                                @php
                                                    $rate = ($value->rate/4)*100;
                                                    $status = [];
                                                    if ($rate == 0) {
                                                        $rate = 100;
                                                        $status = ['rate'=>'Sem classificação','bg'=>'bg-light text-dark'];
                                                    }
                                                    else if ($rate <= 25)
                                                        $status = ['rate'=>'Ruim','bg'=>'bg-danger'];
                                                    else if ($rate <= 50)
                                                        $status = ['rate'=>'Razoável','bg'=>'bg-warning'];
                                                    else if ($rate <= 75)
                                                        $status = ['rate'=>'Bom','bg'=>'bg-success'];
                                                    else
                                                        $status = ['rate'=>'Muito bom','bg'=>'bg-primary'];
                                                @endphp

                                                <div class="col-sm p-1 h-100 ml-auto pt-3">
                                                    <h5><span class="badge badge-secondary">Classificação média</span></h5>
                                                    <div class="progress" style="height: 1px;">
                                                        <div class="progress-bar {{$status['bg']}}" role="progressbar" style="width: {{$rate}}%;" aria-valuenow="{{$rate}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div class="progress mt-1" style="height: 20px;">
                                                        <div class="progress-bar {{$status['bg']}}" role="progressbar" style="width: {{$rate}}%;" aria-valuenow="{{$rate}}" aria-valuemin="0" aria-valuemax="100">
                                                            <strong class="font-weight-bold">{{$status['rate']}}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row m-0 h-auto">
                                                <a href="{{ route('dashWriters.show', $value->id) }}" class="btn btn-primary ml-auto">Saiba mais</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div> 

                </div>

                

            </div>
            {{--  copy end  --}}

            <div class="row col-md-12 m-0 mt-4">
                <div class="col-md-10 m-0 p-0 pt-1 text-center">
                    <p>Veja todos os registros clicando no botão</p>
                </div>

                <div class="col-md-2 m-0 p-0">
                    <a class="btn btn-primary" href="{{ route('dashWriters.index') }}">Ver todos</a>
                </div>
            </div>

        </div>
    
    </div>
    {{--  end dash writers  --}}

    {{--  ============  --}}

    {{--  dash pubs  --}}

    <div class="row w-100 m-0 mt-4 pb-4 navHidden">

        <div id="pubs" class="row m-0 col-md-12 d-flex flex-column">

            <div class="row m-0 col-md-12">
                <p class="title">Dashboard de escritores</p>
            </div>

            <div class="row m-0 col-md-12 text-center">
                <div class="col-md-4">
                    <p class="w-100">Inseridos hoje:</p>
                </div>

                <div class="col-md-4">
                    <p class="w-100">Inseridos nesse mês:</p>
                </div>

                <div class="col-md-4 w-100">
                    <p class="w-100">Total:</p>
                </div>
            </div>

            <div class="row m-0 col-md-12 text-center">
                <div class="col-md-4">
                    <p class="text-primary font-weight-bold w-100">{{$count['pubs'][0]}}</p>
                </div>

                <div class="col-md-4">
                    <p class="text-primary font-weight-bold w-100">{{$count['pubs'][1]}}</p>
                </div>

                <div class="col-md-4">
                    <p class="text-primary font-weight-bold w-100">{{$count['pubs'][2]}}</p>
                </div>
            </div>
            {{--  copy start  --}}
            <div class="row m-0 col-md-12 mt-3">

                <div class="col-md-12 m-0 p-0">
                    <p class="title">Mais acessados</p>
                </div>

                <div class="row col-md-12 m-0 p-0">

                    {{--  open card-deck  --}}
                    <div class="card-deck h-auto w-100 flex-column">
                        

                        {{--  adding cards with $content  --}}
                        @foreach ($content['pubs'] as $value)

                            <div class="card mb-3 w-100 h-auto border-right border-dark bg-dark text-light p-1" style="max-height: 200px;">
                                <div class="row no-gutters h-100">
                                    <div class="col-md-4 h-100">
                                        <img src="{{(!empty($value->image)) ? $value->image : asset('storage/img/pubs/thumb-default.jpg')}}" class="card-img h-100" alt="{{$value->name}}">
                                    </div>
                                    <div class="col-md-8 h-100">
                                        <div class="card-body">
                                            <div class="row m-0 h-auto w-100">
                                                <div class="col-sm p-1 h-100">
                                                    <h4 class="card-title">{{$value->name}}</h4>
                                                </div>

                                                {{--  progress bar  --}}
                                                @php
                                                    $rate = ($value->rate/4)*100;
                                                    $status = [];
                                                    if ($rate == 0) {
                                                        $rate = 100;
                                                        $status = ['rate'=>'Sem classificação','bg'=>'bg-light text-dark'];
                                                    }
                                                    else if ($rate <= 25)
                                                        $status = ['rate'=>'Ruim','bg'=>'bg-danger'];
                                                    else if ($rate <= 50)
                                                        $status = ['rate'=>'Razoável','bg'=>'bg-warning'];
                                                    else if ($rate <= 75)
                                                        $status = ['rate'=>'Bom','bg'=>'bg-success'];
                                                    else
                                                        $status = ['rate'=>'Muito bom','bg'=>'bg-primary'];
                                                @endphp

                                                <div class="col-sm p-1 h-100 ml-auto pt-3">
                                                    <h5><span class="badge badge-secondary">Classificação média</span></h5>
                                                    <div class="progress" style="height: 1px;">
                                                        <div class="progress-bar {{$status['bg']}}" role="progressbar" style="width: {{$rate}}%;" aria-valuenow="{{$rate}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div class="progress mt-1" style="height: 20px;">
                                                        <div class="progress-bar {{$status['bg']}}" role="progressbar" style="width: {{$rate}}%;" aria-valuenow="{{$rate}}" aria-valuemin="0" aria-valuemax="100">
                                                            <strong class="font-weight-bold">{{$status['rate']}}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row m-0 h-auto">
                                                <a href="{{ route('dashPubs.show', $value->id) }}" class="btn btn-primary ml-auto">Saiba mais</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div> 

                </div>

                

            </div>
            {{--  copy end  --}}

            <div class="row col-md-12 m-0 mt-4">
                <div class="col-md-10 m-0 p-0 pt-1 text-center">
                    <p>Veja todos os registros clicando no botão</p>
                </div>

                <div class="col-md-2 m-0 p-0">
                    <a class="btn btn-primary" href="{{ route('dashPubs.index') }}">Ver todos</a>
                </div>
            </div>

        </div>
    
    </div>
    {{--  end dash pubs  --}}

</div>

@endsection