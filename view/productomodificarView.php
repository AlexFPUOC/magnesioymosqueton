<?php require 'config/sesion.php'; ?>
<?php require 'inc/encabezado.inc'; ?>
<?php if (($sesionabierta) && ($_SESSION["IdPerfil"]==4)) { ?>
<div class="container">
    <div class="row mt-5">
        <div class="col-lg-12">
           <?php foreach($allproduct as $producto) {?>
           <?php $idvia=$producto->idpro; ?>
            <form action="<?php echo $helper->url("producto", "modificarvia"); ?>" method="post">
            Id Vía: <input type="text" name="disabled" class="form-control" value="<?php echo $producto->idpro; ?>" disabled />
            <input type="hidden" name="idvia" class="form-control" value="<?php echo $producto->idpro; ?>" />
            Id Sector: <input type="text" name="disabled" class="form-control" value="<?php echo $producto->idcatg; ?>" disabled />
            <input type="hidden" name="idsector" class="form-control" value="<?php echo $producto->idcatg; ?>" />
            Nombre vía: <input type="text" name="nombrevia" class="form-control" value="<?php echo $producto->nombre; ?>" required />
            Responsable: <input type="text" name="responsable" class="form-control" value="<?php echo $producto->responsable; ?>" required />
            Imagen vía: <input type="text" name="img_via" class="form-control" value="<?php echo $producto->img_via; ?>" required />
            Nº Seguros: <input type="text" name="seguros" class="form-control" value="<?php echo $producto->seguros; ?>" required />
            Dificultad: <input type="text" name="dificultad" class="form-control" value="<?php echo $producto->dificultad; ?>" required />
            Descripción: <input type="text" name="descripcion" class="form-control" value="<?php echo $producto->descripcion; ?>" />
            <input type="submit" value="Modificar" class="btn btn-success" />
            <a href="<?php echo $helper->url("producto","gestionar"); ?>" class="btn btn-secondary">Volver</a>
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