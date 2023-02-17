<!DOCTYPE html>
<html>

<head>
    <title></title>
    <style type="text/css">
        body {
            background: linear-gradient(to bottom, #eeeeee, #f5f5f5);
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #444444;
            margin: 0;
            padding: 0;
        }
    
        .container {
            margin: 0 auto;
            max-width: 600px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16);
        }
    
        h1 {
            font-size: 28px;
            font-weight: bold;
            margin: 0 0 20px 0;
        }
    
        h2 {
            font-size: 20px;
            font-weight: bold;
            margin-top: 30px;
        }
    
        p {
            margin-top: 10px;
            line-height: 1.5;
        }
    
        footer {
            background-color: #f2f2f2;
            padding: 10px;
            text-align: center;
        }
    
        hr {
            border: none;
            border-top: 1px solid #ccc;
            margin: 10px 0;
        }
    
        footer p {
            font-size: 14px;
            line-height: 1.5;
            margin: 5px 0;
        }
    
        footer p:first-child {
            margin-top: 0;
        }
    
        footer p:last-child {
            margin-bottom: 0;
        }
    </style>
    
</head>

<body>
    <div class="container">
        <h1>{{ $mensaje }}</h1>
        <p>La actividad {{ $nombre_actividad }} ha sido creada con éxito en el sistema.</p>
        <h2>Descripción:</h2>
        <p>{{ $descripcion }}</p>
        <h2>Fecha de Inicio:</h2>
        <p>{{ $fecha_inicio }}</p>
        <h2>Fecha de Finalización:</h2>
        <p>{{ $fecha_finalizacion }}</p>
        <h2>Costo:</h2>
        <p>{{ $costo }}</p>
    </div>
</body>
<footer style="background-color: #f2f2f2; padding: 10px; text-align: center;">
    <hr style="border: none; border-top: 1px solid #ccc; margin: 10px 0;">
    <p style="font-size: 14px; line-height: 1.5;">Este correo electrónico fue enviado desde <strong>Sociedad
            Zanate</strong>. Si tienes alguna duda o comentario, no dudes en ponerte en contacto con nosotros.</p>
    <p style="font-size: 14px; line-height: 1.5;">Casa amador, Barrio El Centro, 1ave sur, calle el calvario</p>
</footer>
</html>
