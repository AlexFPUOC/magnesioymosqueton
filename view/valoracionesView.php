<?php require 'inc/encabezado.inc'; ?>
<form action="<?php echo $helper->url("valoraciones", "crear"); ?>" method="post" class="col-lg-5" role="form">
    <h3>Añadir valoración</h3>
        <hr/>
        Puntuación: <input type="number" name="puntuacion" class="form-control" required />
        Comentario: <input type="text" name="comentario" class="form-control" />
        <input type="hidden" name="product" class="form-control" value="100" />
        <input type="hidden" name="usuario" class="form-control" value="100" />
        <input type="hidden" name="reportado" class="form-control" value="0" />
        <input type="hidden" name="votos" class="form-control" value="1" />
        <input type="submit" name="value" value="Añadir" class="btn btn-success" />
        </form>
        
        <?php if(isset($allvalorations) && count($allvalorations)>=1) {?>
        <div class="col-lg-7" style="float:right;">
            <h3>Valoraciones</h3>
            <hr/>
            </div>
         <section class="col-lg-7 valoraciones" style="height:400px; overflow-y:scroll;">
            <?php foreach($allvalorations as $valoration) {?>
                <?php echo $valoration->product; ?> -
                <?php echo $valoration->usuario; ?> -
                <?php echo $valoration->puntuacion; ?> -
                <?php echo $valoration->comentario; ?> -
                <?php echo $valoration->votos; ?> -
                <?php echo $valoration->reportado; ?>
                <hr/>
            <?php } ?>
            </section>
            <?php } ?>
<?php require 'inc/pie.inc'; ?>