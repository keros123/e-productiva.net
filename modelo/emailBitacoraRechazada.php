<?php

class mdlPlantillaEmailBitacoraRechazada
{
    public static function crearCuerpoMensajeBitacoraRechazada($nombreAprendiz, $codigoBitacora, $instructor, $ficha, $programa, $novedad)
    {
        $cuerpoEmailBitacoraRechazada = '<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Bitácora Rechazada</title>
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
                                max-width: 400px;
                                height: auto;
                                display: block;
                                ">
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 20px; font-family: Arial, sans-serif; color: #333;">
                                <h2 style="margin-top: 0; text-align: center; color: #dc3545;">Bitácora Rechazada</h2>

                                <p style="font-size: 16px;">Estimado/a <strong>' . $nombreAprendiz . '</strong>,</p>

                                <p style="font-size: 16px; line-height: 1.5;">
                                    Le informamos que la <strong>Bitácora ' . $codigoBitacora . '</strong> 
                                    de la ficha <strong>' . $ficha . '</strong> – <strong>' . $programa . '</strong>,
                                    ha sido <strong style="color: #dc3545;">RECHAZADA</strong> por el instructor 
                                    <strong>' . $instructor . '</strong>.
                                </p>

                                <div style="background-color: #f8f9fa; border-left: 4px solid #dc3545; padding: 15px; margin: 20px 0;">
                                    <h4 style="margin-top: 0; color: #dc3545;">Observaciones del Instructor:</h4>
                                    <p style="margin-bottom: 0; font-style: italic; color: #555;">
                                        ' . nl2br(htmlspecialchars($novedad)) . '
                                    </p>
                                </div>

                                <p style="font-size: 16px; line-height: 1.5;">
                                    <strong>¿Qué debe hacer ahora?</strong><br>
                                    1. Revise las observaciones del instructor<br>
                                    2. Realice las correcciones necesarias en su bitácora<br>
                                    3. Vuelva a subir la bitácora corregida al sistema<br>
                                    4. Espere la nueva revisión del instructor
                                </p>

                                <p style="font-size: 14px; color: #777; margin-top: 30px;">
                                    Este es un mensaje automático. Por favor, no responda a este correo.<br>
                                    Si tiene dudas, contacte directamente con su instructor.
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

        return $cuerpoEmailBitacoraRechazada;
    }
}
