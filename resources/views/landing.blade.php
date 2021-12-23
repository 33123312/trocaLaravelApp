@extends("header")

@push('styles')
    <link href="{{asset('css/landing.css')}}" rel="stylesheet">
@endpush

@section("page")
    <section class="crop-container">
        <div class="bann-msg-cont">
            <div class="bann-msg">
                <h3>Quítate tus zapatos y relájate</h3>
                <p>
                    Reservar es tan fácil como crear una cuenta y 
                    elegir la fecha cuando quieres quedarte con 
                    nosotros.
                </p>

                <a href="{{route('registrarse')}}" class="btn btn-color">Registrate ahora</a>

            </div>
        </div>
        <img src="{{ asset('img/bann.jpg') }}" alt="imagen-banner">

    </section>

    <section class="page-sec troc-props-area" >
        <div >
            <h4>Somos Buenos</h4>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestias, fugit nemo animi natus magnam molestiae totam voluptas nulla odit reiciendis dignissimos qui ut eveniet. Molestiae quo ratione incidunt non officiis!</p>
        </div>
        <div >
            <h4>Somos Buenos</h4>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestias, fugit nemo animi natus magnam molestiae totam voluptas nulla odit reiciendis dignissimos qui ut eveniet. Molestiae quo ratione incidunt non officiis!</p>
        </div>
        <div >
            <h4>Somos Buenos</h4>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestias, fugit nemo animi natus magnam molestiae totam voluptas nulla odit reiciendis dignissimos qui ut eveniet. Molestiae quo ratione incidunt non officiis!</p>
        </div>

    </section>

    <section class="page-sec gall-sec" >
        <h3>Galería</h3>
        <div>
            <img class="materialboxed" src={{asset('img/gall-img1.jpeg')}}>
            <img class="materialboxed" src={{asset('img/gall-img2.jpeg')}}>
            <img class="materialboxed" src={{asset('img/gall-img3.jpeg')}}>
            <img class="materialboxed" src={{asset('img/gall-img4.jpeg')}}>
            <img class="materialboxed" src={{asset('img/gall-img5.jpeg')}}>
        </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.slider');
            var instances = M.Slider.init(elems, options);
        });

        // Or with jQuery

        $(document).ready(function(){
            $('.slider').slider();
        });
      
    </script>


          

    
@endsection