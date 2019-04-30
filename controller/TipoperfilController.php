<?php //Clase para gestionar el intercambio de valores entre la vista y el modelo en la tabla tipoperfil.

class TipoperfilController extends ControladorBase{
    public $conectar;
    public $adapter;
    
    public function __construct() {
        parent::__construct();
        
        $this->conectar=new Conectar();
        $this->adapter=$this->conectar->conexion();
    }
    
    public function index() {
        // Creamos nuevo tipoperfil
        $tipoperfil=new Tipoperfil($this->adapter);
        // Tipoperfil hereda de EntidadBase, usamos su método getAll para tomar todos los datos de la tabla tipoperfil
        $alltipoperfil=$tipoperfil->getAll();
        // Llamamos al método view heredado de ControladorBase con el resulset obtenido para que haga un require_once del archivo tipoperfilView.php
        $this->view("tipoperfil", array(
            "alltipoperfil"=>$alltipoperfil,
            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
        ));
    }
    
    public function crear(){
        if (isset($_POST["perfil"])) {
            $tipoperfil=new Tipoperfil();
            
            $perfil=$_POST["perfil"];
                                    
            $perfil->setPerfil($perfil);
                        
            $save=$tipoperfil->save();
        }
        $this->redirect("tipoperfil","index");
    }
    
    public function borrar(){
        if (isset($_GET["idper"])) {
            $idper=(int)$_GET["idper"];
            
            $tipoperfil=new Tipoperfil();
            $tipoperfil->deleteById($idper);
            
            $this->redirect();
        }
    }
}
?>