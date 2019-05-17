<?php require 'inc/encabezado.inc'; ?>
<div class="container">
   <div class="row">
       <div class="col-lg-6">
           <h3>Imagen vía (Representativa)</h3>
       </div>
         <div class="col-lg-2">
             <h3>Escuela</h3>
         </div>
         <div class="col-lg-2">
             <h3>Sector</h3>
         </div>
         <div class="col-lg-2">
             <h3>Tipo Roca</h3>
         </div>
    </div>
         <div class="row">
         <div class="col-lg-6">
          <?php // var_dump($alldetails); ?>
           <?php if(isset($alldetails) && count($alldetails)>=1) {?>
              <?php $nombrevia="";
                    $responsablevia="";
                    $segurosvia="";
                    $dificultadvia="";
                    $descripcionvia=""; 
             ?>
               <?php foreach($alldetails as $detail) {?>
                   <?php echo "<img src=media/img/".$detail->img_via." width='300' height='300' class='img-fluid img-thumbnail' /></div>"; ?>
                   <?php $nombrevia=$detail->nombre; ?>
                   <?php $responsablevia=$detail->responsable; ?>
                   <?php $segurosvia=$detail->seguros; ?>
                   <?php $dificultadvia=$detail->dificultad; ?>
                   <?php $descripcionvia=$detail->descripcion; ?>
               <?php } ?>
           <?php } ?>
           <div class="col-lg-2">
           <?php if(isset($allescuela) && count($allescuela)>=1) {?>
               <?php foreach($allescuela as $datoescuela) {?>
                   <?php echo $datoescuela->escuela."</div>"; ?>
               <?php } ?>
           <?php } ?>
           <div class="col-lg-2">
           <?php if(isset($allsector) && count($allsector)>=1) {?>
               <?php foreach($allsector as $sector) {?>
                   <?php echo $sector->sector."</div>"; ?>
               <?php } ?>
           <?php } ?>
           <div class="col-lg-2">
           <?php if(isset($allroca) && count($allroca)>=1) {?>
               <?php foreach($allroca as $datoroca) {?>
                   <?php echo $datoroca->tiporoca."</div></div>"; ?>
               <?php } ?>
           <?php } ?>
           <div class="row">
               <div class="col-lg-6 offset-lg-6 col align-self-start">
           <?php if(isset($allvaloraciones) && count($allvaloraciones)>=1 && ($allvaloraciones<>0)) {
              $puntuaciontotal=0;
              $puntuacionparcial=0;
              $votostotal=0;
              $usuariostotal= array();
              $perfil= array();
              $puntuacion= array();
              $comentario= array();
              foreach($allvaloraciones as $valoraciones) {
                   // echo $valoraciones->puntuacion; ?>
                   <?php $puntuacion[]=$valoraciones->puntuacion; ?>
                   <?php $puntuacionparcial=$puntuacionparcial + (int)$valoraciones->puntuacion; 
                         $votostotal=$votostotal+ (int) $valoraciones->votos;         
                    ?>
                   <?php // echo $valoraciones->comentario; ?>
                   <?php $comentario[]=$valoraciones->comentario; ?>   
               <?php } ?>
               <?php $puntuaciontotal=$puntuacionparcial/$votostotal; 
                    echo "<h1>La puntuación total es de: ".$puntuaciontotal."</h1></div</div>"; ?>
                    <?php if(isset($allperfiles) && count($allperfiles)>=1 && ($allperfiles<>0)) {?>
               <?php foreach($allperfiles as $perfiles) {?>
                  <?php foreach($perfiles as $tipoperfil) {?>
                   <?php // echo $tipoperfil->perfil; ?>
                   <?php $perfil[]=$tipoperfil->perfil; ?>
               <?php } ?>
               <?php } ?>
           <?php } ?>
           <?php if(isset($allusuarios) && count($allusuarios)>=1 && ($allusuarios<>0)) {?>
               <?php foreach($allusuarios as $usuarios) {?>
                   <?php // echo $usuarios->apodo; ?>
                   <?php $usuariostotal[]=$usuarios->apodo; ?>
               <?php } ?>
           <?php } ?>
               </div></div>
               <div class="row">
               <div class="col-lg-12">
           <h3>Valoraciones</h3>
            <table class="table table-cell table-striped table-responsive-md">
               <thead>
                   <tr>
                       <th>Usuario</th>
                       <th>Perfil</th>
                       <th>Puntuación</th>
                       <th>Comentario</th>
                   </tr>
               </thead>
               <?php $contador=0;
                    foreach($allvaloraciones as $valoraciones) {?>
               <tr>
                   <td><?php echo $usuariostotal[$contador]; ?></td>
                   <td><?php echo $perfil[$contador]; ?></td>
                   <td><?php echo $puntuacion[$contador]; ?></td>
                   <td><?php echo $comentario[$contador]; ?></td>
               </tr>
                   <?php $contador++; ?>
                    <?php } ?>
                    </div></div>
                    </table>
           <?php } else {
                echo "<h3>Esta vía aún no ha recibido ninguna valoración.</h3></div></div>";
            } ?>
           <div class="row"><div class="col-lg-12">
           <a href="<?php echo $helper->url("producto","verListado"); ?>" class="btn btn-secondary">Volver</a>
           </div></div>
<?php require 'inc/pie.inc'; ?>