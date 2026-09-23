# Flujos de trabajo

SGD de etapa productiva (SGDCIMM). PHP con entrada en `index.php`, pantalla en `vista/plantilla.php` y acceso a datos en `modelo/` mediante `Conexion`. La sesión guarda el tipo de usuario y con eso se arma el menú y las rutas permitidas.

## Roles

| Tipo de sesión | Quién es | Pantalla de inicio |
|---|---|---|
| 1 | Instructor | Seguimientos programados y búsqueda de aprendiz |
| 2 | Administrativo | Panel completo: fichas, aprendices, funcionarios, empresas, historiales e informes |
| 3 | Caprendizaje | Empresas y seguimientos |
| 4 | Admin de seguimientos | Operación de fichas, aprendices y seguimientos, sin historiales de línea |
| 5 | Certificación | Fichas por certificar, aprendices certificados y por certificar |
| 6 | Coordinación académica | Consulta de fichas, funcionarios e informes |
| 7 | Formato 165 | Fichas y formato del aprendiz |
| 10 | Aprendiz en etapa productiva | Bitácoras, seguimientos asignados, certificación y archivo |
| 11 | Aprendiz ya certificado | Solo cierre de sesión |

El menú de cada rol está en `vista/modulos/CL_menu.php`. La lista blanca de rutas está en `vista/plantilla.php`. Los archivos `control/*.php` no repiten esa lista: comprueban que haya sesión y atienden el POST.

## Ingreso

1. El login distingue funcionario y aprendiz.
2. El funcionario entra con correo y contraseña contra `funcionario`. Si `ingreso` es `2`, la cuenta está inhabilitada.
3. El aprendiz entra con tipo de documento, número, ficha y contraseña. Si no coincide, se intenta el mismo documento en `aprendices_certificados` y, si cuadra, la sesión queda como tipo 11.
4. La contraseña del funcionario nuevo se guarda igual al número de documento.

## Fichas y aprendices

1. El administrativo crea la ficha (número, caracterización, fechas, programa, red tecnológica y estado).
2. Carga aprendices uno a uno o por archivo masivo. Cada aprendiz queda ligado a una ficha, un estado y una contraseña.
3. Asigna instructores a la ficha en `ficha_has_funcionario`.
4. El instructor consulta los aprendices de sus fichas y puede registrar el aval.

## Etapa productiva y seguimientos

1. Se registra la práctica en `seguimiento`: fechas, modalidad, empresa y si la etapa es parcial, final, abierta, cerrada o fragmentada.
2. Sobre ese seguimiento se programan visitas en `visita_seguimiento`: tipo, instructor, fechas de radicación y vencimiento, dirección y estado del reporte.
3. El instructor ve las visitas en Seguimientos programados y sube el reporte y el juicio evaluativo.
4. Certificación o el administrativo revisan el reporte: entregado, aprobado o rechazado.
5. Los informes de vencidos comparan `fecha_vencimiento` con la fecha actual y el estado del reporte.

## Bitácoras

Solo el aprendiz tiene la pantalla Bitácoras. El instructor las ve desde la ficha del aprendiz y cambia su estado.

Estados:

| Estado | Significado | Paso siguiente permitido |
|---|---|---|
| 0 | Sin entregar | Entregada |
| 1 | Entregada | Aprobada o rechazada |
| 2 | Aprobada | Ninguno |
| 3 | Rechazada | Volver a entregada, si ya hay archivo |

1. El aprendiz registra empresa, jefe y fechas de la práctica.
2. Sube el archivo (PDF o Excel, hasta 5 MB). Al subirlo, la bitácora pasa a entregada.
3. El instructor, desde el detalle del aprendiz, aprueba o rechaza. El rechazo exige una novedad y envía correo al aprendiz.
4. El aprendiz corrige el archivo y la vuelve a entregar.
5. Al programar seguimientos, el sistema cuenta bitácoras entregadas y aprobadas y avisa al instructor si van por debajo del cronograma.

## Certificación

1. El aprendiz radica documentos de certificación.
2. Certificación revisa fichas cuyos aprendices están en estado de certificar.
3. Al certificar se copia el resumen a `aprendices_certificados` y se retiran de la operación activa las bitácoras, seguimientos y la ficha de aprendiz.
4. Esa persona puede volver a entrar solo como aprendiz certificado.

## Historial

Cada alta, edición o borrado de fichas, aprendices, funcionarios, empresas, seguimientos y líneas tecnológicas deja una fila en las tablas `procesos_*` con fecha, responsable, acción y descripción.
