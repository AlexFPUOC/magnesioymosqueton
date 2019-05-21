<?php require 'config/sesion.php'; ?>
<?php require 'inc/encabezado.inc'; ?>
<?php if (($sesionabierta) && ($_SESSION["IdPerfil"]==4)) { ?>
<div class="container">
    <div class="row mt-5">
        <div class="col-lg-12">
           <?php foreach($allvaloraciones as $val) {?>
           <?php $idval=$val->idval; ?>
            <form action="<?php echo $helper->url("valoraciones", "modificarvaloraciones"); ?>" method="post">
            Id Valoración: <input type="text" name="disabled" class="form-control" value="<?php echo $val->idval; ?>" disabled />
            <input type="hidden" name="idval" class="form-control" value="<?php echo $val->idval; ?>" />
            Id Producto: <input type="text" name="disabled" class="form-control" value="<?php echo $val->product; ?>" disabled />
            <input type="hidden" name="idproduct" class="form-control" value="<?php echo $val->product; ?>" />
            Id Usuario: <input type="text" name="disabled" class="form-control" value="<?php echo $val->usuario; ?>" disabled />
            <input type="hidden" name="idusuario" class="form-control" value="<?php echo $val->usuario; ?>" />
            Reportado: <input type="text" name="reportado" class="form-control" value="<?php echo $val->reportado; ?>" required />
            Puntuación: <input type="number" name="puntuacion" class="form-control" max="10" min="1" value="<?php echo $val->puntuacion; ?>" required />
            Votos: <input type="text" name="votos" class="form-control" value="<?php echo $val->votos; ?>" required />
            Comentario: <input type="text" name="comentario" class="form-control" value="<?php echo $val->comentario; ?>" required />
            <input type="submit" value="Modificar" class="btn btn-success" />
            <a href="<?php echo $helper->url("valoraciones","gestionar"); ?>" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
        </div>
    </div>
</div>
        <?php } ?>
<?php } ?>
<?php require 'inc/pie.inc'; ?>