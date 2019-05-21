<?php require 'inc/encabezado.inc'; ?>
<?php require 'config/sesion.php'; ?>

   <div class="container-fluid">
   <?php if ((!isset($_SESSION["IdUsuario"]) && empty($_SESSION["IdUsuario"])) && (!isset($_SESSION["IdClave"])) && (empty($_SESSION["IdClave"]))) {
    ?>
    <div class="row"><div class="col-lg-12"></div></div>
    <div class="row"><div class="col-lg-12"></div></div>
   <div class="row">
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
   <div class="row"><div class="col-lg-12"></div></div>
    <div class="row"><div class="col-lg-12"></div></div>
   <div class="row">
      <div class="col-lg-2">Usuario: <?php echo $_SESSION['IdUsuario']; ?></div>
       <div class="col-lg-2 offset-lg-3">
           <a href="<?php echo $helper->url("usuario","cerrar"); ?>" class="btn btn-light">Cerrar Sesión</a>
       <div class="offset-lg-5"></div>
       </div></div>
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
   <div class="row">
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
        <hr/>
        <?php if(isset($allproducts) && count($allproducts)>=1) {?>
        <br />
        <h3>Vías de escalada</h3>
            <table class="table table-cell table-striped table-responsive-md">
               <thead>
                   <tr>
                       <th>Detalles</th>
                       <th>Imagen representativa</th>
                       <th>Nombre de la vía</th>
                       <th>Responsable</th>
                       <th>Número de seguros</th>
                       <th>Dificultad</th>
                       <th>Descripción</th>
                   </tr>
               </thead>
            <?php foreach($allproducts as $product) {?>
                <tr><td><a href="<?php echo $helper->url("producto","detalleProducto"); ?>&id=<?php echo $product->idpro; ?>" class="btn btn-dark">Detalle</a></td>
                <td><?php echo "<img src=media/img/".$product->img_via." width='150' height='150'/>"; ?></td>
                <?php // echo $product->idcatg; ?> 
                <td><?php echo $product->nombre; ?></td>
                <td><?php echo $product->responsable; ?></td>
                <td><?php echo $product->seguros; ?></td>
                <td><?php echo $product->dificultad; ?></td>
                <td><?php echo $product->descripcion; ?></td>
                </tr>
            <?php } ?>
            <?php } ?>
            </table>
<?php require 'inc/pie.inc'; ?>