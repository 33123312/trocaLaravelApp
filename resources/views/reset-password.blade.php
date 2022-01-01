@extends("header")
@section("page")
  <section class="page-sec page-sec-cen">
    <form id="form" class="form-res" action="{{route('password.update')}}" method="POST">
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
        <label for="password">Nueva Contraseña</label>
        <input type="password" class="form-control" name="password" id="password"
        placeholder="Contraseña">
        @error('password')
        <div class="fs-6 text-danger"> {{$message}}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="password_confirmation">Confirmar nueva Contraseña</label>
        <input type="password" class="form-control" name="password_confirmation"
        id="password_confirmation" placeholder="Contraseña">
        @error('password_confirmation')
        <div class="fs-6 text-danger"> {{$message}}</div>
        @enderror
      </div>

      <input value="{{$token}}" type="hidden" name="token" id="token" class="payment-method">

      <button id= "sub-button" type="button" class="btn btn-color">Reestablecer</button>
    </form>
  </section>

  <script>  
    //let token = "" + {{json_encode($token)}}
    document.getElementById('sub-button').addEventListener('click', async ()=>{
        //document.getElementById('token').val(token);
        document.getElementById('form').submit();
    })
  </script>
@endsection