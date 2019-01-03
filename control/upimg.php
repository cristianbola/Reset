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
//redimecionar imagen

$rtOriginal=$_FILES['file']['tmp_name'];
if($tipo=='jpg'||$tipo=='jpeg'){$original = imagecreatefromjpeg($rtOriginal);}
if($tipo=='png'){$original = imagecreatefrompng($rtOriginal);}
if($tipo=='gif'){$original = imagecreatefromgif($rtOriginal);}
$max_ancho = 600; $max_alto = 400;
list($ancho,$alto)=getimagesize($rtOriginal);
$x_ratio = $max_ancho / $ancho;
$y_ratio = $max_alto / $alto;
if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
    $ancho_final = $ancho;
    $alto_final = $alto;
}
else if(($x_ratio * $alto) < $max_alto){
    $alto_final = ceil($x_ratio * $alto);
    $ancho_final = $max_ancho;
}
else {
    $ancho_final = ceil($y_ratio * $ancho);
    $alto_final = $max_alto;
}
$lienzo=imagecreatetruecolor($ancho_final,$alto_final);
imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
imagedestroy($original);
//crear thumb
if($tipo == "gif" || $tipo == "jpeg" || $tipo == "bmp"|| $tipo == "jpg"|| $tipo == "png"){ 
imagejpeg($lienzo,$destino.'/'.$cad.'.'.$tipo);
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