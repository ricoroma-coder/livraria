{{--  listing $content  --}}

@php
    $thead = ['Código', 'Nome', 'Idade'];
    $content = [
        ['id'=>1,'name'=> 'Machado de Assis', 'idade' => 19],
        ['id'=>2,'name'=> 'Machado de Assis', 'idade' => 19],
        ['id'=>3,'name'=> 'Machado de Assis', 'idade' => 19]
    ];
@endphp

<div class="row m-0 w-100 h-100 p-4" id="all">

    @if ($modify)
        
        <div class="row m-0 mt-2 mb-2 w-100 h-auto">
            <a href="#" class="btn btn-primary ml-auto">Novo</a>
        </div>

    @endif

    @if (isset($content) || !empty($content))

    <table class="table table-hover">
        <thead class="text-light bg-dark">
            <tr>
            @foreach ($thead as $key)

                <th>{{ ucfirst($key) }}</th>

            @endforeach
            @if ($modify)

                <th class="actions">Ações</th>

            @endif
            </tr>
        </thead>
        <tbody>
            
            @foreach ($content as $value)
            
                <tr value="{{ $value['id'] }}">
                        
                    <td>{{ $value['id'] }}</td>
                    <td>{{ $value['name'] }}</td>
                    <td>{{ $value['idade'] }}</td>

                    @if ($modify)
                        
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">Mudar</a>
                            <a href="#" class="btn btn-danger btn-sm">Apagar</a>
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

