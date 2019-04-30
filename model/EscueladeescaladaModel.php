<?php //Clase para las consultas a la tabla Escueladeescalada
class EscueladeescaladaModel extends ModeloBase{
    private $table;
    
    public function __construct($adapter){
        $this->table="escueladeescalada";
        parent::__construct($this->table,$adapter);
    }
}
?>