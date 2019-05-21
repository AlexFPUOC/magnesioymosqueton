<?php require 'config/sesion.php'; ?>
<?php require 'inc/encabezado.inc'; ?>
<?php if (($sesionabierta) && ($_SESSION["IdPerfil"]==4)) { ?>
         <div class="container">
          <div class="row">
          <div class="col-lg-8">
           <h3>Sectores</h3>
              </div>
              <div class="col-lg-4"><a href="<?php echo $helper->url("categoria","gestionar"); ?>" class="btn btn-secondary">Volver</a></div></div>
              <div class="row"><div class="col-lg-12">
            <table class="table table-cell table-striped table-responsive-md">
               <thead>
                   <tr>
                       <th>Id sector</th>
                       <th>Nombre sector</th>
                       <th>Id escuela</th>
                       <th>Eliminar</th>
                       <th>Modificar</th>
                   </tr>
               </thead>
            <?php foreach($allcategoria as $categoria) {?>
                <tr><td><?php echo $categoria->idsector; ?></td>
                <td><?php echo $categoria->sector; ?></td>
                <td><?php echo $categoria->idesc; ?></td>
                <td><a href="<?php echo $helper->url("categoria","borrar"); ?>&id=<?php echo $categoria->idsector; ?>" class="btn btn-danger">Borrar</a></td>
                <td><a href="<?php echo $helper->url("categoria","modificar"); ?>&id=<?php echo $categoria->idsector; ?>" class="btn btn-success">Modificar</a></td>
                </tr>
            <?php } ?>
            </table></div></div>
                                                <?php } else { ?>
            <div class="alert alert-danger"><strong>¡Alto!</strong> Lo sentimos, permisos de acceso insuficientes.</div>
            <a href="<?php echo $helper->url("producto","verListado"); ?>" class="btn btn-secondary">Volver</a>
            <?php } ?>
<?php require 'inc/pie.inc'; ?>