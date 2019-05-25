<?php //Clase para gestionar el intercambio de valores entre la vista y el modelo en la tabla valoraciones.

class ValoracionesController extends ControladorBase{
    public $conectar;
    public $adapter;
    
    public function __construct() {
        parent::__construct();
        
        $this->conectar=new Conectar();
        $this->adapter=$this->conectar->conexion();
    }
    
    public function revisar() {
        if (isset($_GET["id"])) {
            $idval=(int)$_GET["id"];
            $revisaval=new ValoracionesModel($this->adapter);
            $modrevisaval=$revisaval->revisarValoracion($idval);
                    If ($modrevisaval) {
            $mensaje="<div class='row'><div class='col-lg-12 alert alert-success'><strong>¡Éxito!</strong> La valoración ha sido revisada correctamente.</div>  </div>";
            $enlace="<a href='index.php?controller=valoraciones&action=gestionar' class='btn btn-secondary'>Volver</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                ));
        } else {
            $mensaje="<div class='row'><div class='col-lg-12 alert alert-danger'><strong>¡Error!</strong> La valoración no se ha podido revisar correctamente.</div>  </div>";
            $enlace="<a href='index.php?controller=valoraciones&action=gestionar' class='btn btn-secondary'>Volver</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                ));
        }
        }
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
    
    // Método para gestionar el panel de administrador referente a las valoraciones.
    public function gestionar() {
        // echo "Esto aún hay que implementarlo";
        // IMPLEMENTAR
        $valoraciones=new Valoraciones($this->adapter);
        $allvaloraciones=$valoraciones->getAll();
        $this->view("valoraciones", array(
            "allvaloraciones"=>$allvaloraciones,
            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
            ));
    }
    
            public function modificar() {
         if (isset($_GET["id"])) {
            $idval=(int)$_GET["id"];
            // var_dump($idsector);
            $catval=new ValoracionesModel($this->adapter);
            $valmod=$catval->getValById($idval);
            // var_dump($sectormod);
            $this->view("valoracionesmodificar", array(
            "allvaloraciones"=>$valmod,
            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
        ));
         }
    }
    
    // Método para el reporte de las valoraciones.
    public function reportar() {
        $idvaloracion=$_GET["idva"];
        $producto=$_GET["prod"];
        $reportando=new ValoracionesModel($this->adapter);
        $visto=$reportando->reportarValoracion($idvaloracion);
        // echo "Esto hay que implementarlo";
        // PENDIENTE
        If ($visto) {
            $mensaje="<div class='row'><div class='col-lg-12 alert alert-success    '><strong>¡Éxito!</strong> La valoración se ha reportado correctamente.</div>  </div>";
            $enlace="<a href='index.php?controller=producto&action=detalleProducto&id=".$producto."' class='btn btn-secondary'>Volver</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                ));
        } else {
            $mensaje="<div class='row'><div class='col-lg-12 alert alert-danger'><strong>¡Error!</strong> La valoración no se ha podido reportar, verifique que no esté ya reportada.</div>  </div>";
            $enlace="<a href='index.php?controller=producto&action=detalleProducto&id=".$producto."' class='btn btn-secondary'>Volver</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                ));
        }
    }
    public function crearValoraciones() {
        if (isset($_POST["puntuacion"])) {
            $comprobarvaloracion=new ValoracionesModel($this->adapter);
            $valoraciones=new Valoraciones($this->adapter);
            $product=$_POST["idproducto"];
            $usuario=$_POST["idusuario"];
            $reportado=$_POST["reportado"];
            $puntuacion=$_POST["puntuacion"];
            $votos=$_POST["votos"];
            $comentario=$_POST["comentario"];
            $revisar=$comprobarvaloracion->comprobarProductoUsuario($product, $usuario);
            if (!$revisar) {
                $valoraciones->setProduct($product);
                $valoraciones->setUsuario($usuario);
                $valoraciones->setReportado($reportado);
                $valoraciones->setPuntuacion($puntuacion);
                $valoraciones->setVotos($votos);
                $valoraciones->setComentario($comentario);
                $save=$valoraciones->save();
                if ($save) {
                    $mensaje="<div class='row'><div class='col-lg-12 alert alert-success'><strong>¡Exito!</strong>La valoración se ha grabado correctamente</div></div>";
                    $enlace="<a href='index.php?controller=valoraciones&action=crearValoracion' class='btn btn-secondary'>Volver</a>";
                    $this->view("mensaje", array(
                    "mensaje"=>$mensaje,
                    "enlace"=>$enlace,
                    "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                    ));
                } else {
                    $mensaje="<div class='row><div class='col-lg-12 alert alert-danger'><strong>¡Error!</strong>La valoración <strong>NO</strong> se ha grabado correctamente, inténtelo de nuevo en unos minutos y si el error persiste contacte con el administrador.</div></div>";
                    $enlace="<a href='index.php?controller=valoraciones&action=crearValoracion' class='btn btn-secondary'>Volver</a>";
                    $this->view("mensaje", array(
                    "mensaje"=>$mensaje,
                    "enlace"=>$enlace,
                    "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                    ));
                }
            } else {
                $mensaje="<div class='row'><div class='col-lg-12 alert alert-danger'><strong>¡Error!</strong>El usuario ya ha valorado esa vía.</div>  </div>";
                $enlace="<a href='index.php?controller=valoraciones&action=crearValoracion' class='btn btn-secondary'>Volver</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                ));
            }
        } else {
            $this->redirect("valoraciones","gestionar");
        }
    }

    public function crearValoracion(){
        $usuario=new Usuario($this->adapter);
        $producto=new Producto($this->adapter);
        $allusuarios=$usuario->getAll();
        $allproducts=$producto->getAll();
        $this->view("crearValoracion", array(
                "allusuarios"=>$allusuarios,
                "allproducts"=>$allproducts,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
            ));
    }
    
    public function crear(){
        if (isset($_POST["product"])) {
            $comprobarvaloracion=new ValoracionesModel($this->adapter);
            $valoraciones=new Valoraciones($this->adapter);
            $product=$_POST["product"];
            $usuario=$_POST["usuario"];
            $reportado=$_POST["reportado"];
            $puntuacion=$_POST["puntuacion"];
            $votos=$_POST["votos"];
            $comentario=$_POST["comentario"];
            $revisar=$comprobarvaloracion->comprobarProductoUsuario($product, $usuario);
            if (!$revisar) {
                $valoraciones->setProduct($product);
                $valoraciones->setUsuario($usuario);
                $valoraciones->setReportado($reportado);
                $valoraciones->setPuntuacion($puntuacion);
                $valoraciones->setVotos($votos);
                $valoraciones->setComentario($comentario);
                $save=$valoraciones->save();
                if ($save) {
                    //Si la valoración se graba correctamente comprobamos si el usuario cambia o no su perfil.
                    $comprobarusuario=new UsuarioModel($this->adapter);
                    $sicambiaperf=$comprobarusuario->siCambiaPerfil($usuario);
                    if ($sicambiaperf) {
                        $mensaje="<div class='row'><div class='col-lg-12 alert alert-success'><strong>¡Exito!</strong>La valoración se ha grabado correctamente. <strong>¡Enhorabuena</strong> Ha promocionado al siguiente nivel de usuario.</div></div>";
                        $enlace="<a href='index.php?controller=producto&action=detalleProducto&id=".$product."' class='btn btn-secondary'>Volver</a>";
                        $this->view("mensaje", array(
                        "mensaje"=>$mensaje,
                        "enlace"=>$enlace,
                        "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                        ));
                    } else {
                        $mensaje="<div class='row'><div class='col-lg-12 alert alert-success'><strong>¡Exito!</strong>La valoración se ha grabado correctamente</div></div>";
                        $enlace="<a href='index.php?controller=producto&action=detalleProducto&id=".$product."' class='btn btn-secondary'>Volver</a>";
                        $this->view("mensaje", array(
                        "mensaje"=>$mensaje,
                        "enlace"=>$enlace,
                        "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                        ));
                    }
                } else {
                    $mensaje="<div class='row><div class='col-lg-12 alert alert-danger'><strong>¡Error!</strong>La valoración <strong>NO</strong> se ha grabado correctamente, inténtelo de nuevo en unos minutos y si el error persiste contacte con el administrador.</div></div>";
                    $enlace="<a href='index.php?controller=producto&action=detalleProducto&id=".$product."' class='btn btn-secondary'>Volver</a>";
                    $this->view("mensaje", array(
                    "mensaje"=>$mensaje,
                    "enlace"=>$enlace,
                    "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                    ));
                }
            } else {
                $mensaje="<div class='row'><div class='col-lg-12 alert alert-danger'><strong>¡Error!</strong>El usuario ya ha valorado esa vía.</div>  </div>";
                $enlace="<a href='index.php?controller=producto&action=detalleProducto&id=".$product."' class='btn btn-secondary'>Volver</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                ));
            }
        } else {
            $this->redirect("producto","verListado");
        }
    }
    
public function borrar(){
        if (isset($_GET["id"])) {
            $idvaloracion=(int)$_GET["id"];
            //var_dump($idsector);
            //var_dump($revisar);
            $campo="idval";
                $valoraciones=new Valoraciones($this->adapter);
                $valoraciones->deleteById($idvaloracion, $campo);
                //var_dump($categoria);
                if ($valoraciones){
                    $mensaje="<div class='row'><div class='col-lg-12 alert alert-success'><strong>¡Éxito!</strong> La valoración se ha eliminado correctamente.</div></div>";
                    $enlace="<a href='index.php?controller=valoraciones&action=gestionar' class='btn btn-secondary'>Volver</a>";
                    $this->view("mensaje", array(
                    "mensaje"=>$mensaje,
                    "enlace"=>$enlace,
                    "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                    ));
                } else {
                    $mensaje="<div class='row'><div class='col-lg-12 alert alert-danger'><strong>Error</strong> No ha sido posible efectuar la operación de borrado.</div></div>";
                    $enlace="<a href='index.php?controller=valoraciones&action=gestionar' class='btn btn-secondary'>Volver</a>";
                    $this->view("mensaje", array(
                    "mensaje"=>$mensaje,
                    "enlace"=>$enlace,
                    "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                    ));
                }
            } else {
                $mensaje="<div class='row'><div class='col-lg-12 alert alert-warning'><strong>Error</strong> inesperado, consulte a su administrador.</div></div>";
                $enlace="<a href='index.php?controller=valoraciones&action=gestionar' class='btn btn-secondary'>Volver</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                ));
            }
            
            
}
    public function modificarvaloraciones(){
        if (isset ($_POST["puntuacion"])) {
            $idval=$_POST["idval"];
            $idproduct=$_POST["idproduct"];
            $idusuario=$_POST["idusuario"];
            $reportado=$_POST["reportado"];
            $puntuacion=$_POST["puntuacion"];
            $votos=$_POST["votos"];
            $comentario=$_POST["comentario"];
            $valmod=new ValoracionesModel($this->adapter);
            $revisar=$valmod->modificarValoraciones($idval, $idproduct, $idusuario, $reportado, $puntuacion, $votos, $comentario);
            if ($revisar){
                $mensaje="<div class='row'><div class='col-lg-12 alert alert-success'><strong>¡Éxito!</strong> La valoración se ha actualizado correctamente.</div></div>";
                $enlace="<a href='index.php?controller=valoraciones&action=modificar&id=$idval' class='btn btn-secondary'>Volver</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                ));
            } else {
                $mensaje="<div class='row'><div class='col-lg-12 alert alert-danger'><strong>Error</strong> La valoración no ha podido actualizarse. Inténtelo de nuevo en unos minutos y si persiste la incidencia avise al administrador.</div></div>";
                $enlace="<a href='index.php?controller=valoraciones&action=modificar&id=$idval' class='btn btn-secondary'>Volver</a>";
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