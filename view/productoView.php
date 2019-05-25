<?php require 'config/sesion.php'; ?>
<?php require 'inc/encabezado.inc'; ?>

   <div class="container-fluid">
   <?php if ((!isset($_SESSION["IdUsuario"]) && empty($_SESSION["IdUsuario"])) && (!isset($_SESSION["IdClave"])) && (empty($_SESSION["IdClave"]))) {
    ?>
  <div class="row mt-3">
       <div class="col-lg-1 offset-lg-4">
           <a href="<?php echo $helper->url("usuario","registrar"); ?>" class="btn btn-warning">Registro</a>
       </div>
       <div class="col-lg-1 offset-lg-1">
           <a href="<?php echo $helper->url("usuario","entrar"); ?>" class="btn btn-primary">Inicio Sesión</a>
       </div>
       <div class="offset-lg-5"></div>
   </div>
   <hr />
   <?php } else {?>
   <?php // echo "iniciarSesion crea la variables de sesión IdUsuario = ".$_SESSION["IdUsuario"]."<br />"; ?>
   <?php // echo "iniciarSesion crea la variables de sesión IdClave = ".$_SESSION["IdClave"]."<br />"; ?>
  <div class="row mt-3">
      <div class="col-lg-2 text-light">Usuario: <?php echo $_SESSION['IdUsuario']; ?></div>
       <div class="col-lg-2 offset-lg-3">
           <a href="<?php echo $helper->url("usuario","cerrar"); ?>" class="btn btn-light">Cerrar Sesión</a></div>
       <div class="col-lg-2 offset-lg-3">
           <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminarCuenta">
                    Eliminar cuenta
                    </button>
                     <div class="modal text-danger" id="eliminarCuenta">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Eliminar cuenta</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            ¡Cuidado! Si continúa eliminará la cuenta de manera definitiva y no podrá acceder más con ella. 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <a href="<?php echo $helper->url("usuario","eliminar"); ?>&id=<?php echo $_SESSION["IdId"]; ?>&apodo=<?php echo $_SESSION["IdUsuario"] ?>&perfil=<?php echo $_SESSION["IdPerfil"]; ?>" class="btn btn-danger">Continuar</a>
                          </div>
                        </div>
                      </div>
                    </div>
       </div>
       </div>
   <hr />
   <?php if ($_SESSION["IdPerfil"]==4) { ?>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-2">
                <a href="<?php echo $helper->url("usuario","gestionar"); ?>" class="btn btn-primary">Gestionar Usuarios</a>
            </div>
            <div class="col-lg-2">
                <a href="<?php echo $helper->url("categoria","gestionar"); ?>" class="btn btn-primary">Gestionar Categorias</a>
            </div>
            <div class="col-lg-2">
                <a href="<?php echo $helper->url("producto","gestionar"); ?>" class="btn btn-primary">Gestionar Vías</a>
            </div>
            <div class="col-lg-2">
                <a href="<?php echo $helper->url("valoraciones","gestionar"); ?>" class="btn btn-primary">Gestionar Valoraciones</a>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <hr />
        <?php } ?>
    <?php } ?>
   <div class="row text-light">
   <div class="col-lg-12">
      <?php // var_dump($alldificults); ?>
      <?php // var_dump($allproducts); ?>
      <?php // var_dump($alltipus); ?>
      <?php // var_dump($allescuela); ?>
       <h4>Filtrar listado</h4>
   </div>
   <div class="col-lg-4">
        <form action=" <?php echo $helper->url("producto", "filtrarListado"); ?>" enctype="multipart/form-data" method="post" role="form">
        <input type="hidden" name="Dificultad" value="dificultad" />
        Filtrar por Dificultad: <select name="dificultad">
               <option value="0"></option>
            <?php foreach($alldificults as $dificult) {?>
            <?php echo "<option value='".$dificult->dificultad."'>".$dificult->dificultad."</option>"; ?>
            <?php } ?>
        </select>
        <input type="submit" value="Dificultad" class="btn btn-success" />
       </form>
       </div>
      <div class="col-lg-4"> 
     <form action="<?php echo $helper->url("producto","filtrarListado"); ?>" enctype="multipart/form-data" method="post" role="form">  
       <input type="hidden" name="Tiporoca" value="tiporoca" />
        Filtrar por Tipo de Roca: <select name="Roca">
           <option value="0"></option>
            <?php foreach($alltipus as $tipus) {?>
            <?php echo "<option value=".$tipus->idro.">".$tipus->tiporoca."</option>"; ?>
            <?php } ?>
        </select>
        <input type="submit" value="Roca" class="btn btn-success" />
       </form>
       </div>
       <div class="col-lg-4">
       <form action="<?php echo $helper->url("producto", "filtrarListado"); ?>" enctype="multipart/form-data" method="post" role="form">  
       <input type="hidden" name="Escuela" value="escuela" />
        Filtrar por Escuela de escalada: <select name="escuela">
           <option value="0"></option>
            <?php foreach($allescuela as $escuela) {?>
            <?php echo "<option value=".$escuela->ides.">".$escuela->escuela."</option>"; ?>
            <?php } ?>
        </select>
        <input type="submit" value="Escuela" class="btn btn-success" />
        </form>
       </div>
        </div>
        <?php if(isset($allproducts) && count($allproducts)>=1) {?>
        <br />
        <h3 class="text-light text-center">Vías de escalada</h3>
           <hr />
            <?php foreach($allproducts as $product) {?>
              <div class="row align-items-center">
               <div class="col-lg-1">
                    <a href="<?php echo $helper->url("producto","detalleProducto"); ?>&id=<?php echo $product->idpro; ?>" class="btn btn-dark">Detalle</a>
               </div>
               <div class="col-lg-2">
                    <?php echo "<img src=media/img/".$product->img_via." width='150' height='150' class='img-thumbnail' />"; ?>
               </div>    
               <div class="col-lg-2">
                      <strong class="text-light">Nombre de la vía: </strong><p class="text-light text-center"><?php echo $product->nombre; ?></p>
               </div>
               <div class="col-lg-2">
                   <strong class="text-light">Responsable: </strong><p class="text-light text-center"><?php echo $product->responsable; ?></p>
               </div>
               <div class="col-lg-1 text-light">
                      <strong>Nº seguros: </strong><p class="text-center"><?php echo $product->seguros; ?></p>
               </div>    
               <div class="col-lg-1 text-light">
                      <strong>Dificultad: </strong><p class="text-center"><?php echo $product->dificultad; ?></p>
               </div>
               <div class="col-lg-3 text-light">
                  <strong>Descripción: </strong><p class="text-center"><?php echo $product->descripcion; ?></p>
               </div>
            </div>
               <hr />
                <?php // echo $product->idcatg; ?> 
            <?php } ?>
            <?php } ?>
</div>
<?php require 'inc/pie.inc'; ?>