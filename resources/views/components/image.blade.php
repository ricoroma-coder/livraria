<div class="row m-0 w-100 h-100">
    <div id="image-holder" class="w-100 p-4" style="height:200px;">
        <div id="image" class="h-100 w-100">
            <img class="h-100 w-100 rounded-circle" src="{{ (isset($content) && !empty($content)) ? $content : asset('storage/img/profile.png') }}" alt="Não foi possível carregar a imagem">
        </div>
    </div>

    <div class="row m-0 w-100 text-center" style="height: 50px;">
        <button id="image-trigger" class="btn btn-secondary ml-auto mr-auto">Importar imagem</button>
    </div>
    <input type="file" class="d-none" name="image" id="image-selector">
</div>