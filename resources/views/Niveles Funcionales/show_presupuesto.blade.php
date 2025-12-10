<!-- resources/views/show_presupuesto.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del Presupuesto</title>
    <!-- Puedes agregar estilos CSS aquí -->
</head>
<body>
    <h1>Presupuesto #{{ $presupuesto->id }}</h1>
    
    <p><strong>Cliente:</strong> {{ $presupuesto->cliente }}</p>
    <p><strong>Fecha:</strong> {{ $presupuesto->fecha }}</p>
    <p><strong>Total:</strong> ${{ number_format($presupuesto->total, 2) }}</p>
    
    <!-- Si tienes más detalles, agrégales aquí -->
    
    <a href="{{ route('presupuestos.index') }}">Volver a la lista de presupuestos</a>
</body>
</html>
