<?php

session_start();

date_default_timezone_set('America/Bogota');

if(!isset($_SESSION["us_id"])){

header("Location: ../index.php");

}
if (isset($_GET['pg'])) {
    $desde = $_GET['pg'];
} else {
    $desde = 0;
}
//echo "<script>alert('{$desde}')</script>";
require_once '../control/gets.php';

require_once '../control/sets.php';

//Funcion de comentarios

if(isset($_POST['OK']))

{

$com="com".$_POST['p'];

$idP=$_POST['p'];

$c_Com=$_POST[$com];

$com = new sets();

$com->setComPost($idP,$_SESSION['us_id'],$c_Com);

//refresca pagina

echo"<script language='javascript'>window.location='inicio.php'</script>";

}

      

if(isset($_POST['PUB'])){

$pub = new sets();

$post=$_POST['post_cont'];

$pub->setPost($_SESSION['us_id'],'1',$post);

}

?>

    <!DOCTYPE html>

    <html lang="es">



    <head>
        <meta charset="UTF-8">
        <title>Reset</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
        <script src="js/jquery.js"></script>
        <script src="js/material.min.js"></script>
        <script src="js/materialize.min.js"></script>
        <script src="js/modal-registros.js"></script>
    </head>



    <body>

    <?php
    $getM= new gets();  $noti=$getM->cNoti($_SESSION['us_id']);
    ?>
    <div id="barra-lateral">
        <a href="inicio.php"><img id = 'logo' src="img/logo.png" alt="Reset" title="Reset"></a>
        <?php if($noti>0){ echo "
		<a href='javascript:inboxShow();'  style='margin-left:75%;color:white;'><span id='notiNum' data-value='{$noti}'>{$noti}</span><i class='material-icons'>question_answer</i></a>";}
        else {echo "<a href='javascript:inboxShow();'  style='margin-left:75%;color:#cc4413;'><i class='material-icons'>question_answer</i></a>";} ?>
            <div id='ventana-mensajeria'>
            <div id='ventana-mensajeria2'>
              <!-- mensajes modal -->
              <?php $getM= new gets(); $previewMsj=$getM->modalMsj($_SESSION['us_id']); foreach ($previewMsj as $pM) {
                # code...
              
              echo "
               <a href='inbox.php?idm={$pM['id']}'><div class='mensajeria'>
                   <p class='nombre-usuario-inbox'>{$pM['nombre']}</p>
                   <p class='confirman-mensaje'>".$getM->difFecha($pM['fecha'])."</p>
                    <img id='contendor-perfil-modal' src='{$pM['foto']}' 'foto de perfil' title='{$pM['nombre']}'>
                    <div class='contenedor-mensaje-modal'>
                       <p>{$pM['mensaje']}..</p> 
                    </div>
               </div></a>";
              }?>
            </div> <!--cierre ventana-noficaciones2'-->  
            <a href='javascript:inboxHidden();'><input type='submit' value='Cerrar' style='margin-left: 70%;'></a>
    </div><!--cierre ventana-noficaciones'-->

            <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">

  			<i class="material-icons">more_vert</i>

		</button>



            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right">

                <?php 

      //llenar datos de usuario

                    $test = new gets();

                    $resultado=$test->mTest($_SESSION['us_id']);

                      foreach($resultado as $r) {

                      echo "<li class='mdl-menu__item' style='text-decoration:none; color:#039be5; cursor: default; background: none;' >{$r['nombre']}</li><li class='mdl-menu__item'><a href='perfil.php?idU={$_SESSION['us_id']}'>Mi perfil</a></li>";
                      $role=$r['rol'];
                       ?>

                <li class="mdl-menu__item"><a href="../control/logout.php">Cerrar sesión</a></li>

            </ul>



            <div id="contenedor-perfil">

                <?php echo "<img class='responsive-img circle' src='{$r['p_profile']}' alt='foto perfil' title='foto perfil'>"; } ?>

            </div>

        </div>



        <div id="barra-izquierda">

            <div class="ajustes-contenedores-barra">



                <p id="ajustes-texto-barra">
                    <?php if($role==2){ echo  "<a href='../admin/admin-reset.php' class='link-paginas'> <i class='material-icons'>build</i>Panel administrador</a>";} ?>
                    <i class="material-icons">group</i>Grupos</p>

                <a class="link-paginas" href="">Inicio</a>



                <?php  $gpo = new gets(); $res = $gpo->getGpo($_SESSION["us_id"]);

      $i=1;

      foreach ($res as $r) {

      echo "<a class='link-paginas' href='grupos.php?idG={$r['id']}'>{$r['grupos']}</a>";

      ${'idG'.$i}=$r['id'];

      $i++;

      }?>

            </div>

            <div class="ajustes-contenedores-barra">



                <p class="ajustes-texto-barra-dos"><i class="material-icons">school</i>Biblioteca</p>

                <?php  $bib=$gpo->getBibTiny($idG1,$idG2);

            foreach ($bib as $b) { echo "<a id='ajustea' target=\'_blank\' href='{$b["source"]}'>{$b["nombre"]}</a><br>";}

      ?>



                <a class="link-paginas" href="biblioteca.php">Ir a mis bibliotecas</a>

            </div>

            <div class="ajustes-contenedores-barra">



                <p class="ajustes-texto-barra-dos"><i class="material-icons">info</i>Acerca de</p>

                <a class="link-paginas" href="politicas.php">Politícas</a>

<!--                <a class="link-paginas" href="condiciones.php">Condiciones</a>-->

            </div>

        </div>

        <!-- publicaciones -->

        <div id="contenedor-contenido-paginas">

            <?php

$test = new gets();

$post = $test->getHome($idG1,$idG2,$desde);

foreach($post as $p) { echo "

          <div id='comentarios'> 

             <div class=''>

              <div class='row'>

                  <div id='datos'>

                    <div id='foto'>

                        <img class='circle responsive-img ' id='quien' src='{$p['foto']}' alt='foto perfil' title='foto perfil'>

                        <div id='informacion'>

                           <span><a  id='nombre' href='perfil.php?idU={$p['id']}'>{$p['nombre']}</a></span>

                           <span class='tiempo'>{$test->difFecha($p['fecha'])} en {$p['grupo']}</span>

                        </div>

                    </div>

                    

                    <div id='comentario'>

                      <h2 id='textoComentario'>{$p['post']}</h2>

                    </div>

                    <hr>";

                    $com = $test->getComPost($p['id_pub']);                                         

                    foreach($com as $c){ echo "

                    <div id='subC'>

                       <div id='foto2'>

                            <div id='informacion2'>

                                <img class='circle responsive-img ' id='quien2'  src='{$c['fotoC']}' alt='foto perfil' title='foto perfil'>

                                <span><a id='nombre' href='perfil.php?idU={$c['id']}'>{$c['nombre']}</a></span>

                                <span class='tiempo'>{$test->difFecha($c['fecha'])}</span>

                            </div>

                       </div>

                       <h2 id='textoComentario2'>{$c['comen']}</h2>

                    </div> <hr>"; } echo "

                    

                    <div id='comentar'>

                        <form method ='POST' action = 'inicio.php'>

                          <div class='row'>

                              

                              <div class='input-field col s12'>

                                  <textarea id='icon_prefix2' name='com{$p['id_pub']}' class='materialize-textarea'></textarea>

                                  <label for='icon_prefix2' id='comen'>Escribe un comentario...</label>

                                  <input type = 'hidden' name ='p' value = '{$p['id_pub']}'>

                              </div>

                              

                          </div>

                          <input class='botonR' type='submit' name='OK' value='comentario'>

                       </form>

                    </div> 

                    <!-- termina boton -->

                  </div> 

              </div>

          </div>

       	</div>";} $pg2 = $desde+20; echo "
              <ul class='pagination'>
                  "; if($desde >0){ $pg1=$desde-20;echo "<li class='waves-effect' style = 'margin-left: 40%;'><a href='inicio.php?pg={$pg1}' ><i class='material-icons'>chevron_left</i></a></li>";}
                    else {echo "<li class='disabled' style = 'margin-left: 40%;'><a href='inicio.php?pg={$desde}' ><i class='material-icons'>chevron_left</i></a></li>";} echo "
    
                  <li class='waves-effect' ><a href='inicio.php?pg={$pg2}'><i class='material-icons'>chevron_right</i></a></li>
              </ul>"; ?>

        </div>

        <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>

    </body>
    <footer>

    </footer>


    </html>
