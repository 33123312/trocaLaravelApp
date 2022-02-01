
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <div style="font-size:larger;">
            <div style="padding: 1rem;padding-top:4rem; background-color: #f7f6f5;min-height: 400px">
                <h3 style="margin-top: 0.5rem;margin-bottom: 0.5rem;text-align: center;">Hola, {{$name}}</h3>
                <div style="margin-top: 0.5rem;margin-bottom: 0.5rem;text-align: center;color:#331f0b;">
                    @yield('message')
                </div>
                
            </div>
    
            <footer style="  
                background-color: #2e2a26;
                padding-top: 1rem;
                padding-bottom: 1rem;
                display: flex;
                justify-content: center;
            ">
                <div style="margin-left:1rem;color:white;">El</div> <div style="color: #e8a715;">Trocadero</div>
            </footer>
        </div>

    </body>
    </html>