<?php // Clase de la que heredarán las demás clases de entidades de la base de datos
class EntidadBase{
    private $table, $db, $conectar;
    
    public function __construct($table, $adapter) {
        $this->table=(string) $table;
        /*
        require_once 'Conectar.php';
        $this->conectar= new Conectar();
        $this->db=$this->conectar->conexion();
        */
        $this->conectar=null;
        $this->db=$adapter;
    }
    
    public function getConectar() {
        return $this->conectar;
    }
    
    public function db(){
        return $this->db;
    }
    
    public function getAll() {
        $query=$this->db->query("SELECT * FROM $this->table");
        
        while($row = $query->fetch_object()){
            $resulSet[]=$row;
        }
        
        return $resulSet;
    }
    
    // Este método está sobreescrito en las entidades cuyo campo id tiene un nombre diferente.
    public function getById($id) {
        $query=$this->db->query("SELECT * FROM $this->table WHERE id=$id");
        
        if ($row=$query->fetch_object()) {
            $resulSet=$row;
        }
        
        return $resulSet;
    }
    
    public function getBy($column, $value) {
        $query= $this->db->query("SELECT * FROM $this->table WHERE $column='$value'");
        
        while($row = $query->fetch_object()){
            $resulSet[]=$row;
        }
        
        return $resulSet;
    }
    
    // Este método está sobreescrito en las entidades cuyo campo id tiene un nombre diferente.
    public function deleteById($id) {
        $query=$this->db->query("DELETE FROM $this->table WHERE id=$id");
        return $query;
    }
    
    public function deleteBy($column, $value) {
        $query=$this->db->query("DELETE FROM $this->table WHERE $column='$value'");
        return $query;
    }
}
?>