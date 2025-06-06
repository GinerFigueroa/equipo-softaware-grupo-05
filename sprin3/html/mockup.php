<?php
require_once '../../dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf();

$html = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mockup Visual - Base de Datos AlbumClinica</title>
    <style>
        /* Estilo clínico profesional */
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f9fc;
            color: #333;
        }
        .header {
            background-color: #1a5276;
            color: white;
            padding: 20px;
            text-align: center;
            margin-bottom: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .logo {
            width: 120px;
            margin-bottom: 10px;
        }
        h1 {
            margin: 0;
            font-size: 24px;
        }
        .subtitle {
            font-style: italic;
            opacity: 0.9;
        }
        .card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            page-break-inside: avoid;
        }
        h2 {
            color: #2874a6;
            border-bottom: 2px solid #d4e6f1;
            padding-bottom: 8px;
            margin-top: 0;
            font-size: 20px;
        }
        .table-mockup {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 14px;
        }
        .table-mockup th {
            background-color: #3498db;
            color: white;
            text-align: left;
            padding: 12px;
            font-weight: 500;
        }
        .table-mockup td {
            padding: 10px 12px;
            border-bottom: 1px solid #e0e0e0;
            vertical-align: top;
        }
        .table-mockup tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .table-mockup tr:hover {
            background-color: #ebf5fb;
        }
        .pk {
            color: #27ae60;
            font-weight: bold;
        }
        .fk {
            color: #e67e22;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            color: #7f8c8d;
            font-size: 12px;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
            margin-right: 5px;
        }
        .badge-primary {
            background-color: #3498db;
            color: white;
        }
        .badge-success {
            background-color: #27ae60;
            color: white;
        }
        .badge-warning {
            background-color: #f39c12;
            color: white;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>AlbumClinica - Mockup Visual</h1>
        <div class="subtitle">Diseño de tablas para informe clínico</div>
    </div>

    <!-- Ejemplo 1: Tabla Citas -->
    <div class="card">
        <h2>📅 Tabla: Citas</h2>
        <table class="table-mockup">
            <tr>
                <th>ID</th>
                <th>Paciente</th>
                <th>Tratamiento</th>
                <th>Fecha/Hora</th>
                <th>Estado</th>
            </tr>
            <tr>
                <td class="pk">1</td>
                <td>Juan Martínez</td>
                <td>Limpieza dental</td>
                <td>02/05/2025 10:00</td>
                <td><span class="badge badge-success">Confirmada</span></td>
            </tr>
            <tr>
                <td class="pk">2</td>
                <td>Ana López</td>
                <td>Ortodoncia</td>
                <td>03/05/2025 14:30</td>
                <td><span class="badge badge-primary">Pendiente</span></td>
            </tr>
            <tr>
                <td class="pk">3</td>
                <td>Carlos Sánchez</td>
                <td>Extracción</td>
                <td>04/05/2025 09:00</td>
                <td><span class="badge badge-warning">Cancelada</span></td>
            </tr>
        </table>
        <div style="margin-top: 10px; font-size: 13px; color: #666;">
            <strong>Estructura real:</strong> id_cita (PK), id_paciente (FK), id_tratamiento (FK), fecha_hora, estado, notas
        </div>
    </div>

    <!-- Ejemplo 2: Tabla Pacientes -->
    <div class="card">
        <h2>👤 Tabla: Pacientes</h2>
        <table class="table-mockup">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Fecha Nac.</th>
                <th>Género</th>
                <th>Alergias</th>
            </tr>
            <tr>
                <td class="pk">5</td>
                <td>María González</td>
                <td>05/07/1978</td>
                <td>Femenino</td>
                <td>Frutos secos</td>
            </tr>
            <tr>
                <td class="pk">1</td>
                <td>Juan Martínez</td>
                <td>15/05/1990</td>
                <td>Masculino</td>
                <td>Polen</td>
            </tr>
        </table>
        <div style="margin-top: 10px; font-size: 13px; color: #666;">
            <strong>Estructura real:</strong> id_paciente (PK), id_usuario (FK), fecha_nacimiento, género, alergias, enfermedades_cronicas
        </div>
    </div>

    <!-- Ejemplo 3: Tabla Historial Médico -->
    <div class="card">
        <h2>🏥 Tabla: Historial Médico</h2>
        <table class="table-mockup">
            <tr>
                <th>ID</th>
                <th>Paciente</th>
                <th>Procedimiento</th>
                <th>Fecha</th>
                <th>Diagnóstico</th>
            </tr>
            <tr>
                <td class="pk">1</td>
                <td>Juan Martínez</td>
                <td>Limpieza y empaste</td>
                <td>30/04/2025</td>
                <td>Caries en molar derecho</td>
            </tr>
            <tr>
                <td class="pk">4</td>
                <td>Luisa Fernández</td>
                <td>Extracción quirúrgica</td>
                <td>22/04/2025</td>
                <td>Extracción de tercer molar</td>
            </tr>
        </table>
        <div style="margin-top: 10px; font-size: 13px; color: #666;">
            <strong>Estructura real:</strong> id_historial (PK), id_paciente (FK), procedimiento, diagnóstico, receta
        </div>
    </div>

    <!-- Ejemplo 4: Tabla Tratamientos -->
    <div class="card">
        <h2>🦷 Tabla: Tratamientos</h2>
        <table class="table-mockup">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Especialidad</th>
                <th>Duración</th>
                <th>Costo</th>
            </tr>
            <tr>
                <td class="pk">2</td>
                <td>Limpieza dental profesional</td>
                <td>Limpieza Dental</td>
                <td>45 min</td>
                <td>$500.00</td>
            </tr>
            <tr>
                <td class="pk">3</td>
                <td>Ortodoncia metálica completa</td>
                <td>Ortodoncia</td>
                <td>60 min</td>
                <td>$8000.00</td>
            </tr>
        </table>
        <div style="margin-top: 10px; font-size: 13px; color: #666;">
            <strong>Estructura real:</strong> id_tratamiento (PK), nombre, id_especialidad (FK), duración_estimada, costo
        </div>
    </div>

    <div class="footer">
        Documento generado automáticamente el 06/06/2025 - Sistema AlbumClinica<br>
        <small>Mockup visual para propósitos de diseño y documentación</small>
    </div>
</body>
</html>';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("mockup_tablas_albumclinica.pdf", ["Attachment" => false]);
?>
