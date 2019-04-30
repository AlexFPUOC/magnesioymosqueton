<?php // Clase controlador de la que heredarán el resto de controladores.

class ControladorBase{
    
    public function __construct() {
        require_once 'Conectar.php';
        require_once 'EntidadBase.php';
        require_once 'ModeloBase.php';
        // Recorre el directorio model y hace un require_once de todos los archivos php que encuentra.
        foreach (glob("model/*.php") as $file) {
            require_once $file;
        }
    }
    
    public function view($vista,$datos){
        foreach($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor;
        }
        
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
        
        require_once 'view/'.$vista.'View.php';
    }
    
    public function redirect($controlador=CONTROLADOR_DEFECTO, $accion=ACCION_DEFECTO){
        header("Location:index.php?controller=".$controlador."&action=".$accion);
    }
}
?>