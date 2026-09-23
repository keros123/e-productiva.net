<?php

class mdlPlantillaEmailReporteSeguimiento
{
    public static function crearCuerpoMensajeReporteSeguimiento($nombreAprendiz, $programa, $instructor, $ficha, $nombre_tipoSeguimiento)
    {
        $cuerpoEmailReporteSeguimientoRechazado = '<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Seguimiento</title>
</head>

<body style="Margin:0;padding:0;background-color:#f4f4f4;">
    <center style="width: 100%; background-color: #f4f4f4;">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td align="center" style="padding: 20px;">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%"
                        style="max-width: 600px; background-color: #ffffff; border-radius: 6px; overflow: hidden;">
                        <tr>
                            <td align="center" style="padding: 20px 0;">
                                <img
                                src="https://www.sgdcimm.com.co/ImagenCorreo/imagen_email.png"
                                alt="Logo SGDCIMM"
                                style="
                                width: 100%;
                                max-width: 400px;    /* ajusta hasta 600px de ancho */
                                height: auto;
                                display: block;
                                ">
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 20px; font-family: Arial, sans-serif; color: #333;">
                                <h2 style="margin-top: 0; text-align: center;">Reporte de Seguimiento</h2>

                                <p style="font-size: 16px;">Estimado/a</p>

                                <p style="font-size: 16px; line-height: 1.5;">
                                    Le informamos que el <strong>' . $nombre_tipoSeguimiento . '</strong> correspondiente al aprendiz
                                    <strong>' . $nombreAprendiz . '</strong>,
                                    de la ficha <strong>' . $ficha . '</strong> – <strong>' . $programa . '</strong>,
                                    cuyo responsable es el instructor <strong>' . $instructor . '</strong>,
                                    ha sido cargado nuevamente tras haber sido rechazado.<br><br>
                                    Este seguimiento ya está disponible para su revisión. Por favor,
                                    evalúe si procede su aprobación o si requiere nuevas observaciones.
                                </p>

                                <p style="font-size: 14px; color: #777; margin-top: 30px;">
                                    Este es un mensaje automático. Por favor, no responda a este correo.
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>';

        return $cuerpoEmailReporteSeguimientoRechazado;
    }
}
