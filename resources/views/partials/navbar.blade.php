<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        
        <img src={{ asset('img/UCALogo.png') }} height="50" />

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        @if( Auth::check() )
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <!--
                <li class="nav-item {{ Request::is('subjects') && ! Request::is('subjects/create')? 'active' : ''}}">
                    <a class="nav-link" href="{{url('/subjects')}}">
                        <span class="glyphicon glyphicon-film" aria-hidden="true"></span>
                        Asignaturas
                    </a>
                </li>
                <li class="nav-item {{  Request::is('subjects/create') ? 'active' : ''}}">
                    <a class="nav-link" href="{{url('/subjects/create')}}">
                        <span>&#10010</span> Añadir asignatura
                    </a>
                </li>
                -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Asignaturas
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{url('/subjects')}}">Lista de Asignaturas</a>
                        <a class="dropdown-item" href="{{url('/subjects/create')}}"><span>&#10010</span>Añadir Asignatura</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Profesores
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{url('/teachers')}}">Lista de Profesores</a>
                        <a class="dropdown-item" href="{{url('/teachers/create')}}"><span>&#10010</span>Añadir Profesor</a>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav navbar-right">
                <li class="nav-item">
                    <form action="{{ url('/logout') }}" method="POST" style="display:inline">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-link nav-link" style="display:inline;cursor:pointer">
                            Cerrar sesión
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        @endif
    </div>
</nav>
