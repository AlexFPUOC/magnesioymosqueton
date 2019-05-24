<?php require 'config/sesion.php'; ?>
<?php require 'inc/encabezado.inc'; ?>
<?php if (($sesionabierta) && ($_SESSION["IdPerfil"]==4)) { ?>
<div class="container text-light">
    <div class="row">
        <div class="col-lg-12">
            <form action="<?php echo $helper->url("producto", "crear"); ?>" method="post">
            Sector: <select name="sector">
            <?php foreach($allsector as $sector) {?>
            <?php echo "<option value='".$sector->idsector."'>".$sector->sector."</option>"; ?>
            <?php } ?>
                </select><br />
            Nombre Vía: <input type="text" name="nombrevia" class="form-control" required />
            Responsable: <input type="text" name="responsable" class="form-control" required />
            Imagen: <input type="text" name="img_via" class="form-control" required />
            Nº Seguros: <input type="number" name="seguros" class="form-control" required />
            Dificultad: <input type="text" name="dificultad" class="form-control" required />
            Descripción: <input type="text" name="descripcion" class="form-control" />
            <input type="submit" value="Crear" class="btn btn-success" />
            <a href="<?php echo $helper->url("producto","gestionar"); ?>" class="btn btn-secondary">Volver</a>
            </form>
            
        </div>
        
    </div>
    
</div>

<?php } else { ?>
    <div class="alert alert-danger"><strong>¡Alto!</strong> Lo sentimos, permisos de acceso insuficientes.</div>
    <a href="<?php echo $helper->url("producto","verListado"); ?>" class="btn btn-secondary">Volver</a>
<?php } ?>
<?php require 'inc/pie.inc'; ?>