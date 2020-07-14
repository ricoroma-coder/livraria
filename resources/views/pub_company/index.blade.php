@extends('layout.dash_main')

@section('title', 'Editoras')
@section('content')

<div id="screen" class="close ml-auto">

    <div class="row m-0 w-100">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100">        
                {{--  search tool  --}}
                <form class="form-inline my-2 my-lg-0 w-100">
                    <input class="form-control col-sm-11" type="search" placeholder="Pesquisar" aria-label="Search">
                    <button class="btn btn-primary col-sm-1" type="submit">Ir</button>
                </form>
        </nav>
    </div>

</div>
    
@endsection