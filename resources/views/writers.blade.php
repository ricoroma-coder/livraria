{{--  extending main layout  --}}
@extends('layout.main')

{{--  export title  --}}
@section('title', 'Estante Virtual - Autores')

{{--  export content to main layout  --}}
@section('content')

{{--  Row hall writers  --}}

<div class="row w-100 m-0 mt-4 pb-4">

    {{--  import component hall  --}}
    @component('components.hall', ['content' => [['name'=> 'Machado de Assis', 'sales' => 100],['name'=> 'Eça de Queiroz', 'sales' => 200],['name'=> 'Henrique Roma', 'sales' => 300]], 'title' => 'Escritores'])
    @endcomponent

</div>

@endsection