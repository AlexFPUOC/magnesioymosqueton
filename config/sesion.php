<?php session_start();
if ((isset($_SESSION["idUsuario"]) && !empty($_SESSION["idUsuario"])) && (isset($_SESSION["idClave"])) && (!empty($_SESSION["idClave"]))) {
$usuar=$_SESSION["idUsuario"];
}
?>