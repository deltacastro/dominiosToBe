<nav>
    <div class="nav-wrapper">
        <a href="{{ url('/') }}" class="brand-logo"><i class="material-icons">cloud</i>Dominios</a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            @if (Auth::guest())
                <li><a href="{{ route('login') }}">Logueate</a></li>
            @else
                <li>
                    <a href="{{ route('admin.catalogo.proveedor.index') }}">Proveedores</a>
                </li>
                <li>
                    <a href="{{ route('admin.catalogo.periodicidad.index') }}">Periodicidades</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Cerrar Sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @endif
        </ul>
    </div>
</nav>

<ul class="sidenav" id="mobile-demo">
    @if (Auth::guest())
        <li><a href="{{ route('login') }}">Logueate</a></li>
    @else
        <li>
            <a href="{{ route('admin.catalogo.proveedor.index') }}"><i class="material-icons">assignment_ind</i>Proveedores</a>
        </li>
        <li>
            <a href="{{ route('admin.catalogo.periodicidad.index') }}"><i class="material-icons">assignment_ind</i>Periodicidades</a>
        </li>
        <li>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                Cerrar Sesión
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    @endif
</ul>