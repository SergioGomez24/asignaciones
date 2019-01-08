<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a href="{{ url('/') }}"><img src={{ asset('img/UCALogo.png') }} height="50" width="190" id="logo"/></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        @if( Auth::check() )
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/')}}">Inicio</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{url('/subjects')}}" >Asignaturas</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{url('/teachers')}}">Profesores</a>
                </li>
            </ul>

            <ul class="navbar-nav navbar-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">{{ auth()->user()->name }}</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{url('/settings')}}">Ajustes</a>
                        
                        <form action="{{ url('/logout') }}" method="POST" style="display:inline">
                        {{ csrf_field() }}
                            <input type="submit" class="dropdown-item" style="display:inline;cursor:pointer" value="Cerrar sesión"/>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
        @endif
    </div>
</nav>
