<?php require 'config/sesion.php'; ?>
<?php require 'inc/encabezado.inc'; ?>
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
                <td><?php echo $val->reportado; ?> 
                   <?php if ($val->reportado==1) { ?>
                   <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#resolverReporte<?php echo $val->idval; ?>">
                    Visto
                    </button>
                     <div class="modal text-secondary" id="resolverReporte<?php echo $val->idval; ?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Reporte visto y solucionado</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            Si la valoración ha sido ya revisada pulse Continuar, de lo contrario Cancele.
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <a href="<?php echo $helper->url("valoraciones","revisar"); ?>&id=<?php echo $val->idval; ?>" class="btn btn-warning">Continuar</a>
                                <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div></td>
                <?php if ($val->reportado==1) {
                $control=true;
                } ?>
                <td><?php echo $val->puntuacion; ?></td>
                <td><?php echo $val->votos; ?></td>
                <td><?php echo $val->comentario; ?></td>
                <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#borrarValoracion<?php echo $val->idval; ?>">
                    Borrar
                    </button>
                     <div class="modal text-danger" id="borrarValoracion<?php echo $val->idval; ?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Borrar Valoración</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            Esta acción borrará la valoración definitivamente. ¿Está seguro?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <a href="<?php echo $helper->url("valoraciones","borrar"); ?>&id=<?php echo $val->idval; ?>" class="btn btn-danger">Borrar</a>
                          </div>
                        </div>
                      </div>
                    </div></td>
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