<?php

$fichero_local = 'vista/recursos/contratoAprendizaje.zip'; //ruta al fichero en los directorios locales
$nombre_fichero = 'contratoAprendizaje.zip'; //nombre del fichero que se descargará el usuario
// header('Cache-control: private');
// header('Content-Type: application/octet-stream'); 
// header('Content-Length: '.filesize($fichero_local));
// header('Content-Disposition: filename='.$nombre_fichero);

if( file_exists($fichero_local ) && is_file($fichero_local) ) { //compruebo, por si acaso, que el fichero exista en el sistema
 
	// header('Cache-control: private');
	// header('Content-Type: application/octet-stream'); 
	// header('Content-Length: '.filesize($fichero_local));
	// header('Content-Disposition: filename='.$nombre_fichero);
 
    // flush content
    flush();
 
     //abrimos el fichero
     $file = fopen($fichero_local , "rb");
 
     //imprimimos el contenido del fichero al navegador
     print fread ($file, filesize($fichero_local )); 
 
     //cerramos el fichero abierto
     fclose($file);
 
} else {
 
    die('Error:  El fichero  '.$fichero_local .' no existe!');  //termino la ejecución de código por que el fichero no existe.
 
}