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
    
    
    public function crearRoca() {
        $this->view("crearRoca", array(
            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
        ));
    }
        
    public function crear(){
        if (isset($_POST["roca"])) {
            $nombreroca=$_POST["roca"];
            $roca=new Roca($this->adapter);                        
            $roca->setTiporoca($nombreroca);
            $save=$roca->save();
            if ($save){
                $mensaje="<div class='row'><div class='col-lg-12 alert alert-success'><strong>¡Éxito!</strong> El tipo de roca se ha añadido correctamente.</div></div>";
                $enlace="<a href='index.php?controller=roca&action=gestionarroca' class='btn btn-secondary'>Volver</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                    ));
            }else {
                $mensaje="<div class='row'><div class='col-lg-12 alert alert-danger'><strong>¡Error!</strong> El tipo de roca no se ha añadido correctamente. Inténtelo de nuevo pasados unos minutos, si la incidencia persiste contacte con el administrador.</div></div>";
                $enlace="<a href='index.php?controller=roca&action=gestionarroca' class='btn btn-secondary'>Volver</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                ));
            }
        } else {
            $this->redirect("roca","gestionarroca");
        }
    }
    
    public function borrar(){
        if (isset($_GET["id"])) {
            $idroca=(int)$_GET["id"];
            //var_dump($idsector);
            $comprobarroca=new RocaModel($this->adapter);
            $revisar=$comprobarroca->sirocaBorrable($idroca);
            //var_dump($revisar);
            if (!$revisar) {
                $campo="idro";
                $roca=new Roca($this->adapter);
                $roca->deleteById($idroca, $campo);
                //var_dump($categoria);
                if ($roca){
                    $mensaje="<div class='row'><div class='col-lg-12 alert alert-success'><strong>¡Éxito!</strong> El tipo de roca se ha eliminado correctamente.</div></div>";
                    $enlace="<a href='index.php?controller=roca&action=gestionarroca' class='btn btn-secondary'>Volver</a>";
                    $this->view("mensaje", array(
                    "mensaje"=>$mensaje,
                    "enlace"=>$enlace,
                    "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                    ));
                } else {
                    $mensaje="<div class='row'><div class='col-lg-12 alert alert-danger'><strong>Error</strong> No ha sido posible efectuar la operación de borrado.</div></div>";
                    $enlace="<a href='index.php?controller=roca&action=gestionarroca' class='btn btn-secondary'>Volver</a>";
                    $this->view("mensaje", array(
                    "mensaje"=>$mensaje,
                    "enlace"=>$enlace,
                    "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                    ));
                }
            } else {
                $mensaje="<div class='row'><div class='col-lg-12 alert alert-warning'><strong>Error</strong> Este tipo de roca está siendo usado por escuelas de escalada. No puede borrarse.</div></div>";
                $enlace="<a href='index.php?controller=roca&action=gestionarroca' class='btn btn-secondary'>Volver</a>";
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
            $idroca=(int)$_GET["id"];
            // var_dump($idsector);
            $catroca=new RocaModel($this->adapter);
            $rocamod=$catroca->getcategoriaRocaById($idroca);
            // var_dump($sectormod);
            $this->view("rocamodificar", array(
            "allroca"=>$rocamod,
            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
        ));
         }
    }
    
    public function gestionarroca(){
        $roca=new Roca($this->adapter);
        $allroca=$roca->getAll();
        $this->view("roca", array(
            "allroca"=>$allroca,
            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
            ));
    }
    
    public function modificarroca(){
        if (isset ($_POST["roca"])) {
            $idroca=$_POST["idroca"];
            $tiporoca=$_POST["roca"];
            $rocamod=new RocaModel($this->adapter);
            $revisar=$rocamod->modificarCategoriaRoca($idroca,$tiporoca);
            if ($revisar){
                $mensaje="<div class='row'><div class='col-lg-12 alert alert-success'><strong>¡Éxito!</strong> El tipo de roca se ha actualizado correctamente.</div></div>";
                $enlace="<a href='index.php?controller=roca&action=modificar&id=$idroca' class='btn btn-secondary'>Volver</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                ));
            } else {
                $mensaje="<div class='row'><div class='col-lg-12 alert alert-danger'><strong>Error</strong> El tipo de roca no ha podido actualizarse. Inténtelo de nuevo en unos minutos y si persiste la incidencia avise al administrador.</div></div>";
                $enlace="<a href='index.php?controller=roca&action=modificar&id=$idroca' class='btn btn-secondary'>Volver</a>";
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