@extends("header")
@section("page")
  <section class="page-sec page-sec-cen">
    <form class="form-res" action="{{route('registrarse')}}" method="POST">
        @csrf
      <div class="form-group">
        <label for="firstn">Nombres</label>
        <input type="text" class="form-control" name="firstn"
        id="firstn" aria-describedby="emailHelp" placeholder="Nombres"
        value="{{old('firstn')}}"
        @error('firstn')
        <div class="fs-6 text-danger"> {{$message}}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="lastn">Apellidos</label>
        <input type="text" class="form-control" name="lastn" id="lastn" 
        aria-describedby="emailHelp" placeholder="Apellidos" value="{{old('lastn')}}">
        @error('lastn')
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
  </section>
@endsection

