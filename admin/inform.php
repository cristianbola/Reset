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
            <p><a href='admin-reset.php'>Administrar Grupos</a></p>
            <p><a href='admin-bibliotecas.php'>Administrar bibliotecas</a></p>
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
                            <p contenteditable='true'>Informes</p>

                        </div>
                    </div>
                </div>
            </div>

            <div class='row'>
                <div class='col-sm-3'>
                    <div class='well'>
                        <label>Informes de bibliotecas subidas</label>
                    </div>
                </div>
                <div class='col-sm-9' style='text-align-last: left;'>
                    <form method = 'POST' action="info-bib.php" target="_blank">

                        <label> Cuantos registros deseas ver</label><input name = 'nB' placeholder = 'no dejar en blanco' style='margin-left: 1%'><br>

                        <button type='submit' name = 'infbib' class='btn btn-primary' style='margin-left: 20%' >Ir</button>
                    </form>
                </div>
            </div><br>


            <div class='row'>
                <div class='col-sm-3'>
                    <div class='well'>
                        <label>Informes Registro de usuarios</label>
                    </div>
                </div>
                <div class='col-sm-9'>


                    <form action="info-user.php" method="post">


                        <label> Cuantos registros deseas ver</label><input name = 'nU' placeholder = 'no dejar en blanco' style='margin-left: 1%'><br>

                        <button type='submit' name = 'infuser' class='btn btn-primary' style='margin-left: 20%' >ir</button>



                      </form>


                </div>
            </div><br>

            <div class='row'>
                <div class='col-sm-3'>
                    <div class='well'>
                        <label>Informes de inicio de Sesion</label>
                    </div>
                </div>
                <div class='col-sm-9'>


                    <form action="info-sesion.php" method="post">


                        <label> Cuantos registros deseas ver</label><input name = 'nS' placeholder = 'no dejar en blanco' style='margin-left: 1%'><br>

                        <button type='submit' name = 'infsesion' class='btn btn-primary' style='margin-left: 20%' >ir</button>



                      </form>

                      
                </div>
            </div>
<!--            <div class='row'>-->
<!--                <div class='col-sm-3'>-->
<!--                    <div class='well'>-->
<!--                        <label>Informe inicio de sesion de usuarios</label>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class='col-sm-9'>-->
<!--                    <form action="" method="post">-->
<!--                        <label> Cuantos registros deseas ver</label><input name = 'gUrl' placeholder = 'Ej. adsi-29' style='margin-left: 1%'><br>-->
<!---->
<!--                        <button type='submit' name = 'add' class='btn btn-primary' style='margin-left: 20%' >Agregar</button>-->
<!--                    </form>-->
<!--                </div>-->
<!--            </div>-->

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
if(isset($_POST['admin-publi'])){
    $idGpo=$_POST['id_gpo'];
    echo"<script language='javascript'>window.location='admin-post.php?gpo=".$idGpo."'</script>";

}

?>
?>
</html>
