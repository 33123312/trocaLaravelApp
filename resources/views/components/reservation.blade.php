<div class="res-cont">
    <div>
        {{$res->resDate}}
    </div>
    <div>
        <form action="{{route('reservation.del',$res)}}" method="post">
            @csrf
            @method("delete")
            <button class="btn btn-cancelar-res" type="submit">Cancelar Reservación</button>
        </form>
    </div>
</div>