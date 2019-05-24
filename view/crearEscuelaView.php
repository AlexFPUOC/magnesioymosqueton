<?php require 'config/sesion.php'; ?>
<?php require 'inc/encabezado.inc'; ?>
<?php if (($sesionabierta) && ($_SESSION["IdPerfil"]==4)) { ?>
<div class="container text-light">
    <div class="row">
        <div class="col-lg-12">
            <form action="<?php echo $helper->url("escueladeescalada", "crear"); ?>" method="post">
            Nombre escuela: <input type="text" name="escuela" class="form-control" required />
            Tipo de Roca: <select name="roca">
            <?php foreach($allroca as $roca) {?>
            <?php echo "<option value='".$roca->idro."'>".$roca->tiporoca."</option>"; ?>
            <?php } ?>
            </select>
            <input type="submit" value="Crear" class="btn btn-success" />
            <a href="<?php echo $helper->url("categoria","gestionar"); ?>" class="btn btn-secondary">Volver</a>
            </form>
            
        </div>
        
    </div>
    
</div>

<?php } else { ?>
    <div class="alert alert-danger"><strong>¡Alto!</strong> Lo sentimos, permisos de acceso insuficientes.</div>
    <a href="<?php echo $helper->url("producto","verListado"); ?>" class="btn btn-secondary">Volver</a>
<?php } ?>
<?php require 'inc/pie.inc'; ?>