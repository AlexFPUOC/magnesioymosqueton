<?php //Clase para gestionar el intercambio de valores entre la vista y el modelo en la tabla categoria.

class CategoriaController extends ControladorBase{
    public $conectar;
    public $adapter;
    
    public function __construct() {
        parent::__construct();
        
        $this->conectar=new Conectar();
        $this->adapter=$this->conectar->conexion();
    }
    
    public function index() {
        // Creamos nueva categoria
        $categoria=new Categoria($this->adapter);
        // Categoria hereda de EntidadBase, usamos su método getAll para tomar todos los datos de la tabla categoria
        $allcategoria=$categoria->getAll();
        // Llamamos al método view heredado de ControladorBase con el resulset obtenido para que haga un require_once del archivo categoriaView.php
        $this->view("categoria", array(
            "allcategoria"=>$allcategoria,
            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
        ));
    }
    
    public function crear(){
        if (isset($_POST["sector"])) {
            $categoria=new Categoria();
            
            $categoria=$_POST["sector"];
                                    
            $categoria->setSector($sector);
                        
            $save=$categoria->save();
        }
        $this->redirect("categoria","index");
    }
    
    public function borrar(){
        if (isset($_GET["idsector"])) {
            $idsector=(int)$_GET["idsector"];
            
            $categoria=new Categoria();
            $categoria->deleteById($idsector);
            
            $this->redirect();
        }
    }
}
?>