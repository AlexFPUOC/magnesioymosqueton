<?php //Clase para gestionar el intercambio de valores entre la vista y el modelo en la tabla producto.

class ProductoController extends ControladorBase{
    public $conectar;
    public $adapter;
    
    public function __construct() {
        parent::__construct();
        
        $this->conectar=new Conectar();
        $this->adapter=$this->conectar->conexion();
    }
    
    public function index() {
        // Creamos nuevo producto
        $producto=new Producto($this->adapter);
        // Producto hereda de EntidadBase, usamos su método getAll para tomar todos los datos de la tabla producto
        $allproducts=$producto->getAll();
        // Llamamos al método view heredado de ControladorBase con el resulset obtenido para que haga un require_once del archivo productoView.php
        $this->view("producto", array(
            "allproducts"=>$allproducts,
            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
        ));
    }
    
    public function crear(){
        if (isset($_POST["nombre"])) {
            $producto=new Producto();
            
            $idcatg=$_POST["idcatg"];
            $nombre=$_POST["nombre"];
            $responsable=$_POST["responsable"];
            $img_via=$_POST["img_via"];
            $seguros=$_POST["seguros"];
            $dificultad=$_POST["dificultad"];
            $descripcion=$_POST["descripcion"];
            
            $producto->setIdcatg($idcatg);
            $producto->setNombre($nombre);
            $producto->setResponsable($responsable);
            $producto->setImg_via($img_via);
            $producto->setSeguros($seguros);
            $producto->setDificultad($dificultad);
            $producto->setDescripcion($descripcion);
            
            $save=$producto->save();
        }
        $this->redirect("Producto","index");
    }
    
    public function borrar(){
        if (isset($_GET["idpro"])) {
            $idperfil=(int)$_GET["idppro"];
            
            $producto=new Producto();
            $producto->deleteById($idpro);
            
            $this->redirect();
        }
    }
}
?>