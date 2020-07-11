{{--  implement hall  --}}

{{--  background  --}}
<div class="row w-100 h-auto m-0">
    <div class="bg-hall w-100"></div>
</div>

{{--  row card-deck  --}}
<div class="row m-0 w-100 h-auto">
    {{--  using $title  --}}
    <p class="title">Top {{ $title }}</p>

    <div class="card-deck h-auto w-auto mr-auto ml-auto">

        @php
            $count = 0;
        @endphp

        {{--  adding cards with $content  --}}
        @foreach ($content as $value)

            @php
                $count++;
            @endphp

            <div class="card bg-dark text-light h-auto p-1 ml-auto mr-auto" style="max-width: 30.7%">
                <div class="heroes hero-{{ $count }}"></div>
                <img src="{{ asset('img/livro1.jpg') }}" class="card-img-top h-50" alt="...">
                <div class="card-body">
                <h5 class="card-title">{{ $value['name'] }}</h5>
                <p class="card-text">O autor já vendeu {{ $value['sales'] }} exemplares em nossa loja</p>
                <a href="#" class="btn btn-primary">Conheça</a>
                <p class="card-text update-field text-light"></p>
                </div>
            </div>

            @if ($count == 1)

                <div class="w-100 mt-1 mb-1"></div>

            @endif

        @endforeach
    </div> 

</div>