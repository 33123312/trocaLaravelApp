let reservationTemplate = {
    props:{
        title:{
            default:""
        },
        stat:{
            default:[]
        },
        props:{
            default:[]
        },
        buttons:{
            default:[]
        }
    },
    template: 
    `
        <div class="res-cont">
            <div class="info-cont">
                <div class="date-text">
                    <b>{{title}}</b>
                </div>
                <div class="date-text" v-for= "sta in stat">
                    <div v-if="sta.succ" class="res-ver-msg-1">
                        {{sta.succMsg}}
                    </div>
                    <div v-else class="res-ver-msg-0">
                        {{sta.failMsg}}
                    </div>
                </div>
                <div v-for="prop in props" class="date-text">
                    <div><b>{{prop.title}}</b></div>
                    <div>   {{prop.body }}    </div>
                </div>
            </div>
            <div class="info-cont">
                <button 
                    v-for = "button in buttons"
                    v-on:click="button.event"
                    class=" btn-cancelar-res waves-effect waves-light btn" 
                    :class ="button.customClasses"
                    :href = "button.href"
                >
                    {{button.text}}
                </button>
            </div>
        </div>
    `
    
    
}