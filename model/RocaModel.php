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
    
    //Método que comprueba si existen escuelas asociadas a un tipo de roca, de no haberlas es posible borrarlo, de lo contrario no se puede borrar.
    public function sirocaBorrable($id){
        $idroca=$id;
        $query=$this->ejecutarBorrarSql("SELECT * FROM escueladeescalada WHERE idroc=$idroca");
        // var_dump($query);
        if ($query->num_rows>0){
            return $query;
        } else{
        return false;
        }
    }
    
        //Método para recoger los datos del tipo de roca conociendo su id
    public function getcategoriaRocaById($id){
        $idroca=$id;
        $query=$this->ejecutarSql("SELECT * FROM $this->table WHERE idro=$idroca");
        if ($query){
            return $query;
        } else {
            var_dump($query);
        }
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
    
    public function modificarCategoriaRoca($id, $tiporoca){
        $idroca=$id;
        $roca=$tiporoca;
        $query=$this->ejecutarBorrarSql("UPDATE roca SET idro=$idroca, tiporoca='$roca' WHERE idro=$idroca");
        return $query;
    }
}
?>