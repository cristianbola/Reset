<!DOCTYPE html>
<?php
session_start();
date_default_timezone_set('America/Bogota');
if(!isset($_SESSION["us_id"])){
header("Location: ../index.php");
}
require_once '../control/registro.php';
require_once '../control/gets.php';
require_once '../control/sets.php';
?>
<html lang="es-ES">

<head>
	<meta charset="UTF-8">
	<title>Reset</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
              <a href='inbox.php?idm={$pM['id']}'> <div class='mensajeria'>
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
                      echo "<li class='mdl-menu__item' style='text-decoration:none; color:#039be5; cursor: default; background: none;'>{$r['nombre']}</li><li class='mdl-menu__item' ><a href='perfil.php?idU={$_SESSION['us_id']}'>Mi perfil</a></li>";
                       ?>
			<li class="mdl-menu__item"><a href="../control/logout.php">Cerrar sesión</a></li>
		</ul>

		<div id="contenedor-perfil">
			<?php echo "<img class='img-circle' src='{$r['p_profile']}' alt='foto perfil' title='foto perfil'>"; } ?>
		</div>
	</div>

	<div id="barra-izquierda">
		<div class="ajustes-contenedores-barra">

			<p id="ajustes-texto-barra">
				<i class="material-icons">group</i>Grupos</p>
			<a class="link-paginas" href="inicio.php">Inicio</a>
			<?php  $gpo = new gets(); $res = $gpo->getGpo($_SESSION["us_id"]);
      		$i=1;
      foreach ($res as $r) {
      echo "<a class='link-paginas' href='grupos.php?idG={$r['id']}'>{$r['grupos']}</a>";
      ${'idG'.$i}=$r['id'];
      ${'Gpo'.$i}=$r['id'];
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
        <!--<a class="link-paginas" href="condiciones.php">Condiciones</a>-->
		</div>
	</div>


	<div id="contenedor-contenido-pagina-biblioteca">
		<div id="contenedor-biblioteca">
			<div id="biblio-opciones">
				<p class="textos-bibliotecas">Comparte tu biblioteca</p>

				<form action='../control/upbiblio.php' method='POST' enctype='multipart/form-data'>
					<p class="textos-bibliotecas">Archivo:</p>
					<input type='file' name='file'><br>
				
				
				<p class="textos-bibliotecas">Seleccione grupo a donde desea subir la biblioteca</p>
				<select class="select" name="upBib">
  						<?php  foreach($res as $r) { echo '<option value="'.$r['id'].'">'.$r['grupos'].'</option>';} ?> 					
				</select><br><br>

				<p class="textos-bibliotecas">Seleccione categoria de la biblioteca</p>
				<select class="select" name="catBib">
  						  <?php $cat = new gets();  $cBib = $cat->getCatBib();foreach($cBib as $c)  {
                     		echo '<option value="'.$c['id'].'">'.$c['nombre'].'</option>';}  ?>
  				</select><br><br>
				<input type='submit' value='Comparte!' id="compartir-biblio" name='OK'><br><br>
				</form>
<!--
				<div id="contenedor-buscador">
					<select id="select-buscar">
  						<option value="Programación">Programación</option>
  						<option value="Frontend">Frontend</option>
  						<option value="Poo">Poo</option>
  						<option value="Estructuras">Estructuras</option>
  						<option value="Diseño">Diseño</option>
					</select>
					<a id="boton-buscar" href="#"><i class="material-icons">search</i></a>
				</div>
-->
			</div>
			

			<div id="tablas-biblioteca">
				<table>
				
					<tr>
						<th>Nombre Archivo</th>
						<th>Categoría</th>
						<th>Grupos</th>
						<th>Subido por</th>
						<th>Fecha</th>
						<th>Descargar</th>
					</tr>
				
					<tr>
					 <?php $bib=new gets(); $resBib = $bib->getBib($Gpo1,$Gpo2);foreach ($resBib as $b) {
		            echo "<tr>
		              <td>{$b['nombre']}</td>
		              <td>{$b['cat']}</td>
		              <td>{$b['grupo']}</td>
		              <td>{$b['nom']}".' '."{$b['ape']}</td>
		              <td>{$bib->difFecha($b['fecha'])}</td>
		              <td><a target=\'_blank\' href='{$b['source']}''><i class='material-icons icono-biblioteca'>file_download</i></a></td>
		            </tr>";
		              } ?>
					</table>
			</div>
		</div>
	</div>
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</body>

</html>
