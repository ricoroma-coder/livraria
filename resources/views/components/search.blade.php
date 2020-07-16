<nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100">        
    {{--  search tool  --}}
    <form action="{{ route('search') }}" method="POST" class="form-inline my-2 my-lg-0 w-100 position-relative overflow-visible">
        <input class="form-control col-sm-11" type="text" placeholder="Pesquisar" aria-label="Search" id="searchTarget" href="{{ route('ajaxSearch') }}" data-require="{{ $data }}">
        <div class="row col-sm-11 p-0 m-0 h-auto w-100 position-absolute bg-light" id="searchContent" redirect="{{ route('searchRedirect') }}">

        </div>
        <button class="btn btn-primary col-sm-1" type="submit">Ir</button>
    </form>
</nav>