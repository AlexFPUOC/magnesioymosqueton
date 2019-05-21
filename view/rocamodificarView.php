<?php require 'inc/encabezado.inc'; ?>
<?php require 'config/sesion.php'; ?>
<?php if (($sesionabierta) && ($_SESSION["IdPerfil"]==4)) { ?>
<div class="container">
    <div class="row mt-5">
        <div class="col-lg-12">
           <?php foreach($allroca as $roca) {?>
           <?php $idroca=$roca->idro; ?>
            <form action="<?php echo $helper->url("roca", "modificarroca"); ?>" method="post">
            Id roca: <input type="text" name="disabled" class="form-control" value="<?php echo $roca->idro; ?>" disabled />
            <input type="hidden" name="idroca" class="form-control" value="<?php echo $roca->idro; ?>" />
            Tipo de Roca: <input type="text" name="roca" class="form-control" value="<?php echo $roca->tiporoca; ?>" required />
            <input type="submit" value="Modificar" class="btn btn-success" />
            <a href="<?php echo $helper->url("roca","gestionarroca"); ?>" class="btn btn-secondary">Volver</a>
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