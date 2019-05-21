<?php require 'inc/encabezado.inc'; ?>
<?php require 'config/sesion.php'; ?>
<?php if (($sesionabierta) && ($_SESSION["IdPerfil"]==4)) { ?>
<div class="container">
    <div class="row mt-5">
        <div class="col-lg-12">
           <?php foreach($allescuela as $escuela) {?>
           <?php $idschool=$escuela->idroc; ?>
            <form action="<?php echo $helper->url("escueladeescalada", "modificarsector"); ?>" method="post">
            Id escuela: <input type="text" name="disabled" class="form-control" value="<?php echo $escuela->ides; ?>" disabled />
            <input type="hidden" name="idescuela" class="form-control" value="<?php echo $escuela->ides; ?>" />
            Nombre escuela: <input type="text" name="escuela" class="form-control" value="<?php echo $escuela->escuela; ?>" required />
            Tipo de roca: <select name="roca">
            <?php foreach($allroca as $roca) {?>
            <?php echo "<option value='".$roca->idro."'";
            if ($roca->idro==$idschool){
                echo " selected ";
            }
            echo ">".$roca->tiporoca."</option>"; ?>
            <?php } ?>
            </select>
            <input type="submit" value="Modificar" class="btn btn-success" />
            <a href="<?php echo $helper->url("escueladeescalada","gestionarescuela"); ?>" class="btn btn-secondary">Volver</a>
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