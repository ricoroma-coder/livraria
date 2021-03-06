@extends($extends)

@section('title', 'Livro '.$content['obj']->name)

@section('content')

<div id="screen" class="{{ ($modify) ? 'close' : 'open' }} ml-auto">

    @if ($modify)
        <div class="row m-0 w-100">
            @component('components.search', ['data' => 'books'])
            @endcomponent
        </div>
    @endif
    

    <div id="dash-body">
        <p class="title mt-4">Perfil do livro {{ $content['obj']->name }}</p>

        <div class="row m-0 w-100 h-auto">
            <div class="jumbotron flex-column d-flex col-md-12 h-100">
                <div class="row col-md-6 align-self-center h-auto">
                    @component('components.image', ['content' => $content['obj']->image, 'config' => false])
                    @endcomponent
                </div>
                
                <div class="row col-md-12 h-auto">
                    <hr class="my-4 w-100">
                </div>

                <div class="row m-0 col-md-12 h-auto">

                    <div class="row m-0 col-md-6">

                        <div class="row col-md-12 m-0">
                            <h3 class="badge badge-primary cursor-default">Nome</h3>
                        </div>

                        <div class="row col-md-12 m-0">
                            <input class="pt-2 pl-2 pr-2 pb-1 w-100 border-bottom border-primary bg-transparent rounded input-show cursor-default text-dark" value="{{ $content['obj']->name }}" disabled>
                        </div>

                        <div class="row col-md-12 m-0 mt-1">
                            <h3 class="badge badge-primary cursor-default">ISBN</h3>
                        </div>

                        <div class="row col-md-12 m-0">
                            <input class="pt-2 pl-2 pr-2 pb-1 w-100 border-bottom border-primary bg-transparent rounded input-show cursor-default text-dark" value="{{ $content['obj']->isbn }}" disabled>
                        </div>

                        <div class="row col-md-12 m-0 mt-1">
                            <h3 class="badge badge-primary cursor-default">Ano de publicação</h3>
                        </div>

                        <div class="row col-md-12 m-0">
                            <input class="pt-2 pl-2 pr-2 pb-1 w-100 border-bottom border-primary bg-transparent rounded input-show cursor-default text-dark" value="{{ $content['obj']->year }}" disabled>
                        </div>

                    </div>

                    <div class="row m-0 col-md-6">
                        @php
                            $rate = ($content['obj']->rate/4)*100;
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
                        
                        <div class="row col-md-12 m-0">
                            <div class="row m-0 h-auto col-md-12">

                                <h5 class="col-md-12 text-left p-0 m-0 h-100">
                                    <span class="badge badge-secondary">Classificação média</span>
                                </h5>

                            </div>

                            <div class="row m-0 h-auto col-md-12">

                                <div class="col-sm m-0 p-0">

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

                        </div>

                        <div class="row col-md-12 m-0">

                            <div class="row m-0 h-auto col-md-12">

                                <h5 class="col-md-12 text-left p-0 m-0 h-100">
                                    <span class="badge badge-secondary">Classifique</span>
                                </h5>

                            </div>

                            <div class="row m-0 h-auto col-md-12">

                                <div class="col-sm m-0 p-0">

                                    <form action="{{ route('bookRating', $content['obj']->id) }}" class="rate-form" method="post">

                                        <div class="custom-control custom-checkbox">

                                            <div class="form-check form-check-inline col-sm-6 p-0 m-0">
                                                <input type="checkbox" class="custom-control-input rating" id="rating1" value="1" name="rate1">
                                                <label class="custom-control-label" for="rating1"><small>Ruim</small></h5>
                                            </div>
                                            <div class="form-check form-check-inline col-sm-6 p-0 m-0">
                                                <input type="checkbox" class="custom-control-input rating" id="rating2" value="2" name="rate2">
                                                <label class="custom-control-label" for="rating2"><small>Razoável</small></h5>
                                            </div>
                                            <div class="form-check form-check-inline col-sm-6 p-0 m-0">
                                                <input type="checkbox" class="custom-control-input rating" id="rating3" value="3" name="rate3">
                                                <label class="custom-control-label" for="rating3"><small>Bom</small></h5>
                                            </div>
                                            <div class="form-check form-check-inline col-sm-6 p-0 m-0">
                                                <input type="checkbox" class="custom-control-input rating" id="rating4" value="4" name="rate4">
                                                <label class="custom-control-label" for="rating4"><small>Muito Bom</small></h5>
                                            </div>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                        <div class="row col-md-12 m-0">
                            <p class="message" success="Obrigado!"></p>
                        </div>

                    </div>
                            
                </div>

                <div class="row m-0 col-md-12 h-auto mt-3 pl-4 pr-4">

                    <div class="row col-md-6 m-0">
                        <div class="row col-md-12 m-0 p-0">
                            <h3 class="badge badge-primary cursor-default">Escritor</h3>
                        </div>

                        <div class="row col-md-12 m-0 p-0">
                            <input class="pt-2 pl-2 pr-2 pb-1 w-100 border-bottom border-primary bg-transparent rounded input-show cursor-default text-dark" value="{{ $content['writer']->name }}" disabled>
                        </div>
                    </div>

                    <div class="row col-md-6 m-0">
                        <div class="row col-md-12 m-0 p-0">
                            <h3 class="badge badge-primary cursor-default">Editora</h3>
                        </div>

                        <div class="row col-md-12 m-0 p-0">
                            <input class="pt-2 pl-2 pr-2 pb-1 w-100 border-bottom border-primary bg-transparent rounded input-show cursor-default text-dark" value="{{ $content['pub']->name }}" disabled>
                        </div>
                    </div>

                    <div class="row col-md-12 m-0 mt-3">
                        <h3 class="badge badge-primary cursor-default">Descrição</h3>
                    </div>

                    <div class="row col-md-12 m-0">
                        <input class="pt-2 pl-2 pr-2 pb-1 w-100 border-bottom border-primary bg-transparent rounded input-show cursor-default text-dark" value="{{ (!empty($content['obj']->description)) ? $content['obj']->description : 'Não possui' }}" disabled>
                    </div>

                </div>

                    <div class="row m-0 col-md-12 mt-5">

                        

                        <div class="row m-0 col-md-12 d-flex">
                            <div class="card-deck col-md-12 m-0 p-0 row">

                                <div class="row m-0 col-md-6">
                                    <div class="row col-md-12 m-0 p-0">
                                        <p class="title">Escritor</p>
                                    </div>

                                    <div class="card m-1 border border-dark p-0 w-100" style="height:550px;">
                                        <img src="{{ (!empty($content['writer']->image)) ? $content['writer']->image : asset('storage/img/books/thumb-default.jpg') }}" class="card-img-top h-50" alt="{{ $content['writer']->name }}">
                                        <div class="card-body h-50">
                                            <div class="h-100">
                                                <div class="row m-0 h-25">
                                                    <h5 class="card-title">{{ $content['writer']->name }}</h5>
                                                </div>
                        
                                                <div class="row m-0 h-50">
                        
                                                        <div class="m-0 m-1 w-100 overflow-hidden mh-100 position-relative">
                                                            <p class="card-text p-1"><small>{{ $content['writer']->description }}</small></p>
                                                            <div class="position-absolute" style="bottom:0;right:0;">
                                                                <a href="{{ ($modify) ? route('dashWriters.show', $content['writer']->id) : route('indexWriters', $content['writer']->id) }}" class="btn btn-sm border border-dark bg-light">Leia mais...</a>
                                                            </div>
                                                        </div>
                        
                                                </div>
                        
                                                <div class="row m-0 pt-auto h-25 w-100">
    
                                                    <div class="row m-0 w-100">
                                                        <a href="{{ ($modify) ? route('dashWriters.show', $content['writer']->id) : route('indexWriters', $content['writer']->id) }}" class="btn btn-primary btn-sm h-auto mt-auto ml-auto">Acessar</a>
    
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row m-0 col-md-6">
                                    <div class="row col-md-12 m-0 p-0">
                                        <p class="title">Editora</p>
                                    </div>

                                    <div class="card m-1 border border-dark p-0 w-100" style="height:550px;">
                                        <img src="{{ (!empty($content['pub']->image)) ? $content['pub']->image : asset('storage/img/pubs/thumb-default.jpg') }}" class="card-img-top h-50" alt="{{ $content['pub']->name }}">
                                        <div class="card-body h-50">
                                            <div class="h-100">
                                                <div class="row m-0 h-25">
                                                    <h5 class="card-title">{{ $content['pub']->name }}</h5>
                                                </div>
                        
                                                <div class="row m-0 h-50">
                        
                                                        <div class="m-0 m-1 w-100 overflow-hidden mh-100 position-relative">
                                                            <p class="card-text p-1"><small>{{ $content['pub']->description }}</small></p>
                                                            <div class="position-absolute" style="bottom:0;right:0;">
                                                                <a href="{{ ($modify) ? route('dashPubs.show', $content['pub']->id) : route('indexPubs', $content['pub']->id) }}" class="btn btn-sm border border-dark bg-light">Leia mais...</a>
                                                            </div>
                                                        </div>
                        
                                                </div>
                        
                                                <div class="row m-0 pt-auto h-25 w-100">
    
                                                    <div class="row m-0 w-100">
                                                        <a href="{{ ($modify) ? route('dashPubs.show', $content['pub']->id) : route('indexPubs', $content['pub']->id) }}" class="btn btn-primary btn-sm h-auto mt-auto ml-auto">Acessar</a>
    
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                    
                                

                                
                                
                                

                            </div>
                        </div>

                    </div>

            </div>

        </div>
    </div>
</div>

@endsection