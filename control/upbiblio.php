<?php  
require_once '../control/sets.php';
require_once '../control/arr.php';
session_start();

if($_POST['OK']){
$nombre = $_FILES['file']['name'] ;
$trozos = explode(".", $nombre); 
$extension = end($trozos); 
if(strlen($nombre)>25)
{
	$arr = new arrCh();
	$nombre=$arr->cutChar($nombre);
}


$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; 
$cad = ""; 
for($i=0;$i<12;$i++) { 
$cad .= substr($str,rand(0,62),1); 
} 

$tamano = $_FILES [ 'file' ][ 'size' ]; 
$tamaño_max="50000000000"; 
if( $tamano < $tamaño_max){ 
$destino = '../biblio' ;
$sep=explode('/',$_FILES["file"]["type"]); 
$tipo=$sep[1]; 

move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], $destino . '/' .$cad.'.'.$extension); 
//inserte a base de datos
$up = new sets();
$up->setBib($nombre , $destino.'/'.$cad.'.'.$extension,$_POST['catBib'],$_SESSION['us_id'],$_POST['upBib']);

echo"<script language='javascript'>window.location='../resources/biblioteca.php?idU={$_SESSION['us_id']}'</script>";


} 
else echo "El archivo supera el peso permitido.";
} 

?>