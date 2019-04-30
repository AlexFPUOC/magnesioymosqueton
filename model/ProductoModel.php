<?php //Clase para las consultas a la tabla Producto
class ProductoModel extends ModeloBase{
    private $table;
    
    public function __construct($adapter){
        $this->table="producto";
        parent::__construct($this->table,$adapter);
    }
}

?>