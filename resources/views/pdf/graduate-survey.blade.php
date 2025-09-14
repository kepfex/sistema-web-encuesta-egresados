<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Encuesta de Egresado</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1, h2, h3 { color: #2c3e50; }
        .section { margin-bottom: 20px; }
        .section h3 { border-bottom: 1px solid #ccc; padding-bottom: 4px; }
        .field { margin: 4px 0; }
        .label { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Encuesta de Egresado</h1>
    <p><strong>Nombre:</strong> {{ $graduate->nombre_completo }}</p>
    <p><strong>DNI:</strong> {{ $graduate->dni }}</p>
    <p><strong>Correo:</strong> {{ $graduate->correo_electronico }}</p>
    <p><strong>Fecha completado:</strong> {{ $survey->fecha_completado?->format('d/m/Y H:i') }}</p>

    <div class="section">
        <h3>Sección 1: Datos personales</h3>
        <p class="field"><span class="label">Edad:</span> {{ $survey->edad }} años</p>
        <p class="field"><span class="label">Sexo:</span> {{ $survey->sexo }}</p>
        <p class="field"><span class="label">Nacimiento:</span> {{ $survey->distritoNacimiento?->distrito }}</p>
    </div>

    {{-- Puedes continuar replicando todas las secciones --}}
</body>
</html>
