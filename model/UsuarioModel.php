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
// Método que compara dos fechas, las resta y devuelve los días
    private function compararFechas($fecharegistro, $fechaactual) {
        $valoractual = explode ("-", $fechaactual);   
        list($a,$m,$d) = explode('-', $fecharegistro);
        $valorregistro[0]= $d;
        $valorregistro[1]= $m;
        $valorregistro[2]= $a;
        $diaactual    = $valoractual[0];  
        $mesactual  = $valoractual[1];  
        $yearactual   = $valoractual[2]; 
        $diaregistro   = $valorregistro[0];  
        $mesregistro = $valorregistro[1];  
        $yearregistro  = $valorregistro[2];
        $diasfechaactual = gregoriantojd($mesactual, $diaactual, $yearactual);  
        $diasfecharegistro = gregoriantojd($mesregistro, $diaregistro, $yearregistro);     
        if(!checkdate($mesactual, $diaactual, $yearactual)){
            // "La fecha ".$fechaactual." no es v&aacute;lida";
            return 0;
        }elseif(!checkdate($mesregistro, $diaregistro, $yearregistro)){
            // "La fecha ".$fecharegistro." no es v&aacute;lida";
        return 0;
        }else{
            return  $diasfechaactual - $diasfecharegistro;
        } 

    }
    
    //Método que comprueba, al introducir una valoración, si el usuario reúne los requisitos para promocionar
    public function siCambiaPerfil($id) {
        $idusuario=$id;
        $query=$this->ejecutarSql("SELECT * FROM valoraciones WHERE usuario=$idusuario");
        $valoracionesdelusuario=0;
        foreach ($query as $prueba){
            $valoracionesdelusuario++;
        }
        if ($valoracionesdelusuario>=VALEXPERTO){
            if ($valoracionesdelusuario>=VALPROFESIONAL){
                // Comprobamos fecha para profesional
                $user=$this->getUsuarioById($idusuario);
                foreach ($user as $usu){
                    $fechausuario=$usu->fech_reg;
                }
                $fech_actual=date('d-m-Y');
                $dias=compararFechas($fechausuario,$fech_actual);
                if ($dias>=TIMEPROFESIONAL) {
                    $perfil=(int)VOTOSPROFESIONAL;
                    $promocionar=$this->ejecutarBorrarSql("UPDATE usuario SET idperfil=$perfil WHERE idusuario=$idusuario");
                    if ($promocionar){
                        return true;
                    }
                }
            } else {
                // Comprobamos fecha para experto
                $user=$this->getUsuarioById($idusuario);
                foreach ($user as $usu){
                    $fechausuario=$usu->fech_reg;
                }
                $fech_actual=date('d-m-Y');
                $dias=compararFechas($fechausuario,$fech_actual);
                if ($dias>=TIMEEXPERTO) {
                    $perfil=(int)VOTOSEXPERTO;
                    $promocionar=$this->ejecutarBorrarSql("UPDATE usuario SET idperfil=$perfil WHERE idusuario=$idusuario");
                    if ($promocionar){
                        return true;
                    }
                }
            }
        } else {
            return false;
        }
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
       $query=$this->ejecutarSql("SELECT * FROM $this->table WHERE idusuario=$query1 ORDER BY idusuario");
       return $query;
    }
    // Método que previene que pueda borrarse al usuario administrador o a un usuario que haya emitido valoraciones.
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
    
    public function eliminarUsuario($id, $nombre, $per){
        $iduser=$id;
        $apodo=$nombre." [Eliminado]";
        // echo $apodo;
        $eliminado=1;
        $perfil=$per;
        if ($perfil<>4){
        $query=$this->ejecutarBorrarSql("UPDATE $this->table SET eliminado=$eliminado, apodo='$apodo' WHERE idusuario=$iduser");
            // echo "UPDATE $this->table SET eliminado=$eliminado, apodo=$apodo WHERE idusuario=$iduser";
            } else {
            $query=false;
        }
        if ($query){
            return true;
        } else {
            return false;
        }
    }
    // Método que comprueba que el apodo introducido no existe ya en la base de datos, previene errores de dobles registros.
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
        $eliminado=0;
        if ($query=$this->ejecutarSql("SELECT * FROM $this->table WHERE apodo='$nombre' AND password='$clave' AND eliminado=$eliminado")) {
            return $query;
        } else {
            return false;
            // echo "SELECT * FROM $this->table WHERE apodo='$nombre' AND password='$clave' AND eliminado=$eliminado";
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