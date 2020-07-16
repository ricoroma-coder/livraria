{{--  listing $content  --}}
<div class="row m-0 w-100 h-auto p-4 text-center" id="all">

    {{ $slot }}

    @component('components.message')
    @endcomponent

    @if ($modify)
        
        <div class="row m-0 mt-2 mb-2 w-100 h-auto">
            <a href="{{ route($route.'.create') }}" class="btn btn-primary ml-auto">Novo</a>
        </div>

    @endif

    @if (isset($content) || !empty($content))

    <table class="table table-hover">
        <tbody>
            
            @foreach ($content as $value)
            
                <tr value="{{ $value->id }}">
                        
                    <td class="w-25"><img style="height: 200px;max-height: 200px;" class="h-100 w-100" src="{{ $value->image }}" alt="{{ $value->name }}"></td>
                    <td class="w-25 pt-5"><h4>{{ $value->name }}</h4></td>
                    <td class="w-25 pt-5">{{ $value->clicks }} cliques</td>
                    <td class="w-25 pt-5">Clas: {{ ($value->rate/4)*100 }}%</td>

                    @if ($modify)
                        <td class="w-25 pt-4 m-0">
                            <div class="row m-0 p-0 w-100 h-auto">
                                <a href="{{ route($route.'.edit', $value->id) }}" class="btn btn-primary btn-sm col-sm-12">Mudar</a>
                            
                                <a data="{{$value->id}}" href="{{ route($route.'.destroy', $value->id) }}" class="btn btn-danger btn-sm ajax-delete col-sm-12">Apagar</a>
                            </div>
                        </td>

                    @else

                        <td class="w-25 pt-5">
                            <a href="{{ route($route.'.show', $value->id) }}" class="btn btn-primary btn-sm">Informações</a>
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

