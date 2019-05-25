<?php require 'config/sesion.php'; ?>
<?php require 'inc/encabezado.inc'; ?>
<?php if (($sesionabierta) && ($_SESSION["IdPerfil"]==4)) { ?>
         <div class="container text-light">
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
                <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#borrarSector<?php echo $categoria->idsector; ?>">
                    Borrar
                    </button>
                     <div class="modal text-danger" id="borrarSector<?php echo $categoria->idsector; ?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Borrar sector</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            Esta acción borrará el sector definitivamente. ¿Está seguro?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <a href="<?php echo $helper->url("categoria","borrar"); ?>&id=<?php echo $categoria->idsector; ?>" class="btn btn-danger">Borrar</a>
                          </div>
                        </div>
                      </div>
                    </div></td>
                <td><a href="<?php echo $helper->url("categoria","modificar"); ?>&id=<?php echo $categoria->idsector; ?>" class="btn btn-success">Modificar</a></td>
                </tr>
            <?php } ?>
            </table></div></div>
                                                <?php } else { ?>
            <div class="alert alert-danger"><strong>¡Alto!</strong> Lo sentimos, permisos de acceso insuficientes.</div>
            <a href="<?php echo $helper->url("producto","verListado"); ?>" class="btn btn-secondary">Volver</a>
            <?php } ?>
<?php require 'inc/pie.inc'; ?>