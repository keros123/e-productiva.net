# Problemas de seguridad

Hallazgos vistos en el código y en la forma en que se publica el sitio. No es una prueba de intrusión.

## Contraseñas en texto claro

`funcionario.password` y `aprendiz.password_aprendiz` guardan la contraseña tal como se escribe. El ingreso compara ese valor directo. Al crear un funcionario, la contraseña inicial es el número de documento (`modelo/funcionarioModelo.php`).

La cuenta de usuario imprime la contraseña en el atributo `value` del campo (`vista/modulos/account.php`). La sesión también guarda `$_SESSION["password"]`. Cualquiera con acceso a la base, a un volcado o al HTML de la cuenta puede leer las claves.

## El control de rol solo está en la pantalla

`vista/plantilla.php` limita qué módulo ve cada tipo de usuario. Los archivos `control/*.php` se abren directo por URL y casi todos solo preguntan si existe `$_SESSION["usuario"]`. No comprueban el rol ni si el registro pertenece a quien está conectado.

Con una sesión de aprendiz se puede llamar, por ejemplo, `control/bitacorasControl.php` o `control/funcionarioControl.php` y operar datos de otro aprendiz: el identificador viaja en el POST (`aprendiz`, `idBitacora`) y no se compara con `$_SESSION["id"]`.

El tipo de usuario que actualiza datos también llega en el POST (`control/actualizacion_datos_usuarioControl.php`, `control/archivoControl.php`), así que el cliente puede presentarse como otro rol.

## Errores de base devueltos al navegador

Varios `catch` responden con `$e->getMessage()`. Un fallo de SQL muestra al usuario el mensaje del motor, el nombre de la tabla y, a veces, la ruta del archivo. Eso ya ocurrió en pantalla con `Table 'mi_base.funcionario' doesn't exist`.

## Archivos subidos y carpetas abiertas

Las bitácoras validan extensión por el nombre (`.pdf`, `.xlsx`, `.xls`) y el tamaño, no el contenido. Las carpetas de aprendices se crean con permiso `0777` (`modelo/bitacorasModelo.php`). El archivo queda bajo `archivos/`, dentro del sitio, y la ruta se guarda en la base. Quien conozca la URL puede intentar leerlo si el servidor no bloquea ese directorio.

## Secretos dentro del sitio público

La raíz del proyecto es la carpeta que sirve Apache. Ahí están:

- `modelo/conexion.php`, con usuario y contraseña de PostgreSQL.
- `credenciales-contenedores.md`, con usuarios de MySQL, PostgreSQL y phpMyAdmin.
- `db/mromer04_dbsgdcomercio_pg.sql`, con el volcado completo, contraseñas incluidas.
- `modelo/certificarAprendizModelo copy.php`, con usuario y contraseña de un buzón SMTP.

`.htaccess` solo reescribe rutas cortas hacia `index.php` y desactiva el listado de directorios. No impide pedir esos archivos por su ruta.

## Sesión y peticiones cruzadas

Después de un ingreso correcto no se regenera el identificador de sesión. Los POST de los controladores no llevan un token contra falsificación de petición: una página externa puede disparar acciones si el navegador todavía tiene la cookie.

## Correo y datos personales

Los cuerpos de correo arman HTML concatenando nombres, documentos y teléfonos. No es ejecución de código en el servidor, pero un dato con etiquetas puede alterar el mensaje que recibe el instructor o el aprendiz.
