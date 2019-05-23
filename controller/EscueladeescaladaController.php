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
    
    // Método para ver, modificar y borrar escuelas.
    public function gestionarescuela(){
        $escuela=new Escueladeescalada($this->adapter);
        $allescuela=$escuela->getAll();
        $this->view("escueladeescalada", array(
            "allescuela"=>$allescuela,
            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
        ));
    }
    
    
        public function crearEscuela(){
        $roca= new Roca($this->adapter);
        $allroca=$roca->getAll();
        $this->view("crearEscuela", array(
            "allroca"=>$allroca,
            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
        ));
    }
    
    public function crear(){
        if (isset($_POST["escuela"])) {
            $nombreescuela=$_POST["escuela"];
            $idroca=$_POST["roca"];
            $comprobarnombre=new EscueladeescaladaModel($this->adapter);
            $check=$comprobarnombre->comprobarEscuela($nombreescuela);
            if (!$check) {
                $escuela=new Escueladeescalada($this->adapter);                        
                $escuela->setEscuela($nombreescuela);
                $escuela->setIdroc($idroca);
                $save=$escuela->save();
                if ($save){
                    $mensaje="<div class='row'><div class='col-lg-12 alert alert-success'><strong>¡Éxito!</strong> La escuela se ha añadido correctamente.</div></div>";
                    $enlace="<a href='index.php?controller=escueladeescalada&action=gestionarescuela' class='btn btn-secondary'>Volver</a>";
                    $this->view("mensaje", array(
                    "mensaje"=>$mensaje,
                    "enlace"=>$enlace,
                    "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                        ));
                }else {
                    $mensaje="<div class='row'><div class='col-lg-12 alert alert-danger'><strong>¡Error!</strong> La escuela no se ha añadido correctamente. Inténtelo de nuevo pasados unos minutos, si la incidencia persiste contacte con el administrador.</div></div>";
                    $enlace="<a href='index.php?controller=escueladeescalada&action=crearEscuela' class='btn btn-secondary'>Volver</a>";
                    $this->view("mensaje", array(
                    "mensaje"=>$mensaje,
                    "enlace"=>$enlace,
                    "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                    ));
                }
            } else {
                $mensaje="<div class='row'><div class='col-lg-12 alert alert-danger'><strong>¡Error!</strong> Esta escuela ya existe y no se puede duplicar.</div></div>";
                $enlace="<a href='index.php?controller=escueladeescalada&action=crearEscuela' class='btn btn-secondary'>Volver</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                ));   
            }
        } else {
            $this->redirect("escueladeescalada","gestionarescuela");
        }
    }
    
        public function modificar() {
         if (isset($_GET["id"])) {
            $idescuela=(int)$_GET["id"];
            // var_dump($idsector);
            $catescuela=new EscueladeescaladaModel($this->adapter);
            $roca= new Roca($this->adapter);
            $allroca=$roca->getAll();
            $escuelamod=$catescuela->getSchoolById($idescuela);
            // var_dump($sectormod);
            $this->view("escuelamodificar", array(
            "allroca"=>$allroca,
            "allescuela"=>$escuelamod,
            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
        ));
         }
    }
    
    public function borrar(){
        if (isset($_GET["id"])) {
            $idescuela=(int)$_GET["id"];
            //var_dump($idsector);
            $comprobarescuela=new EscueladeescaladaModel($this->adapter);
            $revisar=$comprobarescuela->siescuelaBorrable($idescuela);
            //var_dump($revisar);
            if (!$revisar) {
                $campo="ides";
                $escuela=new Escueladeescalada($this->adapter);
                $escuela->deleteById($idescuela, $campo);
                //var_dump($categoria);
                if ($escuela){
                    $mensaje="<div class='row'><div class='col-lg-12 alert alert-success'><strong>¡Éxito!</strong> La escuela se ha eliminado correctamente.</div></div>";
                    $enlace="<a href='index.php?controller=escueladeescalada&action=gestionarescuela' class='btn btn-secondary'>Volver</a>";
                    $this->view("mensaje", array(
                    "mensaje"=>$mensaje,
                    "enlace"=>$enlace,
                    "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                    ));
                } else {
                    $mensaje="<div class='row'><div class='col-lg-12 alert alert-danger'><strong>Error</strong> No ha sido posible efectuar la operación de borrado.</div></div>";
                    $enlace="<a href='index.php?controller=escueladeescalada&action=gestionarescuela' class='btn btn-secondary'>Volver</a>";
                    $this->view("mensaje", array(
                    "mensaje"=>$mensaje,
                    "enlace"=>$enlace,
                    "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                    ));
                }
            } else {
                $mensaje="<div class='row'><div class='col-lg-12 alert alert-warning'><strong>Error</strong> Esta escuela tiene sectores. No puede borrarse.</div></div>";
                $enlace="<a href='index.php?controller=escueladeescalada&action=gestionarescuela' class='btn btn-secondary'>Volver</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                ));
            }
            
            
        }
    }
    
        public function modificarsector(){
        if (isset ($_POST["escuela"])) {
            $idescuela=$_POST["idescuela"];
            $escuela=$_POST["escuela"];
            $idroca=$_POST["roca"];
            $escuelamod=new EscueladeescaladaModel($this->adapter);
            $revisar=$escuelamod->modificarCategoriaEscuela($idescuela,$escuela,$idroca);
            if ($revisar){
                $mensaje="<div class='row'><div class='col-lg-12 alert alert-success'><strong>¡Éxito!</strong> La escuela se ha actualizado correctamente.</div></div>";
                $enlace="<a href='index.php?controller=escueladeescalada&action=modificar&id=$idescuela' class='btn btn-secondary'>Volver</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                ));
            } else {
                $mensaje="<div class='row'><div class='col-lg-12 alert alert-danger'><strong>Error</strong> La escuela no ha podido actualizarse. Inténtelo de nuevo en unos minutos y si persiste la incidencia avise al administrador.</div></div>";
                $enlace="<a href='index.php?controller=escueladeescalada&action=modificar&id=$idescuela' class='btn btn-secondary'>Volver</a>";
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