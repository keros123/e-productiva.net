# Quitar el rol aprendiz y pasar la carga de bitácoras al instructor

Hoy el aprendiz (sesión tipo 10) es quien crea la bitácora y sube el archivo. El instructor (tipo 1) solo la consulta desde el detalle del aprendiz y la aprueba o la rechaza. Este documento describe los pasos para invertir esa carga, sin aplicarlos todavía.

## Qué hay que conservar

La tabla `bitacora` sigue sirviendo. El aprendiz sigue existiendo como persona en `aprendiz`; lo que se elimina es su acceso a la aplicación. Los estados 0, 1, 2 y 3 pueden mantenerse: el instructor deja la bitácora en entregada al subir el archivo y otro perfil (administrativo o certificación) la aprueba o la rechaza. Si el mismo instructor aprueba lo que él subió, el control queda en una sola persona.

## Pasos

1. **Cerrar el ingreso del aprendiz.** En `modelo/usuarioModelo.php`, `mdlAutenticarAprendiz` no debe abrir sesión tipo 10. Decidir aparte el tipo 11 (aprendiz certificado): hoy entra con documento, ficha y contraseña y no carga bitácoras.
2. **Sacar las rutas del aprendiz.** En `vista/plantilla.php`, quitar el arreglo del tipo 10 (`bitacoras`, `seguimientosAsignados`, `certificacion`, `archivoAprendiz`). En `vista/modulos/CL_menu.php`, dejar de pintar `MenuAprendiz`.
3. **Dar la pantalla al instructor.** Agregar `bitacoras` a las rutas del tipo 1 y un enlace en `MenuInstructor`. La pantalla debe pedir primero la ficha y el aprendiz; el instructor no tiene un `$_SESSION["id"]` de aprendiz.
4. **Atar la bitácora al aprendiz elegido, no a la sesión.** `control/bitacorasControl.php` hoy toma `$_POST["aprendiz"]`. Hay que comprobar que ese aprendiz pertenece a una ficha asignada al instructor en `ficha_has_funcionario` antes de registrar, editar o subir el archivo.
5. **Reutilizar la subida.** `modelo/bitacorasModelo.php` ya guarda el PDF o Excel y marca estado 1. El instructor puede usar ese mismo método. El correo de rechazo hoy va al aprendiz; si el aprendiz ya no entra, el aviso debe ir al instructor responsable o al administrativo.
6. **Separar quien carga de quien aprueba.** `mdlCambiarEstadoBitacora` no mira el rol. Conviene que el instructor pueda dejarla en entregada y que solo administrativo, admin de seguimientos o certificación pasen a aprobada o rechazada.
7. **Seguimientos y formato 165.** Esas pantallas también son del aprendiz (`seguimientosAsignados`, `archivoAprendiz`, `certificacion`). Hay que decidir si el instructor sube también el reporte de visita y el formato 165, o si eso sigue en certificación. Si no se decide, al quitar el rol 10 esos documentos dejan de tener quien los cargue.
8. **Datos ya cargados.** Las bitácoras actuales no se migran de tabla. Solo cambia quién puede crear las nuevas. Las contraseñas de `aprendiz` pueden dejarse de usar; no hace falta borrar la columna el primer día.
9. **Probar con un instructor de una ficha real.** Crear una bitácora de un aprendiz de su ficha, rechazar la subida de un aprendiz de otra ficha, aprobar con un usuario administrativo y confirmar que un intento de login de aprendiz ya no abre sesión.

## Archivos que concentra el cambio

- `modelo/usuarioModelo.php`
- `vista/plantilla.php`
- `vista/modulos/CL_menu.php`
- `vista/modulos/bitacoras.php`
- `assets/js/cl_bitacoras.js`
- `control/bitacorasControl.php`
- `modelo/bitacorasModelo.php`
- `assets/js/cl_detallesUsuario.js` (aprobación desde el detalle)
