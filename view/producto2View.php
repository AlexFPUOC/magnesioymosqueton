<?php require 'config/sesion.php'; ?>
<?php require 'inc/encabezado.inc'; ?>
<?php if (($sesionabierta) && ($_SESSION["IdPerfil"]==4)) { ?>
         <div class="container text-light">
          <div class="row">
          <div class="col-lg-8">
           <h3>Vías de escalada</h3>
              </div>
              <div class="col-lg-2"><a href="<?php echo $helper->url("producto","verListado"); ?>" class="btn btn-secondary">Volver</a></div>
              <div class="col-lg-2"><a href="<?php echo $helper->url("producto","crearProducto"); ?>" class="btn btn-primary">Añadir Vía</a></div></div>
              <div class="row"><div class="col-lg-12">
            <table class="table table-cell table-striped table-responsive-md">
               <thead>
                   <tr>
                       <th>Id vía de escalada</th>
                       <th>Id Sector</th>
                       <th>Nombre vía</th>
                       <th>Responsable</th>
                       <th>Imagen</th>
                       <th>NºSeguros</th>
                       <th>Dificultad</th>
                       <th>Descripción</th>
                   </tr>
               </thead>
            <?php foreach($allproducto as $producto) {?>
                <tr><td><?php echo $producto->idpro; ?></td>
                <td><?php echo $producto->idcatg; ?></td>
                <td><?php echo $producto->nombre; ?></td>
                <td><?php echo $producto->responsable; ?></td>
                <td><?php echo "<a href='media/img/".$producto->img_via."' target='_blank'><img src=media/img/".$producto->img_via." width='75' height='75' class='img-fluid img-thumbnail' /></a>"; ?></td>
                <td><?php echo $producto->seguros; ?></td>
                <td><?php echo $producto->dificultad; ?></td>
                <td><?php echo $producto->descripcion; ?></td>
                <td><a href="<?php echo $helper->url("producto","borrar"); ?>&id=<?php echo $producto->idpro; ?>" class="btn btn-danger">Borrar</a></td>
                <td><a href="<?php echo $helper->url("producto","modificar"); ?>&id=<?php echo $producto->idpro; ?>" class="btn btn-success">Modificar</a></td>
                </tr>
            <?php } ?>
            </table></div></div>
                                                <?php } else { ?>
            <div class="alert alert-danger"><strong>¡Alto!</strong> Lo sentimos, permisos de acceso insuficientes.</div>
            <a href="<?php echo $helper->url("producto","verListado"); ?>" class="btn btn-secondary">Volver</a>
            <?php } ?>
<?php require 'inc/pie.inc'; ?>