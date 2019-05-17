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
        $this->view("producto2", array(
            "allproducts"=>$allproducts,
            "Hola" => "Prueba de salida de la vista en modo MVC con POO"
        ));
    }
    
    public function verListado() {
        // Creamos nuevo producto
        $producto=new Producto($this->adapter);
        $producto2=new ProductoModel ($this->adapter);
        $tiporoca=new RocaModel ($this->adapter);
        $escuela=new EscueladeescaladaModel ($this->adapter);
        // Producto hereda de EntidadBase, usamos su método getAll para tomar todos los datos de la tabla producto
        $allproducts=$producto->getAll();
        $alldificults=$producto2->getDificultades();
        $alltipus=$tiporoca->getAll(); //getTiposroca();
        $allescuela=$escuela->getAll(); //getEscuelas();
        // Llamamos al método view heredado de ControladorBase con el resulset obtenido para que haga un require_once del archivo productoView.php
        $this->view("producto", array(
            "allproducts"=>$allproducts,
            "Hola" => "Prueba de salida de la vista en modo MVC con POO",
            "alldificults"=>$alldificults,
            "alltipus"=>$alltipus,
            "allescuela"=>$allescuela
        ));
    }
    
   /* public function debugThings() {
        if (isset($_POST["Roca"])) {
            $tiporoca=$_POST["Tiporoca"];
            $roca=$_POST["Roca"]; 
            
            echo $tiporoca;
            echo $roca;
        } else {
            echo "Esto no funciona";
            print_r($GLOBALS); 
        }
    }*/
    
    public function filtrarListado() {
        // Si se ha filtrado por Dificultad entramos en este if.
        if (isset($_POST["Dificultad"])) {
            $dificultad=$_POST["Dificultad"];
            $valor=$_POST["dificultad"];
            
            if ($valor=="0") {
                header("Location:index.php?controller=producto&action=verListado");
                $allproducts=0;
            } else {
                $prodfiltrado=new ProductoModel($this->adapter);
                $allproducts=$prodfiltrado->getBy($dificultad,$valor);
            }
        }
        // Si se ha filtrado por Tipo de Roca entramos en este if.
        if (isset($_POST["Tiporoca"])) {
            $tiporoca=$_POST["Tiporoca"];
            $idroca=$_POST["Roca"];
            // echo "Id de roca elegida = ".$idroca;
            if ($idroca=="0") {
                header("Location:index.php?controller=producto&action=verListado");
                $allproducts=0;
            } else {
                $escuelafil=new EscueladeescaladaModel($this->adapter);
                $consultaescuelas=$escuelafil->getEscuelasByRoc($idroca);
                // print_r($consultaescuelas);
                $sectoresfil=new CategoriaModel($this->adapter);
                $consultasectores= $sectoresfil->getSectoresByEscuelas($consultaescuelas);
                // print_r($consultasectores);
                $productosfil=new ProductoModel($this->adapter);
                $allproducts=$productosfil->getProductosBySector($consultasectores);
            }
            
        }
        
        // Si se ha filtrado por Escuela entramos en este if.
        if (isset($_POST["Escuela"])) {
            $idescuela=$_POST["escuela"];
            
            if ($idescuela=="0"){
                header("Location:index.php?controller=producto&action=verListado");
                $allproducts=0;
            } else {
                $sectoresfil=new CategoriaModel($this->adapter);
                $consultasectores=$sectoresfil->getSectoresByEscuela($idescuela);
                $productosfil=new ProductoModel($this->adapter);
                $allproducts=$productosfil->getProductosBySector($consultasectores);
            }
            
        }
        
        // Creamos nuevo producto
        // $producto=new Producto($this->adapter);
        $producto2=new ProductoModel ($this->adapter);
        $tiporoca=new RocaModel ($this->adapter);
        $escuela=new EscueladeescaladaModel ($this->adapter);
        // Producto hereda de EntidadBase, usamos su método getAll para tomar todos los datos de la tabla producto
        // $allproducts=$producto->getAll();
        $alldificults=$producto2->getDificultades();
        $alltipus=$tiporoca->getAll(); //getTiposroca();
        $allescuela=$escuela->getAll(); //getEscuelas();
        // Llamamos al método view heredado de ControladorBase con el resulset obtenido para que haga un require_once del archivo productoView.php
        $this->view("producto", array(
            "allproducts"=>$allproducts,
            "Hola" => "Prueba de salida de la vista en modo MVC con POO",
            "alldificults"=>$alldificults,
            "alltipus"=>$alltipus,
            "allescuela"=>$allescuela
        ));
    }
    
    public function crear(){
        if (isset($_POST["nombre"])) {
            // print_r($GLOBALS); 
            $producto=new Producto($this->adapter);
            
            $idcatg=$_POST["idcatg"];
            $nombre=$_POST["nombre"];
            $responsable=$_POST["responsable"];
            $imagen=$_POST["imagen"];
            $seguros=$_POST["seguros"];
            $dificultad=$_POST["dificultad"];
            $descripcion=$_POST["descripcion"];
            
            $producto->setIdcatg($idcatg);
            $producto->setNombre($nombre);
            $producto->setResponsable($responsable);
            $producto->setImg_via($imagen);
            $producto->setSeguros($seguros);
            $producto->setDificultad($dificultad);
            $producto->setDescripcion($descripcion);
            
            $save=$producto->save();
        } else {
            echo "Error al grabar el registro.";
        }
        
        $this->redirect("Producto","index");
    }
    
    public function borrar(){
        if (isset($_GET["idpro"])) {
            $idperfil=(int)$_GET["idpro"];
            
            $producto=new ProductoModel($this->adapter);
            $producto->deleteById($idperfil);
            
            $this->redirect("Producto","index");
        }
    }
    
    public function detalleProducto(){
        $idpro=$_GET["id"];
        // echo "Hasta aquí hemos llegado con el id número: ".$idpro."<br />";
        // Creamos los modelos necesarios
        $detalle=new ProductoModel($this->adapter);
        $categoria=new CategoriaModel($this->adapter);
        $escuela=new EscueladeescaladaModel($this->adapter);
        $roca=new RocaModel($this->adapter);
        $valoraciones=new ValoracionesModel($this->adapter);
        $usuario=new UsuarioModel($this->adapter);
        $tipoperfil=new TipoperfilModel($this->adapter);
        
        // Recogemos todos los datos precisos para presentar el detalle.
        //Datos de producto detallado a través de su id para posterior uso en la vista.
        $consultaproducto=$detalle->getProductoById($idpro);
        //Datos del id asociado del sector para pasarlo como parámetro [NO HACE FALTA]
        // $consultaidcatg=$detalle->getIdcatgById($idpro);
        // Datos del sector asociado al producto para posterior uso en la vista.
        $consultacategoria=$categoria->getCategoriaById($consultaproducto);
        // Datos de la escuela asociada al producto para posterior uso en la vista.
        $consultaescueladeescalada=$escuela->getEscuelaById($consultacategoria);
        // Datos del tipo de roca asociado al producto para posterior uso en la vista.
        $consultatiporoca=$roca->getRocaById($consultaescueladeescalada);
        // Datos de las valoraciones asociadas al producto para posterior uso en la vista.
        $consultavaloraciones=$valoraciones->getValoracionesByIdProducto($idpro);
        if ($consultavaloraciones<>0) {
        // Datos de los usuarios asociados a las valoraciones y su perfil para posterior uso en la vista en caso de que existan valoraciones.
        $consultausuarios=$usuario->getUsuariosByValoraciones($consultavaloraciones);
        $consultatipoperfil=$tipoperfil->getPerfilByUsuario($consultausuarios);
        } else {
            $consultausuarios=0;
            $consultatipoperfil=0;
            
        }
        
        // print_r($consultaproducto);
        // var_dump($consultaproducto);
        // Enviamos los datos recogidos a la vista
        $this->view("detalle", array(
            "alldetails"=>$consultaproducto,
            "allsector" => $consultacategoria,
            "allescuela"=>$consultaescueladeescalada,
            "allroca"=>$consultatiporoca,
            "allvaloraciones"=>$consultavaloraciones,
            "allusuarios"=>$consultausuarios,
            "allperfiles"=>$consultatipoperfil
        ));
    }
}
?>