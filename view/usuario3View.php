<?php require 'config/sesion.php'; ?>
<?php require 'inc/encabezado.inc'; ?>
<?php if (($sesionabierta) && ($_SESSION["IdPerfil"]==4)) { ?>
         <div class="container">
          <div class="row">
          <div class="col-lg-8">
           <h3>Usuarios</h3>
              </div>
              <div class="col-lg-2"><a href="<?php echo $helper->url("producto","verListado"); ?>" class="btn btn-secondary">Volver</a></div>
              <div class="col-lg-2"><a href="<?php echo $helper->url("usuario","crearUsuario"); ?>" class="btn btn-primary">Añadir Usuario</a></div></div>
              <div class="row"><div class="col-lg-12">
            <table class="table table-cell table-striped table-responsive-md">
               <thead>
                   <tr>
                       <th>Id Usuario</th>
                       <th>Id Perfil</th>
                       <th>Perfil</th>
                       <th>Fecha Registro</th>
                       <th>Password</th>
                       <th>Apodo</th>
                       <th>Eliminado</th>
                   </tr>
               </thead>
            <?php foreach($allusers as $usuario) {?>
                <tr><td><?php echo $usuario->idusuario; ?></td>
                <td><?php echo $usuario->idperfil; ?></td>
                <?php $user=$usuario->idperfil; ?>
                <?php foreach ($allperfil as $perfil) { ?>
                <?php if ($user==$perfil->idper) { ?>
                    <td><?php echo $perfil->perfil; ?></td>
                <?php }  
                } ?>
                <?php list($a,$m,$d) = explode('-', $usuario->fech_reg);
                    $usuario->fech_reg="$d-$m-$a"; ?>
                <td><?php echo $usuario->fech_reg; ?></td>
                <td><?php echo $usuario->password; ?></td>
                <td><?php echo $usuario->apodo; ?></td>
                <td><?php echo $usuario->eliminado; ?></td>
                <td><a href="<?php echo $helper->url("usuario","borrar"); ?>&id=<?php echo $usuario->idusuario; ?>" class="btn btn-danger">Borrar</a></td>
                <td><a href="<?php echo $helper->url("usuario","modificar"); ?>&id=<?php echo $usuario->idusuario; ?>" class="btn btn-success">Modificar</a></td>
                </tr>
            <?php } ?>
            </table></div></div>
                                                <?php } else { ?>
            <div class="alert alert-danger"><strong>¡Alto!</strong> Lo sentimos, permisos de acceso insuficientes.</div>
            <a href="<?php echo $helper->url("producto","verListado"); ?>" class="btn btn-secondary">Volver</a>
            <?php } ?>
<?php require 'inc/pie.inc'; ?>