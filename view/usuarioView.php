<?php require 'inc/encabezado.inc'; ?>
        <div class="row text-light">
        <div class="col-lg-6">
        <h3>Formulario de registro</h3>
           <?php if (isset($alertas)) {
                echo $alertas; 
            }?>
            </div>
            <div class="col-lg-6">
            <h3>Usuarios (Versión para pruebas.)</h3>
            </div>
            </div>
            <hr/>
        <div class="row text-light">
        <div class="col-lg-6">
        <form action="<?php echo $helper->url("usuario", "crear"); ?>" method="post">
        Apodo: <input type="text" name="apodo" class="form-control" required />
        Contraseña: <input type="password" name="pass" class="form-control" required />
        Confirmar contraseña: <input type="password" name="pass2" class="form-control" required />
        <input type="hidden" name="idperfil" value="1" />
        <input type="hidden" name="eliminado" value="0" />
        <input type="hidden" name="fech_reg" value="<?php echo date('d-m-Y'); ?>" />
        <input type="submit" name="value" value="Registrarme" class="btn btn-success" />
        <a href="<?php echo $helper->url("producto","verListado"); ?>" class="btn btn-secondary">Volver</a>
        </form>
        </div>
        <div class="col-lg-6">
               <table class="table table-cell table-striped table-responsive-md">
               <thead>
                   <tr>
                       <th>Id usuario</th>
                       <th>Id perfil</th>
                       <th>Fecha registro</th>
                       <th>Password</th>
                       <th>Apodo</th>
                       <th>Eliminado</th>
                   </tr>
               </thead>
                   <?php foreach($allusers as $user) {
                    list($a,$m,$d) = explode('-', $user->fech_reg);
                    $user->fech_reg="$d-$m-$a";
                    echo "<tr><td>".$user->idusuario."</td><td>".$user->idperfil."</td><td>".$user->fech_reg."</td><td>".$user->password."</td><td>".$user->apodo."</td><td>".$user->eliminado."</td></tr>";
                    // echo $Hola;                  
}
                   ?></table>
            </div>
</div>
<?php require 'inc/pie.inc'; ?>

