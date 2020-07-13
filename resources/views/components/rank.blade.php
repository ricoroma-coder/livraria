
{{--  implement rank  --}}
<div class="row m-0 mt-0 pt-4 w-100 h-auto p-2" id="rank">

    {{--  open card-deck  --}}
    <div class="card-deck h-auto w-100 flex-column">
        {{ $slot }}

        @if (isset($content) && !empty($content))

            {{--  adding cards with $content  --}}
            @foreach ($content as $value)

                <div class="card mb-3 w-100 h-auto border-right border-dark bg-dark text-light p-1" style="max-height: 150px;">
                    <div class="row no-gutters h-100">
                        <div class="col-md-4 h-100">
                            <img src="{{ $value->image }}" class="card-img h-100" alt="{{ $value->name }}">
                        </div>
                        <div class="col-md-8 h-100">
                            <div class="card-body">
                                <div class="row m-0 h-auto w-100">
                                    <div class="col-sm p-1 h-100">
                                        <h4 class="card-title">{{ $value->name }}</h4>
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
                                        else if ($rate <=50)
                                            $status = ['rate'=>'Razoável','bg'=>'bg-warning'];
                                        else if ($rate <=75)
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
                                    <a href="#" class="btn btn-primary ml-auto">Saiba mais</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
            
        @else

            <div class="card mb-3 w-100 h-auto border-right border-dark bg-dark text-light p-1" style="max-height: 150px;">
                <div class="row no-gutters h-100 w-100 p-2">
                    <div class="col-md-4 h-100">
                        <img src="{{ asset('img/no-data.png') }}" class="card-img h-100" alt="...">
                    </div>
                    <div class="col-md-8 h-100">
                        <div class="row m-0 w-100 p-2">
                            <h4 class="card-title font-weight-bold">Não temos informações suficientes!</h4>
                            <h5 class="card-text">Para criarmos um Ranking, precisamos de livros com classificações dos usuários</h4>
                        </div>

                        <div class="row m-0 w-100 p-2">
                            <a href="{{ route('books') }}" class="btn btn-primary ml-auto">Veja nossa coleção!</a>
                        </div>
                        
                    </div>
                </div>
            </div>

        @endif

    </div> 

</div>