<?php require 'inc/encabezado.inc'; ?>
    <div class="row"><div class="col-lg-12"></div></div>
    <div class="row"><div class="col-lg-12"></div></div>
<div class="row">
        <div class="offset-lg-4 col-lg-4">
            <h3>Formulario de inicio de sesión</h3>
            <?php if (isset($alertas)) {
                echo $alertas; 
            }?>
            <form action="<?php echo $helper->url("usuario", "iniciarSesion"); ?>" method="post">
        Apodo: <input type="text" name="apodo" class="form-control" required />
        Contraseña: <input type="text" name="password" class="form-control" required />
        <input type="submit" name="value" value="Entrar" class="btn btn-success" />
        <a href="<?php echo $helper->url("producto","verListado"); ?>" class="btn btn-secondary">Volver</a>
        </form>
    </div>
    <div class="col-lg-4"></div>
</div>
<?php require 'inc/pie.inc'; ?>