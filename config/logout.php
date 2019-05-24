<?php if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
//destruye las variables de sesión.
session_destroy();			
?>