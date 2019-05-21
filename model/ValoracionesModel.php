<?php //Clase para las consultas a la tabla Valoraciones
class ValoracionesModel extends ModeloBase{
    private $table;
    
    public function __construct($adapter){
        $this->table="valoraciones";
        parent::__construct($this->table,$adapter);
    }
    
    public function getValoracionesByIdProducto($product) {
        $idproducto=$product;
        if (is_array($idproducto)){
        foreach ($idproducto as $thing => $datoproducto){
            $query1 = $datoproducto->idpro;
        }
        }
        $query=$this->ejecutarSql("SELECT * FROM $this->table WHERE product=$idproducto");
        return $query;
    }
    // Método que comprueba que no existe ya una valoración con esa combinación de producto y usuario.
    public function comprobarProductoUsuario($producto,$usuario){
        $pro=$producto;
        $usu=$usuario;
        $query=$this->ejecutarSql("SELECT * FROM $this->table WHERE product=$pro AND usuario=$usu");
        return $query;
    }
    
    // Método que marca una valoración como reportada.
    public function reportarValoracion($id) {
        $idval=$id;
        $query=$this->ejecutarBorrarSql("UPDATE $this->table SET reportado=1 WHERE idval=$idval");
        return $query;
    }
    
            //Método para recoger los datos del sector conociendo su id
    public function getValById($id){
        $idval=$id;
        $query=$this->ejecutarSql("SELECT * FROM $this->table WHERE idval=$idval");
        if ($query){
            return $query;
        } else {
            var_dump($query);
        }
    }
    public function modificarValoraciones($idv, $idp, $idu, $rep, $pun, $vot, $com){
        $idval=$idv;
        $idproduct=$idp;
        $idusuario=$idu;
        $reportado=$rep;
        $puntuacion=$pun;
        $votos=$vot;
        $comentario=$com;
        $query=$this->ejecutarBorrarSql("UPDATE valoraciones SET idval=$idval, product=$idproduct, usuario=$idusuario, reportado=$reportado, puntuacion=$puntuacion, votos=$votos, comentario='$comentario' WHERE idval=$idval");
        return $query;
    }
}

?>