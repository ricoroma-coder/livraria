@extends('layout.dash_main')

@section('title', (isset($content['book'])) ? 'Mudar livro' : 'Novo livro')
@section('content')

<div id="screen" class="close ml-auto">

    <div class="row m-0 w-100">
        @component('components.search')
        @endcomponent
    </div>

    <div id="dash-body">
        @if (isset($content['book']))
            <p class="title mt-4">Dashboard de edição do livro {{ $content['book']->name }}!</p>
        @else
            <p class="title mt-4">Cadastre um novo livro!</p>
        @endif

        @component('components.message')
        @endcomponent

        <div class="row m-0 w-100">
            <form action="#" class="h-100 w-100 ajax-form p-3 border-top border-bottom pt-4" enctype="multipart/form-data" method="POST">
                @csrf
                @if (isset($content['book']))
                    <input type="hidden" name="id" value="{{$content['book']->id}}">
                    @method('put')
                @endif

                <div class="row form-group m-0">
                    <div class="col-sm-4 mh-100" style="min-height: 250px;max-height: 250px;">
                        @if (isset($content['book']))
                            @component('components.image', ['content' => $content['book']->image])
                            @endcomponent
                        @else
                            @component('components.image')
                            @endcomponent
                        @endif
                        
                    </div>

                    <div class="col-sm-8 h-100">
                        <label for="name">Nome</label>
                        <input class="form-control mb-1" type="text" name="name" id="name" placeholder="Nome" value="{{ (isset($content['book'])) ? $content['book']->name : '' }}">

                        <div class="row m-0">
                            <div class="col-md-6 p-0">
                                <label for="isbn">ISBN</label>
                                <input class="form-control mb-1" type="text" name="isbn" id="isbn" placeholder="ISBN" value="{{ (isset($content['book'])) ? $content['book']->isbn : '' }}">
                            </div>

                            <div class="col-md-6 p-0">
                                <label for="year">Ano da publicação</label>
                                <input class="form-control mb-1" type="number" name="year" id="year" placeholder="Ano" min="1000" value="{{ (isset($content['book'])) ? $content['book']->year : '' }}">
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-md-6 p-0">
                                <label for="id_writer">Escritor</label>
                                <select class="form-control mb-1" name="id_writer" id="id_writer" value="{{ (isset($content['book'])) ? $content['book']->id_writer : '' }}">

                                    @if (isset($content['book']))
                                        <option value="{{ $content['book']->id_writer }}">{{ $content['writers']->find($content['book']->id_writer)->name }}</option>
                                    @else
                                        <option value="0">Selecione...</option>
                                    @endif

                                    @foreach ($content['writers'] as $w)
                                        @if (isset($content['book']))
                                            @if ($w->id != $content['book']->id_writer)
                                                <option value="{{ $w->id }}">{{ $w->name }}</option>
                                            @endif
                                        @else
                                            <option value="{{$w->id}}">{{$w->name}}</option>
                                        @endif
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-6 p-0">
                                <label for="id_pub">Editora</label>
                                <select class="form-control mb-1" name="id_pub" id="id_pub" value="{{ (isset($content['book'])) ? $content['book']->id_pub : '' }}">

                                    @if (isset($content['book']))
                                        <option value="{{ $content['book']->id_pub }}">{{ $content['pubs']->find($content['book']->id_pub)->name }}</option>
                                    @else
                                        <option value="0">Selecione...</option>
                                    @endif

                                    @foreach ($content['pubs'] as $p)
                                        @if (isset($content['book']))
                                            @if ($p->id != $content['book']->id_pub)
                                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                                            @endif
                                        @else
                                            <option value="{{$p->id}}">{{$p->name}}</option>
                                        @endif
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="row form-group m-0 mt-3 p-3">
                    <label for="description">Descrição</label>
                    <textarea rows="4" class="form-control mb-1" name="description" id="description" placeholder="Descrição">{{ (isset($content['book'])) ? $content['book']->description : '' }}</textarea>
                </div>

                <div class="row w-100 m-0 p-4">
                    <button type="submit" class="btn btn-success ml-auto">Enviar</button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection