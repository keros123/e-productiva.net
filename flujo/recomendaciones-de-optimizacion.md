# Recomendaciones para optimizar los procesos

Ordenadas por el efecto que tienen en la operación diaria y en el tiempo de respuesta.

## Una sola conexión por petición

Cada llamada a `Conexion::conectar()` abre un PDO nuevo. Una pantalla que lista fichas, aprendices y visitas puede abrir decenas de conexiones a PostgreSQL. Conviene abrir una conexión al empezar el request y reutilizarla. En PostgreSQL el costo de conectar es más alto que en el MySQL que había antes.

## Dejar de traer filas de más

Casi todas las consultas son `SELECT *` con varios `INNER JOIN`. El detalle de un aprendiz y los informes repiten el mismo cruce de visita, seguimiento, aprendiz, ficha, funcionario y empresa. Esas consultas deberían devolver solo las columnas que pinta la tabla y paginar. Hoy una ficha grande manda al navegador todos los seguimientos de una vez.

## Arreglar el historial antes de que crezca

Las tablas `procesos_fichas`, `procesos_aprendices`, `procesos_funcionarios` y `procesos_linea_red_tecnologica` tienen todas sus filas con `idproceso = 0` y no tienen llave primaria. Cada alta o edición intenta insertar otro historial. En PostgreSQL ese insert falla porque `idproceso` es obligatorio y no tiene valor automático. El historial ya no se está escribiendo. Hay que darles una secuencia y un índice por fecha. Sin eso, el módulo de historial va a quedar vacío a partir de la migración.

## Índices para lo que sí se filtra

Las búsquedas frecuentes son documento de aprendiz, número de ficha, correo de funcionario y aprendiz de un seguimiento. Conviene índice en `aprendiz.documento`, `ficha.numero_ficha`, `funcionario.email` y `seguimiento.aprendiz_idaprendiz`. `visita_seguimiento` se filtra por vencimiento y estado del reporte en los informes; un índice por `fecha_vencimiento, estado_reporte` evita recorrer la tabla completa cuando haya más visitas.

## Integridad que hoy revisa el código

`seguimiento`, `visita_seguimiento` y `empresa` no tienen llaves foráneas en PostgreSQL. El programa comprueba a mano que el aprendiz y la empresa existan antes de insertar. Una restricción en la base evita seguimientos huérfanos y permite borrar en cascada lo que hoy hace `certificarAprendizModelo` con varios `DELETE` seguidos.

## Archivos duplicados

`modelo/certificarAprendizModelo copy.php` repite la certificación y además guarda una clave de correo. El código vivo está en `certificarAprendizModelo.php`. El archivo copia solo confunde y no debe desplegarse.

## Fechas de vencimiento

PHP trabaja en `America/Bogota` y la base que está corriendo responde en `Etc/UTC`. Un informe de vencidos pedido cerca de la medianoche en Colombia puede contar el día siguiente. La zona de la base debería ser `America/Bogota`, que es lo que ya deja escrito el script de creación para una instalación nueva.

## Subida de archivos

Cada bitácora y cada reporte crean carpetas y mueven el archivo en el mismo request que escribe la base. Si el disco está lento, la pantalla se queda esperando. Guardar el archivo con un nombre único y registrar la ruta en una sola transacción, fuera del ciclo que arma correos, acorta la respuesta del instructor.

## Correos dentro del ciclo

`enviarSeguimientosModelo` arma un mensaje por destinatario dentro del recorrido de visitas. Conviene agrupar por instructor y enviar un solo correo con la tabla, que es lo que el asunto ya intenta decir ("seguimientos asignados del mes").
