<?php
// Vaciar todas las variables de sesión
$_SESSION = array();

// Si quieres destruir también la cookie de sesión (para eliminar la sesión en el cliente)
// if (ini_get("session.use_cookies")) {
//     $params = session_get_cookie_params();
//     setcookie(session_name(), '', time() - 42000,
//         $params["path"], $params["domain"],
//         $params["secure"], $params["httponly"]
//     );
// }


session_destroy();

echo '<script>

	window.location = "inicio";

</script>';