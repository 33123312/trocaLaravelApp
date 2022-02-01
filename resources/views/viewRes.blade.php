@extends('header')
@push('styles')
    <link href="{{ asset('css/viewRes.css') }}" rel="stylesheet">
@endpush
@section('page')
    <div id = "app">
        <crp></crp>
    </div>
    <script src="{{ asset('js/reservationRow.js') }}" rel="stylesheet"></script>
    <script src="https://unpkg.com/vue@next"></script>

    <script>
        let app = Vue.createApp({
            components:["crp"],
        })

        app.component("crp",{
            template:
        `       <section class="page-sec">
                    <div>
                        <h4><b>Reservaciónes</b></h4>
                        <h6>
                            Las reservaciones cuyos pagos no se hayan validado 
                            antes de que se cumpla una hora desde que se hicieron, 
                            quedarán descartadas.
                        </h6>
                        <div>
                            <reservation 
                                v-for="(res, index) in reservations" 
                                :reservation = "res"   
                                :index = "index"
                                v-on:remove-reservation="removeRes"
                                url = "{{ route("reservation.del", "id") }}"
                            ></reservation>
                        </div>
                    </div>
                </section>
                <section class="page-sec">
                    <h4><b>Reservaciónes</b></h4>
                    <div>
                        <refounded-reservation 
                            v-for="res in refoundedReservations" 
                            :refoundedReservation = "res"   
                            v-on:remove-reservation="removeRes"
                        ></refounded-reservation>
                    </div>
                </section>
            `
            ,
            data(){
                return{
                    reservations:[],
                    refoundedReservations:[]
                }
            },
            created(){
                this.reservations = {!! json_encode($ress, JSON_HEX_TAG) !!};
                this.refoundedReservations = {!! json_encode($ref, JSON_HEX_TAG) !!};

            },
            methods:{
                removeRes(index){
                    this.reservations.splice(index, 1)   
                    
                }
            },
            components:["reservation","refoundedReservation"]
        })

        app.component("reservationTemplate",reservationTemplate);

        app.component('reservation', {
            components:["reservationTemplate"],
            props: ["reservation","url","index"],
            data(){
                return{
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
                    buttons:[{
                        text:"Cancelar Reservación",
                        event:this.deleteRes
                    }]
                    
                }
            },

            methods:{
                deleteRes(){

                    let scope = this
                    let delRoute=this.url.replace('id', this.reservation.id)

                    console.log(this.reservation)
                    console.log(delRoute)
                    
                    fetch(delRoute, {
                        headers:{
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                            },
                            method:'DELETE',
                        })
                        .then(response => {
                            return response.json()
                        })
                        .then(function(result){
                            scope.$emit("remove-reservation",this.index)   
                        })
                        .catch(function (error) {
                            console.log(error);
                        });

                    this.cancelReason = ""
                }
            },
            template: 
            `
            <reservation-template
                    :title="reservation.resDate"
                    :stat="refoundStatus"
                    :props="propiedades"
                    :buttons="buttons"
                >
            </reservation-template>
            `
        })

        
        app.component("refoundedReservation",{
            props: ["refoundedReservation"],
            data(){
                let dat = {
                    
                    refoundStatus:[
                        {
                            succMsg:"Se ha reembolsado el pago",
                            failMsg:"Aún no se ha reembolsado el pago",
                            succ:this.refoundedReservation.refounded_at != null
                        }
                    ],
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
                    ]
                }

                if(dat.refoundStatus.succ)
                    dat.propiedades.push(
                        {
                            title:"Reembolsado el",
                            body: this.refoundedReservation.reservation_to_refound.deleted_at
                        }
                    )

                return dat
            },
            components:["reservationTemplate"],
            template:
            `
                <reservation-template
                    :title="refoundedReservation.resDate"
                    :stat="refoundStatus"
                    :props="propiedades"
                >
                </reservation-template>
            `
        })

        app.mount("#app")
    </script>
@endsection



