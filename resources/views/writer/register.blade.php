@extends('layout.dash_main')

@section('title', (isset($content)) ? 'Mudar escritor' : 'Novo escritor')
@section('content')

<div id="screen" class="close ml-auto">

    <div class="row m-0 w-100">
        @component('components.search', ['data' => 'writers'])
        @endcomponent
    </div>

    <div id="dash-body">
        @if (isset($content))
            <p class="title mt-4">Dashboard de edição do escritor {{ $content->name }}!</p>
        @else
            <p class="title mt-4">Cadastre um novo escritor!</p>
        @endif
        @php
            $action = route('dashWriters.store');
            $message = 'Cadastrado com sucesso';
            if (isset($content)) {
                $action = route('dashWriters.update', $content->id);
                $message = 'Alterado com sucesso';
            }
        @endphp
        @component('components.message', ['message' => $message])
        @endcomponent

        <div class="row m-0 w-100">
            
            <form action="{{ $action }}" class="h-100 w-100 ajax-form p-3 border-top border-bottom pt-4" enctype="multipart/form-data" method="POST">
                @csrf
                @if (isset($content))
                    <input type="hidden" name="id" id="id">
                    @method('put')
                @endif

                <div class="row form-group m-0">
                    <div class="col-sm-4 mh-100" style="min-height: 250px;max-height: 250px;">
                        @if (isset($content))
                            @component('components.image', ['content' => $content->image, 'config' => true])
                            @endcomponent
                        @else
                            @component('components.image', ['config' => true])
                            @endcomponent
                        @endif
                    </div>

                    <div class="col-sm-8 h-100">
                        <label for="name">Nome</label>
                        <input class="form-control mb-1" type="text" name="name" id="name" placeholder="Nome">

                        <label for="birth">Data de nascimento</label>
                        <input class="form-control mb-1" type="date" name="birth" id="birth">

                        <label for="death">Data de óbito</label>
                        <input class="form-control mb-1" type="date" name="death" id="death">
                        <input class="form-check-input ml-auto disable-checkbox" type="checkbox" target="#death">
                        <label class="form-check-label pl-4">Autor ainda vivo</label>
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
        @if ($errors->any())
            <div class="row w-100 m-0 p-0 card-footer">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger col-md-12" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

@endsection
@section('script')
<script>
    var obj = JSON.parse('<?php if(isset($content)) echo json_encode($content); else echo "{}";?>');

    $(document).ready(function(){
        if(!$.isEmptyObject(obj)){
            $('#id').val(obj['id']);
            updateFields();
        }
    });
</script>
@endsection