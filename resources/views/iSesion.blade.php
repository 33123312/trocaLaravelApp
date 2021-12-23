@extends("header")
@section('page')
<section class="page-sec page-sec-cen">
  <form class="form-res" action="{{route('iSesion')}}" method="POST">
    @csrf
    <div class="form-group">
      <label for="email">Correo electrónico</label>
      <input type="email" class="form-control" name="email" id="email"  value="{{old('email')}}"
      aria-describedby="emailHelp" placeholder="Correo electrónico">
      @error('email')
      <div class="fs-6 text-danger"> {{$message}}</div>
      @enderror
    </div>

    <div class="form-group">
      <label for="password">Contraseña</label>
      <input type="password" class="form-control" name="password" id="password"
      placeholder="Contraseña">
      @error('password')
      <div class="fs-6 text-danger"> {{$message}}</div>
      @enderror
    </div>

  @if (session("status"))
      <div class="text-danger">{{session("status")}}</div>      
  @endif

  <button type="submit" class="btn btn-color">Iniciar Sesión</button>
</form>

</section>

@endsection