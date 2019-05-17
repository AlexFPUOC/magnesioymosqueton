<?php //Clase para las consultas a la tabla Valoraciones
class ValoracionesModel extends ModeloBase{
    private $table;
    
    public function __construct($adapter){
        $this->table="valoraciones";
        parent::__construct($this->table,$adapter);
    }
    
    public function getValoracionesByIdProducto($product) {
        $idproducto=$product;
        if (is_array($idproducto)){
        foreach ($idproducto as $thing => $datoproducto){
            $query1 = $datoproducto->idpro;
        }
        }
        $query=$this->ejecutarSql("SELECT * FROM $this->table WHERE product=$idproducto");
        return $query;
    }
}

?>