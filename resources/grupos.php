<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
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
require_once '../control/gets.php';
require_once '../control/sets.php';
require_once '../control/arr.php';
require_once '../control/updates.php';
$idG=$_GET['idG'];
$vGpo = new gets(); $res = $vGpo->getGpo($_SESSION["us_id"]); $i=1; foreach ($res as $r) { ${'vG'.$i}=$r['id'];$i++;}
if(!((($vG1==$idG)||($vG2==$idG))||$_SESSION["us_rol"]==2)){echo "<script>alert('No perteneces a este grupo')</script>" ; echo "<script language='javascript'>window.location='inicio.php'</script>";}

$idG=$_GET['idG'];
if(isset($_POST['OK']))
{
$com="com".$_POST['p'];
$idP=$_POST['p'];
$c_Com=$_POST[$com];
$com = new sets();
$com->setComPost($idP,$_SESSION['us_id'],$c_Com);
//refresca pagina
echo"<script language='javascript'>window.location='grupos.php?idG={$idG}'</script>";
}

  
if(isset($_POST['PUB'])){
$pub = new sets();
$post=$_POST['post_cont'];
$pub->setPost($_SESSION['us_id'],$idG,$post);
}

$nomg = new gets();
$res=$nomg->getGpo1($idG);
foreach ($res as $r) {
$nomGru = $r['nombre']; 
$portGru = $r['imagen'];
$princiGpo=$r['principal'];
}

if(isset($_POST['elicom'])){
	$idC=$_POST['idCom'];
	$eli = new updates();
	$eli->borrarCom($idC);
}
if(isset($_POST['eliPub'])){
	$idPub=$_POST['idPub'];
	$eli = new updates();
	$eli->borrarPub($idPub);
}
?>
<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>Reset</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="js/jquery.js"></script>
        <script src="js/material.min.js"></script>
        <script src="js/materialize.min.js"></script> 
        <script src="js/modal-registros.js"></script>
        <link rel="stylesheet" href="css/slide.css">
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
            	<?php $getM= new gets(); $previewMsj=$getM->modalMsj($_SESSION['us_id']); foreach ($previewMsj as $pM) {
            		# code...
            	
            	echo "
               <a href='inbox.php?idm={$pM['id']}'><div class='mensajeria'>
                   <p class='nombre-usuario-inbox'>{$pM['nombre']}</p>
                   <p class='confirman-mensaje'>".$getM->difFecha($pM['fecha'])."</p>
                    <img id='contendor-perfil-modal' src='{$pM['foto']}' 'foto de perfil' title='{$pM['nombre']}'>
                    <div class='contenedor-mensaje-modal'>
                       <p>{$pM['mensaje']}...</p> 
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
                      		$rol=$r['rol'];
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

					<i class="material-icons">group</i>Grupos</p>

				<a class="link-paginas"  href="inicio.php">Inicio</a>

				

				<?php  $gpo = new gets(); $res = $gpo->getGpo($_SESSION["us_id"]);

		      $i=1;

		      foreach ($res as $r) {

				//campana-icono 

                //echo"<i class='material-icons ' id='campana'>notifications</i>";

				  

		      echo " <a class='link-paginas'href='grupos.php?idG={$r['id']}'>{$r['grupos']}</a>";

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

				<a class="link-paginas" href="politicas.php">Políticas</a>

<!--				<a class="link-paginas" href="condiciones.php">Condiciones</a>-->

			</div>

		</div>





		<div id="contenedor-contenido-grupos">

		

			<div id="barra-derecha">

				<p id="usuarios-titulo">USUARIOS GRUPOS</p>

				<div class="usuarios-barra-derecha">

					<?php $getU= new gets(); $gU=$getU->getUsers($idG); $f = new arrCh();

					foreach ($gU as $g) {

					echo "<p ><a class='nombres-usuarios' href='perfil.php?idU={$g['id']}'>{$f->upChar($g['nom_u'])} </a><img class='img-responsive circle'  id='contenedor-foto-barra'  src='{$g['foto_u']}'></p>"; }

					?>

				</div>

			</div>

		</div>

		<!--Creacion de portada -->
		
            <?php
            if($princiGpo==1){
            	echo "<div id='foto-portada'>";
            	$ofert=$getU->getOfert($idG);
            	
            	$i=1;
                foreach($ofert as $of) { 
            		            	
            echo "
           
            <p class='item-{$i}' style = 'color : #cecece;font-size:larger;'><strong>{$of['nom_emp']}</strong><br>{$of['contenido']}<br> <strong>Email:</strong>{$of['email_emp']} <br></strong>Telefono:</strong> {$of['tele_emp']}</p>
            ";
            $i=$i+1;  }

            }else{
            	//aqui va boton de cambiar portada
            	echo "
            	<div id='foto-portada' style='background-image:url(img/portadas/teclado.jpg);'>
           		<button type = 'submit' onmouseout='hiden(this)' onmouseover='normal(this)' class='btn waves-effect waves-light' name='action' style = 'width:10%; font-size:10px; margin-left 60%;'>Cambiar portada<i class='material-icons right'>send</i></button>
           		</div>
                ";
                
            }
            ?>


		</div>
<!--Finaliza portada-->

		<br><br>

		<div id="contenedor-pc">

			<div id="caja-publicar">

				<div class="contenido mdl-shadow--2dp">

					<div class="row">

						<?php echo "<form action='grupos.php?idG={$_GET['idG']}' method='POST' >"; ?>

						<div class="row">

							<div class="input-field col s12">

								<i class="material-icons prefix">textsms</i>

								<textarea id="icon_prefix2" name="post_cont" class="materialize-textarea"></textarea>

								<label for="icon_prefix2">¿Que deseas compartir en <?php echo $nomGru?>?</label>

							</div>

						</div>

						<input id="botonpublicar" type="submit" name="PUB" value="Publicar!">

						</form>

					</div>

				</div>



				<?php

			 $test = new gets();

             $idG=$_GET['idG'];

             $post = $test->getPGpo($idG,$desde);

             foreach($post as $p) {  echo "

          

             	<div class='cajacomentarios '>

				<div class='row'>

					<div id='datos'>

						<div id='foto'>

							<img class='circle responsive-img' id='quien' src='{$p['foto']}' alt='foto perfil' title='foto perfil'>

							<div id='informacion'>

								<span id='nombre'><a id='nombre' href='perfil.php?idU={$p['id']}'>{$p['nombre']}</a></span>

								<span class='tiempo'>{$test->difFecha($p['fecha'])}. en {$p['grupo']}</span>
								<span id='tiempo' style = 'margin-left: 70%;  font-color: white; border-radius: 5px;'>"; if(($p['id']==$_SESSION['us_id'])||($rol==2)){echo "<form method = 'POST' action='grupos.php?idG={$idG}'>
                                <input type = 'hidden' name ='idPub' value='{$p['id_pub']}'>
                                <input type='submit' value = 'Eliminar' name = 'eliPub' class='botoneliminar' ></form>";} echo "

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

                                <img class='circle responsive-img ' id='quien2' src='{$c['fotoC']}' alt='foto perfil' title='foto perfil'>

                                <span id='nombre'><a href='perfil.php?idU={$c['id']}'>{$c['nombre']}</a></span>
                                <span class='tiempo'>{$test->difFecha($c['fecha'])}</span> 
                                <span id='tiempo' style = 'margin-left: 70%;  font-color: white; border-radius: 5px;'>"; if($c['id']==$_SESSION['us_id']||($rol==2)){echo "<form method = 'POST' action='grupos.php?idG={$idG}'>
                                <input type = 'hidden' name ='idCom' value='{$c['idC']}'>
                                <input type='submit' value = 'Eliminar' name = 'elicom' class='botoneliminar' ></form>";} echo "</span>
                                

                            </div>

                       </div>

                       <h2 id='textoComentario2'>{$c['comen']}</h2>

                    </div><hr> "; } echo "

						<div id='comentar'>

							<form method ='POST' action = 'grupos.php?idG={$idG}'>

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


					</div>

				</div>

			</div>";} $pg2 = $desde+20; echo "
              <ul class='pagination'>
                  "; if($desde >0){ $pg1=$desde-20;echo "<li class='waves-effect' style = 'margin-left: 40%;'><a href='grupos.php?idG={$_GET['idG']}&pg={$pg1}' ><i class='material-icons'>chevron_left</i></a></li>";}
                else {echo "<li class='disabled' style = 'margin-left: 40%;'><a href='' ><i class='material-icons'>chevron_left</i></a></li>";} echo "
    
                  <li class='waves-effect' ><a href='grupos.php?idG={$_GET['idG']}&pg={$pg2}'><i class='material-icons'>chevron_right</i></a></li>
              </ul>"; ?>


                <div>

			</div>

		</div>

		<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
		<script>
function hiden(x) {
    x.style.display = "none";
 }

function normal(x) {
    x.style.display = "inline";
    
}
</script>

	</body>

</html>

