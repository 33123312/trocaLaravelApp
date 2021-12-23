@extends("html")

@push('styles')
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
@endpush

@section("cont")

<nav>
    <div class="nav-wrapper head-cont" >
      <a href="{{route("landing")}}" class="brand-logo">
        <div class="tit-cont">
          <div class="tit-1">El</div>
          <div class="tit-2">Trocadero</div>
        </div>
      </a>
      <ul id="nav-mobile nav-link-list" class="right hide-on-med-and-down">
        @auth
            <li><a class="my-2 my-lg-0" href="{{route('reservation')}}">Reservar</a></li>
            <li><a class="my-2 my-lg-0" href="{{route('viewRes')}}">Ver reservaciones</a></li>
            <li>
                <form action="{{route('LogOut')}}" method="POST">
                @csrf
                <button type="submit" class="btn ses-btn-col">Cerrar Sesión</button>
            </form>
            </li>
        @endauth
        @guest
            <li><a class="btn ses-btn-col" href="{{route('iSesion')}}">Iniciar sesión</a></li>
            <li><a class="my-2 my-lg-0" href="{{route('registrarse')}}">Registrarse</a></li>
        @endguest
      </ul>
    </div>
  </nav>
        
  @yield("page")

  

@endsection