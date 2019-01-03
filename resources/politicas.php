<!DOCTYPE html>
<?php
session_start();
date_default_timezone_set('America/Bogota');
if(!isset($_SESSION["us_id"])){
die(header("Location: ../index.php"));
}
require_once '../control/gets.php';
require_once '../control/sets.php';
?>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Reset</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
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
              <?php  $previewMsj=$getM->modalMsj($_SESSION['us_id']); foreach ($previewMsj as $pM) {
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
        <!--<a class="link-paginas" href="condiciones.php">Condiciones</a>-->
		</div>
	</div>

<!--	</div>-->


	<div id="contenedor-contenido-politicas">
	 <div id="contenedor-politicas">
	 
		 <h3 class="titulo-politicas">RESET</h3>
        <h4 class="titulo-politicas">(Red Social Estudiantil Tecnológica)</h4><br>

        <p id="texto-politica">
            <strong class="sub-politicas">POLÍTICAS DE USO DE RED SOCIAL RESET</strong> <br><br>

            <strong class="sub-politicas">Las políticas de uso definidas para la red social Reset para las cuentas oficiales y debidamente registradas son:</strong><br><br> Administrar y organizar con el fin de dar a conocer las actividades académicas, culturales, deportivas de la institución y apoyar la formación académica en todos sus ámbitos.<br><br>


            <strong class="sub-politicas">1.	Proteger la información confidencial y de propiedad: </strong> No publicar información confidencial o reservada acerca de estudiantes, instructores y ex alumnos. Quien comparta información confidencial en la red social, lo hace a consecuencias legales (Sujeto a las disposiciones constitucionales y legales aplicables).<br><br>

            <strong class="sub-politicas">2.	Respetar la audiencia: </strong> No utilizar insultos étnicos, personales u obscenidades. Mostrar respeto por la privacidad de las personas y de los temas que pueden ser objetables como es la religión y la política.<br><br>

            <strong class="sub-politicas">3.	Respetar el derecho de autor y el uso justo: </strong> Al publicar documentos, imágenes, archivos audiovisuales, ser conscientes de los derechos de autor y la propiedad intelectual. <br><br>

            <strong class="sub-politicas">4.No utilizar el nombre de la red o logos con fines políticos y publicitarios:</strong> No utilizar este medio para promocionar un producto o partido político.<br><br>

            <strong class="sub-politicas">5.	Conducta en la red: </strong>Asegúrese de que su conducta sea coherente con todas las políticas contenidas en el Reglamento Manual para la Convivencia.<br><br>

            <strong class="sub-politicas">6.	Uso del sentido común: </strong> Abstenerse de publicar artículos negativos que perjudiquen o reflejen negativamente la imagen y la reputación incluyendo los comentarios u otros mensajes sobre el abuso de drogas, alcohol, palabras fuera de tono, humor sexual, u otras conductas inapropiadas como Memes negativos.<br><br>

            <strong class="sub-politicas">7. Respeto de las diferencias: </strong>Apreciar la diversidad de opiniones, dentro del marco del respeto.<br><br>

            <strong class="sub-politicas">8. No Insultar o caer en provocaciones: </strong> Dada la facilidad de establecer un diálogo puede suceder que existan ataques de provocadores, también llamados trolls, para los cuales su único objetivo es provocar al interlocutor, basándose en insultos o argumentaciones sin sentido. Cuando se detecte algún usuario de este tipo se deberá ignorar y reportar al administrador para que le haga el llamado de atención pertinente.<br><br>

            <strong class="sub-politicas">9. Publicación de fotos y videos: </strong>No se deben publicar fotos y videos que involucren miembros de la comunidad educativa en donde se vea vulnerada la integridad de los integrantes de la institución, de igual forma las imágenes deben responder a actividades netamente institucionales. Los miembros deben evitar agregar como contactos a personas ajenas a la comunidad educativa de igual forma deben evitar incluir fotos o videos de los mismos.<br><br> 

            <strong class="sub-politicas">10. Los miembros de la comunidad educativa: </strong>(estudiantes, Instructores) deben evitar crear espacios o grupos (chat) en donde se divulguen mensajes negativos acerca de miembros de la institución o apreciaciones que no construyan ambientes sanos y de respeto.<br><br>

            De igual forma deben abstenerse de construir páginas o portales adicionales a nombre de la red Reset o de sus áreas, ya que la red no se hace responsable de sus publicaciones. Toda información de las áreas: Académica, Bienestar social, Administrativa y de Gestión Humana debe hacerse por medio de los canales oficiales de la red. POLÍTICAS DE USO DEL ADMINISTRADOR OFICIAL DE LA REDE SOCIAL RESET.<br><br>

            <strong class="sub-politicas">El administrador en el buen uso de sus funciones debe: </strong> <br><br> • Mantener la calidad y actualización de la información publicada.<br><br> • Atender y dar respuesta de forma rápida a las comunicaciones emitidas por los usuarios, a través de los esquemas electrónicos o por medio de respuestas automáticas.<br><br> • Velar porque la calidad de los mensajes emitidos prevalezca sobre la cantidad de los mismos.<br><br> • Publicar eventos o celebraciones del Servicio Nacional de Aprendizaje “SENA”, material audiovisual, información general relacionada con el ámbito educativo, teniendo en cuenta que sean mensajes que promuevan la interacción con los usuarios. <br><br>

              <strong class="sub-politicas">Legislación relacionada: </strong><br><br> • Constitución Política, artículo 15 y 20. <br> • Ley 1266 de 2008. <br> • Ley 1581 de 2012. <br> • Decretos Reglamentarios 1727 de 2009 y 2952 de 2010, y Decreto Reglamentario parcial No. 1377 de 2013.<br> • Sentencias de la Corte Constitucional C – 1011 de 2008, y C - 748 del 2011.<br> • Demás disposiciones reglamentarias y complementarias<br>
        </p>
	</div>
	
	</div><!--contenedor politicas-->
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>

</body>

</html>

