<?php
session_start();
if(!(($_SESSION['us_rol']==2) & (isset($_SESSION['us_id'])))){
    header('Location: ../index.php');
}
date_default_timezone_set('America/Bogota');
$id=$_SESSION['us_id'];
require_once '../control/getAdmin.php';
require_once '../control/gets.php';
$arr=new gets();
?>
<!DOCTYPE html>
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
            <p><a href='#'>Administrar Grupos</a></p>
            
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
        <div class='col-sm-7'>

            <div class='row'>
                <div class='col-sm-12'>
                    <div class='panel panel-default text-left'>
                        <div class='panel-body'>
                            <p contenteditable='true'>Administrador De Grupos</p>

                        </div>
                    </div>
                </div>
            </div>

            <div class='row'>
                <div class='col-sm-3'>
                    <div class='well'>
                        <label>Agergar Grupo</label>
                    </div>
                </div>
                <div class='col-sm-9' style='text-align-last: left;'>
                    <form method = 'POST' action="">
                    <label> Nombre</label><input name = 'gNom' placeholder = 'Ej. ADSI' style='margin-left: 10%'><br>
                        <label> URL Amigable</label><input name = 'gUrl' placeholder = 'Ej. adsi-29' style='margin-left: 1%'><br>
                    <label> Descripcion</label><input name ='gDesc' placeholder = 'Ej. analista en sistemas' style='margin-left: 4%'><br>
                    <label>Enfoque</label> <select name = 'tGrupo'style='margin-left: 8%'><option value = '1'>Principal</option><option value = '2'>Enfocado</option></select><br>
                    <button type='submit' name = 'add' class='btn btn-primary' style='margin-left: 20%' >Agregar</button>
                    </form>
                </div>
            </div><br>
            <div class='row'>
                <div class='col-sm-3'>
                    <div class='well'>
                        <label>Modificar Grupo</label>
                    </div>
                </div>
                <div class='col-sm-9'>


                    <form action="" method="post">
                        <label >Grupo</label>
                    <select name = 'grupMod'>
                        <?php
                        foreach ($grupos as $g) { if((isset($_GET['modG'])& ($_GET['modG']==$g['id'])))
                            {echo " <option value = '{$g['id']}' selected>{$g['nombre']}</option>";}
                            echo "
            
            <option value = '{$g['id']}' >{$g['nombre']}</option> "; } ?>

                        ?>
                    </select><button name = 'ir' type='submit' class='btn btn-warning' style="margin-left: 2%">ir a modificar</button>

                    <?php if(isset($_GET['modG'])){
                        $modGpo=$info->infoGMod($_GET['modG']); foreach ($modGpo as $mod){
                        echo "<br><br>
                    <form method = 'POST' action=''>
                    <label> Nombre</label><input name = 'gNomM' value = '{$mod['nombre']}' style='margin-left: 10%'><br><br>
                    <label> URL Amigable</label><input name = 'gUrlM' value = '{$mod['slug']}' style='margin-left: 1%'><br><br>
                    <label> Descripcion</label><input name ='gDescM' value = '{$mod['descripcion']}' style='margin-left: 4%'><br><br>
                    <label style='margin-left: 0%'>Enfoque</label> <select name = 'tGrupoM'><option value = '2'>Enfocado</option><option value = '1'>Principal</option></select>
                    <input type='hidden' name = 'gId' value = '{$mod['id']}'>
                    <button type='submit' name = 'mod' class='btn btn-warning' style='margin-left: 5%' >Modificar</button>
                    </form> <br><br><br>";}

                    }


                    ?></form>
                </div>
            </div><br>
            <div class='row'>
                <div class='col-sm-3'>
                    <div class='well'>
                        <label>Eliminar grupo</label>
                    </div>
                </div>
                <div class='col-sm-9'>
                    <form action="" method="post">
                    <label>Grupo</label> <select name ='delG'>
                        <?php foreach ($grupos as $g) { echo "
                        <option value = '{$g['id']}'>{$g['nombre']}</option> "; } ?>
                    </select>
                    <button name='del' type='submit' class='btn btn-danger'>Eliminar</button>
                    </form>
                </div>
            </div>

        </div>
        <div class='col-sm-2 well'>
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

<footer class='container-fluid text-center'>
    <p>Administrador RESET Red social tecnologica estudiantil</p>
</footer>

</body>
<?php
//seccion de modificacion de grupos
// agregar grupo
if(isset($_POST['add'])){
    $nomG=$_POST['gNom'];
    $descG=$_POST['gDesc'];
    $tG=$_POST['tGrupo'];
    $urlG=$_POST['gUrl'];
    $info->setGpo($nomG,$descG,$tG,$urlG);
    echo "<script>swal('Agregado grupo {$nomG} con exito')</script>";
}
//modificar grupo
if(isset($_POST['mod'])){
    $idGpo=$_POST['gId'];
    $nomG=$_POST['gNomM'];
    $descG=$_POST['gDescM'];
    $tG=$_POST['tGrupoM'];
    $urlG=$_POST['gUrlM'];
    $info->updateGpo($nomG,$descG,$tG,$urlG,$idGpo);
    echo "<script>swal('Modificado el grupo {$nomG} con exito');sleep(4000);</script>";
    echo"<script>sleep(4000)</script></script><script language='javascript'>window.location='admin-reset.php'</script>";
}

if(isset($_POST['ir'])){
    echo"<script language='javascript'>window.location='admin-reset.php?modG={$_POST['grupMod']}'</script>";

}

if(isset($_POST['del'])){
    $id=$_POST['delG'];
    $info->delGpo($id);
    echo "<script>swal('A sido borrado el grupo');sleep(4000);</script>";

}

if(isset($_POST['admin-publi'])){
    $idGpo=$_POST['id_gpo'];
    echo"<script language='javascript'>window.location='admin-post.php?gpo=".$idGpo."'</script>";

}

?>

</html>
