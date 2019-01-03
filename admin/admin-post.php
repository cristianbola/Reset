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
require_once '../control/updates.php';
$arr=new gets();
if(isset($_GET['gpo'])){
    $gpo=$_GET['gpo'];
} else {echo "<script>alert('No selecciono grupo')</script>";}
?>
<html lang="en">
<head>
  <title>Administrador Reset</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/post.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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

<nav class="navbar navbar-inverse"  style = 'background-color: rgb(242, 118, 73);z-index:3;position:fixed;width:100%'>
  <div class="container-fluid"  style = 'background-color: rgb(242, 118, 73);z-index:3;'>
    <div class="navbar-header" >
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
                             
      </button>
      <a class="navbar-brand" href="#" ><img src = '../resources/img/logo.png' style ='margin-top: -10%;margin-left: -10%;width: 60%;height: auto;'></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar" style = 'background-color: rgb(242, 118, 73);z-index:3;'>
      <ul class="nav navbar-nav">
          <li class='active'><a href='../'  style = 'background-color: rgb(242, 118, 73);'>Ir a RESET</a></li>
          <li class='active' ><a href='../control/logout.php'  style = 'background-color: rgb(242, 118, 73);'>Cerrar sesion</a></li>
        
      </ul>
      
     
    </div>
  </div>
</nav>
  <br>
<div class='container text-center'>
    <div class='row'>
        <div class='col-sm-3 well' style="position: fixed;margin-top: 5%;">
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
    <div class="col-sm-7" style="margin-left: 30%;margin-top: 5%">
    
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-default text-left">
            <div class="panel-body">
              <h2 style = 'text-align: center;'>Administrador De Publicaciones</h2>
                 
            </div>
          </div>
        </div>
      </div>
  <div class="row">
    <div class="col-md-8" style="width: 120%;">
        <?php $nombreGpo=$info->getNombreGpo($gpo);
        echo "<h2 class='page-header'>Publicaciones del Grupo {$nombreGpo[0]}</h2>"; ?>
        <section class="comment-list">
          <!-- First Comment -->
            <?php $publi=$info->getPubli($gpo,$desde); foreach ($publi as $p){ echo "
            <article class='row'>
                <div class='col-md-2 col-sm-2 hidden-xs'>
                    <figure class='thumbnail'>
                        <img class='img-responsive' src='{$p['foto']}' />
                        <figcaption class='text-center'>{$p['nombre']}</figcaption>
                    </figure>
                </div>
                <div class='col-md-10 col-sm-10'>
                    <div class='panel panel-default arrow left'>
                        <div class='panel-body'>
                            <header class='text-left'>
                                <div class='comment-user'><i class='fa fa-user'></i> {$p['nombre']}</div>
                                <time class='comment-date' datetime='{$p['fecha']}'><i class='fa fa-clock-o'></i> {$arr->difFecha($p['fecha'])}</time>
                            </header>
                            <div class='comment-post'>
                                <p>
                                    {$p['post']}
                                </p>
                            </div>
                            <p class='text-right'><a href='admin-post.php?gpo=".$gpo."&eliPost={$p['id_pub']}&pg=".$desde."' class='btn btn-default btn-sm'><i class='fa fa-reply'></i> eliminar</a></p>
                        </div>
                    </div>
                </div>
                <!--            comentario-->
                
            </article>";
                $coment=$info->getComents($p['id_pub']); foreach ($coment as $c) {
                echo "
                <article class='row' style='height: 50%'>
                    <div class='col-md-2 col-sm-2 col-md-offset-1 col-sm-offset-0 hidden-xs'>
                        <figure class='thumbnail' style='width: 50%;height: auto;'>
                            <img class='img-responsive' src='{$c['fotoC']}' />
                            <figcaption class='text-center' style='font-size: x-small;'>{$c['nombre']}</figcaption>
                        </figure>
                    </div>
                    <div class='col-md-9 col-sm-9'>
                        <div class='panel panel-default arrow left'>
                            <div class='panel-heading right'>Eliminar</div>
                            <div class='panel-body'>
                                <header class='text-left'>
                                    <div class='comment-user'><i class='fa fa-user'></i>{$c['nombre']}</div>
                                    <time class='comment-date' datetime='{$c['fecha']}'><i class='fa fa-clock-o'></i> {$arr->difFecha($c['fecha'])}</time>
                                </header>
                                <div class='comment-post'>
                                    <p>
                                        {$c['comen']}
                                    </p>
                                </div>
                                <p class='text-right'><a href='admin-post.php?gpo=".$gpo."&eliCom={$c['idC']}&pg=".$desde."' class='btn btn-default btn-sm'><i class='fa fa-reply'></i> Eliminar</a></p>
                            </div>
                        </div>
                    </div>
                </article> 
                <!--              fin comentario--> ";}}?>
        </section>
        <nav aria-label="Page navigation example">
            <ul class="pagination" style="margin-left: -50%"> <?php if (!($desde== 0)){echo '
    <li class="page-item"><a class="page-link" href="admin-post.php?pg='.($desde-5).'&gpo='.$gpo.'">< Anterior</a></li>';}
                else {echo '<li class="page-item"><a class="page-link" href="admin-post.php?pg='.$desde.'&gpo='.$gpo.'">< Anterior</a></li>';}

                echo '<li class="page-item"><a class="page-link" href="admin-post.php?pg='.($desde+5).'&gpo='.$gpo.'">Siguiente ></a></li>'; ?>
            </ul>
        </nav>
    </div>
  </div>
         
    </div>
   
  </div>

</div>

</body>
<?php
$eli=new updates();
if(isset($_GET['eliPost'])){
$eli->borrarPub($_GET['eliPost']);
echo "<script>alert('Publicacion Borrada')</script>";
echo"<script language='javascript'>window.location='admin-post.php?pg={$desde}&gpo={$gpo}'</script>";
}
if(isset($_GET['eliCom'])){
$eli->borrarPub($_GET['eliCom']);
echo "<script>alert('Comentario Borrada')</script>";
echo"<script language='javascript'>window.location='admin-post.php?pg={$desde}&gpo={$gpo}'</script>";
}
/** @var TYPE_NAME $_POST */
if(isset($_POST['admin-publi'])){
    $idGpo=$_POST['id_gpo'];
    echo"<script language='javascript'>window.location='admin-post.php?gpo=".$idGpo."'</script>";

}
?>
</html>
