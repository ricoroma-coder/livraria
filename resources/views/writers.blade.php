{{--  extending main layout  --}}
@extends('layout.main')

{{--  export title  --}}
@section('title', 'Estante Virtual - Autores')

{{--  export content to main layout  --}}
@section('content')

{{--  component navigation  --}}
@component('components.navigation')
@endcomponent

{{--  Row hall writers  --}}

<div class="row w-100 m-0 mt-4 pb-4 navHidden">

    {{--  import component hall  --}}
    @component('components.hall', ['content' => [['name'=> 'Machado de Assis', 'sales' => 100],['name'=> 'Eça de Queiroz', 'sales' => 200],['name'=> 'Henrique Roma', 'sales' => 300]], 'title' => 'Escritores'])
    @endcomponent

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
<div class="row m-0 p-0 w-100 h-auto navHidden">

    @component('components.rank', ['content' => [['name'=> 'Saraiva', 'books' => 200, 'rate' => 1],['name'=> 'Autografia', 'books' => 200, 'rate' => 2],['name'=> 'HarperCollins', 'books' => 200, 'rate' => 3],['name'=> 'Henrique Roma', 'books' => 200, 'rate' => 4]], 'title' => 'Escritores'])
    @endcomponent

</div>

<div class="row m-0 p-0 w-100 h-auto inData mt-4 mb-4">

    <p class="title">Todos escritores</p>

    @component('components.list', ['modify' => false])
    @endcomponent

</div>


@endsection