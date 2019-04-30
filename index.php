<?php // Controlador frontal, única página que se visita.
require_once 'config/global.php';
require_once 'core/ControladorBase.php';
require_once 'core/ControladorFrontal.func.php';

if (isset($_GET["controller"])){
    $controllerObj=cargarControlador($_GET["controller"]);
    
}else{
    $controllerObj=cargarControlador(CONTROLADOR_DEFECTO);
}
lanzarAccion($controllerObj);

?>