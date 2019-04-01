<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/logo.png') }}"/></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        @if( Auth::check() )
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{url('/subjects')}}" style="color: black; font-weight: bold;">Asignaturas</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{url('/teachers')}}" style="color: black; font-weight: bold;">Profesores</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{url('/elections')}}" style="color: black; font-weight: bold;">Elecciones</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" style="color: black; font-weight: bold;">Solicitudes</a>
                    <div class="dropdown-menu">
                        @if (Auth()->user()->role == 'Director')
                        <a class="dropdown-item"  href="{{url('/solicitudes')}}" style="color: black; font-weight: bold;">Director</a>
                        @else
                        <a class="dropdown-item"  href="{{url('/solicitudes')}}" style="color: black; font-weight: bold;">Profesor</a>
                        <a class="dropdown-item" href="{{url('/coordinators')}}" style="color: black; font-weight: bold;">Coordinador</a>
                        @endif
                    </div>
                </li>

                @if (Auth()->user()->role == 'Director')
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/settings')}}" style="color: black; font-weight: bold;">Ajustes</a>
                </li>
                @endif

            </ul>

            <ul class="navbar-nav navbar-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" style="color: black; font-weight: bold;">{{ auth()->user()->name }}</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item"  href="{{ url('/teachers/show/'.Auth()->user()->id ) }}" style="color: black; font-weight: bold;">Mi perfil</a>
                    
                        <form action="{{ url('/logout') }}" method="POST" style="display:inline">
                        {{ csrf_field() }}
                            <input type="submit" class="dropdown-item" style="display:inline;cursor:pointer;color: black; font-weight: bold;" value="Cerrar sesión"/>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
        @endif
    </div>
</nav>
