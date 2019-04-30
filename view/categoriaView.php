<?php require 'inc/encabezado.inc'; ?>
<form action="<?php echo $helper->url("categoria", "crear"); ?>" method="post" class="col-lg-5" role="form">
    <h3>Añadir sector</h3>
        <hr/>
        Sector: <input type="text" name="perfil" class="form-control" required />
        <input type="submit" name="value" value="Añadir" class="btn btn-success" />
        </form>
        
        <?php if(isset($allcategoria) && count($allcategoria)>=1) {?>
        <div class="col-lg-7" style="float:right;">
            <h3>Sectores</h3>
            <hr/>
            </div>
         <section class="col-lg-7 valoraciones" style="height:400px; overflow-y:scroll;">
            <?php foreach($allcategoria as $categoria) {?>
                <?php echo $categoria->idsector; ?> -
                <?php echo $categoria->sector; ?> -
                <?php echo $categoria->idesc; ?>
                <hr/>
            <?php } ?>
            </section>
            <?php } ?>
<?php require 'inc/pie.inc'; ?>