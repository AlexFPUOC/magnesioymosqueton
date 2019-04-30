<?php // Clase de la entidad tipoperfil de la base de datos. Falta el método update.

class Tipoperfil extends EntidadBase{
    private $idper, $perfil;
    
    public function __construct($adapter){
        $table="tipoperfil";
        parent::__construct($table,$adapter);
    }
    
    public function getIdper(){
        return $this->idper;
    }
    
    public function getPerfil(){
        return $this->perfil;
    }
    
    public function setIdper($idper){
        $this->idper=$idper;
    }
    
    public function setPerfil($perfil){
        $this->perfil=$perfil;
    }
    
    public function save() {
        $query="INSERT INTO tipoperfil (idper,perfil)
                VALUES (NULL,
                '".$this->perfil."');";
        
        $save=$this->db()->query($query);
                //$this->db()->error;
                return $save;
    }
    
}

