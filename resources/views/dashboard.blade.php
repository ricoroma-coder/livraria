@extends('layout.dash_main')

@section('title', 'Index')
@section('content')

<div id="screen" class="close ml-auto">

    <div class="row m-0 w-100">
        @component('components.search')
        @endcomponent
    </div>

</div>

@endsection