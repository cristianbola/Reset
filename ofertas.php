<?php
require_once 'control/gets.php';
require_once 'control/sets.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Reset</title>
	<link rel="stylesheet" href="resources/css/style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<!-- 	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	

	


</head>

<body>
	<div id="barra-lateral">
		<a href="index.php"><img id = 'logo' src="img/logo.png" alt="Reset" title="Reset"></a>
	</div>

	<br><br>
	 <div class="container">
            <div id="passwordreset" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <h2>Enviar ofertas laborales</h2><br>
                <p>Recuerda colocar datos validos para poder que tu oferta sea ubicada en el lugar correcto y tenga una respuesta efectiva, y del personal buscado.</p>
                <div class="panel panel-info">
                    
                    <div class="panel-heading">
                        <div class="panel-title">Envia una oferta de trabajo</div>
                    </div>                     
                    <div class="panel-body">
                        <form id="signupform" class="form-horizontal" role="form" action = '' method="post">
                           
                            <div class="form-group">
                                <label for="email" class=" control-label col-sm-3">Nombre de la emrpesa</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="empresa" placeholder="Nombre de la empresa">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class=" control-label col-sm-3">Correo empresa</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="email" placeholder="usuasrio@tudominio.com">
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="email" class=" control-label col-sm-3">Telefono</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="tel" placeholder="Telefono de contacto">
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="text" class=" control-label col-sm-3">Descripcion</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control" name="desc" placeholder="Descripcion de la oferta"></textarea>
                                </div>
                            </div>
                                <div class="form-group">
                               <label for="text" class=" control-label col-sm-3">Habilidades</label>
                              <select class="form-group" name = 'programa' >
                                <?php $prog=gets::programaUsr(); foreach ($prog as $p) {
                                    echo "
                                    <option value = '{$p['id']}' >{$p['descripcion']}</option >
                                    ";
                                  }
                                ?>
                              </select>
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


<?php 
if(isset($_POST['OK'])){
    $nomEmpr=$_POST['empresa'];
    $email=$_POST['email'];
    $tel=$_POST['tel'];
    $desc=$_POST['desc'];
    $hab=$_POST['programa'];

    sets::sendOfert($nomEmpr,$email,$tel,$desc,$hab);
    echo "<script>swal('Su oferta ha sido enviada');</script>";
}
 ?>


	

	<!-- cierre contenedor-contenido-pagina-perfil"-->
	
	
</body>

</html>

