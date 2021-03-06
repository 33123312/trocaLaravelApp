@extends("header")
@section("page")
  <section class="page-sec page-sec-cen">
    <form class="form-res" action="{{route('registrarse')}}" method="POST">
        @csrf
      <div class="form-group">
        <label for="nickname">Nombre de Usuario</label>
        <input type="text" class="form-control" name="nickname"
        id="nickname" aria-describedby="emailHelp" placeholder="Nombres"
        value="{{old('nickname')}}"
        @error('nickname')
        <div class="fs-6 text-danger"> {{$message}}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="pnumber">Teléfono</label>
        <input type="tel" class="form-control" name="pnumber"  value="{{old('pnumber')}}"
        id="pnumber" aria-describedby="emailHelp" placeholder="Teléfono">
        @error('pnumber')
            <div class="fs-6 text-danger"> {{$message}}</div>
        @enderror
      </div>

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

      <div class="form-group">
        <label for="password_confirmation">Contraseña</label>
        <input type="password" class="form-control" name="password_confirmation"
        id="password_confirmation" placeholder="Contraseña">
        @error('password_confirmation')
        <div class="fs-6 text-danger"> {{$message}}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-color">Registrarse</button>
    </form>
    <a href="{{route("fac-log","facebook")}}" type="submit" class="btn btn-color">Facebook</a>
    <a href="{{route("fac-log","google")}}" type="submit" class="btn btn-color">Google</a>
  </section>
@endsection

