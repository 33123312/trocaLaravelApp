@extends('header')

@push('styles')
    <link href="{{ asset('css/verify-email.css') }}" rel="stylesheet">
@endpush

@section('page')

    <section class="page-sec page-sec-cen">
        <div class="ver-mess">
            <h1>¡Demuéstranos que eres tú!</h1>
            <p>
                Se ha enviado un correo de verificación a {{auth()->user()->email}}, da clck en
                el link contenido en el dicho correo para activar tu cuenta.
                
                <div class="resend-area">
                    <p>Si perdiste el correo, haz click para enviarlo nuevamente.</p>
                    <form action={{route("verification.send")}} method="post" >
                        @csrf
                        <button class="btn btn-color">
                            Reenviar
                        </button>
                    </form>
                </div>
            </p>
        </div>

    </section>
    
@endsection