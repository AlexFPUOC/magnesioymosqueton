<?php //Clase para gestionar el intercambio de valores entre la vista y el modelo en la tabla roca.

class RocaController extends ControladorBase{
    public $conectar;
    public $adapter;
    
    public function __construct() {
        parent::__construct();
        
        $this->conectar=new Conectar();
        $this->adapter=$this->conectar->conexion();
    }
    
    public function index() {
        // Creamos nuevo Roca
        $roca=new Roca($this->adapter);
        // Roca hereda de EntidadBase, usamos su método getAll para tomar todos los datos de la tabla roca
        $allroca=$roca->getAll();
        // Llamamos al método view heredado de ControladorBase con el resulset obtenido para que haga un require_once del archivo rocaView.php
        $this->view("roca", array(
            "allroca"=>$allroca,
            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
        ));
    }
    
    public function crear(){
        if (isset($_POST["tiporoca"])) {
            $roca=new Roca();
            
            $tiporoca=$_POST["tiporoca"];
                                    
            $roca->setTiporoca($tiporoca);
                        
            $save=$roca->save();
        }
        $this->redirect("roca","index");
    }
    
    public function borrar(){
        if (isset($_GET["idro"])) {
            $ides=(int)$_GET["idro"];
            
            $roca=new Roca();
            $roca->deleteById($idro);
            
            $this->redirect();
        }
    }
}
?>