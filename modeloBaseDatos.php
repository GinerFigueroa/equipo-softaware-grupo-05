<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

// Crear instancia de Dompdf
$dompdf = new Dompdf();

// HTML con todas las tablas ordenadas
$html = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Estructura Completa de Base de Datos - AlbumClinica</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #2c3e50; text-align: center; margin-bottom: 30px; }
        h2 { 
            color: #3498db; 
            border-bottom: 2px solid #3498db; 
            padding-bottom: 5px;
            margin-top: 30px;
            page-break-after: avoid;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 30px;
            page-break-inside: avoid;
        }
        th { 
            background-color: #3498db; 
            color: white; 
            text-align: left; 
            padding: 10px;
            font-weight: bold;
        }
        td { 
            padding: 8px; 
            border: 1px solid #ddd;
            vertical-align: top;
        }
        tr:nth-child(even) { background-color: #f8f9fa; }
        .footer { 
            text-align: center; 
            margin-top: 50px; 
            color: #6c757d; 
            font-size: 12px;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
        .table-info {
            background-color: #e7f5ff;
            font-style: italic;
            padding: 15px;
            border-left: 4px solid #3498db;
            margin-bottom: 20px;
        }
        .fk { color: #e67e22; font-weight: bold; }
        .pk { color: #2ecc71; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Estructura Completa de Base de Datos - AlbumClinica</h1>
    <p style="text-align: center;"><strong></strong> </p>

    <div class="table-info">
        <strong>Nota:</strong> Campos marcados con <span class="pk">PK</span> son claves primarias, 
        <span class="fk">FK</span> son claves foráneas. Relaciones detalladas al final.
    </div>

    <!-- TABLA CITAS -->
    <h2>1. Tabla: citas</h2>
    <table>
        <tr><th>Campo</th><th>Tipo</th><th>Descripción</th></tr>
        <tr><td><span class="pk">id_cita</span></td><td>int(11)</td><td>Clave primaria</td></tr>
        <tr><td><span class="fk">id_paciente</span></td><td>int(11)</td><td>Relación con pacientes</td></tr>
        <tr><td><span class="fk">id_tratamiento</span></td><td>int(11)</td><td>Relación con tratamientos</td></tr>
        <tr><td><span class="fk">id_dentista</span></td><td>int(11)</td><td>Relación con dentistas (opcional)</td></tr>
        <tr><td>fecha_hora</td><td>datetime</td><td>Fecha y hora programada</td></tr>
        <tr><td>duracion</td><td>int(11)</td><td>Duración en minutos (default: 30)</td></tr>
        <tr><td>estado</td><td>enum</td><td>Pendiente, Confirmada, Completada, Cancelada, No asistió</td></tr>
        <tr><td>notas</td><td>text</td><td>Observaciones adicionales</td></tr>
        <tr><td>recordatorio_enviado</td><td>tinyint(1)</td><td>Indicador de recordatorio (0/1)</td></tr>
        <tr><td>creado_en</td><td>timestamp</td><td>Fecha de creación (auto)</td></tr>
        <tr><td>creado_por</td><td>int(11)</td><td>Usuario que creó el registro</td></tr>
    </table>

    <!-- TABLA CONFIGURACION -->
    <h2>2. Tabla: configuracion</h2>
    <table>
        <tr><th>Campo</th><th>Tipo</th><th>Descripción</th></tr>
        <tr><td><span class="pk">id_config</span></td><td>int(11)</td><td>Clave primaria</td></tr>
        <tr><td>nombre</td><td>varchar(50)</td><td>Nombre del parámetro (único)</td></tr>
        <tr><td>valor</td><td>text</td><td>Valor configurado</td></tr>
        <tr><td>tipo</td><td>enum</td><td>string, number, boolean, json</td></tr>
        <tr><td>descripcion</td><td>text</td><td>Explicación del parámetro</td></tr>
        <tr><td>actualizado_en</td><td>timestamp</td><td>Última actualización (auto)</td></tr>
    </table>

    <!-- TABLA DENTISTAS -->
    <h2>3. Tabla: dentistas</h2>
    <table>
        <tr><th>Campo</th><th>Tipo</th><th>Descripción</th></tr>
        <tr><td><span class="pk">id_dentista</span></td><td>int(11)</td><td>Clave primaria</td></tr>
        <tr><td><span class="fk">id_usuario</span></td><td>int(11)</td><td>Relación con usuarios (único)</td></tr>
        <tr><td><span class="fk">id_especialidad</span></td><td>int(11)</td><td>Relación con especialidades</td></tr>
        <tr><td>cedula_profesional</td><td>varchar(20)</td><td>Número de cédula (único)</td></tr>
        <tr><td>biografia</td><td>text</td><td>Información profesional</td></tr>
        <tr><td>experiencia</td><td>int(11)</td><td>Años de experiencia</td></tr>
        <tr><td>horario</td><td>text</td><td>Horario en formato JSON</td></tr>
        <tr><td>foto</td><td>varchar(255)</td><td>Ruta de la foto profesional</td></tr>
    </table>

    <!-- TABLA DOCUMENTOS -->
    <h2>4. Tabla: documentos</h2>
    <table>
        <tr><th>Campo</th><th>Tipo</th><th>Descripción</th></tr>
        <tr><td><span class="pk">id_documento</span></td><td>int(11)</td><td>Clave primaria</td></tr>
        <tr><td><span class="fk">id_paciente</span></td><td>int(11)</td><td>Relación con pacientes</td></tr>
        <tr><td>tipo</td><td>enum</td><td>Radiografía, Consentimiento, Historial, Otro</td></tr>
        <tr><td>nombre</td><td>varchar(100)</td><td>Nombre descriptivo</td></tr>
        <tr><td>ruta_archivo</td><td>varchar(255)</td><td>Ubicación física del archivo</td></tr>
        <tr><td>notas</td><td>text</td><td>Comentarios adicionales</td></tr>
        <tr><td>subido_en</td><td>timestamp</td><td>Fecha de subida (auto)</td></tr>
        <tr><td>subido_por</td><td>int(11)</td><td>Usuario que subió el documento</td></tr>
    </table>

    <!-- TABLA ESPECIALIDADES -->
    <h2>5. Tabla: especialidades</h2>
    <table>
        <tr><th>Campo</th><th>Tipo</th><th>Descripción</th></tr>
        <tr><td><span class="pk">id_especialidad</span></td><td>int(11)</td><td>Clave primaria</td></tr>
        <tr><td>nombre</td><td>varchar(50)</td><td>Nombre de la especialidad</td></tr>
        <tr><td>descripcion</td><td>text</td><td>Descripción detallada</td></tr>
        <tr><td>icono</td><td>varchar(30)</td><td>Ícono representativo</td></tr>
        <tr><td>creado_en</td><td>timestamp</td><td>Fecha de creación (auto)</td></tr>
    </table>

    <!-- TABLA HISTORIAL_MEDICO -->
    <h2>6. Tabla: historial_medico</h2>
    <table>
        <tr><th>Campo</th><th>Tipo</th><th>Descripción</th></tr>
        <tr><td><span class="pk">id_historial</span></td><td>int(11)</td><td>Clave primaria</td></tr>
        <tr><td><span class="fk">id_paciente</span></td><td>int(11)</td><td>Relación con pacientes</td></tr>
        <tr><td><span class="fk">id_dentista</span></td><td>int(11)</td><td>Relación con dentistas</td></tr>
        <tr><td><span class="fk">id_tratamiento</span></td><td>int(11)</td><td>Relación con tratamientos</td></tr>
        <tr><td>fecha_procedimiento</td><td>datetime</td><td>Fecha del procedimiento</td></tr>
        <tr><td>diagnostico</td><td>text</td><td>Diagnóstico médico</td></tr>
        <tr><td>procedimiento</td><td>text</td><td>Descripción del tratamiento</td></tr>
        <tr><td>observaciones</td><td>text</td><td>Notas adicionales</td></tr>
        <tr><td>receta</td><td>text</td><td>Medicamentos recetados</td></tr>
        <tr><td>proxima_visita</td><td>date</td><td>Fecha de seguimiento</td></tr>
        <tr><td>adjuntos</td><td>text</td><td>Documentos relacionados (JSON)</td></tr>
    </table>

    <!-- TABLA INVENTARIO -->
    <h2>7. Tabla: inventario</h2>
    <table>
        <tr><th>Campo</th><th>Tipo</th><th>Descripción</th></tr>
        <tr><td><span class="pk">id_item</span></td><td>int(11)</td><td>Clave primaria</td></tr>
        <tr><td>nombre</td><td>varchar(50)</td><td>Nombre del artículo</td></tr>
        <tr><td>categoria</td><td>enum</td><td>Material, Medicamento, Equipo, Consumible</td></tr>
        <tr><td>descripcion</td><td>text</td><td>Descripción detallada</td></tr>
        <tr><td>cantidad</td><td>int(11)</td><td>Stock disponible (default: 0)</td></tr>
        <tr><td>unidad_medida</td><td>varchar(10)</td><td>Unidad de medida (ej: unidades, ml)</td></tr>
        <tr><td>stock_minimo</td><td>int(11)</td><td>Límite para alertas (default: 5)</td></tr>
        <tr><td>proveedor</td><td>varchar(50)</td><td>Nombre del proveedor</td></tr>
        <tr><td>costo_unitario</td><td>decimal(10,2)</td><td>Precio por unidad</td></tr>
        <tr><td>ubicacion</td><td>varchar(50)</td><td>Lugar de almacenamiento</td></tr>
        <tr><td>activo</td><td>tinyint(1)</td><td>Indicador de activo (1/0)</td></tr>
        <tr><td>actualizado_en</td><td>timestamp</td><td>Última actualización (auto)</td></tr>
    </table>

    <!-- TABLA PACIENTES -->
    <h2>8. Tabla: pacientes</h2>
    <table>
        <tr><th>Campo</th><th>Tipo</th><th>Descripción</th></tr>
        <tr><td><span class="pk">id_paciente</span></td><td>int(11)</td><td>Clave primaria</td></tr>
        <tr><td><span class="fk">id_usuario</span></td><td>int(11)</td><td>Relación con usuarios (único)</td></tr>
        <tr><td>fecha_nacimiento</td><td>date</td><td>Fecha de nacimiento</td></tr>
        <tr><td>genero</td><td>enum</td><td>Masculino, Femenino, Otro</td></tr>
        <tr><td>alergias</td><td>text</td><td>Alergias conocidas</td></tr>
        <tr><td>enfermedades_cronicas</td><td>text</td><td>Enfermedades preexistentes</td></tr>
        <tr><td>medicamentos</td><td>text</td><td>Medicación regular</td></tr>
        <tr><td>seguro_medico</td><td>varchar(50)</td><td>Nombre del seguro</td></tr>
        <tr><td>numero_seguro</td><td>varchar(50)</td><td>Número de póliza</td></tr>
        <tr><td>creado_en</td><td>timestamp</td><td>Fecha de creación (auto)</td></tr>
    </table>

    <!-- TABLA PAGOS -->
    <h2>9. Tabla: pagos</h2>
    <table>
        <tr><th>Campo</th><th>Tipo</th><th>Descripción</th></tr>
        <tr><td><span class="pk">id_pago</span></td><td>int(11)</td><td>Clave primaria</td></tr>
        <tr><td><span class="fk">id_cita</span></td><td>int(11)</td><td>Relación con citas</td></tr>
        <tr><td>monto</td><td>decimal(10,2)</td><td>Cantidad pagada</td></tr>
        <tr><td>metodo_pago</td><td>enum</td><td>Efectivo, Tarjeta crédito, Tarjeta débito, Transferencia</td></tr>
        <tr><td>estado</td><td>enum</td><td>Pendiente, Completado, Reembolsado, Cancelado</td></tr>
        <tr><td>referencia</td><td>varchar(50)</td><td>Número de referencia/recibo</td></tr>
        <tr><td>fecha_pago</td><td>datetime</td><td>Fecha y hora del pago</td></tr>
        <tr><td>notas</td><td>text</td><td>Observaciones adicionales</td></tr>
    </table>

    <!-- TABLA ROLES -->
    <h2>10. Tabla: roles</h2>
    <table>
        <tr><th>Campo</th><th>Tipo</th><th>Descripción</th></tr>
        <tr><td><span class="pk">id_rol</span></td><td>int(11)</td><td>Clave primaria</td></tr>
        <tr><td>nombre</td><td>varchar(20)</td><td>Nombre del rol</td></tr>
        <tr><td>descripcion</td><td>varchar(100)</td><td>Descripción del permiso</td></tr>
        <tr><td>creado_en</td><td>timestamp</td><td>Fecha de creación (auto)</td></tr>
    </table>

    <!-- TABLA TRATAMIENTOS -->
    <h2>11. Tabla: tratamientos</h2>
    <table>
        <tr><th>Campo</th><th>Tipo</th><th>Descripción</th></tr>
        <tr><td><span class="pk">id_tratamiento</span></td><td>int(11)</td><td>Clave primaria</td></tr>
        <tr><td>nombre</td><td>varchar(50)</td><td>Nombre del tratamiento</td></tr>
        <tr><td><span class="fk">id_especialidad</span></td><td>int(11)</td><td>Relación con especialidades</td></tr>
        <tr><td>descripcion</td><td>text</td><td>Descripción detallada</td></tr>
        <tr><td>duracion_estimada</td><td>int(11)</td><td>Duración en minutos</td></tr>
        <tr><td>costo</td><td>decimal(10,2)</td><td>Precio del tratamiento</td></tr>
        <tr><td>requisitos</td><td>text</td><td>Condiciones previas</td></tr>
        <tr><td>activo</td><td>tinyint(1)</td><td>Indicador de activo (1/0)</td></tr>
        <tr><td>creado_en</td><td>timestamp</td><td>Fecha de creación (auto)</td></tr>
    </table>

    <!-- TABLA USUARIOS -->
    <h2>12. Tabla: usuarios</h2>
    <table>
        <tr><th>Campo</th><th>Tipo</th><th>Descripción</th></tr>
        <tr><td><span class="pk">id_usuario</span></td><td>int(11)</td><td>Clave primaria</td></tr>
        <tr><td><span class="fk">id_rol</span></td><td>int(11)</td><td>Relación con roles</td></tr>
        <tr><td>email</td><td>varchar(50)</td><td>Correo electrónico (único)</td></tr>
        <tr><td>usuario_clave</td><td>varchar(255)</td><td>Contraseña encriptada</td></tr>
        <tr><td>usuario_usuario</td><td>varchar(50)</td><td>Nombre de usuario (único)</td></tr>
        <tr><td>nombre_apellido</td><td>varchar(50)</td><td>Nombre completo</td></tr>
        <tr><td>telefono</td><td>varchar(15)</td><td>Número de contacto</td></tr>
        <tr><td>activo</td><td>tinyint(1)</td><td>Indicador de activo (1/0)</td></tr>
        <tr><td>ultimo_login</td><td>datetime</td><td>Fecha del último acceso</td></tr>
        <tr><td>creado_en</td><td>timestamp</td><td>Fecha de creación (auto)</td></tr>
        <tr><td>actualizado_en</td><td>timestamp</td><td>Última actualización (auto)</td></tr>
    </table>

    <!-- RELACIONES ENTRE TABLAS -->
    <h2>Relaciones Clave</h2>
    <div class="table-info">
        <strong>Diagrama de relaciones:</strong> Esta sección describe las conexiones principales entre tablas.
    </div>
    <table>
        <tr><th>Tabla Origen</th><th>Campo</th><th>Tabla Destino</th><th>Tipo Relación</th></tr>
        <tr><td>citas</td><td>id_paciente</td><td>pacientes</td><td>Muchos a Uno</td></tr>
        <tr><td>citas</td><td>id_tratamiento</td><td>tratamientos</td><td>Muchos a Uno</td></tr>
        <tr><td>citas</td><td>id_dentista</td><td>dentistas</td><td>Muchos a Uno</td></tr>
        <tr><td>dentistas</td><td>id_usuario</td><td>usuarios</td><td>Uno a Uno</td></tr>
        <tr><td>dentistas</td><td>id_especialidad</td><td>especialidades</td><td>Muchos a Uno</td></tr>
        <tr><td>documentos</td><td>id_paciente</td><td>pacientes</td><td>Muchos a Uno</td></tr>
        <tr><td>historial_medico</td><td>id_paciente</td><td>pacientes</td><td>Muchos a Uno</td></tr>
        <tr><td>historial_medico</td><td>id_dentista</td><td>dentistas</td><td>Muchos a Uno</td></tr>
        <tr><td>historial_medico</td><td>id_tratamiento</td><td>tratamientos</td><td>Muchos a Uno</td></tr>
        <tr><td>pacientes</td><td>id_usuario</td><td>usuarios</td><td>Uno a Uno</td></tr>
        <tr><td>pagos</td><td>id_cita</td><td>citas</td><td>Muchos a Uno</td></tr>
        <tr><td>tratamientos</td><td>id_especialidad</td><td>especialidades</td><td>Muchos a Uno</td></tr>
        <tr><td>usuarios</td><td>id_rol</td><td>roles</td><td>Muchos a Uno</td></tr>
    </table>

    <div class="footer">
        Documento generado automáticamente el 06/06/2025 - Sistema AlbumClinica<br>
        <small>Incluye todas las tablas y relaciones de la base de datos</small>
    </div>
</body>
</html>
';

// Cargar HTML en Dompdf
$dompdf->loadHtml($html);

// Configurar tamaño de papel
$dompdf->setPaper('A4', 'portrait');

// Renderizar PDF
$dompdf->render();

// Mostrar el PDF en el navegador
$dompdf->stream("estructura_completa_bd_albumclinica.pdf", ["Attachment" => false]);
?>
