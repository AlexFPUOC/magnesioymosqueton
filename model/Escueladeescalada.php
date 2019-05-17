<?php // Clase de la entidad escueladeescalada de la base de datos. Falta el método update.

class Escueladeescalada extends EntidadBase{
    private $ides, $escuela, $idroc;
        
    public function __construct($adapter){
        $table="escueladeescalada";
        parent::__construct($table,$adapter);
    }
    
    public function getIdes(){
        return $this->ides;
    }
    
    public function getEscuela(){
        return $this->escuela;
    }
    
    public function getIdroc(){
        return $this->idroc;
    }
    
    public function setIdes($ides){
        $this->ides=$ides;
    }
    
    public function setEscuela($escuela){
        $this->escuela=$escuela;
    }
    
    public function setIdroc($idroc){
        $this->idroc=$idroc;
    }
    

    public function save() {
        $query="INSERT INTO escueladescalada (ides,escuela,idroc)
                VALUES (NULL,
                '".$this->escuela."',
                '".$this->idroc."');";
        
        $save=$this->db()->query($query);
                //$this->db()->error;
                return $save;
    }
}