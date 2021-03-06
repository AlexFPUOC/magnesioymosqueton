<?php //Clase para gestionar el intercambio de valores entre la vista y el modelo en la tabla usuario.

class UsuarioController extends ControladorBase{
    public $conectar;
    public $adapter;
    
    public function __construct() {
        parent::__construct();
        
        $this->conectar=new Conectar();
        $this->adapter=$this->conectar->conexion();
    }
    
    public function index() {
        // Creamos nuevo usuario
        $usuario=new Usuario($this->adapter);
        // Usuario hereda de EntidadBase, usamos su método getAll para tomar todos los datos de la tabla usuario
        $allusers=$usuario->getAll();
        // Llamamos al método view heredado de ControladorBase con el resulset obtenido para que haga un require_once del archivo indexView.php
        $this->view("usuario", array(
            "allusers"=>$allusers,
            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
        ));
    }
    
    public function crear(){
        if (isset($_POST["apodo"])) {
            $usuario=new Usuario();
            
            $idperfil=$_POST["idperfil"];
            $fech_reg=$_POST["fech_reg"];
            $password=sha1 ($_POST["password"]);
            $apodo=$_POST["apodo"];
            $eliminado=$_POST["eliminado"];
            
            $usuario->setIdperfil($idperfil);
            $usuario->setFech_reg($fech_reg);
            $usuario->setPassword($password);
            $usuario->setApodo($apodo);
            $usuario->setEliminado($eliminado);
            
            $save=$usuario->save();
        }
        $this->redirect("Usuario","index");
    }
    
    public function borrar(){
        if (isset($_GET["idusuario"])) {
            $idusuario=(int)$_GET["idusuario"];
            
            $usuario=new Usuario();
            $usuario->deleteById($idusuario);
            
            $this->redirect();
        }
    }
    
    public function recuperarAdmin(){
        $usuario=new UsuarioModel;
        $usu=$usuario->getAdmin();
        var_dump($usu);
    }
}
?>