@extends('header')

@push('styles')
    <link href="{{ asset('css/reservations.css') }}" rel="stylesheet">
@endpush

<script src="https://js.stripe.com/v3/"></script>

@section('page')
<section class="page-sec page-sec-cen ">
  <div class="dis-dates-advisor">
    Aviso: Hay algunas fechas que no son elegibles ya que están ocupadas por otros clientes.
  </div>
  <form id="form-res" class= "form-res" action="{{route("reservation")}}" method="POST">
    @csrf
    <div class="form-group">
      <label for="resDate">Fecha de la reservación</label>
      <input type="text" class="datepicker" name="resDate"  id="resDate" placeholder="Ingresar fecha de la reservación">
    </div>
    @error('resDate')
        <div class="error-msg"> {{$message}}</div>
    @enderror

    @if ($hpm)
      <button class="btn btn-color">Hacer reservación</button>
    @else
      <input type="hidden" name="payment_method" class="payment-method">
      <label for="resDate">Nombre del dueño de la tarjeta</label>
      <input card-input id="card-holder-name" type="text">
      <div id="card-element" class="card-input"></div>
      <button type="button" id="card-button" class="btn btn-color">Hacer reservación</button>
    @endif
  </form>
</section>

<script>
    const stripe = Stripe('stripe-public-key');

    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');
</script>

<script>
  const cardHolderName = document.getElementById('card-holder-name');
  const cardButton = document.getElementById('card-button');

  cardButton.addEventListener('click', 
  async (e) => {

      const { paymentMethod, error } = await stripe.createPaymentMethod(
          'card',
           cardElement,
          {
              billing_details: {
                 name: cardHolderName.value 
              }
          }
      );

      if (error) 
        $(".card-input").after("<div class='error-msg'>" + error.message + "</div>")
      else {
        $('.payment-method').val(paymentMethod)
        document.getElementById("form-res").submit();
      }
        
      
  });
</script>

<script>
    
    $(document).ready(function(){
      let res = @json($res);
      let dates = []

      res.forEach(element => {
        let trimed = element.split("-")
        dates.push(new Date(trimed[0],trimed[1]-1,trimed[2]).toDateString());
      });

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