<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Recordatorio de Vacunación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007bff;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #666;
        }

        .highlight {
            color: #e67e22;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="email-container">
        <h2>Recordatorio de Vacunación</h2>

        <p>Hola <span class="highlight">{{ $vacunacion->mascota->dueno->nombre }}</span>,</p>

        <p>Este es un recordatorio amable de que tu mascota <strong>{{ $vacunacion->mascota->nombre }}</strong> debe recibir su
            próxima vacuna:</p>

        <p><strong>Tipo de vacuna:</strong> {{ $vacunacion->producto->nombre }}</p>
        <p><strong>Fecha programada:</strong> {{ $vacunacion->proxima_vacunacion }}</p>

        <p>No olvides acudir a tu veterinario para mantener a tu mascota protegida y saludable.</p>

        <div class="footer">
            <p>Saludos cordiales,</p>
            <p><strong>Tu Clínica Veterinaria</strong></p>
        </div>
    </div>

</body>

</html>
