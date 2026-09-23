<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

/**
 * Crea y retorna una instancia de PHPMailer configurada con los
 * parámetros SMTP del sistema SGD-CIMM.
 *
 * Uso:
 *   $mail = crearEmail('nombre.remitente@sgdcimm.com.co', 'Nombre Remitente');
 *   $mail->addAddress($destinatario, $nombreDestinatario);
 *   $mail->Subject = 'Asunto';
 *   $mail->Body    = $cuerpoHtml;
 *   $mail->send();
 *
 * @param string $remitente    Dirección desde la que se envía (por defecto la del sistema).
 * @param string $nombreRemitente Nombre visible del remitente.
 * @return PHPMailer
 */
function crearEmail(
    string $remitente     = 'seguimientos@sgdcimm.com.co',
    string $nombreRemitente = 'Sistema SGD-CIMM'
): PHPMailer {

    $mail = new PHPMailer(true);

    // --- Configuración SMTP ---
    $mail->isSMTP();
    $mail->Host       = 'www.eproductiva.net';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'seguimientos@eproductiva.net';
    $mail->Password   = 'W.7LB3w;D3rhEd$E';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->SMTPDebug  = 0;
    $mail->Timeout    = 10; // Evita colgar el servidor si el puerto SMTP est�� bloqueado
    
    // --- Defaults de contenido ---
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';

    // --- Remitente ---
    $mail->setFrom($remitente, $nombreRemitente);

    return $mail;
}
