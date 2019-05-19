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
    
    public function borrar(){
        if (isset($_GET["idusuario"])) {
            $idusuario=(int)$_GET["idusuario"];
            
            $usuario=new Usuario();
            $usuario->deleteById($idusuario);
            
            $this->redirect();
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
    
    
    public function iniciarSesion() {
        if (isset($_POST["apodo"])) {
            $apodo=$_POST["apodo"];
            $password=$_POST["password"];
            $check=new UsuarioModel($this->adapter);
            $revisar=$check->comprobarPassword($password,$apodo);
            if ($revisar) {
                session_start();
                $_SESSION["IdUsuario"]=$apodo;
                $_SESSION["IdClave"]=$password;
                $this->redirect("producto","verListado"); 
            } else {
                $alertas="<div class='alert alert-warning'><strong>¡Alerta!</strong> El usuario o la contraseña no son correctos.</div>";
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