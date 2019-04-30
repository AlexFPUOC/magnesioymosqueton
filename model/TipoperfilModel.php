<?php //Clase para las consultas a la tabla Tipoperfil
class TipoperfilModel extends ModeloBase{
    private $table;
    
    public function __construct($adapter){
        $this->table="tipoperfil";
        parent::__construct($this->table,$adapter);
    }
}

?>