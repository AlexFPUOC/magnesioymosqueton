<?php require 'config/sesion.php'; ?>
<?php require 'inc/encabezado.inc'; ?>
<?php if (($sesionabierta) && ($_SESSION["IdPerfil"]==4)) { ?>
         <div class="container text-light">
          <div class="row">
          <div class="col-lg-8">
           <h3>Tipos de roca</h3>
              </div>
              <div class="col-lg-4"><a href="<?php echo $helper->url("categoria","gestionar"); ?>" class="btn btn-secondary">Volver</a></div></div>
              <div class="row"><div class="col-lg-12">
            <table class="table table-cell table-striped table-responsive-md">
               <thead>
                   <tr>
                       <th>Id Roca</th>
                       <th>Tipo de Roca</th>
                       <th>Eliminar</th>
                       <th>Modificar</th>
                   </tr>
               </thead>
            <?php foreach($allroca as $roca) {?>
                <tr><td><?php echo $roca->idro; ?></td>
                <td><?php echo $roca->tiporoca; ?></td>
                <td><a href="<?php echo $helper->url("roca","borrar"); ?>&id=<?php echo $roca->idro; ?>" class="btn btn-danger">Borrar</a></td>
                <td><a href="<?php echo $helper->url("roca","modificar"); ?>&id=<?php echo $roca->idro; ?>" class="btn btn-success">Modificar</a></td>
                </tr>
            <?php } ?>
            </table></div></div>
                                                <?php } else { ?>
            <div class="alert alert-danger"><strong>¡Alto!</strong> Lo sentimos, permisos de acceso insuficientes.</div>
            <a href="<?php echo $helper->url("producto","verListado"); ?>" class="btn btn-secondary">Volver</a>
            <?php } ?>
<?php require 'inc/pie.inc'; ?>