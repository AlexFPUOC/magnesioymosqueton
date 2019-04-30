<?php //Clase para las consultas a la tabla Valoraciones
class ValoracionesModel extends ModeloBase{
    private $table;
    
    public function __construct($adapter){
        $this->table="valoraciones";
        parent::__construct($this->table,$adapter);
    }
}

?>