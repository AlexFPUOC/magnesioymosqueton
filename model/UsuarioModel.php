<?php // Clase para las consultas a la tabla usuario
class UsuarioModel extends ModeloBase{
    private $table;
    
    public function __construct($adapter){
        $this->table = "usuario";
        parent::__construct($this->table, $adapter);
    }
    
    public function getAdmin() {
        $query="SELECT * FROM usuario WHERE idperfil='4'";
        $usuario=$this->ejecutarSQL($query);
        return $usuario;
    }
    
    public function getUsuariosByValoraciones($datos) {
        $idvaloraciones=$datos;
        $contador=0;
        if (is_array($idvaloraciones)){
        foreach ($idvaloraciones as $thing => $datovaloracion){
            if ($contador==0){
            $query1 = $datovaloracion->usuario;
            }
            if ($contador>0){
                $query1=$query1." OR idusuario= ".$datovaloracion->usuario;
            }
            
            $contador++;
        }
            // echo $contador." ".$query1;
        } else {
            // var_dump($idvaloraciones);
        foreach ($idvaloraciones as $thing => $datovaloracion){
            if ($contador==0){
            $query1 = $datovaloracion;
            }
            if ($contador>0){
                $query1=$query1." OR idusuario= ".$datovaloracion;
            }
            $contador++;
        }
        }
       // echo "Consulta Usuarios: SELECT * FROM ".$this->table." WHERE idusuario= ".$query1;
       $query=$this->ejecutarSql("SELECT * FROM $this->table WHERE idusuario=$query1");
       return $query;
    }
    
    public function comprobarUsuario($dato) {
        $nombre=$dato;
        // echo "El dato que llega a comprobarUsuario es".$nombre;
        if ($query=$this->ejecutarSql("SELECT * FROM $this->table WHERE apodo='$dato'")){
            // var_dump($query);
            return true;
        } else {
            // var_dump($query);
            return false;
        }
    }
    
    public function comprobarPassword($password, $usuario) {
        $nombre=$usuario;
        $clave=$password;
        if ($query=$this->ejecutarSql("SELECT * FROM $this->table WHERE apodo='$nombre' AND password='$clave'")) {
            return true;
        } else {
            return false;
        }
    }
        
}
?>