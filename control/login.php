<?php
session_start();
require_once 'control/gets.php';
if(isset($_POST['START'])){
$var = new gets();
$get = $var->valiSesion($_POST['sEmail'],md5($_POST['sPass']));
if($get)
{
echo '<script>alert("Iniciando session con exito");</script>';
$_SESSION['us_id']=$get;
//session_start();
//echo"<script language='javascript'>window.location='res/test.php'</script>";
header("Location: ../res/test.php");
}
else					{
//echo '<script>alert("Usuario o contraseña erronea");</script>';
header("Location: ../");
}
}
?>