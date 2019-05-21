<?php //Clase para las consultas a la tabla Categoria
class CategoriaModel extends ModeloBase{
    private $table;
    
    public function __construct($adapter){
        $this->table="categoria";
        parent::__construct($this->table,$adapter);
    }
    //Método que recoge el id de una escuela y que devuelve los id de los sectores asociados.
    public function getSectoresByEscuela($dato){
        $idescuela=$dato;
        $query=$this->ejecutarSql("SELECT idsector FROM $this->table WHERE idesc=$idescuela");
        return $query;
    }
    
    //Método que comprueba si existen productos asociados a un sector, de no haberlos es posible borrarlo, de lo contrario no se puede borrar.
    public function sisectorBorrable($dato){
        $idsector=$dato;
        $query=$this->ejecutarBorrarSql("SELECT * FROM producto WHERE idcatg=$idsector");
        // var_dump($query);
        if ($query->num_rows>0){
            return $query;
        } else{
        return false;
            }
    }
    //Método que recoge un array que contiene el id de las escuelas asociadas a un determinado tipo de roca y que devuelve los id de los sectores asociados.
    public function getSectoresByEscuelas($datos) {
        $idescuelas=$datos;
        $contador=0;
        if (is_array($idescuelas)){
        foreach ($idescuelas as $thing => $datoescuela){
            if ($contador==0){
            $query1 = $datoescuela->ides;
            }
            if ($contador>0){
                $query1=$query1." OR idesc= ".$datoescuela->ides;
            }
            
            $contador++;
        }
            // echo $contador." ".$query1;
        } else {
        foreach ($idescuelas as $thing => $datoescuela){
            if ($contador==0){
            $query1 = $datoescuela;
            }
            if ($contador>0){
                $query1=$query1." OR idesc= ".$datoescuela;
            }
            $contador++;
        }
        }
       // echo "Consulta Sectores: SELECT idsector FROM ".$this->table." WHERE idesc= ".$query1;
       $query=$this->ejecutarSql("SELECT idsector FROM $this->table WHERE idesc=$query1");
       return $query;
    }
    //Método para recoger los datos del sector conociendo su id
    public function getSectorById($id){
        $idcate=$id;
        $query=$this->ejecutarSql("SELECT * FROM $this->table WHERE idsector=$idcate");
        if ($query){
            return $query;
        } else {
            var_dump($query);
        }
    }
    // Método para recoger los id de los sectores asociados a las escuelas.
    public function getCategoriaById($idsec) {
        $idcatego=$idsec;
        // var_dump($idcatego);
        if (is_array($idcatego)){
        foreach ($idcatego as $thing => $datosector){
            $query1 = $datosector->idcatg;
        }
        $query=$this->ejecutarSql("SELECT * FROM $this->table WHERE idsector=$query1");
        // var_dump($query);
        return $query;
        }
    }
    
    public function modificarCategoriaSector($sector, $escuela, $id){
        $nombre=$sector;
        $idescuela=$escuela;
        $iddelsector=$id;
        $query=$this->ejecutarBorrarSql("UPDATE categoria SET idsector=$iddelsector, sector='$nombre', idesc=$idescuela WHERE idsector=$iddelsector");
        return $query;
    }
    
    /*public function debugDatos($datos) {
        $debug=$datos;
        foreach ($debug as $valor) {
            echo $valor;
        }
    }*/
}
?>