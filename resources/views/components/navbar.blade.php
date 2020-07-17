{{--  implement navbar  --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    {{--  book store title  --}}
    <a class="navbar-brand text-warning" href="{{ route('index') }}">Estante Virtual</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    {{--  Menu links  --}}
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ request()->routeIs('index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('index') }}">Página Inicial</a>
            </li>

            <li class="nav-item {{ request()->routeIs('books') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('books') }}">Livros</a>
            </li>

            <li class="nav-item {{ request()->routeIs('writers') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('writers') }}">Autores</a>
            </li>

            <li class="nav-item {{ request()->routeIs('pub') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pub') }}">Editoras</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('dash') }}">Dashboard</a>
            </li>
        </ul>

        {{--  search tool  --}}
        <form action="{{ route('search', 'books writers pub_companies') }}" class="form-inline my-2 my-lg-0 row">
            @csrf
            <input type="hidden" name="modify" value="0">

            <div class="col-md-12 m-0 p-0 row">
                <div class="col-md-9 m-0 p-0">
                    <input class="form-control mr-sm-2 w-100 m-0" type="search" placeholder="Pesquisar" aria-label="Search" id="searchTarget" href="{{ route('ajaxSearch') }}" data-require="books writers pub_companies" name="search">
                </div>

                <div class="row p-0 m-0 h-auto w-100 position-absolute bg-light" id="searchContent" redirect="{{ route('searchRedirect') }}" modify="false"></div>
            
                <div class="col-md-3 m-0 p-0">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ir</button>
                </div>
            </div>
            

            
        </form>
    </div>
</nav>