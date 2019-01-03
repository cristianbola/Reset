<!DOCTYPE html>
<?php
session_start();
date_default_timezone_set('America/Bogota');
if((!($_SESSION['us_rol']==2)) & (!isset($_SESSION['us_id']))){
    header('Location: ../index.php');
}
if (isset($_GET['pg'])) {
    $desde = $_GET['pg'];
} else {
    $desde = 0;
}
$id=$_SESSION['us_id'];
require_once '../control/getAdmin.php';
require_once '../control/gets.php';
$arr=new gets();
?>
<html lang='en'>
<head>
    <title>Administrador Reset</title>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        /* Set black background color, white text and some padding */
        footer {
            background-color: #555;
            color: white;
            padding: 15px;
        }
    </style>
</head>
<body>

<nav class='navbar navbar-inverse'  style = 'background-color: rgb(242, 118, 73);'>
    <div class='container-fluid'  style = 'background-color: rgb(242, 118, 73);'>
        <div class='navbar-header' >
            <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>

            </button>

            <a class='navbar-brand' href='#' ><img src = '../resources/img/logo.png' style ='margin-top: -10%;margin-left: -10%;width: 60%;height: auto;'></a>
        </div>
        <div class='collapse navbar-collapse' id='myNavbar' style = 'background-color: rgb(242, 118, 73);'>
            <ul class='nav navbar-nav'>
                <li class='active'><a href='../'  style = 'background-color: rgb(242, 118, 73);'>Ir a RESET</a></li>
                <li class='active' ><a href='../control/logout.php'  style = 'background-color: rgb(242, 118, 73);'>Cerrar sesion</a></li>

            </ul>


        </div>
    </div>
</nav>
<br>
<div class='container text-center'>
    <div class='row'>
        <div class='col-sm-3 well'>
            <div class='well'>
                <?php $info = new getAdmin(); $getInfo = $info->getInfo($id);
                foreach ($getInfo as $inf){ $nombre = $inf['nombre']; echo" 
        <p><a href='#'>{$inf['nombre']} {$inf['apellido']}</a></p>
        <img src='{$inf['p_profile']}' class='img-circle' height='65' width='65' alt='Avatar'>
      </div>
      <div class='well'>"; } ?>
                <p><a href='#'>Grupos</a></p>
                <p>
                    <span class='label label-default'>Administrador</span>
                    <?php $getGpo = $info->getGpo($id); foreach ($getGpo as $Gpo){ echo "
          <span class='label label-primary'>{$Gpo['nombre']}</span>
          ";} ?>

                </p>
            </div>
            <div class='alert alert-success fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>
                <?php echo " <p><strong>Hola {$nombre}</strong></p>" ; ?>
                Recuerda que este es el menu de administrador, lo debes usar con responsabilidad.
            </div>
            <p><a href='admin-reset.php'>Administrar Grupos</a></p>
            <p><a href='admin-bibliotecas.php'>Administrar bibliotecas</a></p>
            <p><a href='inform.php'>Descargar informes</a></p>
            <p><strong>Ir a publicaciones de grupo</strong></p>
            <form method="post" action="">
                <select name='id_gpo'>
                    <?php $grupos = $info->getAll(); foreach ($grupos as $g) { echo "
            <option value = '{$g['id']}'>{$g['nombre']}</option> "; } ?>
                </select >
                <button type='submit' name ='admin-publi' class='btn-primary'> ir </button>
            </form>

            <p><strong>Ultimas Bibliotecas</strong></p>
            <?php $bib = $info->bibTiny(); foreach ($bib as $b){ echo "
            <p><a href='{$b['src']}' target='_blank'>{$b['nombre']}</a></p> "; }?>
        </div>
<!--      termina el cabezal-->
    <div class="col-sm-7">
    
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-default text-left">
            <div class="panel-body">
              <p contenteditable="true">Administrador De Bibliotecas</p>
                 
            </div>
          </div>
        </div>
      </div>
      
      <div class="row">
          <div class="container" >
  <h2 style = 'width: 50%;'>Bibliotecas</h2>
  <p style = 'width: 50%;'>Administra las bibliotecas</p>            
  <table class="table table-hover" style = 'width: 50%;' style="position: fixed;">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Subido por</th>
          <th>Grupo</th>
          <th>Fecha</th>
        <th>Eliminar</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $bibl=$info->getBibT($desde); foreach ($bibl as $b){ echo "
        <tr>
        <td>{$b['nombre']}</td>
        <td>{$b['nom']} {$b['ape']}</td>
        <td>{$b['grupo']}</td>
        <td>{$arr->difFecha($b['fecha'])}</td>
        <td><a href='admin-bibliotecas.php?idBib={$b['id']}'><button  name='eliminar' class ='btn-danger'>Eliminar</button></a></td>
      </tr>";}
      ?>
        
    </tbody>
  </table>
<nav aria-label="Page navigation example">
  <ul class="pagination" style="margin-left: -50%"> <?php if (!($desde== 0)){echo '
    <li class="page-item"><a class="page-link" href="admin-bibliotecas.php?pg='.($desde-12).'">< Anterior</a></li>';}
    else {echo '<li class="page-item"><a class="page-link" href="admin-bibliotecas.php?pg='.$desde.'">< Anterior</a></li>';}

    echo '<li class="page-item"><a class="page-link" href="admin-bibliotecas.php?pg='.($desde+12).'">Siguiente ></a></li>'; ?>
  </ul>
</nav>
</div>
      </div><br>
      
     
         
    </div>
    <div class="col-sm-2 well">
        <p><strong>Usuario recientes</strong></p>
        <?php $userPanel = $info->getUser(); foreach ($userPanel as $uPan){ echo "
            <div class='thumbnail'>
                <p>{$uPan['nombre']} {$uPan['apellido']}</p>
                <img src='{$uPan['foto']}' alt='{$uPan['nombre']}' width='400' height='300'>
                <p><strong>{$uPan['grupo1']}</strong></p>
                <p><strong>{$uPan['grupo2']}</strong></p>
                <p>{$arr->difFecha($uPan['fecha'])}</p>

            </div>
             "; }?>
    </div>
  </div>
</div>



</body>
<?php
if(isset($_GET['idBib'])){
    $idB=$_GET['idBib'];
    $info->delBib($idB);
    echo "<script>alert('Biblioteca eliminada.')</script>";
    echo"<script language='javascript'>window.location='admin-bibliotecas.php'</script>";
}
if(isset($_POST['admin-publi'])){
    $idGpo=$_POST['id_gpo'];
    echo"<script language='javascript'>window.location='admin-post.php?gpo=".$idGpo."'</script>";

}
?>
</html>
