<?php require 'config/sesion.php'; ?>
<?php require 'inc/encabezado.inc'; ?>
<?php if (($sesionabierta) && ($_SESSION["IdPerfil"]==4)) { ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <form action="<?php echo $helper->url("valoraciones", "crearValoraciones"); ?>" method="post">
            Nombre Vía: <select name="idproducto">
            <?php foreach($allproducts as $via) {?>
            <?php echo "<option value='".$via->idpro."'>".$via->nombre."</option>"; ?>
            <?php } ?>
                </select>
            Usuario: <select name="idusuario">
            <?php foreach($allusuarios as $user) {?>
            <?php echo "<option value='".$user->idusuario."'>".$user->apodo."</option>"; ?>
            <?php } ?>
                </select><br />
            Reportado: <input type="text" name="disabled" class="form-control" value="0" disabled />
            <input type="hidden" name="reportado" class="form-control" value="0" />
            Puntuación: <input type="number" name="puntuacion" class="form-control" max="10" min="1" required />
            Votos: <input type="number" name="votos" class="form-control" max="4" min="1" required />
            Comentario: <input type="text" name="comentario" class="form-control" />
            <input type="submit" value="Crear" class="btn btn-success" />
            <a href="<?php echo $helper->url("valoraciones","gestionar"); ?>" class="btn btn-secondary">Volver</a>
            </form>
            
        </div>
        
    </div>
    
</div>

<?php } else { ?>
    <div class="alert alert-danger"><strong>¡Alto!</strong> Lo sentimos, permisos de acceso insuficientes.</div>
    <a href="<?php echo $helper->url("producto","verListado"); ?>" class="btn btn-secondary">Volver</a>
<?php } ?>
<?php require 'inc/pie.inc'; ?>