@extends('layout.dash_main')

@section('title', 'Escritores')
@section('content')

<div id="screen" class="close ml-auto position-relative">

    @component('components.modals')
    @endcomponent

    <div class="row m-0 w-100">
        @component('components.search', ['data' => 'writers'])
        @endcomponent
    </div>

    <div id="dash-body">
        <div class="row m-0 w-100">
            @component('components.filters', ['content' => ['writer' => null]])
            @endcomponent
        </div>

        <div class="row m-0 w-100">
            @component('components.list', ['content' => $content, 'modify' => true, 'route' => 'dashWriters', 'hidden' => ['count','age','created_at']])
            @endcomponent
        </div>
    </div>

</div>
    
@endsection