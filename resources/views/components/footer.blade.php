{{--  implement navbar footer  --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="footer">

    {{--  grid system  --}}
    <div class="row w-100">

            {{--  col-1  --}}
        <div class="col-sm text-center">

            <p class="title text-warning">Estante Virtual</p>

            <p class="text-light">Sua biblioteca virtual de livros exclusivos de editoras campeãs de vendas e autores conceituados. Consulte nossos exemplares e adquira diretamente na loja!</p>

            <a class="btn btn-primary ml-auto mr-auto" href="#">Confira!</a>

        </div>

        {{--  col-2  --}}
        <div class="col-sm text-center">
            <div class="collapse navbar-collapse w-100" id="navbarSupportedContent">
                <ul class="navbar-nav flex-column ml-auto mr-auto">
                    <li class="nav-item {{ request()->routeIs('index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Livros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Autores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Editoras</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
  </nav>