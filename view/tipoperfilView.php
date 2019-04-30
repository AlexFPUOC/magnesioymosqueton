<?php require 'inc/encabezado.inc'; ?>
<form action="<?php echo $helper->url("tipoperfil", "crear"); ?>" method="post" class="col-lg-5" role="form">
    <h3>Añadir tipo de perfil</h3>
        <hr/>
        Tipo de perfil: <input type="text" name="perfil" class="form-control" required />
        <input type="submit" name="value" value="Añadir" class="btn btn-success" />
        </form>
        
        <?php if(isset($alltipoperfil) && count($alltipoperfil)>=1) {?>
        <div class="col-lg-7" style="float:right;">
            <h3>Tipo</h3>
            <hr/>
            </div>
         <section class="col-lg-7 valoraciones" style="height:400px; overflow-y:scroll;">
            <?php foreach($alltipoperfil as $tipoperfil) {?>
                <?php echo $tipoperfil->idper; ?> -
                <?php echo $tipoperfil->perfil; ?>
                <hr/>
            <?php } ?>
            </section>
            <?php } ?>
<?php require 'inc/pie.inc'; ?>