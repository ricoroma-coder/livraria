@extends('layout.dash_main')

@section('title', 'Nova editora')
@section('content')

<div id="screen" class="close ml-auto">

    <div class="row m-0 w-100">
        @component('components.search')
        @endcomponent
    </div>

    <div id="dash-body">
        <p class="title mt-4">Cadastre uma nova editora!</p>

        @component('components.message')            
        @endcomponent

        <div class="row m-0 w-100">
            <form action="{{ route('dashPubs.store') }}" class="h-100 w-100 ajax-form p-3 border-top border-bottom pt-4" enctype="multipart/form-data">

                <div class="row form-group m-0">
                    <div class="col-sm-4 mh-100" style="min-height: 200px;max-height:100%;">
                        @component('components.image')
                        @endcomponent
                    </div>

                    <div class="col-sm-8 h-100">
                        <label for="name">Nome</label>
                        <input class="form-control mb-1" type="text" name="name" id="name" placeholder="Nome">

                        <label for="slogan">Slogan</label>
                        <input class="form-control mb-1" type="text" name="slogan" id="slogan" placeholder="Slogan">

                        <label for="matriz">Matriz</label>
                        <input class="form-control mb-1" type="text" name="matriz" id="matriz" placeholder="Endereço">
                    </div>
                </div>

                
                <div class="row form-group m-0 mt-3 p-3">
                    <label for="description">Descrição</label>
                    <textarea rows="4" class="form-control mb-1" name="description" id="description" placeholder="Descrição"></textarea>
                </div>

                <div class="row w-100 m-0 p-4">
                    <button type="submit" class="btn btn-success ml-auto">Enviar</button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection