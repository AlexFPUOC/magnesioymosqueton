<?php //Clase para gestionar el intercambio de valores entre la vista y el modelo en la tabla categoria.

class CategoriaController extends ControladorBase{
    public $conectar;
    public $adapter;
    
    public function __construct() {
        parent::__construct();
        
        $this->conectar=new Conectar();
        $this->adapter=$this->conectar->conexion();
    }
    
    // Método para ver, modificar y borrar sectores.
    public function gestionarsector(){
        $categoria=new Categoria($this->adapter);
        $allcategoria=$categoria->getAll();
        $this->view("sector", array(
            "allcategoria"=>$allcategoria,
            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
        ));
    }
    
    
    // Método para gestionar el panel de administrador referente a las categorías.
    public function gestionar() {
        // echo "Esto aún hay que implementarlo";
        // IMPLEMENTAR
        // $categoria=new Categoria($this->adapter);
        //$roca=new Roca ($this->adapter);
        //$escuela=new Escueladeescalada ($this->adapter);
        //$allcategoria=$categoria->getAll();
        //$allroca=$roca->getAll();
        //$allescuela=$escuela->getAll(); //getEscuelas();
        $this->view("categoria", array(
            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
        ));
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
    
    public function crearSector(){
        $escuela= new Escueladeescalada($this->adapter);
        $allescuela=$escuela->getAll();
        $this->view("crearSector", array(
            "allescuela"=>$allescuela,
            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
        ));
    }
    public function crear(){
        if (isset($_POST["sector"])) {
            $nombresector=$_POST["sector"];
            $idescuela=$_POST["escuela"];
            $categoria=new Categoria($this->adapter);                        
            $categoria->setSector($nombresector);
            $categoria->setIdesc($idescuela);
            $save=$categoria->save();
            if ($save){
                $mensaje="<div class='row'><div class='col-lg-12 alert alert-success'><strong>¡Éxito!</strong> El sector se ha añadido correctamente.</div></div>";
                $enlace="<a href='index.php?controller=categoria&action=gestionarsector' class='btn btn-secondary'>Volver</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                    ));
            }else {
                $mensaje="<div class='row'><div class='col-lg-12 alert alert-danger'><strong>¡Error!</strong> El sector no se ha añadido correctamente. Inténtelo de nuevo pasados unos minutos, si la incidencia persiste contacte con el administrador.</div></div>";
                $enlace="<a href='index.php?controller=categoria&action=gestionarsector' class='btn btn-secondary'>Volver</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                ));
            }
        } else {
            $this->redirect("categoria","gestionarsector");
        }
    }
    
    public function borrar(){
        if (isset($_GET["id"])) {
            $idsector=(int)$_GET["id"];
            //var_dump($idsector);
            $comprobarsector=new CategoriaModel($this->adapter);
            $revisar=$comprobarsector->sisectorBorrable($idsector);
            //var_dump($revisar);
            if (!$revisar) {
                $campo="idsector";
                $categoria=new Categoria($this->adapter);
                $categoria->deleteById($idsector, $campo);
                //var_dump($categoria);
                if ($categoria){
                    $mensaje="<div class='row'><div class='col-lg-12 alert alert-success'><strong>¡Éxito!</strong> El sector se ha eliminado correctamente.</div></div>";
                    $enlace="<a href='index.php?controller=categoria&action=gestionarsector' class='btn btn-secondary'>Volver</a>";
                    $this->view("mensaje", array(
                    "mensaje"=>$mensaje,
                    "enlace"=>$enlace,
                    "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                    ));
                } else {
                    $mensaje="<div class='row'><div class='col-lg-12 alert alert-danger'><strong>Error</strong> No ha sido posible efectuar la operación de borrado.</div></div>";
                    $enlace="<a href='index.php?controller=categoria&action=gestionarsector' class='btn btn-secondary'>Volver</a>";
                    $this->view("mensaje", array(
                    "mensaje"=>$mensaje,
                    "enlace"=>$enlace,
                    "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                    ));
                }
            } else {
                $mensaje="<div class='row'><div class='col-lg-12 alert alert-warning'><strong>Error</strong> Este sector está siendo usado por vías de escalada. No puede borrarse.</div></div>";
                $enlace="<a href='index.php?controller=categoria&action=gestionarsector' class='btn btn-secondary'>Volver</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                ));
            }
            
            
        }
    }
    
    public function modificar() {
         if (isset($_GET["id"])) {
            $idsector=(int)$_GET["id"];
            // var_dump($idsector);
            $catsector=new CategoriaModel($this->adapter);
            $escuela= new Escueladeescalada($this->adapter);
            $allescuela=$escuela->getAll();
            $sectormod=$catsector->getSectorById($idsector);
            // var_dump($sectormod);
            $this->view("categoriamodificar", array(
            "allcategoria"=>$sectormod,
            "allescuela"=>$allescuela,
            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
        ));
         }
    }
    
    public function modificarsector(){
        if (isset ($_POST["sector"])) {
            $idsector=$_POST["idsector"];
            $sector=$_POST["sector"];
            $escuela=$_POST["escuela"];
            $sectormod=new CategoriaModel($this->adapter);
            $revisar=$sectormod->modificarCategoriaSector($sector,$escuela,$idsector);
            if ($revisar){
                $mensaje="<div class='row'><div class='col-lg-12 alert alert-success'><strong>¡Éxito!</strong> El sector se ha actualizado correctamente.</div></div>";
                $enlace="<a href='index.php?controller=categoria&action=modificar&id=$idsector' class='btn btn-secondary'>Volver</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                ));
            } else {
                $mensaje="<div class='row'><div class='col-lg-12 alert alert-danger'><strong>Error</strong> El sector no ha podido actualizarse. Inténtelo de nuevo en unos minutos y si persiste la incidencia avise al administrador.</div></div>";
                $enlace="<a href='index.php?controller=categoria&action=modificar&id=$idsector' class='btn btn-secondary'>Volver</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                ));
            }
        } else {
            $this->redirect();
        }
    }
}
?>