<?php
require_once 'connect.php';
class updates {
	public function __construct() {
	
		
	}

	public static function upFoto($url,$id)
	{
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare('UPDATE usuario SET p_profile=:url WHERE  id=:id;');
	   $consulta->bindParam(':id', $id);
	   $consulta->bindParam(':url', $url);
	   $consulta->execute();
	   //$registro= $consulta->fetchAll();
	   //return $registro;
	}

		public static function borrarCom($idC)
	{
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare('DELETE FROM publicaciones_comentario WHERE  id=:idC;');
	   $consulta->bindParam(':idC', $idC);
	   $consulta->execute();
	  
	}

	public static function borrarPub($idP)
	{
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare('DELETE FROM publicaciones_comentario WHERE  publicaciones_id = :idP ; DELETE FROM publicaciones WHERE  id = :idP ;');
	   $consulta->bindParam(':idP', $idP);
	   $consulta->execute();

	}

	public static function actUser($id,$email,$nom,$ape,$ciud)
	{
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare('UPDATE usuario SET email=:email, nombre=:nom, apellido=:ape,ciudad=:ciud WHERE  id=:id;');
	   $consulta->bindParam(':id', $id);
	   $consulta->bindParam(':email', $email);
	   $consulta->bindParam(':nom', $nom);
	   $consulta->bindParam(':ape', $ape);
	   $consulta->bindParam(':ciud', $ciud);
	   $consulta->execute();

	}

	public static function actPass($id,$pass,$idT)
	{
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare('UPDATE usuario SET pass=:pass WHERE  id=:id');
	   $consulta->bindParam(':id', $id);
	   $consulta->bindParam(':pass', $pass);
	   $consulta->execute();
	   $consulta1 = $conexion->prepare('DELETE FROM recover WHERE id = :idT');
	   $consulta1->bindParam(':idT', $idT);
	   $consulta1->execute();

	}
}
?>