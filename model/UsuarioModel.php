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
}
?>