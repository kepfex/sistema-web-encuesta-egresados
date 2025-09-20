<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Encuesta de Egresado - {{ $graduate->nombre_completo }}</title>
    <style>
        /* Estilos compatibles con DOMPDF */
        @page {
            margin: 3.5cm 1.5cm 2.5cm 1.5cm; /* Aumentamos margen superior para el nuevo header */
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #333;
        }

        .header {
            position: fixed;
            top: -120px; /* Ajusta esta distancia para subir/bajar el header */
            left: 0px;
            right: 0px;
            width: 100%;
        }

        .footer {
            position: fixed;
            bottom: -80px;
            left: 0px;
            right: 0px;
            /* height: 50px; */
            text-align: right;
            font-size: 9px;
            color: #777;
        }
        
        .footer .page-number:before {
            content: "Página " counter(page);
        }
        
        /* Estilos para la tabla del encabezado */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            border: none;
        }

        .header-table td {
            vertical-align: middle;
            text-align: center;
        }

        .logo-minedu { height: 50px; }
        .logo-iestp { height: 60px; }

        .p-r-5 {
            padding-right: 5px;
        }
        .bg-dark-blue {
            background-color: #002060;
            color: white;
            font-size: 9px;
            font-weight: bold;
            padding: 2px;
            padding-bottom: 4px;
        }
        
        .bg-green {
            background-color: #92D050;
            color: black;
            font-weight: bold;
            font-size: 10px;
            padding-top: 7px;
            padding-bottom: 7px;
        }

        .year-denomination {
            text-align: center;
            font-size: 11px;
            font-style: italic;
            margin-top: 0px;
            width: 100%;
        }

        h1, h2 { text-align: center; color: #2c3e50;}
        h1 { font-size: 20px; margin-top: 0; margin-bottom: 5px; border-bottom: 2px solid #2980b9; padding-bottom: 8px;}
        h2 { font-size: 16px; display: inline-block; margin-top: 20px; margin-bottom: 20px; border: 1px solid blue; padding: 5px 15px;}
        h3 { font-size: 14px; border-bottom: 1px solid #ccc; padding-bottom: 5px; margin-top: 20px; margin-bottom: 10px; }

        .section {
            margin-bottom: 15px;
            padding-left: 10px;
            border-left: 2px solid #ecf0f1;
        }
        
        .table { width: 100%; border-collapse: collapse; }
        .uppercase { text-transform: uppercase; }
        .table td { padding: 5px; border: 1px solid #ddd; }
        .table .label-cell { background-color: #f9f9f9; font-weight: bold; width: 35%; }
        .field { margin-bottom: 6px; line-height: 1.4; }

    </style>
</head>
<body>
    
    <div class="header">
        <table class="header-table">
            <tr>
                <td style="width: 20%;">
                    <img src="{{ public_path('img/logo-minedu.png') }}" alt="Logo MINEDU" class="logo-minedu">
                </td>
                <td style="width: 35%;" class="p-r-5">
                    <div class="bg-dark-blue">
                        I.E.S.T.P<br>
                        "FELIPE HUAMÁN POMA DE AYALA"<br>
                        Revalidado R.D. N° 0085-2006-ED.
                    </div>
                </td>
                <td style="width: 25%;" class="p-r-5">
                    <div class="bg-green">
                        UNIDAD DE BIENESTAR<br>Y EMPLEABILIDAD
                    </div>
                </td>
                <td style="width: 20%;">
                    <img src="{{ public_path('img/logo.png') }}" alt="Logo IESTP" class="logo-iestp">
                </td>
            </tr>
        </table>
        @php
            use App\Models\CurrentYear;
            $currentYear = CurrentYear::first();
        @endphp
        <p class="year-denomination">
            "{{ $currentYear->denominacion ?? 'No se ha definido una denominación para el año.' }}"
        </p>
    </div>

    <div class="footer">
        <p class="page-number"></p>
    </div>

    <h1>ANEXO 1: ENCUESTA DE SEGUIMIENTO A EGRESADOS</h1>
    <div style="text-align: center;">
        <h2>N° EE-{{ str_pad($survey->id, 4, '0', STR_PAD_LEFT) }}-{{ $survey->fecha_completado?->format('Y') }}</h2>
    </div>
    <div class="section">
        <h3>Sección 1: Identificación del Egresado</h3>
        <table class="table">
            <tr><td class="label-cell">Apellidos y Nombres</td><td class="uppercase">{{ $graduate->nombre_completo ?? 'No especificado' }}</td></tr>
            <tr><td class="label-cell">DNI</td><td class="uppercase">{{ $graduate->dni ?? 'No especificado' }}</td></tr>
            <tr><td class="label-cell">Correo Electrónico</td><td class="uppercase">{{ $graduate->correo_electronico ?? 'No especificado' }}</td></tr>
            <tr><td class="label-cell">Número de Celular</td><td class="uppercase">{{ $graduate->numero_celular ?? 'No especificado' }}</td></tr>
            <tr><td class="label-cell">Programa de Estudios</td><td class="uppercase">{{ $graduate->programa->nombre ?? 'No especificado' }}</td></tr>
            <tr><td class="label-cell">Año de Culminación (VI Semestre)</td><td class="uppercase">{{ $graduate->anio_egreso ?? 'No especificado' }}</td></tr>
            <tr><td class="label-cell">Fecha de Titulación</td><td class="uppercase">{{ $graduate->fecha_titulacion ? \Carbon\Carbon::parse($graduate->fecha_titulacion)->format('d/m/Y') : 'No especificado' }}</td></tr>
        </table>
    </div>

    <div class="section">
        <h3>Sección 2: Dirección de Residencia</h3>
        <table class="table">
            <tr><td class="label-cell">Dirección Permanente</td><td class="uppercase">{{ $graduate->direccion_residencia ?? 'No especificado' }}</td></tr>
            <tr><td class="label-cell">Distrito / Provincia / Región</td><td class="uppercase">{{ optional($graduate->distritoResidencia)->distrito ?? 'N/A' }} / {{ optional(optional($graduate->distritoResidencia)->provincia)->provincia ?? 'N/A' }} / {{ optional(optional(optional($graduate->distritoResidencia)->provincia)->departamento)->departamento ?? 'N/A' }}</td></tr>
        </table>
    </div>
    
    <div class="section">
        <h3>Sección 3: Datos Personales</h3>
        <table class="table">
            <tr><td class="label-cell">Edad</td><td class="uppercase">{{ $survey->edad ?? 'No especificado' }} años</td></tr>
            <tr><td class="label-cell">Sexo</td><td class="uppercase">{{ $survey->sexo ?? 'No especificado' }}</td></tr>
            <tr><td class="label-cell">Fecha de Nacimiento</td><td class="uppercase">{{ $survey->fecha_nacimiento ? \Carbon\Carbon::parse($survey->fecha_nacimiento)->format('d/m/Y') : 'No especificado' }}</td></tr>
            <tr><td class="label-cell">Lugar de Nacimiento</td><td class="uppercase">{{ optional($survey->distritoNacimiento)->distrito ?? 'N/A' }} / {{ optional(optional($survey->distritoNacimiento)->provincia)->provincia ?? 'N/A' }} / {{ optional(optional(optional($survey->distritoNacimiento)->provincia)->departamento)->departamento ?? 'N/A' }}</td></tr>
        </table>
    </div>
    
    <div class="section">
        <h3>Sección 4: Actividad Laboral</h3>
        <table class="table">
            <tr><td class="label-cell">¿Inició a desempeñarse en su especialidad tras egresar?</td><td class="uppercase">{{ $survey->desempeno_post_egreso ? 'Sí' : 'No' }}</td></tr>
            <tr><td class="label-cell">¿Inició a desempeñarse en su especialidad tras titularse?</td><td class="uppercase">{{ $survey->desempeno_post_titulacion ? 'Sí' : 'No' }}</td></tr>
            <tr><td class="label-cell">Tiempo sin trabajar tras egresar</td><td class="uppercase">{{ $survey->tiempo_sin_trabajar_egreso ?? 'No especificado' }}</td></tr>
            <tr><td class="label-cell">Tiempo sin trabajar tras titularse</td><td class="uppercase">{{ $survey->tiempo_sin_trabajar_titulacion ?? 'No especificado' }}</td></tr>
            <tr><td class="label-cell">Condición Laboral Actual</td><td style="font-weight: bold;">{{ ucfirst($survey->condicion_laboral) }}</td></tr>

            @if ($survey->condicion_laboral === 'no laborando')
                <tr><td class="label-cell">Motivo por el que no ejerce la carrera</td><td class="uppercase">{{ $survey->motivo_no_ejerce_carrera ?? 'No especificado' }}</td></tr>
            @elseif ($survey->condicion_laboral === 'laborando')
                <tr><td class="label-cell">Remuneración Mensual (S/.)</td><td class="uppercase">S/ {{ number_format($survey->remuneracion_mensual, 2) }}</td></tr>
                
                @if ($survey->es_independiente)
                <tr><td class="label-cell" style="background-color: #eafaf1;">Tipo de Empleo</td><td style="background-color: #eafaf1;"><strong>Independiente</strong></td></tr>
                <tr><td class="label-cell">Descripción de actividad</td><td class="uppercase">{{ $survey->independiente_descripcion ?? 'No especificado' }}</td></tr>
                @endif
                
                @if ($survey->es_dependiente)
                <tr><td class="label-cell" style="background-color: #eafaf1;">Tipo de Empleo</td><td style="background-color: #eafaf1;"><strong>Dependiente</strong></td></tr>
                <tr><td class="label-cell">Nombre de la Empresa/Institución</td><td class="uppercase">{{ $survey->dependiente_empresa_nombre ?? 'No especificado' }}</td></tr>
                <tr><td class="label-cell">Dirección de la Empresa</td><td class="uppercase">{{ $survey->dependiente_empresa_direccion ?? 'No especificado' }}</td></tr>
                <tr><td class="label-cell">Ubicación de la Empresa</td><td class="uppercase">{{ optional($survey->dependienteEmpresaDistrito)->distrito ?? 'N/A' }} / {{ optional(optional($survey->dependienteEmpresaDistrito)->provincia)->provincia ?? 'N/A' }} / {{ optional(optional(optional($survey->dependienteEmpresaDistrito)->provincia)->departamento)->departamento ?? 'N/A' }}</td></tr>
                <tr><td class="label-cell">Tipo de Empresa</td><td class="uppercase">{{ $survey->dependiente_empresa_tipo ?? 'No especificado' }}</td></tr>
                <tr><td class="label-cell">RUC</td><td class="uppercase">{{ $survey->dependiente_empresa_ruc ?? 'No especificado' }}</td></tr>
                <tr><td class="label-cell">Actividad / Rubro</td><td class="uppercase">{{ $survey->dependiente_empresa_rubro ?? 'No especificado' }}</td></tr>
                <tr><td class="label-cell">Nombre del Jefe Inmediato</td><td class="uppercase">{{ $survey->dependiente_empresa_jefe ?? 'No especificado' }}</td></tr>
                <tr><td class="label-cell">Cargo que Desempeña</td><td class="uppercase">{{ $survey->dependiente_cargo ?? 'No especificado' }}</td></tr>
                <tr><td class="label-cell">Fecha de Ingreso</td><td class="uppercase">{{ $survey->dependiente_fecha_ingreso ? \Carbon\Carbon::parse($survey->dependiente_fecha_ingreso)->format('d/m/Y') : 'No especificado' }}</td></tr>
                <tr><td class="label-cell">Condición del Cargo</td><td class="uppercase">{{ ucfirst($survey->dependiente_condicion_cargo) ?? 'No especificado' }}</td></tr>
                <tr><td class="label-cell">Formalidad del Empleo</td><td class="uppercase">{{ ucfirst($survey->condicion_formalidad) ?? 'No especificado' }}</td></tr>
                @endif
                
                @if ($survey->no_aplica_empleo)
                <tr><td class="label-cell">Tipo de Empleo</td><td class="uppercase">No aplica</td></tr>
                @endif
            @endif
        </table>
    </div>

    <div class="section">
        <h3>Sección 5: Evaluación de la Formación Profesional</h3>
        <table class="table">
            <tr><td class="label-cell">Calificación de la formación recibida</td><td class="uppercase">{{ str_replace('_', ' ', ucfirst($survey->calificacion_formacion)) }}</td></tr>
            <tr><td class="label-cell">¿El contenido aprendido fue útil?</td><td class="uppercase">{{ ucfirst($survey->utilidad_contenido) }}</td></tr>
            <tr><td class="label-cell">Nivel de satisfacción (1=Nada, 5=Muy)</td><td class="uppercase">{{ $survey->satisfaccion_formacion ?? 'N/A' }}</td></tr>
        </table>
    </div>
    
    <div class="section">
        <h3>Sección 6: Medios de Contacto</h3>
        <table class="table">
            <tr><td class="label-cell">Medio de contacto preferido</td><td class="uppercase">{{ ucfirst($survey->medio_contacto_preferido) ?? 'No especificado' }}</td></tr>
            <tr><td class="label-cell">Días de disponibilidad</td><td class="uppercase">{{ $survey->disponibilidad_dias ?? 'No especificado' }}</td></tr>
            <tr><td class="label-cell">Horarios de disponibilidad</td><td class="uppercase">{{ $survey->disponibilidad_horarios ? implode(', ', (array)$survey->disponibilidad_horarios) : 'No especificado' }}</td></tr>
        </table>
    </div>

    <div class="section">
        <h3>Sección 7: Otras Actividades</h3>
        <table class="table">
            @if ($survey->sin_otra_actividad)
                <tr><td class="label-cell">¿A qué otra actividad te dedicas?</td><td class="uppercase">No tengo otra actividad</td></tr>
            @else
                <tr><td class="label-cell">¿A qué otra actividad te dedicas?</td><td class="uppercase">{{ $survey->otra_actividad_descripcion ?? 'No especificado' }}</td></tr>
            @endif

            <tr><td class="label-cell">¿Estudia otra carrera?</td><td class="uppercase">{{ $survey->estudia_otra_carrera ? 'Sí' : 'No' }}</td></tr>
            
            @if ($survey->estudia_otra_carrera)
                <tr><td class="label-cell">Nombre de la otra carrera</td><td class="uppercase">{{ $survey->otra_carrera_nombre ?? 'No especificado' }}</td></tr>
                <tr><td class="label-cell">Institución donde estudia</td><td class="uppercase">{{ $survey->otra_carrera_institucion ?? 'No especificado' }}</td></tr>
                <tr><td class="label-cell">Tipo de Institución</td><td class="uppercase">{{ str_replace('_', ' ', ucfirst($survey->otra_carrera_tipo_institucion)) }}</td></tr>
            @endif
        </table>
    </div>
    
    <div class="section">
        <h3>Sección 8: Sugerencias o Recomendaciones</h3>
        <p class="field uppercase">{{ $survey->sugerencias ?? 'Sin sugerencias.' }}</p>
    </div>

    <div style="margin-top: 40px; text-align: center;">
        <p><strong>Fecha de la encuesta:</strong> {{ $survey->fecha_completado ? \Carbon\Carbon::parse($survey->fecha_completado)->format('d/m/Y') : '' }}</p>
        <p style="margin-top: 60px;">_________________________</p>
        <p style="font-weight: bold;">Jefe de Bienestar y Empleabilidad</p>
    </div>

</body>
</html>