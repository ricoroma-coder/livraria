{{--  implement hall  --}}
{{--  background  --}}
<div class="row w-100 h-auto m-0">
    <div class="bg-hall w-100"></div>
</div>

{{--  row card-deck  --}}
<div class="row m-0 w-100 h-auto" id="hall">

    {{ $slot }}

    <div class="card-deck h-auto w-100 mr-auto ml-auto">

        @php
            $count = 0;
        @endphp

        @if (isset($content) && !empty($content))
            
            {{--  adding cards with $content  --}}
            @foreach ($content as $value)

                @php
                    $count++;
                @endphp

                <div class="card bg-dark text-light h-auto p-1 ml-auto mr-auto" style="max-width: 30.7%;min-height: 350px;">
                    <div class="heroes hero-{{ $count }}"></div>
                    <img src="{{ $value->image }}" class="card-img-top h-50" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $value->name }}</h5>
                        @if (isset($book))
                            <p class="card-text">Taxa média de acessos: {{ $value->count }}%</p>
                        @else
                            <p class="card-text">Possui {{ $value->count }} {{ ($value->count > 1) ? 'obras' : 'obra' }} em nossa loja</p>
                        @endif
                        <a href="#" class="btn btn-primary">Conheça</a>
                        <p class="card-text update-field text-light"></p>
                    </div>
                </div>

                @if ($count == 1)

                    <div class="w-100 mt-1 mb-1"></div>

                @endif

            @endforeach

        @else
            
            <div class="card bg-dark text-light h-auto p-1 ml-auto mr-auto w-50" style="max-width: 30.7%;min-height: 400px;">
                <img src="{{ asset('storage/img/no-data.png') }}" class="card-img-top h-50" alt="...">
                <div class="card-body h-50">
                    <h5 class="card-title">Não há dados para mostrar!</h5>
                    <p class="card-text">Para criar um Hall, precisamos de dados como acesso à páginas e classificação de livros.</p>
                    <a href="{{ route('books') }}" class="btn btn-primary">Ver Livros</a>
                </div>
            </div>

        @endif

        
    </div> 

</div>