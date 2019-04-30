<?php // Clase que genera la url para llamar al controlador y a la accion por defecto desde el controlador frontal.
class AyudaVistas{
    public function url($controlador=CONTROLADOR_DEFECTO,$accion=ACCION_DEFECTO) {
        $urlString="index.php?controller=".$controlador."&action=".$accion;
        return $urlString;
    }
}
?>