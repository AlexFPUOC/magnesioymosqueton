<?php //Clase para las consultas a la tabla Tipoperfil
class TipoperfilModel extends ModeloBase{
    private $table;
    
    public function __construct($adapter){
        $this->table="tipoperfil";
        parent::__construct($this->table,$adapter);
    }
    
    public function getPerfilByUsuario($datos) {
        $usuarios=$datos;
        $contador=0;
        if (is_array($usuarios)){
             $query= array();
        foreach ($usuarios as $thing => $datousuario){
            $id = $datousuario->idperfil;
            switch($id) {
                case 1:
                    $query[]="novel";
                    break;
                case 2:
                    $query[]="experto";
                    break;
                case 3:
                    $query[]="profesional";
                    break;
                case 4:
                    $query[]="administrador";
                    break;
                default:
                    $query[]="error";
                    break;
            }
        }
       /*     // echo $contador." ".$query1;
        } else {
            // var_dump($idvaloraciones);
        foreach ($usuarios as $thing => $datousuario){
            if ($contador==0){
            $query1 = $datousuario;
            }
            if ($contador>0){
                $query1=$query1." OR idper= ".$datousuario;
            }
            $contador++;
            $query2=$this->ejecutarSql("SELECT * FROM $this->table WHERE idper=$query1");
            $query[]=$query2;
        }
        }
       // echo "Consulta Perfiles: SELECT * FROM ".$this->table." WHERE idper= ".$query1;
       // $query=$this->ejecutarSql("SELECT * FROM $this->table WHERE idper=$query1");
       //var_dump($query);*/
        return $query;
    }
}
}
?>