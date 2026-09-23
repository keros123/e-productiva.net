# Compatibilidad con PostgreSQL

Comprobado contra la base `mromer04_dbsgdcomercio_pg` que está en uso (PostgreSQL 16). El proyecto ya no usa MySQL.

## Lo que ya funciona

- Las 32 tablas tienen el mismo número de filas que el origen MySQL.
- Existen las funciones `year`, `month` y `curdate`, así que las gráficas y el informe de vencidos pueden usar esas llamadas.
- La resta de intervalos en la recuperación de contraseña usa `INTERVAL '10 minutes'`, que es la forma válida en PostgreSQL.
- La comparación `estado_reporte < 1` se cambió por comparación de texto (`''` o `'0'`), porque `estado_reporte` es `varchar` y PostgreSQL no convierte solo ese texto a número.
- La comparación de `fecha_entrega` con `''` se quitó de la gráfica. La columna es `date` y una cadena vacía produce error de tipo.
- La consulta de fichas por certificar, que agrupa por las llaves de ficha, estado, programa y red, se ejecutó bien: PostgreSQL acepta el resto de columnas porque dependen de esas llaves primarias.
- `url_archivo_formato_165` quedó sin el tabulador que tenía el nombre en MySQL. El PHP ya usaba el nombre sin ese carácter.

## Fallos verificados en la base actual

### El historial no se puede insertar

`procesos_fichas`, `procesos_aprendices`, `procesos_funcionarios` y `procesos_linea_red_tecnologica` tienen `idproceso` obligatorio, sin secuencia y sin valor por defecto. Las 27, 21, 31 y 26 filas que vinieron de MySQL están todas con `idproceso = 0`. MySQL rellenaba ese entero con 0 cuando el INSERT no lo enviaba. PostgreSQL no lo hace.

Se probó el mismo INSERT que usa el programa:

```sql
INSERT INTO procesos_fichas (fecha_hora_proceso, responsable, proceso, descripcion_proceso)
VALUES (NOW(), 'prueba', 'prueba', 'prueba');
```

La base respondió: `null value in column "idproceso" of relation "procesos_fichas" violates not-null constraint`. No se guardó la fila. Cada alta o edición de ficha, aprendiz, funcionario o línea tecnológica va a fallar en el historial, aunque el registro principal sí se haya guardado si el código no aborta toda la transacción.

`procesos_empresas` y `procesos_seguimientos` sí tienen `idproceso` como identidad. Esos dos sí aceptan el INSERT sin ese campo.

### La zona horaria de la base en uso es UTC

`SHOW timezone` en `mromer04_dbsgdcomercio_pg` devuelve `Etc/UTC`. PHP fija `America/Bogota` al conectar desde la clase, pero cualquier cliente que no lo haga (informes, `psql`, tareas) calcula `NOW()` y `CURDATE()` cinco horas adelante. El script de `db/` ya deja `America/Bogota` al crear la base de nuevo; la base que está corriendo no se recreó, así que sigue en UTC.

### El cotejo de la base en uso no es el del script

La base actual está en `en_US.utf8` con proveedor libc. El script de creación, para una base nueva, pide UTF-8 e ICU `es-CO`. Los caracteres `ñ` y `ü` se guardan en las dos configuraciones. Lo que cambia es el orden: en español `ñ` va entre `n` y `o`. Un reporte ordenado por nombre no saldrá igual si se restaura el script en una base nueva y se compara con la base actual.

### Dos correos de funcionario no van a coincidir al entrar

El login pasa el correo a minúsculas y PostgreSQL compara con distinción de mayúsculas. Hay 2 filas en `funcionario` cuyo correo no es igual a su versión en minúsculas. Esas cuentas fallan el ingreso aunque la contraseña sea correcta. En el MySQL de origen el cotejo también era binario, así que el comportamiento se mantuvo; no es un fallo nuevo, pero queda confirmado en estos datos.

### Tablas de la operación sin llave foránea

En `pg_constraint` no hay llaves foráneas para `seguimiento`, `visita_seguimiento` ni `empresa`. Sí existen para aprendiz, ficha, bitácora, funcionario y certificación. Un `empresa_idempresa` o un `seguimiento_idseguimiento` inválido no lo rechaza la base. El borrado al certificar depende por completo del orden de los `DELETE` del PHP.

### Contraseña del funcionario corta

`funcionario.password` es `varchar(20)`. Una clave más larga se rechaza al guardar. La del aprendiz admite 45 caracteres. No es un error de sintaxis, pero un cambio de contraseña que en pantalla parezca válido puede fallar solo para funcionarios.

## Qué no hay que volver a escribir

No hace falta cambiar `LIMIT`, los `JOIN` ni los parámetros `:nombre` de PDO. Esos los acepta PostgreSQL. El punto que sí rompe procesos reales, y que se vio ejecutando el INSERT, es `idproceso` en cuatro tablas de historial.
