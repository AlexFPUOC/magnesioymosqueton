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
    
    
            //Método para recoger los datos del usuario conociendo su id
    public function getUsuarioById($id){
        $iduser=$id;
        $query=$this->ejecutarSql("SELECT * FROM $this->table WHERE idusuario=$iduser");
        if ($query){
            return $query;
        } else {
            var_dump($query);
        }
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
    
        public function siusuarioBorrable($dato){
        $iduser=$dato;
        $admin=4;
        $query=$this->ejecutarBorrarSql("SELECT * FROM valoraciones WHERE usuario=$iduser");
        // var_dump($query);
        if ($query->num_rows>0){
            return $query;
        } else{
        $query2=$this->ejecutarBorrarSql("SELECT * FROM usuario WHERE usuario=$iduser AND idperfil=$admin");
            if ($query2){
                return $query2;
            } else {
        return false;
                }
        }
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
            return $query;
        } else {
            return false;
        }
    }
    public function modificarUsuario($idu, $idp, $fec, $pas, $apo, $eli){
        $idusuario=$idu;
        $idperfil=$idp;
        $fech_reg=$fec;
        $password=$pas;
        $apodo=$apo;
        $eliminado=$eli;
        $query=$this->ejecutarBorrarSql("UPDATE usuario SET idusuario=$idusuario, idperfil=$idperfil, fech_reg='$fech_reg', password='$password', apodo='$apodo', eliminado=$eliminado WHERE idusuario=$idusuario");
        return $query;
    } 
    public function modificarPerfilUsuario($id,$idperfil){
        $idusuario=$id;
        $idperfil=$idperfil;
        $query=$this->ejecutarBorrarSql("UPDATE usuario SET idperfil=$idperfil WHERE idusuario=$idusuario");
        return $query;
    }
    
    public function modificarBorradoTotal($id, $apo) {
        $apodo=$apo." Eliminado";
        $eliminado=1;
        $idusuario=$id;
        $query=$this->ejecutarBorrarSql("UPDATE usuario SET apodo='$apodo', eliminado=$eliminado WHERE idusuario=$idusuario");
        return $query;
    }
}
?>