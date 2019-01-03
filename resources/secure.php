<?php 
if(isset($_GET['fuckPass'])&& isset($_GET['idUser'])){
$token=$_GET['fuckPass'];
$idU=$_GET['idUser'];
}
else {header ("Location: ../index.php");} 
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8'); 
require_once '../control/gets.php';
require_once '../control/sets.php';
require_once '../control/arr.php';
require_once '../control/updates.php';
//actualizar perfil

?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Reset</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<!-- 	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	

	


</head>

<body>
	<div id="barra-lateral">
		<a href="inicio.php"><img id = 'logo' src="img/logo.png" alt="Reset" title="Reset"></a>
	</div>

	<br><br>
	 <div class="container">
            <div id="passwordreset" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">Crea una nueva contraseña</div>
                    </div>                     
                    <div class="panel-body">
                        <form id="signupform" class="form-horizontal" role="form" action = '' method="post">
                           
                            <div class="form-group">
                                <label for="email" class=" control-label col-sm-3">Nueva Contraseña</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="password1" placeholder="Contraseña">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class=" control-label col-sm-3">Confirma tu contraseña</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="password2" placeholder="Confirmar">
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- Button -->                                 
                                <div class="  col-sm-offset-3 col-sm-9">
                                    <button id="btn-signup" type="submit" class="btn btn-success" name = 'OK' style = 'width:75%;'>Cambiar</button>
                                </div>
                            </div>                             
                        </form>
                    </div>
                </div>
            </div>             
        </div>


  </div>
  </div>


	

	<!-- cierre contenedor-contenido-pagina-perfil"-->
	
	
</body>
<?php
if(isset($_POST['OK'])){
	
	if(!($_POST['password1']==$_POST['password2'])){echo '<script>swal("La confirmacion de contraseña no coincide.");</script>';}
	else {
		$pass=$_POST['password1'];
		$val= new gets();
		$vali=$val->securePass($token,$idU);
		if(!($vali)==null){
			foreach ($vali as $v) {$idT=$v['id'];}
		$cambiar = new updates() ;
		$cambiar->actPass($idU,md5($pass),$idT);
		echo '<script>swal("Su password ha sido cambiado");</script>';

		}
			else {echo '<script>swal("Este enlace caduco o no es valido");</script>';
		
		}
	}
	
}
?>
</html>
