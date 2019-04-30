<?php require 'inc/encabezado.inc'; ?>
<form action="<?php echo $helper->url("roca", "crear"); ?>" method="post" class="col-lg-5" role="form">
    <h3>Añadir Tipo de Roca</h3>
        <hr/>
        Tipo de roca: <input type="text" name="perfil" class="form-control" required />
        <input type="submit" name="value" value="Añadir" class="btn btn-success" />
        </form>
        
        <?php if(isset($allroca) && count($allroca)>=1) {?>
        <div class="col-lg-7" style="float:right;">
            <h3>Tipos de roca</h3>
            <hr/>
            </div>
         <section class="col-lg-7 valoraciones" style="height:400px; overflow-y:scroll;">
            <?php foreach($allroca as $roca) {?>
                <?php echo $roca->idro; ?> -
                <?php echo $roca->tiporoca; ?>
                <hr/>
            <?php } ?>
            </section>
            <?php } ?>
<?php require 'inc/pie.inc'; ?>