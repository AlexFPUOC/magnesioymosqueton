<?php //Clase para ejecutar consultas y recuperar resultado. Se pueden incluir más métodos de consulta.

class ModeloBase extends EntidadBase {
    private $table;
    
    public function __construct($table, $adapter) {
        $this->table = (string) $table;
        parent::__construct($table, $adapter);
    }
    
    public function ejecutarBorrarSql($query){
        $query=$this->db()->query($query);
    }
    
    public function ejecutarSql($query){
       
        $query=$this->db()->query($query);
        
        if ($query){
            if ($query->num_rows>1){
                while($row=$query->fetch_object()){
                    $resultSet[]=$row;
                }
            } elseif($query->num_rows==1) {
                if ($row=$query->fetch_object()){
                    // Probamos a dejarlos todos como arrays para poder usarlos en las vistas sin errores
                    $resultSet[]=$row;
                }
            }else{
                $resultSet=0;
            }
        } else {
            $resultSet=false;
        }
       //  print_r($resulSet);
        return $resultSet;
    }
}
?>