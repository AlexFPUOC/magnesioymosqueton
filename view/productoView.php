<?php require 'inc/encabezado.inc'; ?>
<form action="<?php echo $helper->url("producto", "crear"); ?>" enctype="multipart/form-data" method="post" class="col-lg-5" role="form">
    <h3>Añadir Vía de escalada</h3>
        <hr/>
        Seleccionar Sector: <input type="text" name="idcatg" class="form-control" required />
        Nombre: <input type="text" name="nombre" class="form-control" required />
        Responsable: <input type="text" name="responsable" class="form-control" required value="Desconocido" />
        Imagen de la vía: <input type="file" name="img_via" class="form-control" required value="Sin imagen" />
        Número de seguros: <input type="number" name="seguros" class="form-control" required />
        Dificultad: <input type="text" name="dificultad" class="form-control" required />
        Descripción: <input type="text" name="descripcion" class="form-control" />
        <input type="submit" name="value" value="Añadir" class="btn btn-success" />
        </form>
        
        <?php if(isset($allproducts) && count($allproducts)>=1) {?>
        <div class="col-lg-7" style="float:right;">
            <h3>Productos</h3>
            <hr/>
            </div>
         <section class="col-lg-7 producto" style="height:400px; overflow-y:scroll;">
            <?php foreach($allproducts as $product) {?>
                <?php echo "<img src=media/img/".$product->img_via." width='150' height='150'/>"; ?>
                <?php echo $product->idcatg; ?> -
                <?php echo $product->nombre; ?> -
                <?php echo $product->responsable; ?> -
                <?php echo $product->seguros; ?>
                <?php echo $product->dificultad; ?>
                <?php echo $product->descripcion; ?>
                <hr/>
            <?php } ?>
            </section>
            <?php } ?>
<?php require 'inc/pie.inc'; ?>