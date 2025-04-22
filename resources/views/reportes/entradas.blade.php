<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Ventas</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9fafb;
            text-align: center;
            padding: 20px;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        p {
            margin: 5px 0;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background: #007BFF;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: bold;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }

        tr:hover {
            background-color: #f9fafb;
        }

        .cliente-info {
            margin-bottom: 8px;
        }

        .producto {
            margin-bottom: 6px;
        }

        .producto strong {
            display: block;
            margin-bottom: 2px;
            color: #333;
        }

        .producto span {
            display: block;
            color: #666;
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
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Productos</th>
                    <th>Monto Gs.</th>
                </tr>
            </thead>
            <tbody>
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
                                        <strong>{{ $producto->cantidad }} {{ $producto->producto->nombre ?? '' }}</strong>
                                        <span>{{ $producto->tipoConsulta->nombre ?? '' }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </td>
                        <td>{{ number_format($venta->monto, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>