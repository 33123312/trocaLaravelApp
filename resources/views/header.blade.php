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

    <a href="{{route("landing")}}" data-target="mobile-demo" class="sidenav-trigger">
      <i class="material-icons">menu</i>
    </a>

      <ul id="nav-mobile nav-link-list" class="right hide-on-med-and-down">
        @if (Auth::guard("admin")->check())
          <li><a class="my-2 my-lg-0" href="{{route('resAdmin')}}">Ver reservaciones</a></li>
          <li>
          <form action="{{route('resAdmin.logOut')}}" method="POST" style="display:flex;align-items:center;">
            @csrf
            <button type="submit" class="btn ses-btn-col">Cerrar Sesión</button>
          </form>
        @else
          @auth
          
          <li><a class="my-2 my-lg-0" href="{{route('notifications')}}">Notificaciones</a></li>


          <script> $('.dropdown-trigger').dropdown();</script>

            <li><a class="my-2 my-lg-0" href="{{route('reservation')}}">Reservar</a></li>
            <li><a class="my-2 my-lg-0" href="{{route('viewRes')}}">Ver reservaciones</a></li>
            <li>
                <form action="{{route('LogOut')}}" method="POST" style="margin:0!important">
                  @csrf
                  <button type="submit" class="btn ses-btn-col">Cerrar Sesión</button>
                </form>
            </li>
          @endauth
          @guest
              <li><a class="my-2 my-lg-0" href="{{route('login')}}">Iniciar sesión</a></li>
              <li><a class="btn ses-btn-col" href="{{route('registrarse')}}">Registrarse</a></li>
          @endguest
        @endif
              
      </ul>

      <ul class="sidenav" id="mobile-demo">
        @if (Auth::guard("admin")->check())
          <li><a class="my-2 my-lg-0" href="{{route('resAdmin')}}">Ver reservaciones</a></li>
          <li>
          <form action="{{route('resAdmin.logOut')}}" method="POST">
            @csrf
            <button type="submit" class="btn ses-btn-col">Cerrar Sesión</button>
          </form>
        @else
          @auth
          
          <li><a class="my-2 my-lg-0" href="{{route('notifications')}}">Notificaciones</a></li>


          <script> $('.dropdown-trigger').dropdown();</script>

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
              <li><a class="my-2 my-lg-0" href="{{route('login')}}">Iniciar sesión</a></li>
              <li><a class="btn ses-btn-col" href="{{route('registrarse')}}">Registrarse</a></li>
          @endguest
        @endif
      </ul>

    </div>
  </nav>

<script>
    $(document).ready(function(){
    $('.sidenav').sidenav();
  });
</script>
        
  @yield("page")

  

@endsection