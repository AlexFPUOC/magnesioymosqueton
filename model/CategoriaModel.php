<?php //Clase para las consultas a la tabla Categoria
class CategoriaModel extends ModeloBase{
    private $table;
    
    public function __construct($adapter){
        $this->table="categoria";
        parent::__construct($this->table,$adapter);
    }
}
?>