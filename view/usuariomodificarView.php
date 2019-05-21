<?php require 'config/sesion.php'; ?>
<?php require 'inc/encabezado.inc'; ?>
<?php if (($sesionabierta) && ($_SESSION["IdPerfil"]==4)) { ?>
<div class="container">
    <div class="row mt-5">
        <div class="col-lg-12">
           <?php foreach($alluser as $usuario) {?>
           <?php $idusuario=$usuario->idusuario; ?>
            <form action="<?php echo $helper->url("usuario", "modificarusuario"); ?>" method="post">
            Id Usuario: <input type="text" name="disabled" class="form-control" value="<?php echo $usuario->idusuario; ?>" disabled />
            <input type="hidden" name="idusuario" class="form-control" value="<?php echo $usuario->idusuario; ?>" />
            Id Perfil: <input type="text" name="disabled" class="form-control" value="<?php echo $usuario->idperfil; ?>" disabled />
            <input type="hidden" name="idperfil" class="form-control" value="<?php echo $usuario->idperfil; ?>" />
            <?php list($a,$m,$d) = explode('-', $usuario->fech_reg);
                    $usuario->fech_reg="$d-$m-$a"; ?>
            Fecha Registro: <input type="text" name="fech_reg" class="form-control" value="<?php echo $usuario->fech_reg; ?>" disabled />
            Password: <input type="text" name="password" class="form-control" value="<?php echo $usuario->password; ?>" disabled />
            Apodo: <input type="text" name="apodo" class="form-control" value="<?php echo $usuario->apodo; ?>" disabled />
            Eliminado: <input type="text" name="eliminado" class="form-control" value="<?php echo $usuario->eliminado; ?>" disabled />
            <input type="submit" value="Modificar" class="btn btn-success" disabled />
            <a href="<?php echo $helper->url("usuario","gestionar"); ?>" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
        <div class="alert alert-warning">No es posible modificar los usuarios introducidos. Cualquier duda contactar con el administrador.</div>
        </div>
    </div>
</div>
        <?php } ?>
<?php } ?>
<?php require 'inc/pie.inc'; ?>