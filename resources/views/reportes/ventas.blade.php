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
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 10px;
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
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reporte de Ventas</h2>
        fecha: {{ \Carbon\Carbon::parse($desde)->format('d-m-Y') }}  a {{ \Carbon\Carbon::parse($hasta)->format('d-m-Y') }}
        <br>
        Usuario: {{ Auth::user()->name }}
        <table>
            <tr>
                <th>Producto</th>
                <th>Ventas</th>
            </tr>
            @foreach ($ventas as $venta)            
                <tr>
                    <td>{{ $venta->producto->nombre }}</td>
                    <td>{{ $venta->producto->ventas }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
