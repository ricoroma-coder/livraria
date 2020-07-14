{{--  implement navbar  --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark flex-row position-fixed p-3 open" id="dashNav">
    {{--  Menu links  --}}

    <div id="configNav" class="open" target="dashNav">
    </div>

        <ul class="navbar-nav mr-auto flex-column h-100 mt-5 w-100">
            <li class="nav-item {{ request()->routeIs('dash') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dash') }}">Dashboard</a>
            </li>
    
            <li class="nav-item {{ request()->routeIs('#') ? 'active' : '' }}">
                <a class="nav-link" href="#">Livros</a>
            </li>
    
            <li class="nav-item {{ request()->routeIs('#') ? 'active' : '' }}">
                <a class="nav-link" href="#">Autores</a>
            </li>
    
            <li class="nav-item {{ request()->routeIs('dashPubs.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashPubs.index') }}">Editoras</a>
            </li>

            <li class="nav-item {{ request()->routeIs('#') ? 'active' : '' }}">
                <a class="nav-link" href="#">Categorias</a>
            </li>

        </ul>

    

</nav>