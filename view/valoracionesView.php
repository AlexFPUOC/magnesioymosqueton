<?php require 'inc/encabezado.inc'; ?>
<?php require 'config/sesion.php'; ?>
<?php if (($sesionabierta) && ($_SESSION["IdPerfil"]==4)) { ?>
         <div class="container text-light">
          <div class="row">
          <div class="col-lg-8">
           <h3>Valoraciones</h3>
              </div><?php $control=false; ?>
              <div class="col-lg-2"><a href="<?php echo $helper->url("producto","verListado"); ?>" class="btn btn-secondary">Volver</a></div>
              <div class="col-lg-2"><a href="<?php echo $helper->url("valoraciones","crearValoracion"); ?>" class="btn btn-primary">Añadir Valoración</a></div></div>
              <table class="table table-cell table-striped table-responsive-md">
                  <thead>
                   <tr>
                    <th>Id valoración</th>
                       <th>Id Producto</th>
                       <th>Id Usuario</th>
                       <th>Reportado</th>
                       <th>Puntuación</th>
                       <th>NºVotos</th>
                       <th>Comentario</th>
                   </tr>
               </thead>
            <?php foreach($allvaloraciones as $val) {?>
                <tr><td><?php echo $val->idval; ?></td>
                <td><?php echo $val->product; ?></td>
                <td><?php echo $val->usuario; ?></td>
                <td><?php echo $val->reportado; ?></td>
                <?php if ($val->reportado==1) {
                $control=true;
                } ?>
                <td><?php echo $val->puntuacion; ?></td>
                <td><?php echo $val->votos; ?></td>
                <td><?php echo $val->comentario; ?></td>
                <td><a href="<?php echo $helper->url("valoraciones","borrar"); ?>&id=<?php echo $val->idval; ?>" class="btn btn-danger">Borrar</a></td>
                <td><a href="<?php echo $helper->url("valoraciones","modificar"); ?>&id=<?php echo $val->idval; ?>" class="btn btn-success">Modificar</a></td>
                </tr>
            <?php } ?>
            </table></div></div>
            <?php if ($control){ ?>
            <div class="row"><div class="col-lg-12 alert alert-danger"> Hay valoraciones reportadas que requieren su atención.</div> </div></div>               <?php } ?>
                                                <?php } else { ?>
            <div class="alert alert-danger"><strong>¡Alto!</strong> Lo sentimos, permisos de acceso insuficientes.</div>
            <a href="<?php echo $helper->url("producto","verListado"); ?>" class="btn btn-secondary">Volver</a>
            <?php } ?>
<?php require 'inc/pie.inc'; ?>