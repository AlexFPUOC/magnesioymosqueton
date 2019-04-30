<?php //Clase para las consultas a la tabla Roca
class RocaModel extends ModeloBase{
    private $table;
    
    public function __construct($adapter){
        $this->table="roca";
        parent::__construct($this->table,$adapter);
    }
}
?>