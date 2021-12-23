@extends('header')
@push('styles')
    <link href="{{ asset('css/viewRes.css') }}" rel="stylesheet">
@endpush
@section('page')
    <section class="page-sec">
        <h5>Reservaciónes</h5>
        <div>
            @foreach ($ress as $res)
                <x-reservation :res="$res"/>
            @endforeach
        </div>
    </section>

@endsection