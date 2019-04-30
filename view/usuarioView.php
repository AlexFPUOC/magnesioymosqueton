<?php require 'inc/encabezado.inc'; ?>
    <body>
        <form action="<?php echo $helper->url("usuario", "crear"); ?>" method="post" class="col-lg-5">
        <h3>Añadir Usuario</h3>
        <hr/>
        Apodo: <input type="text" name="apodo" class="form-control" required />
        Contraseña: <input type="text" name="password" class="form-control" required />
        <input type="hidden" name="idperfil" value="1" />
        <input type="hidden" name="eliminado" value="0" />
        <input type="hidden" name="fech_reg" value="<?php echo date('d-m-Y'); ?>" />
        <input type="submit" name="value" value="Añadir" class="btn btn-success" />
        </form>
        
        <div class="col-lg-6 usuario" style="height:400px;overflow-y:scroll;">
           <h3>Usuarios</h3>
               <?php foreach($allusers as $user) {
                    echo $user->apodo." - ".$user->password."<hr/>";
                    // echo $Hola;                  
}
            ?>
            </div>
<?php require 'inc/pie.inc'; ?>

