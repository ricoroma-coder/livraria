@extends('layout.dash_main')

@section('title', 'Busca')
@section('content')

<div id="screen" class="close ml-auto">

    @component('components.modals')
    @endcomponent

    <div class="row m-0 w-100">
        @component('components.search', ['data' => 'books writers pub_companies'])
        @endcomponent
    </div>

    <div id="dash-body">
        <div class="row m-0 w-100">
            
        </div>

        <div class="row m-0 w-100">
            {{--  listing $content  --}}
            <div class="row m-0 w-100 h-auto p-4 text-center" id="all">

                <p class="title">Resultado da busca</p>

                @component('components.message')
                @endcomponent

                @if (isset($content) || !empty($content))

                    <table class="table table-hover">

                        <thead class="thead-dark">

                            <tr>
                                <th>Imagem</th>
                                <th>Nome</th>
                                <th>Acessos</th>
                                <th>Classificação</th>
                                <th>Classe</th>
                                <th>Ações</th>
                            </tr>

                        </thead>

                        <tbody>
                            
                            @foreach ($content as $value)
                            
                                <tr value="{{ $value->id }}">
                                        
                                    <td class="w-25"><img style="height: 200px;max-height: 200px;" class="h-100 w-100" src="{{ (!empty($value->image)) ? $value->image : asset('storage/img/'.$value->imgDefault.'/thumb-default.jpg') }}" alt="{{ $value->name }}"></td>
                                    <td class="w-25 pt-5"><h4>{{ $value->name }}</h4></td>
                                    <td class="w-25 pt-5">{{ $value->clicks }} cliques</td>
                                    <td class="w-25 pt-5">{{ ($value->rate/4)*100 }}%</td>
                                    <td class="w-25 pt-5">{{ $value->class }}</td>

                                    @if ($modify)
                                        <td class="w-25 pt-4 m-0">
                                            <div class="row m-0 p-0 w-100 h-auto">
                                                <a href="{{ route($value->route.'.edit', $value->id) }}" class="btn btn-primary btn-sm col-sm-12">Mudar</a>

                                                <a href="{{ route($value->route.'.show', $value->id) }}" class="btn btn-secondary btn-sm col-sm-12">Acessar</a>

                                                <a data="{{$value->id}}" href="{{ route($value->route.'.destroy', $value->id) }}" class="btn btn-danger btn-sm ajax-delete col-sm-12">Apagar</a>
                                            </div>
                                        </td>

                                    @else

                                        <td class="w-25 pt-5">
                                            <a href="{{ route($value->route.'.show', $value->id) }}" class="btn btn-secondary btn-sm col-sm-12">Acessar</a>
                                        </td>

                                    @endif
                                </tr>

                            @endforeach

                        </tbody>
                    </table>

                    <nav aria-label="Page navigation exemple" class="ml-auto mr-auto h-auto">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>

            @endif

            </div>


        </div>
    </div>

</div>
    
@endsection