<?php

class mdlPlantillaEmail{


    public static function crearCuerpoMensaje($nombre_tipoSeguimiento,$nombreAprendiz,$telefono,$programa,$instructor,$fecha_vencimiento,$ubicacion){

        $cuerpoEmail = '<!DOCTYPE html>
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
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background-color: #ffffff; border-radius: 6px; overflow: hidden;">
                                        <tr>
                                            <td style="padding: 20px; font-family: Arial, sans-serif; color: #333;">
                                            <h2 style="margin-top: 0; text-align: center;">Reporte de Seguimiento</h2>
                                            <p style="font-size: 16px;">Cordial saludo,</p>

                                            <p style="font-size: 16px; line-height: 1.5;">
                                                Le informamos que el siguiente seguimiento ha sido reasignado. Agradecemos su gestión dentro de las fechas indicadas.
                                                <br><br>
                                                En caso de presentarse alguna novedad, le solicitamos informar con antelación al área de Coordinación Académica, con copia al correo:
                                                <br>
                                                <strong>contratoaprendizajecimm@sena.edu.co</strong>
                                            </p>

                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse; margin-top: 20px;">
                                                <thead>
                                                    <tr>
                                                        <th style="background-color: #569c2a; color: #ffffff; padding: 10px; border: 1px solid #cccccc; text-align: left;font-size: 10px;">Tipo</th>
                                                        <th style="background-color: #569c2a; color: #ffffff; padding: 10px; border: 1px solid #cccccc; text-align: left;font-size: 10px;">Aprendiz</th>
                                                        <th style="background-color: #569c2a; color: #ffffff; padding: 10px; border: 1px solid #cccccc; text-align: left;font-size: 10px;">Telefono</th>
                                                        <th style="background-color: #569c2a; color: #ffffff; padding: 10px; border: 1px solid #cccccc; text-align: left;font-size: 10px;">Programa</th>
                                                        <th style="background-color: #569c2a; color: #ffffff; padding: 10px; border: 1px solid #cccccc; text-align: left;font-size: 10px;">Instructor</th>
                                                        <th style="background-color: #569c2a; color: #ffffff; padding: 10px; border: 1px solid #cccccc; text-align: left;font-size: 10px;">fecha de vencimiento</th>
                                                        <th style="background-color: #569c2a; color: #ffffff; padding: 10px; border: 1px solid #cccccc; text-align: left;font-size: 10px;">Ubicación</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="padding: 10px; border: 1px solid #cccccc;font-size: 9px;">'.$nombre_tipoSeguimiento.'</td>
                                                        <td style="padding: 10px; border: 1px solid #cccccc;font-size: 9px;">'.$nombreAprendiz.'</td>
                                                        <td style="padding: 10px; border: 1px solid #cccccc;font-size: 9px;">'.$telefono.'</td>
                                                        <td style="padding: 10px; border: 1px solid #cccccc;font-size: 9px;">'.$programa.'</td>
                                                        <td style="padding: 10px; border: 1px solid #cccccc;font-size: 9px;">'.$instructor.'</td>
                                                        <td style="padding: 10px; border: 1px solid #cccccc;font-size: 9px;">'.$fecha_vencimiento.'</td>
                                                        <td style="padding: 10px; border: 1px solid #cccccc;font-size: 9px;">'.$ubicacion.'</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <p style="font-size: 14px; color: #777; margin-top: 30px;">Este es un mensaje automático. Por favor, no respondas a este correo.</p>
                                            </td>
                                        </tr>
                                        </table>
                                    </td>
                                    </tr>
                                </table>
                                </center>
                            </body>
                        </html>';

        return $cuerpoEmail;
    }
} 