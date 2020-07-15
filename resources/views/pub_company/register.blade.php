@extends('layout.dash_main')

@section('title', (isset($content)) ? 'Mudar editora' : 'Nova editora')
@section('content')

<div id="screen" class="close ml-auto">

    <div class="row m-0 w-100">
        @component('components.search')
        @endcomponent
    </div>

    <div id="dash-body">
        @if (isset($content))
            <p class="title mt-4">Dashboard de edição da editora {{ $content->name }}!</p>
        @else
            <p class="title mt-4">Cadastre uma nova editora!</p>
        @endif

        @component('components.message')
        @endcomponent

        <div class="row m-0 w-100">
            @php
                $action = route('dashPubs.store');
                if (isset($content))
                    $action = route('dashPubs.update', $content->id);
            @endphp
            <form action="{{ $action }}" class="h-100 w-100 ajax-form p-3 border-top border-bottom pt-4" enctype="multipart/form-data" method="POST">
                @csrf
                @if (isset($content))
                    <input type="hidden" name="id" value="{{$content->id}}">
                    @method('put')
                @endif

                <div class="row form-group m-0">
                    <div class="col-sm-4 mh-100" style="min-height: 250px;max-height: 250px;">
                        @if (isset($content))
                            @component('components.image', ['content' => $content->image])
                            @endcomponent
                        @else
                            @component('components.image')
                            @endcomponent
                        @endif
                    </div>

                    <div class="col-sm-8 h-100">
                        <label for="name">Nome</label>
                        <input class="form-control mb-1" type="text" name="name" id="name" placeholder="Nome" value="{{ (isset($content)) ? $content->name : '' }}">

                        <label for="slogan">Slogan</label>
                        <input class="form-control mb-1" type="text" name="slogan" id="slogan" placeholder="Slogan" value="{{ (isset($content)) ? $content->slogan : '' }}">

                        <label for="matriz">Matriz</label>
                        <input class="form-control mb-1" type="text" name="matriz" id="matriz" placeholder="Endereço" value="{{ (isset($content)) ? $content->address : '' }}">
                    </div>
                </div>

                
                <div class="row form-group m-0 mt-3 p-3">
                    <label for="description">Descrição</label>
                    <textarea rows="4" class="form-control mb-1" name="description" id="description" placeholder="Descrição">{{ (isset($content)) ? $content->description : '' }}</textarea>
                </div>

                <div class="row w-100 m-0 p-4">
                    <button type="submit" class="btn btn-success ml-auto">Enviar</button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection