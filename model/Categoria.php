<?php // Clase de la entidad categoria de la base de datos. Falta el método update.

class Categoria extends EntidadBase{
    private $idsector, $sector, $idesc;
    
    public function __construct($adapter){
        $table="categoria";
        parent::__construct($table,$adapter);
    }
    
    public function getIdsector(){
        return $this->idsector;
    }
    
    public function getSector(){
        return $this->sector;
    }
    
    public function getIdesc(){
        return $this->idesc;
    }
    
    public function setIdsector($idsector){
        $this->idsector=$idsector;
    }
    
    public function setSector($sector){
        $this->sector=$sector;
    }
    
    public function setIdesc($idesc){
        $this->idesc=$idesc;
    }
    
    public function save() {
        $query="INSERT INTO categoria (idsector,sector,idesc)
                VALUES (NULL,
                '".$this->sector."',
                '".$this->idesc."');";
        
        $save=$this->db()->query($query);
                //$this->db()->error;
                return $save;
    }
}