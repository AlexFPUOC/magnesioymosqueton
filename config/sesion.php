<?php if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if ((isset($_SESSION["IdUsuario"]) && !empty($_SESSION["IdUsuario"])) && (isset($_SESSION["IdClave"])) && (!empty($_SESSION["IdClave"]))) {
    $sesionabierta=true;
//    echo "apodo = ".$_SESSION["IdUsuario"];
//    echo " password = ".$_SESSION["IdClave"];
//    echo " tipoperfil = ".$_SESSION["IdPerfil"];
//    echo " fecha = ".$_SESSION["IdFech_reg"];
//    echo " Id = ".$_SESSION["IdId"];
//    echo " eliminado = ".$_SESSION["IdEliminado"];
} else {
    $sesionabierta=false;
}
?>