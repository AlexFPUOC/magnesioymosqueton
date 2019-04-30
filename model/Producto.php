<?php // Clase de la entidad producto de la base de datos. Falta el método update.

class Producto extends EntidadBase{
    private $idpro, $idcatg, $nombre, $responsable, $img_via, $seguros, $dificultad, $descripcion;
    
    public function __construct($adapter){
        $table="producto";
        parent::__construct($table,$adapter);
    }
    
    public function setDescripcion($descripcion){
        $this->descripcion=$descripcion;
    }
    
    public function getDescripcion(){
        return $this->descripcion;
    }
    
    public function setDificultad($dificultad){
        $this->dificultad=$dificultad;
    }
    
    public function getDificultad(){
        return $this->dificultad;
    }
    
    public function setSeguros($seguros){
        $this->seguros=$seguros;
    }
    
    public function getSeguros(){
        return $this->seguros;
    }
    
    public function setImg_via($img_via){
        $this->img_via=$img_via;
    }
    
    public function getImg_via(){
        return $this->img_via;
    }
    
    public function setResponsable($responsable){
        $this->responsable=$responsable;
    }
    
    public function getResponsable(){
        return $this->responsable;
    }
    
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }
    
    public function getNombre(){
        return $this->nombre;
    }
    
    public function setIdcatg($idcatg){
        $this->idcatg=$idcatg;
    }
    
    public function getIdcatg() {
        return $this->idcatg;
    }
    
    public function setIdpro($idpro){
        $this->idpro=$idpro;
    }
    
    public function getIdpro(){
        return $this->idpro;
    }
    
    // Método sobreescrito
    public function deleteById($idpro) {
        $query=$this->db->query("DELETE FROM $this->table WHERE idpro=$idpro");
        return $query;
    }
    
    public function save(){
        $query="INSERT INTO producto (idpro,idcatg,nombre,responsable,img_via,seguros,dificultad,descripcion)
                VALUES (NULL,
                '".$this->idcatg."',
                '".$this->nombre."',
                '".$this->responsable."',
                '".$this->img_via."',
                '".$this->seguros."',
                '".$this->dificultad."',
                '".$this->descripcion."');";
        $save=$this->db()->query($query);
        //$this->db()->error;
        return $save;
    }
}
?>