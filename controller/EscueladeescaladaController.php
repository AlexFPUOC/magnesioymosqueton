<?php //Clase para gestionar el intercambio de valores entre la vista y el modelo en la tabla escueladeescalada.

class EscueladeescaladaController extends ControladorBase{
    public $conectar;
    public $adapter;
    
    public function __construct() {
        parent::__construct();
        
        $this->conectar=new Conectar();
        $this->adapter=$this->conectar->conexion();
    }
    
    public function index() {
        // Creamos nueva escueladeescalada
        $escueladeescalada=new Escueladeescalada($this->adapter);
        // Escueladeescalada hereda de EntidadBase, usamos su método getAll para tomar todos los datos de la tabla escueladeescalada
        $allescueladeescalada=$escueladeescalada->getAll();
        // Llamamos al método view heredado de ControladorBase con el resulset obtenido para que haga un require_once del archivo escueladeescaladaView.php
        $this->view("escueladeescalada", array(
            "allescueladeescalada"=>$allescueladeescalada,
            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
        ));
    }
    
    public function crear(){
        if (isset($_POST["escuela"])) {
            $escueladeescalada=new Escueladeescalada();
            
            $escuela=$_POST["escuela"];
                                    
            $escueladeescalada->setSector($escuela);
                        
            $save=$escueladeescalada->save();
        }
        $this->redirect("escueladeescalada","index");
    }
    
    public function borrar(){
        if (isset($_GET["ides"])) {
            $ides=(int)$_GET["ides"];
            
            $escueladeescalada=new Escueladeescalada();
            $escueladeescalada->deleteById($ides);
            
            $this->redirect();
        }
    }
}
?>