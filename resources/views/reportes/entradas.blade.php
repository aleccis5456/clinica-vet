<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Ventas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
        }

        .container {
            max-width: 1100px; /* Aumentamos el ancho para más espacio */
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 15px; /* Aumentamos el padding para más separación */
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #007BFF;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td {
            color: #333;
            vertical-align: top;
        }

        .cliente-info {
            margin-bottom: 8px; /* Separación entre líneas del cliente */
        }

        .producto {
            display: flex;
            align-items: center;
            gap: 10px; /* Separación entre elementos */
            margin-bottom: 6px; /* Espacio entre productos */
        }

        .producto p {
            margin: 0; /* Eliminamos márgenes extras */
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Reporte de Entradas</h2>
        <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($desde)->format('d/m/Y') }} a 
            {{ \Carbon\Carbon::parse($hasta)->format('d/m/Y') }}</p>
        <p><strong>Usuario:</strong> {{ Auth::user()->name }}</p>
        <table>
            <tr>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Productos</th>
                <th>Monto Gs.</th>
            </tr>
            @foreach ($ventas as $venta)
                <tr>
                    <td>{{ $venta->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="cliente-info">
                            <strong>Nombre:</strong> {{ $venta->cliente->nombre_rs }}
                        </div>
                        <div class="cliente-info">
                            <strong>RUC:</strong> {{ $venta->cliente->ruc_ci }}
                        </div>
                    </td>
                    <td>
                        @foreach ($movimientoP as $producto)
                            @if ($producto->venta_id == $venta->id)
                                <div class="producto">
                                    <strong>{{ $producto->cantidad }}</strong>
                                    <p>{{ $producto->producto->nombre ?? '' }}</p>
                                    <p>{{ $producto->consulta->nombre ?? '' }}</p>
                                </div>
                            @endif
                        @endforeach
                    </td>
                    <td>{{ number_format($venta->monto, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
