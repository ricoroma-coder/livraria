@extends('layout.dash_main')

@section('title', (isset($content['book'])) ? 'Mudar livro' : 'Novo livro')
@section('content')

<div id="screen" class="close ml-auto">

    <div class="row m-0 w-100">
        @component('components.search', ['data' => 'books'])
        @endcomponent
    </div>

    <div id="dash-body">
        @if (isset($content['book']))
            <p class="title mt-4">Dashboard de edição do livro {{ $content['book']->name }}!</p>
        @else
            <p class="title mt-4">Cadastre um novo livro!</p>
        @endif

        @php
            $action = route('dashBooks.store');
            $message = 'Cadastrado com sucesso';
            if (isset($content['book'])) {
                $action = route('dashBooks.update', $content['book']->id);
                $message = 'Alterado com sucesso';
            }
        @endphp
        @component('components.message', ['message' => $message])
        @endcomponent

        <div class="row m-0 w-100">
            <form action="{{ $action }}" class="h-100 w-100 ajax-form p-3 border-top border-bottom pt-4" enctype="multipart/form-data" method="POST">
                @csrf
                @if (isset($content['book']))
                    <input type="hidden" name="id" id="id">
                    @method('put')
                @endif

                <div class="row form-group m-0">
                    <div class="col-sm-4 mh-100" style="min-height: 250px;max-height: 250px;">
                        @if (isset($content['book']))
                            @component('components.image', ['content' => $content['book']->image, 'config' => true])
                            @endcomponent
                        @else
                            @component('components.image', ['config' => true])
                            @endcomponent
                        @endif
                        
                    </div>

                    <div class="col-sm-8 h-100">
                        <label for="name">Nome</label>
                        <input class="form-control mb-1" type="text" name="name" id="name" placeholder="Nome">

                        <div class="row m-0">
                            <div class="col-md-6 p-0">
                                <label for="isbn">ISBN</label>
                                <input class="form-control mb-1" type="text" name="isbn" id="isbn" placeholder="ISBN">
                            </div>

                            <div class="col-md-6 p-0">
                                <label for="year">Ano da publicação</label>
                                <input class="form-control mb-1" type="number" name="year" id="year" placeholder="Ano" min="1000">
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-md-6 p-0">
                                <label for="id_writer">Escritor</label>
                                <select class="form-control mb-1" name="id_writer" id="id_writer">
                                    <option value="0">Selecione...</option>

                                    @foreach ($content['writers'] as $w)
                                        <option value="{{ $w->id }}">{{ $w->name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-6 p-0">
                                <label for="id_pub">Editora</label>
                                <select class="form-control mb-1" name="id_pub" id="id_pub">
                                    <option value="0">Selecione...</option>

                                    @foreach ($content['pubs'] as $p)
                                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
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
    var obj = JSON.parse('<?php if(isset($content["book"])) echo json_encode($content["book"]); else echo "{}";?>');

    $(document).ready(function(){
        if(!$.isEmptyObject(obj)){
            $('#id').val(obj['id']);
            updateFields();
        }
    });
</script>
@endsection