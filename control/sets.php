<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once 'connect.php';
require_once 'gets.php';
require_once 'inform.php';
$conexion = new Conexion();
class sets {
	public function __construct() {
	
		
	}
	//metodo para ejectur publicaciones

	 public static function setPost ($id_us,$id_gpo,$texto){
	   if(!($texto==null)){
	   $filtrar = new sets();$texto=$filtrar->id_youtube($texto);
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare("INSERT INTO `publicaciones` (`id_usuarios`, `id_grupo`, `texto`) VALUES (:id_us, :id_gpo, :texto);");
	   $consulta->bindParam(':id_us', $id_us);
	   $consulta->bindParam(':id_gpo', $id_gpo);
	   $consulta->bindParam(':texto', $texto);
	   $consulta->execute();
		}
	        
	   
   }
   //metodo para ejecutar comentarios

   public static function setComPost ($id_Post,$id_us,$coment){
   	if(!($coment==null)){
   	   $filtrar = new sets();$coment=$filtrar->id_youtube($coment);
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare("INSERT INTO `publicaciones_comentario` (`publicaciones_id`, `usuarios_id`, `comentario`) VALUES (:id_Post, :id_us, :coment);");
	   $consulta->bindParam(':id_Post', $id_Post);
	   $consulta->bindParam(':id_us', $id_us);
	   $consulta->bindParam(':coment', $coment);
	   $consulta->execute();
	   }     
	   
   }

   public static function sendOfert($nom,$email,$tel,$desc,$hab){
   	$conexion = new Conexion();
   	$consulta = $conexion->prepare("INSERT INTO ofert_lab (nom_emp, email_emp, tele_emp, contenido, grupo) VALUES (:nom, :email, :tel, :descr, :hab)");
   	$consulta->bindParam(':nom', $nom);
	$consulta->bindParam(':email', $email);
	$consulta->bindParam(':tel', $tel);
	$consulta->bindParam(':descr', $desc);
	$consulta->bindParam(':hab', $hab);
	$consulta->execute();

   }

   public static function setBib ($nombre,$src,$cat,$idUs,$idGpo){
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare("INSERT INTO bibliotecas (nombre, src, categ) VALUES (:nombre, :src, :cat);");
	   $consulta->bindParam(':nombre', $nombre);
	   $consulta->bindParam(':src', $src);
	   $consulta->bindParam(':cat', $cat);
	   $consulta->execute();
	   $idBib=$conexion->lastInsertId();

	   $consulta2 = $conexion->prepare("INSERT INTO biblioteca_grupos (`id_usuario`, `id_grupo`, `id_biblioteca`) VALUES (:idUs, :idGpo, :idBib);");
	   $consulta2->bindParam(':idUs', $idUs);
	   $consulta2->bindParam(':idGpo', $idGpo);
	   $consulta2->bindParam(':idBib', $idBib);
	   $consulta2->execute();

   }

public static function id_youtube($url) {
    $patron = '%^ (?:https?://)? (?:www\.)? (?: youtu\.be/ | youtube\.com (?: /embed/ | /channel/ | /v/ | /watch\?v= ) ) ([\w-]{10,12}) $%x';
    $array = preg_match($patron, $url, $parte);
    if ($array) {
        return "<iframe width='200' height='200' src='https://www.youtube.com/embed/{$parte['1']}' frameborder='0' allowfullscreen></iframe>";
    }
    else{return htmlspecialchars($url, ENT_QUOTES);}
}
public static function insMsj ($idDest,$idRem,$text){
		$conexion = new Conexion();
	   $consulta = $conexion->prepare("INSERT INTO mensajes (texto, est_in, est_out) VALUES (:texto, :dest, :rem)");
	   $consulta->bindParam(':texto', $text);
	   $consulta->bindParam(':dest', $idDest);
	   $consulta->bindParam(':rem', $idRem);
	   $consulta->execute();
	   $idMsj=$conexion->lastInsertId();
	   $consulta1 = $conexion->prepare("INSERT INTO msj_user (user_in, user_out, id_msj) VALUES (:dest, :rem, :msj)");
	   $consulta1->bindParam(':msj', $idMsj);
	   $consulta1->bindParam(':dest', $idDest);
	   $consulta1->bindParam(':rem', $idRem);
	   $consulta1->execute();
	   
   }

   public static function TokenRecover($email,$idUser) {
    $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; 
	$cad = ""; 
	for($i=0;$i<24;$i++) {$cad .= substr($str,rand(0,62),1);}
	$conexion = new Conexion();
	$consulta = $conexion->prepare("INSERT INTO recover (id_user, token) VALUES (:id, :token)");
	$consulta->bindParam(':id', $idUser);
	$consulta->bindParam(':token', $cad);
	$consulta->execute();
	$contEmail = new inform();
	$cEmail = $contEmail->mailRecover($email,$idUser,$cad);
	$headers = "MIME-Version: 1.0\r\n"; $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; $headers .= "Admin RESET < recover@reset.com.co >\r\n";
	mail($email,'Recuperar contraseña',$cEmail,$headers);

	
	
}
public static function insOfert ($nom,$email,$tel,$contenido,$gpo){
	   	   $conexion = new Conexion();
	   $consulta = $conexion->prepare("INSERT INTO ofert_lab (nom_emp, email_emp, tele_emp, contenido, grupo) VALUES (:nom, :email, :tel, :conte, :gpo);");
	   $consulta->bindParam(':nom', $nom);
	   $consulta->bindParam(':email', $email);
	   $consulta->bindParam(':tel', $tel);
	   $consulta->bindParam(':conte', $contenido);
	   $consulta->bindParam(':gpo', $gpo);
	   $consulta->execute();
		}

   public static function logSe ($id){
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare("INSERT INTO log_sesion ( usuario ) VALUES ( :id ) ");
	   $consulta->bindParam(':id', $id);
	   $consulta->execute();
		}


}

?>