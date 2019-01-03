<?php  
require_once '../control/updates.php';
session_start();

if($_POST){ 

$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; 
$cad = ""; 
for($i=0;$i<12;$i++) { 
$cad .= substr($str,rand(0,62),1); 
} 

$tamano = $_FILES [ 'file' ][ 'size' ]; 
$tamaño_max="50000000000"; 
if( $tamano < $tamaño_max){ 
$destino = '../img/p_profile' ;
$sep=explode('image/',$_FILES["file"]["type"]); 
$tipo=$sep[1]; 
if($tipo == "gif" || $tipo == "jpeg" || $tipo == "bmp"|| $tipo == "jpg"|| $tipo == "png"){ 
move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], $destino . '/' .$cad.'.'.$tipo); 
//inserte a base de datos
$up = new updates();
$up->upFoto($destino.'/'.$cad.'.'.$tipo,$_SESSION['us_id']);
echo"<script language='javascript'>window.location='../resources/perfil.php?idU={$_SESSION['us_id']}'</script>";
} 
else echo "el tipo de archivo no es de los permitidos";
} 
else echo "El archivo supera el peso permitido.";
} 

?>