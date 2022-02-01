@extends('header')

@push('styles')
    <link href="{{ asset('css/reservations.css') }}" rel="stylesheet">
@endpush

<script src="https://js.stripe.com/v3/"></script>

@section('page')
<section class="page-sec page-sec-cen ">
  <form id="form-res" class= "form-res" action="{{route("reservation")}}" method="POST">
    @csrf
    <div class="form-group">
      <label for="resDate">Fecha de la reservación</label>
      <input type="text" class="datepicker" name="resDate"  id="resDate" placeholder="Ingresar fecha de la reservación">
      <div style="margin-bottom: 1rem;">Hay algunas fechas que no son elegibles ya que están ocupadas por otros clientes.</div>
    </div>
    <div class = "hours-container">
      <input type="text" class="timepicker" name="init_hour"  id="init_hour" placeholder="Desde">

      <input type="text" class="timepicker" name="end_hour"  id="end_hour" placeholder="Hasta">
    </div>

      
      
    @error('resDate')
        <div class="error-msg"> {{$message}}</div>
    @enderror

    <button class="btn btn-color">Hacer reservación</button>

  </form>

  <h6 class="form-res">
    Una vez hecha la reservación, 
    tiene una hora para realizar el pago, de no realizarse en ese lapso de tiempo la reservación se borrará,
    una vez se haya verificado el pago, recibirá un email confirmandolo, dicho proceso
    puede tardar varios minutos.
  </h6>

</section>



<script>
    
    $(document).ready(function(){
      let res = @json($res);
      let dates = []

      res.forEach(element => {
        let trimed = element.split("-")
        dates.push(new Date(trimed[0],trimed[1]-1,trimed[2]).toDateString());
      });

      $('.timepicker').timepicker();

      $('.datepicker').datepicker({ 
          firstDay: true, 
          format: 'yyyy-mm-dd',
          disableDayFn:(date) => dates.includes(date.toDateString()),
          i18n: {
              months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
              monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
              weekdays: ["Domingo","Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
              weekdaysShort: ["Dom","Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
              weekdaysAbbrev: ["D","L", "M", "M", "J", "V", "S"]
          }
      });
    });

</script>
@endsection