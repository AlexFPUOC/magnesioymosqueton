<?php // Clase de la entidad roca de la base de datos. Falta el método update.

class Roca extends EntidadBase{
    private $idro, $tiproca;
        
    public function __construct($adapter){
        $table="roca";
        parent::__construct($table,$adapter);
    }
    
    public function getIdro(){
        return $this->idro;
    }
    
    public function getTiporoca(){
        return $this->Tiporoca;
    }
    
    public function setIdro($idro){
        $this->idro=$idro;
    }
    
    public function setTiporoca($tiporoca){
        $this->tiporoca=$tiporoca;
    }
    
    public function save() {
        $query="INSERT INTO roca (idro,tiporoca)
                VALUES (NULL,
                '".$this->tiporoca."');";
        
        $save=$this->db()->query($query);
                //$this->db()->error;
                return $save;
    }
}