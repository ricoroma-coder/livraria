@extends('layout.dash_main')

@section('title', 'Editoras')
@section('content')

<div id="screen" class="close ml-auto">

    <div class="row m-0 w-100">
        @component('components.search')
        @endcomponent
    </div>

    <div id="dash-body">
        <div class="row m-0 w-100">
            @component('components.filters', ['content' => ['pub']])
            @endcomponent
        </div>

        <div class="row m-0 w-100">
            @component('components.list', ['content' => $content])
        </div>
    </div>

</div>
    
@endsection