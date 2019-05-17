<?php //Clase para las consultas a la tabla Producto
class ProductoModel extends ModeloBase{
    private $table;
    
    public function __construct($adapter){
        $this->table="producto";
        parent::__construct($this->table,$adapter);
    }
    
    // Método sobreescrito
    public function deleteById($idpro) {
        $query=$this->ejecutarBorrarSql("DELETE FROM $this->table WHERE idpro=$idpro");
        return $query;
    }
    // Método para recoger los datos de un determinado producto conociendo su id
    public function getProductoById($idpro){
        $idproducto=$idpro;
        $query=$this->ejecutarSql("SELECT * FROM $this->table WHERE idpro=$idproducto");
        return $query;
    }
    
    public function getIdcatgById($idpro){
        $idproducto=$idpro;
        $query=$this->ejecutarSql("SELECT idcatg FROM $this->table WHERE idpro=$idproducto");
        return $query;
    }
    
    // Método para recoger los valores de dificultad para los filtros de la lista de selección dinámica.
    public function getDificultades(){
        $query=$this->ejecutarSql("SELECT DISTINCT dificultad FROM $this->table");
        
       return $query;
    }
    //Método que recoge un array o un objeto con el id de los sectores asociadas a un determinado tipo de roca y que devuelve los productos asociados.
    public function getProductosBySector($datos) {
        $idproductos=$datos;
        $contador=0;
        $query1="";
        if (is_array($idproductos)){
            foreach ($idproductos as $valor => $datosector){
                if ($contador==0){
                $query1 = $datosector->idsector;
                }
                if ($contador>0){
                    $query1=$query1." OR idcatg= ".$datosector->idsector;
                }
                $contador++;
            }
            // echo $contador." ".$query1;
        } else {
            foreach ($idproductos as $valor){
                if ($contador==0){
                $query1 = $valor->idsector;
                }
                if ($contador>0){
                    $query1=$query1." OR idcatg= ".$valor->idsector;
                }
                $contador++;
            }
            
        }
        // echo "Consulta Producto: SELECT * FROM ".$this->table." WHERE idcatg=".$query1;
        $query=$this->ejecutarSql("SELECT * FROM $this->table WHERE idcatg=$query1");
        return $query;
    }
}

?>