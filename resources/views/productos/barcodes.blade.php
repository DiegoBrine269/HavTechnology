<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Barcodes</title>
        <style>

            html {
                width:100%;
                margin: 50px 40px;
            }

            img {
                width: 90px;
                margin-right: 20px; 
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <main>
            @foreach ($srcs as $src)
                <img src="{{ $src }}" alt="">
            @endforeach
        </main>
    </body>
</html>