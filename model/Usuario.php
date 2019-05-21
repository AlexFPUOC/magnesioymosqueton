<?php // Clase de la entidad usuario de la base de datos. Falta el método update.
class Usuario extends EntidadBase{
    private $idusuario, $idperfil, $fech_reg, $password, $apodo, $eliminado; 
    
    public function __construct($adapter) {
        $table='usuario';
        parent::__construct($table, $adapter);
    }
    
    public function getIdusuario() {
        return $this->idusuario;
    }
    
    public function getIdperfil() {
        return $this->idperfil;
    }
    
    public function getFech_reg() {
        return $this->fech_reg;
    }
    
    public function getPassword(){
        return $this->password;
    }
    
    public function getApodo() {
        return $this->apodo;
    }
    
    public function getEliminado() {
        return $this->elminado;
    }
    
    public function setIdusuario($idusuario) {
        $this->idusuario=$idusuario;
    }
    
    public function setIdperfil($idperfil) {
        $this->idperfil=$idperfil;
    }
    
    public function setFech_reg($fech_reg) {
        $this->fech_reg=$fech_reg;
    }
    
    public function setPassword($password) {
        $this->password=$password;
    }
    
    public function setApodo($apodo) {
        $this->apodo=$apodo;
    }
    
    public function setEliminado($eliminado) {
        $this->eliminado=$eliminado;
    }
    
    //Convertir la fecha date de mySQL al valor de uso en vistas
    public function dateVista($amd) {
    list($a,$m,$d) = explode('-', $amd);
    return "$d-$m-$a";
    }
    //Método para recoger los datos ordenados
        public function getAllOrder() {
        $query=$this->db->query("SELECT * FROM $this->table ORDER BY idusuario");
        
        while($row = $query->fetch_object()){
            $resulSet[]=$row;
        }
        
        return $resulSet;
    }
    
    //Convertir la fecha que recogemos en el formulario al formato date de mySQL
    function dateMysql($dma) {
    list($d,$m,$a) = explode('-', $dma);
    return "$a-$m-$d";
    }
    
    public function save(){
        $date=$this->dateMysql($this->fech_reg);
        $this->setFech_reg($date);
        // echo $date."=".$this->fech_reg;
        $query="INSERT INTO usuario(idusuario, idperfil, fech_reg, password, apodo, eliminado) "
            ."VALUES (NULL," 
            ."'".$this->idperfil."',"
            ."'".$this->fech_reg."',"
            ."'".$this->password."',"
            ."'".$this->apodo."',"
            ."'".$this->eliminado."'"
            .");";
        // echo $query;
        $save=$this->db()->query($query);
        return $save;
    }
    
}
?>