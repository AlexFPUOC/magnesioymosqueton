<?php //Clase para gestionar el intercambio de valores entre la vista y el modelo en la tabla valoraciones.

class ValoracionesController extends ControladorBase{
    public $conectar;
    public $adapter;
    
    public function __construct() {
        parent::__construct();
        
        $this->conectar=new Conectar();
        $this->adapter=$this->conectar->conexion();
    }
    
    public function index() {
        // Creamos nueva valoración
        $valoraciones=new Valoraciones($this->adapter);
        // Valoraciones hereda de EntidadBase, usamos su método getAll para tomar todos los datos de la tabla valoraciones
        $allvalorations=$valoraciones->getAll();
        // Llamamos al método view heredado de ControladorBase con el resulset obtenido para que haga un require_once del archivo valoracionesView.php
        $this->view("valoraciones", array(
            "allvalorations"=>$allvalorations,
            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
        ));
    }
    
    public function crear(){
        if (isset($_POST["product"])) {
            $valoraciones=new Producto();
            
            $product=$_POST["product"];
            $usuario=$_POST["usuario"];
            $reportado=$_POST["reportado"];
            $puntuacion=$_POST["puntuacion"];
            $votos=$_POST["votos"];
            $comentario=$_POST["comentario"];
                        
            $valoraciones->setProduct($product);
            $valoraciones->setUsuario($usuario);
            $valoraciones->setReportado($reportado);
            $valoraciones->setPuntuacion($puntuacion);
            $valoraciones->setVotos($votos);
            $valoraciones->setComentario($comentario);
            
            $save=$valoraciones->save();
        }
        $this->redirect("Valoraciones","index");
    }
    
    public function borrar(){
        if (isset($_GET["product"])) {
            $product=(int)$_GET["product"];
            
            $valoraciones=new Valoraciones();
            $valoraciones->deleteById($product);
            
            $this->redirect();
        }
    }
}
?>