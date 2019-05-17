<?php //Clase para las consultas a la tabla Escueladeescalada
class EscueladeescaladaModel extends ModeloBase{
    private $table;
    
    public function __construct($adapter){
        $this->table="escueladeescalada";
        parent::__construct($this->table,$adapter);
    }
    
     // Método para recoger los valores de la escuela de escalada para los filtros de la lista de selección dinámica.
    public function getEscuelas(){
        $query=$this->ejecutarSql("SELECT escuela FROM $this->table");
        
        while($row = $query->fetch_object()){
            $resulSet[]=$row;
        }
    }

// Método para recoger el id de las escuelas correspondientes a un determinado tipo de roca.
    public function getEscuelasByRoc($idroca) {
        $idroc=$idroca;
        // $debuggeando="SELECT ides FROM $this->table WHERE idroc=$idroc";
        // echo "Hacemos la consulta a base de datos = ".$debuggeando;
        $query=$this->ejecutarSql("SELECT ides FROM $this->table WHERE idroc=$idroc");
        // print_r($query);
        return $query;
}
    public function getEscuelaById($idesc) {
        $idescuela=$idesc;
        if (is_array($idescuela)){
        foreach ($idescuela as $thing => $datoescuela){
            $query1 = $datoescuela->idesc;
        }
        $query=$this->ejecutarSql("SELECT * FROM $this->table WHERE ides=$query1");
        return $query;
        }
    }
}
?>