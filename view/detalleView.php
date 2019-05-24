<?php require 'config/sesion.php'; ?>
<?php require 'inc/encabezado.inc'; ?>
<div class="container-fluid">
   <div class="row">
       <div class="col-lg-4">
           <h4 class="text-light">Imagen vía (Representativa)</h4></div></div>
         <div class="row text-light">
         <div class="col-lg-3">
          <?php // var_dump($alldetails); ?>
          <?php // Variable que comprueba si el usuario activo ya ha emitido una valoración de esta vía.
              $valorado=false; ?>
           <?php if(isset($alldetails) && count($alldetails)>=1) {?>
              <?php $nombrevia="";
                    $responsablevia="";
                    $segurosvia="";
                    $dificultadvia="";
                    $descripcionvia="";
                    $idvia=0;
             ?>
               <?php foreach($alldetails as $detail) {?>
                   <?php echo "<a href='media/img/".$detail->img_via."' target='_blank'><img src=media/img/".$detail->img_via." width='150' height='150' class='img-fluid img-thumbnail' /></a></div>"; ?>
                   <?php $nombrevia=$detail->nombre; ?>
                   <?php $responsablevia=$detail->responsable; ?>
                   <?php $segurosvia=$detail->seguros; ?>
                   <?php $dificultadvia=$detail->dificultad; ?>
                   <?php $descripcionvia=$detail->descripcion; ?>
                   <?php $idvia=$detail->idpro; ?>
               <?php } ?>
           <?php } ?>
           <div class="col-lg-3">
           <?php if(isset($allescuela) && count($allescuela)>=1) {?>
               <?php foreach($allescuela as $datoescuela) {?>
                   <?php echo "<b>Escuela:</b> ".$datoescuela->escuela."</div>"; ?>
               <?php } ?>
           <?php } ?>
           <div class="col-lg-3">
           <?php if(isset($allsector) && count($allsector)>=1) {?>
               <?php foreach($allsector as $sector) {?>
                   <?php echo "<b>Sector:</b> ".$sector->sector."</div>"; ?>
               <?php } ?>
           <?php } ?>
           <div class="col-lg-3">
           <?php if(isset($allroca) && count($allroca)>=1) {?>
               <?php foreach($allroca as $datoroca) {?>
                   <?php echo "<b>Tipo de roca:</b> ".$datoroca->tiporoca."</div></div>"; ?>
               <?php } ?>
           <?php } ?>
           <div class="row text-light">
           <div class="col-lg-3">
           <?php echo "<b>Nombre via: </b>".$nombrevia."</div>"; ?>
           <div class="col-lg-3">
           <?php echo "<b>Responsable: </b>".$responsablevia."</div>"; ?>
           <div class="col-lg-3">
           <?php echo "<b>Dificultad: </b>".$dificultadvia."</div>"; ?>
           <div class="col-lg-3">
           <?php echo "<b>Número de seguros: </b>".$segurosvia."</div></div>"; ?>
           <div class="row">
               <div class="col-lg-12">
           <?php if(isset($allvaloraciones) && count($allvaloraciones)>=1 && ($allvaloraciones<>0)) {
              $puntuaciontotal=0;
              $puntuacionparcial=0;
              $votostotal=0;
              $usuariostotal= array();
              $perfil= array();
              $puntuacion= array();
              $comentario= array();
              $idvalor= array();
              $reportado= array();
              foreach($allvaloraciones as $valoraciones) {
                   if ($sesionabierta) {
                       if ($_SESSION["IdId"]==$valoraciones->usuario) {
                           $valorado=true;
                       }
                   }
                    // echo $valoraciones->puntuacion; ?>
                   <?php $puntuacion[]=$valoraciones->puntuacion; ?>
                   <?php $puntuacionparcial=$puntuacionparcial + (int)$valoraciones->puntuacion; 
                         $votostotal=$votostotal+ (int) $valoraciones->votos;         
                    ?>
                   <?php // echo $valoraciones->comentario; ?>
                   <?php $comentario[]=$valoraciones->comentario; ?> 
                   <?php $idvalor[]=$valoraciones->idval; ?>  
                   <?php $reportado[]=$valoraciones->reportado; ?>
               <?php } ?>
               <?php $puntuaciontotal=$puntuacionparcial/$votostotal;
                    $puntuaciontotal=round( $puntuaciontotal, 1, PHP_ROUND_HALF_UP);
                    echo "<div class='alert alert-primary'>La puntuación total de la vía es de: <strong>".$puntuaciontotal."</strong></div></div></div>"; ?>
                    <?php if(isset($allperfiles) && count($allperfiles)>=1 && ($allperfiles<>0)) {?>
                    <?php //var_dump($allperfiles); ?>
               <?php foreach($allperfiles as $perfiles) {?>
                   <?php // echo $tipoperfil->perfil; ?>
                   <?php $perfil[]=$perfiles; ?>
               <?php } ?>
           <?php } else {
                        // var_dump($allperfiles);
                        foreach ($allperfiles as $per){
                           // echo $per;
                        $perfil[]=$per;
                        }
                    }?>
           <?php if(isset($allusuarios) && ($allusuarios<>0)) {?>
               <?php foreach($allusuarios as $usuarios) {?>
                   <?php // echo $usuarios->apodo; ?>
                   <?php $usuariostotal[]=$usuarios->apodo; ?>
               <?php } ?>
           <?php } ?>
               </div></div>
               <h3 class=" text-light ml-4">Valoraciones</h3>
               <hr />
               <?php $contador=0;
                    foreach($allvaloraciones as $valoraciones) {?>
        <div class="row ml-2 text-light">
            <div class="col-lg-2">
                <b>Usuario: </b><?php echo $usuariostotal[$contador]; ?>
            </div>
            <div class="col-lg-2">
                <b>Perfil: </b><?php echo $perfil[$contador]; ?>
            </div>
            <div class="col-lg-3">
                <b>Puntuación: </b><?php echo $puntuacion[$contador]; ?>
            </div>           
            <div class="col-lg-3">
                <b>Comentario: </b><?php echo $comentario[$contador]; ?>
            </div>           
            <?php if ($sesionabierta) {?>
            <div class="col-lg-2">
                <?php if ($reportado[$contador]==0){ ?>
                <a href="<?php echo $helper->url("valoraciones","reportar"); ?>&idva=<?php echo $idvalor[$contador]; ?>&prod=<?php echo $idvia; ?>" class="btn btn-secondary">Reportar</a></div>
                   <?php } else {?>
                       <div class="alert alert-warning">Reportada</div></div>
                       <?php }?>
            
                <?php } else { ?>
               <div class="col-lg-2"></div></div>
                 <?php } ?>
                   <?php $contador++; ?>
                      </div>
                      <hr />
                       <?php } ?>
                       
           <?php } else {
                echo "<h3 class='text-light'>Esta vía aún no ha recibido ninguna valoración.</h3></div></div>";
            } ?>
           <div class="row text-light"><div class="col-lg-12">
           <a href="<?php echo $helper->url("producto","verListado"); ?>" class="ml-4 btn btn-secondary">Volver</a>
           <?php if ($valorado==false && $sesionabierta==true){
                echo "<hr /><h3>Emitir valoración</h3>";
                echo "</div></div><div class='row'><div class='col-lg-12'>"; ?>
                <form action="<?php echo $helper->url("valoraciones", "crear"); ?>" method="post">
                <input type="hidden" name="product" value="<?php echo $idvia ?>" />
                <input type="hidden" name="usuario" value="<?php echo $_SESSION["IdId"]; ?>" />
                <input type="hidden" name="reportado" value="0" />
                Puntuación (1 al 10): <input type="number" name="puntuacion" class="form-control" max="10" min="1"required />
                <input type="hidden" name="votos" value="<?php echo $_SESSION["IdPerfil"]; ?>" />
                Comentario (Opcional): <input type="text" name="comentario" class="form-control" />
                <input type="submit" name="value" value="Valorar" class="btn btn-success" />
               </form>
            <?php } ?>
           </div></div>
<?php require 'inc/pie.inc'; ?>