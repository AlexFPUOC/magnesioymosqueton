<?php require 'inc/encabezado.inc'; ?>
<?php require 'config/sesion.php'; ?>
<?php if (($sesionabierta) && ($_SESSION["IdPerfil"]==4)) { ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <form action="<?php echo $helper->url("categoria", "crear"); ?>" method="post">
            Nombre sector: <input type="text" name="sector" class="form-control" required />
            Escuela: <select name="escuela">
            <?php foreach($allescuela as $escuela) {?>
            <?php echo "<option value='".$escuela->ides."'>".$escuela->escuela."</option>"; ?>
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