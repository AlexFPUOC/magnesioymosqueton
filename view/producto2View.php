<?php require 'inc/encabezado.inc'; ?>
<form action="<?php echo $helper->url("producto","crear"); ?>" enctype="multipart/form-data" method="post">
            <h3>Añadir producto</h3>
            <hr/>
            Selecciona Sector: <input type="text" name="idcatg" class="form-control"/>
            Nombre: <input type="text" name="nombre" class="form-control"/>
            Responsable: <input type="text" name="responsable" class="form-control"/>
            Imagen: <input type="file" name="imagen" class="form-control"/>
            Seguros: <input type="text" name="seguros" class="form-control"/>
            Dificultad: <input type="text" name="dificultad" class="form-control"/>
            Descripción: <input type="text" name="descripcion" class="form-control"/>
            <input type="submit" value="enviar" class="btn btn-success"/>
        </form>
            <h3>Usuarios</h3>
            <hr/>
        <section class="col-lg-7 usuario" style="height:400px;overflow-y:scroll;">
            <?php foreach($allproducts as $producto) { //recorremos el array de objetos y obtenemos el valor de las propiedades ?>
                <?php echo $producto->idcatg; ?> -
                <?php echo $producto->nombre; ?> -
                <?php echo $producto->responsable; ?> -
                <?php echo "<img src=media/img/".$producto->img_via." width='150' height='150'/>"; ?>
                <?php echo $producto->seguros; ?> -
                   <?php echo $producto->dificultad; ?> -
                   <?php echo $producto->descripcion; ?> 
                    <a href="<?php echo $helper->url("producto","borrar"); ?>&idpro=<?php echo $producto->idpro; ?>" class="btn btn-danger">Borrar</a>
                <hr/>
            <?php } ?>
        </section>
        <footer class="col-lg-12">
            <hr/>
           Ejemplo PHP MySQLi POO MVC - Víctor Robles - <a href="http://victorroblesweb.es">victorroblesweb.es</a> - Copyright &copy; <?php echo  date("Y"); ?>
        </footer>
<?php require 'inc/pie.inc'; ?>