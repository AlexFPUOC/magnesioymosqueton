<?php // Clase de la entidad valoraciones de la base de datos. Falta el método update.

class Valoraciones extends EntidadBase{
    private $idval, $product, $usuario, $reportado, $puntuacion, $votos, $comentario;
    
    public function __construct($adapter){
        $table="valoraciones";
        parent::__construct($table,$adapter);
    }
    
    public function setComentario($comentario){
        $this->comentario=$comentario;
    }
    
    public function getComentario(){
        return $this->comentario;
    }
    
    public function setVotos($votos){
        $this->votos=$votos;
    }
    
    public function getVotos() {
        return $this->votos;
    }
    
    public function setPuntuacion($puntuacion){
        $this->puntuacion=$puntuacion;
    }
    
    public function getPuntuacion(){
        return $this->puntuacion;
    }
    
    public function setReportado($reportado){
        $this->reportado=$reportado;
    }
    
    public function getReportado(){
        return $this->reportado;
    }
    
    public function setUsuario($usuario){
        $this->usuario=$usuario;
    }
    
    public function getUsuario(){
        return $this->usuario;
    }
    
    public function setProduct($product){
        $this->product=$product;
    }
    
    public function getProduct(){
        return $this->product;
    }
    
    public function setIdval($idval){
        $this->idval=$idval;
    }
    
    public function getIdval(){
        return $this->idval;
    }
    //Método para recoger los datos ordenados
    public function getAllOrder() {
        $query=$this->db->query("SELECT * FROM $this->table ORDER BY usuario");
        
        while($row = $query->fetch_object()){
            $resulSet[]=$row;
        }
        
        return $resulSet;
    }
   public function save(){
        $query="INSERT INTO valoraciones (idval,product,usuario,reportado,puntuacion,votos,comentario)
                VALUES (NULL,
                '".$this->product."',
                '".$this->usuario."',
                '".$this->reportado."',
                '".$this->puntuacion."',
                '".$this->votos."',
                '".$this->comentario."');";
                $save=$this->db()->query($query);
                //$this->db()->error;
                return $save;
    }
}