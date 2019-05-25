<?php require 'inc/encabezado.inc'; ?>
 <div class="container">
  <div id="carouselportada" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselportada" data-slide-to="0" class="active"></li>
      <li data-target="#carouselportada" data-slide-to="1"></li>
      <li data-target="#carouselportada" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="media/img/carousel01.jpg" class="d-block w-100 img-fluid" alt="Magnesio para no resbalar las manos.">
        <div class="carousel-caption d-none d-md-block">
          <h5 class="text-white bg-dark">Magnesio</h5>
          <p class="text-white bg-dark">Para no resbalar en las vías más difíciles. <a href="<?php echo $helper->url("producto","verListado"); ?>" class="btn btn-light">Empezar</a></p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="media/img/carousel02.jpg" class="d-block w-100 img-fluid" alt="Mosquetón para la seguridad.">
        <div class="carousel-caption d-none d-md-block">
          <h5 class="text-white bg-dark">Mosquetón</h5>
          <p class="text-white bg-dark">Porque nuestra seguridad es primordial. <a href="<?php echo $helper->url("producto","verListado"); ?>" class="btn btn-dark">Empezar</a></p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="media/img/carousel03.jpg" class="d-block w-100 img-fluid" alt="Para llegar a lo más alto.">
        <div class="carousel-caption d-none d-md-block">
          <h5 class="text-white bg-dark">Magnesio y Mosquetón</h5>
          <p class="text-white bg-dark">Tu web de valoración de vías de escalada para llegar a lo más alto.<a href="<?php echo $helper->url("producto","verListado"); ?>" class="btn btn-primary">Empezar</a></p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselportada" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#carouselportada" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Siguiente</span>
    </a>
  </div>
</div>
<?php require 'inc/pie.inc'; ?>