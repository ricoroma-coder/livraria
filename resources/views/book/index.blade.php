@extends('layout.dash_main')

@section('title', 'Livros')
@section('content')

<div id="screen" class="close ml-auto">

    @component('components.modals')
    @endcomponent

    <div class="row m-0 w-100">
        @component('components.search', ['data' => 'books'])
        @endcomponent
    </div>

    <div id="dash-body">
        <div class="row m-0 w-100">
            @component('components.filters', ['content' => ['book' => $content]])
            @endcomponent
        </div>

        <div class="row m-0 w-100">
            @component('components.list', ['content' => $content['books'], 'modify' => true, 'route' => 'dashBooks', 'hidden' => ['year','created_at','id_pub','id_writer']])
            @endcomponent
        </div>
    </div>

</div>
    
@endsection