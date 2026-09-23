<?php

    $mensaje_email = '
    <!doctype html>
    <html>
    
    <head>
    <title>Recuperación de Contraseña — SGDC</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        #outlook a {
            padding: 0;
        }
    
        body {
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
    
        table,
        td {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
    
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }
    
        p {
            display: block;
            margin: 13px 0;
        }
    
        .linea {
                border-width: 0.5px;
                border-style: solid; 
                border-color: #5f61e6; 
                background-color: #5f61e6;
                width: 100%;
                height: 2px;
                text-align: center;
            }
    
        .mj-column-per-100 {
            width: 100% !important;
            max-width: 100%;
        }
    
        .mj-column-per-50 {
            width: 50% !important;
            max-width: 50%;
        }
    
        .mj-column-per-30 {
            width: 30% !important;
            max-width: 30%;
        }
    
        .mj-column-per-70 {
            width: 70% !important;
            max-width: 70%;
        }
    
        table.mj-full-width-mobile {
            width: 100% !important;
        }
    
        td.mj-full-width-mobile {
            width: auto !important;
        }
        a,
        span,
        td,
        th {
            -webkit-font-smoothing: antialiased !important;
            -moz-osx-font-smoothing: grayscale !important;
        }

        .blocked-image {
            pointer-events: none;
        }
    </style>
    </head>
    
    <body style="background-color:#ffffff;">
        <div style="background-color:#ffffff;">
        <div style="margin:0px auto;max-width:600px;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
                <tbody>
                <tr>
                    <td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:0px;text-align:center;">
                    <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                        <tr>
                            <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                <tbody>
                                </tbody>
                            </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:0px;word-break:break-word;">
                            <div style="height:20px;"> &nbsp; </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" style="font-size:0px;padding:0;word-break:break-word;">
                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                <tbody>
                                <tr>
                                    <td style="width:600px;">
                                        <br><br>
                                        <img src="https://www.sgdcimm.com.co/ImagenCorreo/imagen_email.png" width="100%" style="pointer-events: none;" class="blocked-image">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            </td>
                        </tr>
                        </table>
                    </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div style="margin:0px auto;max-width:600px;">
            <br><br>
            <div class="linea"></div>
            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
            <tbody>
                <tr>
                    <td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:0px;text-align:center;">
                    <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                        <tr>
                            <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                            <div style="font-weight:400;line-height:24px;text-align:left;color:#434245;">
                                <h2 style="font-size:18px;margin: 0; word-wrap: break-word;  text-align: justify; font-family: verdana; color: black;"><b>Recuperación de Contrase&ntilde;a</b></h2>
                                <br>
                                <p style="font-size:12px;margin: 0; word-wrap: break-word;  text-align: justify; font-family: verdana; color: black;"><b>Hola '. $emailUsuario .' sigue los siguientes pasos, para actualizar tu contrase&ntilde;a:</b></p>
                                <p style="font-size:12px;margin: 0; word-wrap: break-word;  text-align: justify; font-family: verdana; color: black;"><b>1. ingresa el c&oacute;digo de verificaci&oacute;n en el formulario actualizaci&oacute;n de contrase&ntilde;a.</b></p>
                                <p style="font-size:12px;margin: 0; word-wrap: break-word;  text-align: justify; font-family: verdana; color: black;"><b>2. crea y confirma tu nueva contrase&ntilde;a.</b></p>
                                <p style="font-size:12px;margin: 0; word-wrap: break-word;  text-align: justify; font-family: verdana; color: black;"><b>3. haz click en actualizar para cambiar tu contrase&ntilde;a.</b></p>
                                <br>
                                <p style="font-size:18px;margin: 0; word-wrap: break-word;  text-align: center; font-family: verdana; color: black;"><b>su c&oacute;digo de verificaci&oacute;n es:</b></p>
                                <br>
                                <p style="font-size:40px;margin: 0; word-wrap: break-word;  text-align: center; font-family: Impact; color: black;">'. $cod_recuperacion .'</p>
                                <br>
                                <p style="font-size:12px;margin: 0; word-wrap: break-word;  text-align: center; font-family: verdana; color: black;">Nota: este c&oacute;digo solo es valido por 10 minutos, no compartas este c&oacute;digo.</p>
                            </div>
                            </td>
                        </tr>
                        </table>
                    </div>
                    </td>
                </tr>
            </tbody>
            </table>
        </div>
        <div style="margin:0px auto;max-width:600px;">
            <br><br>
            <div class="linea"></div>
            <br><br>
            <p style="font-size:14px;margin: 0; word-wrap: break-word;  text-align: center; font-family: Verdana;"> &copy; '. date('Y') .' - Centro Industrial de Mantenimiento y Manufactura</p>
            <br><br>
        </div>
    </body>
    
    </html>';