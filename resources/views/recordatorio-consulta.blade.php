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
    <div class="email-container" style="font-family: sans-serif; line-height: 1.6; color: #333;">
        <h2 style="color: #2d6a4f;">📅 Recordatorio de Consulta</h2>

        <p>Hola <strong>{{ $consulta->mascota->dueno->nombre }}</strong>,</p>

        <p>Te recordamos que tu mascota <strong>{{ $consulta->mascota->nombre }}</strong> tiene una consulta próxima
            agendada.</p>

        <p><strong>🩺 Tipo de consulta:</strong> {{ $consulta->tipoConsulta->nombre }}<br>
            <strong>🕓 Fecha y hora:</strong> {{ \Carbon\Carbon::parse($consulta->fecha)->format('d/m/Y') }} a las {{ $consulta->hora }}
        </p>

        <p>Por favor, asegúrate de asistir puntualmente. Mantener a tu mascota saludable es nuestra prioridad.</p>

        <p>Si tenés alguna duda o necesitás reprogramar, no dudes en contactarnos.</p>

        <div class="footer" style="margin-top: 2rem;">
            <p>Saludos cordiales,</p>
            <p><strong>🐾 Tu Clínica Veterinaria</strong></p>
        </div>
    </div>


</body>

</html>
