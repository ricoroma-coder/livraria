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
    @component('components.hall', ['content' => $content['hall']])
        <p class="title">Hall das Editoras</p>
    @endcomponent

</div>

{{--  Row best ranked publishing companies  --}}
    {{--  import component rank  --}}
    {{--  parameters = content --}}
<div class="row m-0 p-0 w-100 h-auto navHidden">

    @component('components.rank', ['content' => $content['rank']])
        <p class="title">Ranking das Editoras</p>
    @endcomponent

</div>

<div class="row m-0 p-0 w-100 h-auto inData mt-4 mb-4">

    @component('components.list', ['content' => $content['all'], 'modify' => false])
        <p class="title">Todas as editoras</p>
    @endcomponent

</div>


@endsection