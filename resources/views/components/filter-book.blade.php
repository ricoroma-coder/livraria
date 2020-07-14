<div class="form-group w-100 m-0">
    <h5>Nome</h5>
    <input type="text" name="name-books" class="form-control" placeholder="Nome">
    <h5>Ano</h5>
    <input type="number" name="year-books" class="form-control" placeholder="Ano de publicação">
    <h5>Escritor</h5>
    <select name="id_writer">
        <option value="0">Selecione...</option>
        @foreach ($content['writers'] as $w)
            <option value="{{ $w->id }}">{{ $w->name }}</option>
        @endforeach
    </select>
    <h5>Editora</h5>
    <select name="id_pub">
        <option value="0">Selecione...</option>
        @foreach ($content['writers'] as $w)
            <option value="{{ $w->id }}">{{ $w->name }}</option>
        @endforeach
    </select>
    <h5>Cadastrado em:</h5>
    <input type="date" name="created_at-books" class="form-control" placeholder="Criado em">
    <h5>Excluído em:</h5>
    <input type="date" name="deleted_at-books" class="form-control" placeholder="Excluído em">
</div>