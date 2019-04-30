<?php require 'inc/encabezado.inc'; ?>
<form action="<?php echo $helper->url("escueladeescalada", "crear"); ?>" method="post" class="col-lg-5" role="form">
    <h3>Añadir Escuela de escalada</h3>
        <hr/>
        Escuela de escalada: <input type="text" name="perfil" class="form-control" required />
        <input type="submit" name="value" value="Añadir" class="btn btn-success" />
        </form>
        
        <?php if(isset($allescueladeescalada) && count($allescueladeescalada)>=1) {?>
        <div class="col-lg-7" style="float:right;">
            <h3>Escuelas de escalada</h3>
            <hr/>
            </div>
         <section class="col-lg-7 valoraciones" style="height:400px; overflow-y:scroll;">
            <?php foreach($allescueladeescalada as $escueladeescalada) {?>
                <?php echo $escueladeescalada->ides; ?> -
                <?php echo $escueladeescalada->escuela; ?> -
                <?php echo $escueladeescalada->idroc; ?>
                <hr/>
            <?php } ?>
            </section>
            <?php } ?>
<?php require 'inc/pie.inc'; ?>