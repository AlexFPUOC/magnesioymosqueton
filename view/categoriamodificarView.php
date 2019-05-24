<?php require 'config/sesion.php'; ?>
<?php require 'inc/encabezado.inc'; ?>
<?php if (($sesionabierta) && ($_SESSION["IdPerfil"]==4)) { ?>
<div class="container text-light">
    <div class="row mt-5">
        <div class="col-lg-12">
           <?php foreach($allcategoria as $categoria) {?>
           <?php $idcat=$categoria->idesc; ?>
            <form action="<?php echo $helper->url("categoria", "modificarsector"); ?>" method="post">
            idsector: <input type="text" name="disabled" class="form-control" value="<?php echo $categoria->idsector; ?>" disabled />
            <input type="hidden" name="idsector" class="form-control" value="<?php echo $categoria->idsector; ?>" />
            Nombre sector: <input type="text" name="sector" class="form-control" value="<?php echo $categoria->sector; ?>" required />
            Escuela: <select name="escuela">
            <?php foreach($allescuela as $escuela) {?>
            <?php echo "<option value='".$escuela->ides."'";
            if ($escuela->ides==$idcat){
                echo " selected ";
            }
            echo ">".$escuela->escuela."</option>"; ?>
            <?php } ?>
            </select>
            <input type="submit" value="Modificar" class="btn btn-success" />
            <a href="<?php echo $helper->url("categoria","gestionarsector"); ?>" class="btn btn-secondary">Volver</a>
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