
<?php //Clase para gestionar el intercambio de valores entre la vista y el modelo en la tabla usuario.

class UsuarioController extends ControladorBase{
    public $conectar;
    public $adapter;
    
    public function __construct() {
        parent::__construct();
        
        $this->conectar=new Conectar();
        $this->adapter=$this->conectar->conexion();
    }
    
    public function index() {
        // Creamos nuevo usuario
        $usuario=new Usuario($this->adapter);
        // Usuario hereda de EntidadBase, usamos su método getAll para tomar todos los datos de la tabla usuario
        $allusers=$usuario->getAll();
        // Llamamos al método view heredado de ControladorBase con el resulset obtenido para que haga un require_once del archivo indexView.php
        $this->view("usuario", array(
            "allusers"=>$allusers,
            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
        ));
    }
    
    // Método para gestionar el panel de administrador referente a los usuarios.
    public function gestionar() {
        // echo "Esto aún hay que implementarlo";
        // IMPLEMENTAR
        $usuario=new Usuario($this->adapter);
        $tipoperfil=new Tipoperfil($this->adapter);
        $allperfil=$tipoperfil->getAll();
        $allusers=$usuario->getAll();
        $this->view("usuario3", array(
            "allusers"=>$allusers,
            "allperfil"=>$allperfil,
            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
            ));
    }
    
            public function crearUsuario(){
            // $tipoperfil= new Tipoperfil($this->adapter);
            // $allperfil=$tipoperfil->getAll();
            $this->view("crearUsuario", array(
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
            ));
    }
    public function crearUser(){
            if (isset($_POST["apodo"])) {
            $idperfil=$_POST["perfil"];
            $fech_reg=$_POST["fech_reg"];
            $password=$_POST["password"];
            $apodo=$_POST["apodo"];
            $eliminado=$_POST["eliminado"];
            $comprobando=new UsuarioModel($this->adapter);
            $revisar=$comprobando->comprobarUsuario($apodo);
                if (!$revisar){
                    $usuario=new Usuario($this->adapter);
                    $usuario->setIdperfil($idperfil);
                    $usuario->setFech_reg($fech_reg);
                    $usuario->setPassword($password);
                    $usuario->setApodo($apodo);
                    $usuario->setEliminado($eliminado);
                    $save=$usuario->save();
                        if ($save){
                            $mensaje="<div class='row'><div class='col-lg-12 alert alert-success'><strong>¡Éxito!</strong> El usuario se ha añadido correctamente.</div></div>";
                            $enlace="<a href='index.php?controller=usuario&action=gestionar' class='btn btn-secondary'>Volver</a>";
                            $this->view("mensaje", array(
                            "mensaje"=>$mensaje,
                            "enlace"=>$enlace,
                            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                            ));
                        }else {
                            $mensaje="<div class='row'><div class='col-lg-12 alert alert-danger'><strong>¡Error!</strong> El usuario no se ha añadido correctamente. Inténtelo de nuevo pasados unos minutos, si la incidencia persiste contacte con el administrador.</div></div>";
                            $enlace="<a href='index.php?controller=usuario&action=gestionar' class='btn btn-secondary'>Volver</a>";
                            $this->view("mensaje", array(
                            "mensaje"=>$mensaje,
                            "enlace"=>$enlace,
                            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                            ));
                        }
                } else {
                    $alertas="<div class='alert alert-warning'><strong>¡Alerta!</strong> El nombre escogido ya existe, por favor escoja otro.</div>";
                    $mensaje="<div class='row'><div class='col-lg-12 alert alert-danger'><strong>¡Error!</strong> El nombre escogido ya existe, por favor escoja otro.</div></div>";
                    $enlace="<a href='index.php?controller=usuario&action=gestionar' class='btn btn-secondary'>Volver</a>";
                    $this->view("mensaje", array(
                    "mensaje"=>$mensaje,
                    "enlace"=>$enlace,
                    "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                    ));
                }
            }
    }
    public function crear(){
            if (isset($_POST["apodo"])) {
            $idperfil=$_POST["idperfil"];
            $fech_reg=$_POST["fech_reg"];
            $password=$_POST["password"];
            $password2=$_POST["password2"];
            $apodo=$_POST["apodo"];
                // echo "APODO ENVIADO A comprobarUsuario = ".$apodo;
            $eliminado=$_POST["eliminado"];
            $comprobando=new UsuarioModel($this->adapter);
            $revisar=$comprobando->comprobarUsuario($apodo);
                if (!$revisar){
                    if ($password==$password2) {
                    $usuario=new Usuario($this->adapter);
                    $usuario->setIdperfil($idperfil);
                        // echo "Id del perfil de usuario".$idperfil;
                    $usuario->setFech_reg($fech_reg);
                        // echo "Fecha de registro del usuario".$fech_reg;
                    $usuario->setPassword($password);
                        // echo "Password escogido por el usuario".$password;
                    $usuario->setApodo($apodo);
                        // echo "Apodo escogido por el usuario".$apodo;
                    $usuario->setEliminado($eliminado);
                        // echo "Dato de eliminación del usuario".$eliminado;
                    $save=$usuario->save();
                        if ($save){
                        $alertas="<div class='alert alert-success'><strong>¡Correcto!</strong> El usuario se ha guardado con éxito.</div>";
                            } else {
                            $alertas="<div class='alert alert-danger'><strong>¡Cuidado!</strong> El usuario <strong>NO</strong> se ha guardado correctamente. Avise al <a href='mailto:asevaa@fp.uoc.edu' class='alert-link'>administrador de la página</a></div>";
                        }
                        // Usuario hereda de EntidadBase, usamos su método getAll para tomar todos los datos de la tabla producto
                        $allusers=$usuario->getAll();
                        // Llamamos al método view heredado de ControladorBase con el resulset obtenido para que haga un require_once del archivo usuarioView.php
                        $this->view("usuario", array(
                        "allusers"=>$allusers,
                        "alertas"=>$alertas,
                        "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                        ));
                    } else {
                        $alertas="<div class='alert alert-warning'><strong>¡Alerta!</strong> Las contraseñas no coinciden.</div>";
                        $usuario=new Usuario($this->adapter);
                        // Usuario hereda de EntidadBase, usamos su método getAll para tomar todos los datos de la tabla producto
                        $allusers=$usuario->getAll();
                        // Llamamos al método view heredado de ControladorBase con el resulset obtenido para que haga un require_once del archivo usuarioView.php
                        $this->view("usuario", array(
                        "allusers"=>$allusers,
                        "alertas"=>$alertas,
                        "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                        ));
                    }
                } else {
                    $alertas="<div class='alert alert-warning'><strong>¡Alerta!</strong> El nombre escogido ya existe, por favor escoja otro.</div>";
                    $usuario=new Usuario($this->adapter);
                    // Usuario hereda de EntidadBase, usamos su método getAll para tomar todos los datos de la tabla producto
                    $allusers=$usuario->getAll();
                    // Llamamos al método view heredado de ControladorBase con el resulset obtenido para que haga un require_once del archivo usuarioView.php
                    $this->view("usuario", array(
                    "allusers"=>$allusers,
                    "alertas"=>$alertas,
                    "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                    ));
                }
        } else {
        // echo "Redirigido a crear correctamente, sin datos.";
        $this->redirect();
        }
    }
    
            public function modificar() {
         if (isset($_GET["id"])) {
            $idusuario=(int)$_GET["id"];
            // var_dump($idsector);
            $catuser=new UsuarioModel($this->adapter);
            $usuariomod=$catuser->getUsuarioById($idusuario);
            // var_dump($sectormod);
            $this->view("usuariomodificar", array(
            "alluser"=>$usuariomod,
            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
        ));
         }
    } 
    
    // Método que no se usa.
        public function modificarusuario(){
        if (isset ($_POST["apodo"])) {
            $idusuario=$_POST["idusuario"];
            $idperfil=$_POST["idperfil"];
            $fecha=$_POST["fech_reg"];
            $password=$_POST["password"];
            $apodo=$_POST["apodo"];
            $eliminado=$_POST["eliminado"];
            $usuario=new Usuario($this->adapter);
            $fecha=$usuario->dateMysql($fecha);
            $usuariomod=new UsuarioModel($this->adapter);
            $revisar=$usuariomod->modificarUsuario($idusuario, $idperfil, $fech_reg, $password, $apodo, $eliminado);
            if ($revisar){
                $mensaje="<div class='row'><div class='col-lg-12 alert alert-success'><strong>¡Éxito!</strong> El usario se ha actualizado correctamente.</div></div>";
                $enlace="<a href='index.php?controller=usuario&action=modificar&id=$idusuario' class='btn btn-secondary'>Volver</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                ));
            } else {
                $mensaje="<div class='row'><div class='col-lg-12 alert alert-danger'><strong>Error</strong> El usuario no ha podido actualizarse. Inténtelo de nuevo en unos minutos y si persiste la incidencia avise al administrador.</div></div>";
                $enlace="<a href='index.php?controller=usuario&action=modificar&id=$idusuario' class='btn btn-secondary'>Volver</a>";
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
    public function borradototal(){
        if (isset($_GET["id"])) {
            $idusuario=(int)$_GET["id"];
            $paraeliminado=new UsuarioModel($this->adapter);
            $eliminar=$paraeliminado->getUsuarioById($idusuario);
            foreach($eliminar as $erase){
                $apodo=$erase->apodo;
            }
            $borradotot=$paraeliminado->modificarBorradoTotal($idusuario, $apodo);
            if ($borradotot){
                $mensaje="<div class='row'><div class='col-lg-12 alert alert-success'><strong>¡Éxito!</strong> El usario se ha eliminado correctamente.</div></div>";
                $enlace="<a href='index.php?controller=usuario&action=modificar&id=$idusuario' class='btn btn-secondary'>Volver</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                ));
            } else {
                $mensaje="<div class='row'><div class='col-lg-12 alert alert-danger'><strong>Error</strong> El usuario no ha podido eliminarse. Inténtelo de nuevo en unos minutos y si persiste la incidencia avise al administrador.</div></div>";
                $enlace="<a href='index.php?controller=usuario&action=modificar&id=$idusuario' class='btn btn-secondary'>Volver</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                ));
            }
            //Pendiente a terminar el modificar.
        } else {
            $this->redirect();
        }
    }
    public function borrar(){
        if (isset($_GET["id"])) {
            $idusuario=(int)$_GET["id"];
            //var_dump($idsector);
            $comprobarusuario=new UsuarioModel($this->adapter);
            $revisar=$comprobarusuario->siusuarioBorrable($idusuario);
            //var_dump($revisar);
            if (!$revisar) {
                $campo="idusuario";
                $usuario=new Usuario($this->adapter);
                $usuario->deleteById($idusuario, $campo);
                //var_dump($categoria);
                if ($usuario){
                    $mensaje="<div class='row'><div class='col-lg-12 alert alert-success'><strong>¡Éxito!</strong> El usuario se ha eliminado correctamente.</div></div>";
                    $enlace="<a href='index.php?controller=usuario&action=gestionar' class='btn btn-secondary'>Volver</a>";
                    $this->view("mensaje", array(
                    "mensaje"=>$mensaje,
                    "enlace"=>$enlace,
                    "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                    ));
                } else {
                    $mensaje="<div class='row'><div class='col-lg-12 alert alert-danger'><strong>Error</strong> No ha sido posible efectuar la operación de borrado. Este mensaje aparece por un error, o si intentamos eliminar al usuario administrador.</div></div>";
                    $enlace="<a href='index.php?controller=usuario&action=gestionar' class='btn btn-secondary'>Volver</a>";
                    $this->view("mensaje", array(
                    "mensaje"=>$mensaje,
                    "enlace"=>$enlace,
                    "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                    ));
                }
            } else {
                $mensaje="<div class='row'><div class='col-lg-12 alert alert-warning'><strong>Error</strong> Este usuario tiene valoraciones realizadas. No puede borrarse sin eliminar previamente sus valoraciones. Si a pesar de ello desea eliminarlo pulse de nuevo en borrar.</div></div>";
                $enlace="<a href='index.php?controller=usuario&action=gestionar' class='btn btn-secondary'>Volver</a><a href='index.php?controller=usuario&action=borradototal&id=$idusuario' class='btn btn-danger'>Borrar</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                ));
            }
            
            
        }
    }
    
    // Carga la vista usuarioView. Para realizar el registro de usuario.
    public function registrar() {
         // Creamos nuevo usuario
        $usuario=new Usuario($this->adapter);
        // Usuario hereda de EntidadBase, usamos su método getAll para tomar todos los datos de la tabla producto
        $allusers=$usuario->getAll();
        // Llamamos al método view heredado de ControladorBase con el resulset obtenido para que haga un require_once del archivo usuarioView.php
        $this->view("usuario", array(
            "allusers"=>$allusers,
            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
        ));
    }
    // Carga la vista usuario2View. Para realizar el inicio de sesión.
    public function entrar() {
        $this->view("usuario2", array(
        "Hola" => "Prueba de salida de la vista."
        ));
    }
    
    public function eliminar () {
        if (isset($_GET["id"])) {
            $idusuario=$_GET["id"];
            $apodo=$_GET["apodo"];
            $perfil=$_GET["perfil"];
        }
        $delusuario=new UsuarioModel($this->adapter);
        $revisar=$delusuario->eliminarUsuario($idusuario, $apodo, $perfil);
        if ($revisar){
            require 'config/logout.php'; 
            $mensaje="<div class='row'><div class='col-lg-12 alert alert-success'><strong>¡Éxito!</strong> La cuenta ha sido eliminada correctamente.</div></div>";
                $enlace="<a href='index.php?controller=producto&action=verListado' class='btn btn-secondary'>Volver</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                ));
        } else {
            $mensaje="<div class='row'><div class='col-lg-12 alert alert-warning'><strong>Error</strong> El usuario no ha podido eliminarse, inténtelo de nuevo más tarde, si persiste el error contacte con el administrador.</div></div>";
                $enlace="<a href='index.php?controller=producto&action=verListado' class='btn btn-secondary'>Volver</a>";
                $this->view("mensaje", array(
                "mensaje"=>$mensaje,
                "enlace"=>$enlace,
                "Hola" => "Prueba de salida de la vista en modo MVC con POO"
                ));
        }
    }
    public function iniciarSesion() {
        if (isset($_POST["apodo"])) {
            $apodo=$_POST["apodo"];
            $password=$_POST["password"];
            $check=new UsuarioModel($this->adapter);
            $revisar=$check->comprobarPassword($password,$apodo);
            if ($revisar) {
                session_start();
                foreach ($revisar as $su){
                $_SESSION["IdUsuario"]=$su->apodo;
                $_SESSION["IdClave"]=$su->password;
                $_SESSION["IdPerfil"]=$su->idperfil;
                $_SESSION["IdFech_reg"]=$su->fech_reg;
                $_SESSION["IdId"]=$su->idusuario;
                $_SESSION["IdEliminado"]=$su->eliminado;
                }
                $this->redirect("producto","verListado"); 
            } else {
                $alertas="<div class='alert alert-warning'><strong>¡Alerta!</strong> El usuario o la contraseña no son correctos, o el usuario ha sido eliminado.</div>";
                $this->view("usuario2", array(
                "Hola" => "Prueba de salida de la vista.",
                "alertas" => $alertas
        ));
                
            }
        }
    }
    
    public function cerrar() {
        require 'config/logout.php';
        $this->redirect("producto","verListado");
    }
    public function recuperarAdmin(){
        $usuario=new UsuarioModel;
        $usu=$usuario->getAdmin();
        var_dump($usu);
    }
}
?>