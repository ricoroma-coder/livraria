
<div class="form-group w-100 m-0">
    
    <h5>Nome</h5>
    <input type="text" name="name" class="form-control" placeholder="Nome">

    <h5>Ano</h5>
    <input type="number" name="year" class="form-control" placeholder="Ano de publicação">
    
    <div class="row m-0">

        <div class="col-md-6 p-0">
            <h5>Escritor</h5>
            <select name="id_writer" class="form-control">
                <option value="">Selecione...</option>
                @foreach ($content['writers'] as $w)
                    <option value="{{ $w->id }}">{{ $w->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 p-0">
            <h5>Editora</h5>
            <select name="id_pub" class="form-control">
                <option value="">Selecione...</option>
                @foreach ($content['pubs'] as $p)
                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                @endforeach
            </select>
        </div>

    </div>

    <h5>Cadastrado em:</h5>
    <input type="date" name="created_at" class="form-control">

</div>