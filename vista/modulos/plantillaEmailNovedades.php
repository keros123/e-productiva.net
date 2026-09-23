<?php
// Este archivo debe estar en la ruta ../vista/modulos/plantillaEmailNovedades.php 

$cuerpoMensajeNovedadReporte = '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novedad Reporte Seguimiento</title>
    <style>
        body {
            font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .email-wrapper {
            width: 100%;
            background-color: #f4f7f6;
            padding: 40px 0;
        }
        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .header {
            text-align: center;
            padding: 25px 0;
            background-color: #ffffff;
            border-bottom: 4px solid #39A900;
        }
        .header img {
            max-width: 250px;
            height: auto;
            border: 0;
        }
        .body-section {
            padding: 35px;
            color: #333333;
        }
        .title {
            margin: 0 0 25px 0;
            font-size: 22px;
            color: #39A900;
            text-align: center;
            font-weight: 600;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .info-table th, .info-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eeeeee;
            font-size: 14px;
        }
        .info-table th {
            width: 35%;
            color: #666666;
            font-weight: 600;
            background-color: #fafafa;
        }
        .info-table td {
            color: #222222;
            font-weight: 500;
        }
        .novedad-box {
            background-color: #f8faf8;
            border-left: 5px solid #39A900;
            padding: 20px;
            border-radius: 0 6px 6px 0;
            margin-bottom: 20px;
        }
        .novedad-title {
            font-size: 13px;
            font-weight: 700;
            color: #39A900;
            text-transform: uppercase;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }
        .novedad-text {
            margin: 0;
            font-size: 15px;
            line-height: 1.6;
            color: #444444;
        }
        .footer {
            background-color: #333333;
            padding: 20px;
            text-align: center;
            color: #aaaaaa;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-content">
            <div class="header">
                <img src="https://www.sgdcimm.com.co/ImagenCorreo/imagen_email.png" alt="SENA CIMM" width="250">
            </div>
            <div class="body-section">
                <h2 class="title">Novedad de Seguimiento</h2>
                
                <table class="info-table">
                    ' . (!empty($infoAprendiz["nombreAprendiz"]) || !empty($infoAprendiz["apellidosAprendiz"]) ? '
                    <tr>
                        <th>Aprendiz</th>
                        <td>' . ($infoAprendiz["nombreAprendiz"] ?? "") . ' ' . ($infoAprendiz["apellidosAprendiz"] ?? "") . '</td>
                    </tr>' : '') . '
                    ' . (!empty($infoAprendiz["numero_ficha"]) ? '
                    <tr>
                        <th>Ficha</th>
                        <td>' . ($infoAprendiz["numero_ficha"] ?? "") . (!empty($infoAprendiz["caracterizacion"]) ? ' - ' . $infoAprendiz["caracterizacion"] : "") . '</td>
                    </tr>' : '') . '
                    <tr>
                        <th>Registrado por</th>
                        <td>' . ($autor ?? "") . '</td>
                    </tr>
                    <tr>
                        <th>Fecha de Registro</th>
                        <td>' . ($fecha ?? "") . '</td>
                    </tr>
                </table>

                <p style="font-size: 15px; color: #444444; line-height: 1.6; margin-top: 10px; margin-bottom: 20px; text-align: justify;">
                    Se ha registrado una nueva anotación u observación relacionada con el proceso de etapa práctica. A continuación, el detalle del mensaje:
                </p>

                <div class="novedad-box">
                    <div class="novedad-title">Mensaje de la Novedad</div>
                    <div class="novedad-text" style="word-wrap: break-word; overflow-wrap: break-word;">' . ($novedad ?? "") . '</div>
                </div>
                
                ' . ((strpos(strtolower($novedad ?? ""), "rechazado") !== false || !empty($requiereAccionArchivo)) ? '
                <div style="background-color: #fff8e1; border-left: 5px solid #ffc107; padding: 15px 20px; margin-bottom: 20px; border-radius: 4px;">
                    <p style="margin: 0; font-size: 14px; color: #5d4037; font-weight: 500; line-height: 1.5;">
                        <strong>⚠️ Acción Requerida:</strong> Por favor, lea detenidamente las observaciones superiores, realice las correcciones pertinentes, <strong>vuelva a subir el archivo</strong> a la plataforma y finalmente <strong>radíquelo nuevamente</strong> para su respectiva revisión.
                    </p>
                </div>' : '') . '
            </div>
            <div class="footer">
                &copy; ' . date("Y") . ' Centro Industrial de Mantenimiento y Manufactura (CIMM)
            </div>
        </div>
    </div>
</body>
</html>';