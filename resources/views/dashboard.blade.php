@extends('layout.dash_main')

@section('title', 'Index')
@section('content')

<div id="screen" class="close ml-auto">

    <div class="row m-0 w-100">
        @component('components.search', ['data' => 'books writers pub_companies'])
        @endcomponent
    </div>

    <div class="row m-0 w-100 p-0 mt-4">
        @component('components.navigation-dash')
        @endcomponent
    </div>

    {{--  dash books  --}}
    <div class="row w-100 m-0 mt-4 pb-4 inData">

        <div id="books" class="row m-0 col-md-12 d-flex flex-column">

            <div class="col-md-12">
                <p class="title">Dashboard de livros</p>
            </div>

        </div>
    
    </div>
    {{--  end dash books  --}}

</div>

@endsection