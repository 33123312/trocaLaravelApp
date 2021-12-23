<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EL Trocadero</title>

    

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">

    @stack('styles')


</head>
<body>
    <script src="/js/materialize.min.js"></script>
    <div class="page-container">
        @yield("cont")
    </div>

    <footer class="footer">
        <div class=" footer-top page-sec">
            <div>
                <h5>Contacto</h5>
                <ul>
                    <li><b>Correo:</b> uncorreo@gmail.com</li>
                    <li><b>Teléfono:</b> 6301231213</li>
                </ul>
            </div>

        </div>
        <div class="footer-bot">
            Cd Delicias, Chihuahua
        </div>
    </footer>
    
</body>
</html>