@extends('header')

@push('styles')
    <link href="{{ asset('css/notifications.css') }}" rel="stylesheet">
@endpush

@section('page')

    <section class="page-sec">
        <div class="not-area">
            <h4>Bandeja de notificaciones</h4>
            @foreach ($nots as $not)
                @if ($not->read_at == null)
                    <div class=" unreaded-not ">
                        <h6><b>El Trocadero</b></h6>
                        <p >{{$not->data["message"]}}</p>
                        <div>{{$not->data["date"]}}</div>
                    </div>
                @else
                    <div>
                        <h6><b>El Trocadero</b></h6>
                        <p >{{$not->data["message"]}}</p>
                        <div>{{$not->data["date"]}}</div>
                    </div>
                @endif
            @endforeach
        </div>
    
    </section>
    
@endsection