<?php require 'inc/encabezado.inc'; ?>
<?php require 'config/sesion.php'; ?>
<?php if (($sesionabierta) && ($_SESSION["IdPerfil"]==4)) { ?>
<div class="container">
          <div class="row">
              <div class="offset-lg-3 col-lg-6">
                  <h3>Panel de administrador de Categorías</h3>
              </div>
          </div>
          <div class="row mt-4">
            <div class="col-lg-4">
                <a href="<?php echo $helper->url("categoria","gestionarsector"); ?>" class="btn btn-primary">Gestionar Sectores</a>
            </div>
            <div class="col-lg-4">
                <a href="<?php echo $helper->url("escueladeescalada","gestionarescuela"); ?>" class="btn btn-primary">Gestionar Escuelas</a>
            </div>
            <div class="col-lg-4">
                <a href="<?php echo $helper->url("roca","gestionarroca"); ?>" class="btn btn-primary">Gestionar Tipos de roca</a>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-4">
                <a href="<?php echo $helper->url("categoria","crearSector"); ?>" class="btn btn-primary">Añadir sector</a>
            </div>
            <div class="col-lg-4">
                <a href="<?php echo $helper->url("escueladeescalada","crearEscuela"); ?>" class="btn btn-primary">Añadir Escuela</a>
            </div>
            <div class="col-lg-4">
                <a href="<?php echo $helper->url("roca","crearRoca"); ?>" class="btn btn-primary">Añadir Tipo de roca</a>
            </div>
        </div>
        <div class="row mt-4"><div class="offset-lg-4 col-lg-4"><a href="<?php echo $helper->url("producto","verListado"); ?>" class="btn btn-secondary">Volver</a></div></div>
        <?php } else { ?>
            <div class="alert alert-danger"><strong>¡Alto!</strong> Lo sentimos, permisos de acceso insuficientes.</div>
            <a href="<?php echo $helper->url("producto","verListado"); ?>" class="btn btn-secondary">Volver</a>
            <?php } ?>
<?php require 'inc/pie.inc'; ?>