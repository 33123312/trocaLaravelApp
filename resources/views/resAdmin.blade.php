@extends('header')

@push('styles')
    <link href="{{ asset('css/viewRes.css') }}" rel="stylesheet">
@endpush

@section('page')
<div id= "app">
    <section class="page-sec" >
        <h5>Reservaciónes</h5>
        
        <div>
                <reservation 
                    v-for="(res, index) in reservations" 
                    :reservation = "res"
                    :index ="index"
                    v-on:show-message-setter="deleteCurrenReservation"
                >
                </reservation>

        </div>

        <div id="modal1" class="modal">
            <div class="modal-content">
                <h4>Escriba un mensaje para el cliente</h4>

                <textarea v-model="cancelReason" class="msg-txt-area" rows="3" ></textarea>
                <button v-on:click = "removeReservation" class="btn btn-cancelar-res modal-close">Cancelar la reservación</button>

            </div>
        </div>
    </section>

    <section class="page-sec" >
        <h5>Reembolsos Pendientes</h5>

        <div>
                <refounded-reservation 
                    v-for="(res, index) in reservationsRefounded" 
                    :refounded-reservation = "res"
                    :index ="index"
                    v-on:refound-paid="payRefound"
                >
                </refounded-reservation>

        </div>

    </section>

</div>
    <script src="{{ asset('js/reservationRow.js') }}" rel="stylesheet"></script>
  <script src="https://unpkg.com/vue@next"></script>
  <script>

    const refRoute =  {!!json_encode(route('refound',"id"))!!}
    const delRoute =  {!!json_encode(route('resAdmin.del',"id"))!!}
    const verRoute =  {!!json_encode(route('resAdmin.ver',"id"))!!}

      let app = Vue.createApp({
        components: ["reservation"],
        data(){
            return{
                reservationToDeleteIndex:-1,
                reservationToDelete:[],
                reservations:[],
                cancelReason:"",
                reservationsRefounded:[],
                
            }
        },
        components:["reservationTemplate"],
        created(){
            this.reservations = {!! json_encode($res, JSON_HEX_TAG) !!};
            this.reservationsRefounded = {!! json_encode($ref, JSON_HEX_TAG) !!};

        },
        methods:{
            payRefound(index){
                this.reservationsRefounded.splice(index, 1)  
            },
            deleteCurrenReservation(res ,resindex){
                this.reservationToDelete = res
                this.reservationToDeleteIndex = resindex;

            },
            removeReservation(){
                let scope = this
                route = delRoute.replace('id', this.reservationToDelete.id)

                fetch(route,{
                    headers:{
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                        },
                        method:'DELETE',
                        body: JSON.stringify({reason:this.cancelReason})
                    })
                    .then(response => {
                        return response.json()
                    })
                    .then(function(result){
                        scope.reservations.splice(scope.reservationToDeleteIndex, 1)     
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                this.cancelReason = ""
            }
                
            }
        })

        app.component("reservationTemplate",reservationTemplate);

        app.component("refoundedReservation",{
            props: ["refoundedReservation","index"],
            data(){
                console.log(this.refoundedReservation)
                return{
                    propiedades:[
                        {
                            title:"Reembolso",
                            body: this.refoundedReservation.reservation_to_refound.amount
                        },
                        {
                            title:"Costo",
                            body: this.refoundedReservation.cost
                        },
                        {
                            title:"Cancelado el",
                            body: this.refoundedReservation.canceled_at
                        },
                        {
                            title:"Usuario",
                            body: this.refoundedReservation.user.nickname
                        },
                        {
                            title:"Cancelado por",
                            body: this.refoundedReservation.reservation_to_refound.canceled_by
                        },
                    ],                         
                    buttons:[{
                        text:"Reembolsar",
                        event:this.payRefound
                    }],                              
                    refRoute:refRoute.replace('id', this.refoundedReservation.reservation_to_refound.id),
                }
            },
            methods:{
                payRefound(){
                    let scope = this;
                    let route = refRoute
                    route = route.replace('id', this.refoundedReservation.reservation_to_refound.id)
                    
                    fetch(route, {
                        headers:{
                            "Accept": "application/json",
                            //'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                            },
                            method:'DELETE',
                        })
                        .then(response => {
                            return response.json()
                        })
                        .then(function(result){
                            scope.$emit("refoundPaid",scope.index);
                            
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            },
        template:
            ` 
                <reservation-template
                    :title="refoundedReservation.resDate"
                    :props="propiedades"
                    :buttons="buttons"
                >
                </reservation-template>
            `
            
        })

      app.component("reservation",{
        props: ["reservation","index"],
        data(){

            return{

            }
        },
        data(){

            let data = {
                    refoundStatus:[
                        {
                            succMsg:"Se ha verificado el pago",
                            failMsg:"Aún no se Se ha verificado el pago",
                            succ:this.reservation.payment_verified
                        }
                    ],
                    propiedades:[
                        {
                            title:"Desde",
                            body:this.reservation.init_hour 
                        },
                        {
                            title:"Hasta",
                            body:this.reservation.end_hour 
                        }
                    ],                         
                    buttons:[

                        {
                            text:"Cancelar",
                            event:this.deleteReservation,
                            customClasses:["modal-trigger"],
                            href:"#modal1"
                            
                        }
                    ]                         
                }

                if(!data.refoundStatus[0].succ)
                data.buttons.push(                        
                    {
                            text:"Verificar",
                            event:this.verifyReservation
                            
                    })

                return data;
            },
        methods:{
            deleteReservation(){
                this.$emit("show-message-setter",this.reservation,this.index)
            },
            verifyReservation(){
                let scope = this;
                let route = verRoute
                route = route.replace('id', this.reservation.id)
                
                fetch(route, {
                    headers:{
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                        },
                        method:'POST',
                    })
                    .then(response => {
                        return response.json()
                    })
                    .then(function(result){
                        scope.refoundStatus[0].succ = true;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        template:` 
                <reservation-template
                    :title="reservation.resDate"
                    :stat="refoundStatus"
                    :props="propiedades"
                    :buttons="buttons"
                >
                </reservation-template>

                `
      })

      app.mount("#app")

  </script>

  <script>
        $(document).ready(function(){
    $('.modal').modal();
  });
  </script>


@endsection


`

