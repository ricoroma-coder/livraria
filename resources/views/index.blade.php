@extends('layout.main')

@section('title', 'Minha Estante - Index')
@section('content')

<div class="container">

    <div class="row">
        <div class="col-sm">
            @component('components.carousel')
            @endcomponent
        </div>
        <div class="col-sm">
            One of three columns
        </div>
    </div>
    
</div>

@endsection