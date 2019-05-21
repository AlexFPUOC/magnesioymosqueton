<?php require 'inc/encabezado.inc'; ?>
<?php require 'config/sesion.php'; ?>
<?php if (($sesionabierta) && ($_SESSION["IdPerfil"]==4)) { ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
           <?php 
            $data=date('d-m-Y');
            list($a,$m,$d) = explode('-', $data);
            $data="$d-$m-$a"; ?>
            <form action="<?php echo $helper->url("usuario", "crearUser"); ?>" method="post">
            <input type="hidden" name="perfil" class="form-control" value="1" />
            Fecha Registro: <input type="text" name="disabled" class="form-control" disabled value="<?php echo date('d-m-Y'); ?>" />
            <input type="hidden" name="fech_reg" class="form-control" value="<?php echo date('d-m-Y'); ?>" />
            Password: <input type="password" name="password" class="form-control" required />
            Apodo: <input type="text" name="apodo" class="form-control" required />
            Eliminado: <input type="text" name="disabled" class="form-control" disabled value="0" />
            <input type="hidden" name="eliminado" class="form-control" value="0" />
            <input type="submit" value="Crear" class="btn btn-success" />
            <a href="<?php echo $helper->url("usuario","gestionar"); ?>" class="btn btn-secondary">Volver</a>
            </form>
            
        </div>
        
    </div>
    
</div>

<?php } else { ?>
    <div class="alert alert-danger"><strong>¡Alto!</strong> Lo sentimos, permisos de acceso insuficientes.</div>
    <a href="<?php echo $helper->url("producto","verListado"); ?>" class="btn btn-secondary">Volver</a>
<?php } ?>
<?php require 'inc/pie.inc'; ?>