<?php //Clase para las consultas a la tabla Roca
class RocaModel extends ModeloBase{
    private $table;
    
    public function __construct($adapter){
        $this->table="roca";
        parent::__construct($this->table,$adapter);
    }
    
    // Método para recoger los valores del tipo de roca para los filtros de la lista de selección dinámica.
    public function getTiposroca(){
        $query=$this->ejecutarSql("SELECT tiporoca FROM $this->table");
        
        while($row = $query->fetch_object()){
            $resulSet[]=$row;
        }
        return $resulSet;
    }
    public function getRocaById($idroc) {
        $idroca=$idroc;
        if (is_array($idroca)){
        foreach ($idroca as $thing => $datoroca){
            $query1 = $datoroca->idroc;
        }
        $query=$this->ejecutarSql("SELECT * FROM $this->table WHERE idro=$query1");
        return $query;
        }
    }
}
?>