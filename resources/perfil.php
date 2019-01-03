<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8'); 
$idU=$_GET['idU'];
session_start();
date_default_timezone_get();
if(!isset($_SESSION["us_id"])){
die(header("Location: ../index.php"));
}
require_once '../control/gets.php';
require_once '../control/sets.php';
require_once '../control/arr.php';
require_once '../control/updates.php';
//actualizar perfil
if(isset($_POST['UPD'])){
	$val=new gets();
	if($val->valiSena($_POST['email'])){
	$Upd= new updates();
	$nom=$_POST['nombre'];
	$ape=$_POST['apellido'];
	$email=$_POST['email'];
	$ciud=$_POST['ciudad'];
	$Upd->actUser($idU,$email,$nom,$ape,$ciud);
}else {echo "<script>alert('Correo no valido, recuerde que el correo debe ser @Misena.edu.co');</script>";}
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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<!-- <link href='../css/style_msj.css' rel='stylesheet'> -->
	<script src='../css/msj.js'></script>
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
                      echo "<li class='mdl-menu__item' style='text-decoration:none; color:#039be5; cursor: default; background: none;'>{$r['nombre']}</li><li class='mdl-menu__item'><a href='perfil.php?idU={$_SESSION['us_id']}'>Mi perfil</a></li>";
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
			<a class="link-paginas" href="inicio.php">Inicio</a>

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
			<a class="link-paginas" href="politicas.php">Políticas</a>
			<a class="link-paginas" href="condiciones.php">Condiciones</a>
		</div>
	</div>


	<div id="contenedor-contenido-pagina-perfil">
		<div id="pagina-perfil">
			<?php 
				$prof = new gets();
	            $print = $prof->getProfile($idU);
	            $f = new arrCh();
	            foreach($print as $p){ echo "
			<div id='cambiar-perfil'>
				<div id='contenedor-foto-pagina-perfil'>
					<img class='responsive-img circle' src='{$p['foto']}' alt='foto perfil' title='foto perfil'>
				</div>";
				
			if($_SESSION['us_id']==$idU){
				echo "
				<div id='boton-actulizar-registros'>
					<a  href='javascript:ventana();' style='color:#fff;text-decoration: none;'<button>Actulizar perfil </button></a>
				</div>
				<div id='ventana1'>
					<div id='ventana2'>
						<form action='perfil.php?idU={$idU}' method='POST' >
							<label>Nombre</label><br>
							<input type='input' name='nombre' placeholder='Nombre' class='input-modal' value = '{$p['nombre']}' style = 'font-size:12px;'><br>
							<label>Apellido</label><br>
							<input type='input' name='apellido' placeholder='Nombre' class='input-modal' value = '{$p['apellido']}' style = 'font-size:12px;'><br>
							<label>Correo</label><br>
							<input type='input' name='email' placeholder='Email' class='input-modal' value = '{$p['email']}' style = 'font-size:12px;'><br>";
							//llenado de ciudades
							$ciudad = $prof->getCiudad();
							$depart = $prof->getDepart();
							?>
							
               				<label>Ciudad</label>
							<select  name='ciudad' class='form-control' id='sel1' style='width:40%; font-size:12px;'>
							<?php foreach($ciudad as $C) {if ($C['id']==$p['idC']){echo "<option value='{$C['id']}' selected='selected'>{$C['nombre']}</option>'";}
							else {echo "<option value='{$C['id']}'>{$C['nombre']}</option>";}} ?> 				
							</select>
							<?php
							echo "
							<input class='botones-ventana' type='submit' name ='UPD' value='Actulizar Información'><br>				
						</form>
						<br>
					<form action='../control/upimg.php' method='POST' enctype='multipart/form-data'>
						<p id='parrafo2'>Cambiar foto de perfil</p>
						<input class='boton-actulizar' type='file' name = 'file'><br><br>
						<input id='boton-actulizar2' type='submit' value='Actualizar foto' name = 'subir'>
					</form>	
					<a href='javascript:ventanacerrar();'><input class='botones-ventana' type='submit' value='Cerrar' style = ' margin-left:85%;'></a>
				</div><!--id='ventana1'	-->
				</div><!--id='ventana2'	-->
				
				";} else { echo "
				<div id='body' style='overflow:hidden;'>
				<div id='abc'>
				<!-- Popup Div Starts Here -->
				<div id='popupContact'>
				<!-- Contact Us Form -->
				<form action='perfil.php?idU={$idU}' id='msj' method='POST' name='form'>
				<img id='close' src='../img/icon/3.png' onclick ='div_hide()'>
				<h2 id= 'textoComentario'>Enviar mensaje a {$f->upChar($p['nombre'])}</h2>
				<hr>
				<textarea id='txtMsj' name='msj' placeholder='Mensaje'></textarea>
				<input id='submit' type='submit' value='Enviar' name = 'send'>
				</form>
				</div>
				</div>
				<button id='popup' onclick='div_show()' style='margin-left:5%;color:white;'>Enviar mensaje</button>
				</div>
				";} ?>
		</div>


		<div id="informacion-perfil">
			<?php
				echo "
				<h3 class='parrafo'>Datos personales</h3>
				<P class='datos'><strong class='negrita-text'>NOMBRE:</strong> {$f->upChar($p['nombre'])} {$f->upChar($p['apellido'])}</P>
				<P class='datos'><strong class='negrita-text'>E-MAIL: </strong>{$p['email']} </P>
				<P class='datos'><strong class='negrita-text'>CIUDAD:</strong> {$p['ciudad']}</P>
				<P class='datos'><strong class='negrita-text'>DEPARTAMENTO:</strong> {$p['departamento']}</P>
				<h3 class='parrafo'>Grupos</h3>
				<P class='datos'><strong class='negrita-text'>Programa :</strong> {$p['grupo_p']}</P>
				<P class='datos'><strong class='negrita-text'>Curso :</strong> {$p['grupo_s']}</P>";

				}
				?>
		</div>


		<!--</div>
		 cieere pagina-perfil-->
	</div>
	<!-- cierre contenedor-contenido-pagina-perfil"-->
	
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</body>
<?php
if(isset($_POST['send'])){

    $pub = new sets();
    $texto=$_POST['msj'];
    $pub->insMsj($idU,$_SESSION["us_id"],$texto);
   echo '<script>swal("Su mensaje fue enviado");</script>';
    }
?>
</html>
