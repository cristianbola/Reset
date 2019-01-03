<?php
session_start();
date_default_timezone_set('America/Bogota');
if(!isset($_SESSION["us_id"])){
header("Location: ../");
}
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once '../control/registro.php';
require_once '../control/gets.php';
require_once '../control/sets.php';
$idm=$_GET['idm'];
?>
<!DOCTYPE html>
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
    <div id="barra-lateral">
    <a href="inicio.php"><img id = 'logo' src="img/logo.png" alt="Reset" title="Reset"></a>
    
                      
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
      <a class="link-paginas" href="condiciones.php">Condiciones</a>
    </div>
  </div>


	<div id="contenedor-contenido-inbox">
       
        <div id='ventana-mensajeria-inbox'>
          <?php $prMsj = new gets(); $msj = $prMsj->priMsj($_SESSION['us_id']); foreach ($msj as $m) {
            
              echo "<a href='inbox.php?idm={$m['id']}'>
               <div class='mensajeria'>
                   <p class='nombre-usuario-inbox'>{$m['nombre']}</p>
                   <p class='confirman-mensaje'>".$m['fecha']."</p>
                    <img id='contendor-perfil-modal' src='{$m['foto']}' 'foto de perfil' title='{$m['nombre']}'>
                    <div class='contenedor-mensaje-modal'>
                       <p>{$m['mensaje']}</p> 
                    </div>
               </div></a>"; }
               ?>
               
              </div> <!--cierre ventana-mensajeria-inbox-->
            
            <div id='ventana-inbox' style='height: 70%; overflow: scroll;overflow-x:hidden;'>
               <?php $conte=$prMsj->getMsj($_SESSION['us_id'],$idm); foreach ($conte as $con) {
                
                 if($con['idS']!= $_SESSION['us_id']){
               
              echo "
              <!-- ellos -->
                <div class='mensajes-usuarios'>
                    <div class='inbox-usuario-entrada'style = 'word-wrap: break-word;background: #01a6bd5e;>
                        <p  class='nombre-usuario-inbox'><strong>{$con['nombreS']}</strong></p>
                        <p class='confirman-mensaje'>{$prMsj->difFecha($con['fecha'])}</p>
                    <div class='contenedor-mensaje-modal-inbox'>
                       <p>{$con['texto']}</p> 
                    </div>
                    </div>
                </div><br>";
              }if($con['idS']!=$idm){ echo " 
                <!-- yo -->
                <div class='mensajes-usuarios'>
                     <div class='inbox-usuario-salida'style = 'word-wrap: break-word; background: #f276499>
                         <p  class='nombre-usuario-inbox'><strong>{$con['nombreS']}</strong></p>
                        <p class='confirman-mensaje' alt = '{$con['fecha']}'>{$prMsj->difFecha($con['fecha'])}</p>
                    <div class='contenedor-mensaje-modal-inbox' style = 'background: #f276499;' >
                       <p>{$con['texto']}</p> 
                    </div>
                    </div>
                </div><br>";
                 }
                } ?>
                </div><!-- cierre ventana-inbox-->
                <form method="post" action="">
                <div id='contenedor-eniviar-mensaje' style="width:64%;position:fixed !important; right:0%; top:77%; z-index:10 !important">
                   
                    <input name = 'contSend' type='input' placeholder='Escribe un mensaje' id='text-eniviar-mensaje' >
                     <button name = 'send' type = "submit"  id='icono-enviar-mensaje' style='margin-left: 90%;background-color: rgba(0, 0, 0, 0);'><i class="material-icons">send</i></button>
                </div>
                </form>
	</div><!-- cierre contenedor-contenido-inbox-->
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</body>
<?php if(isset($_POST['send'])){
  $mensaje=$_POST['contSend'];
  if(!($mensaje==null || $mensaje == ' ' || $mensaje== '' || $mensaje == '  ')){
  $send = new sets();
  $send->insMsj($idm,$_SESSION['us_id'],$mensaje); 
  echo"<script language='javascript'>window.location='inbox.php?idm={$idm}'</script>";
}
}
?>
</html>
