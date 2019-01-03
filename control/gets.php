<?php

require_once 'connect.php';
$conexion = new Conexion();
class gets {
	
	public function __construct() {
	
		
	}
	
	 public static function programaUsr (){
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare("select nombre,id,descripcion from grupos where principal =1");
	   $consulta->execute();
	   $registros = $consulta->fetchAll();
       return $registros;
	   
   }
   public static function cursoUsr (){
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare('select nombre,id from grupos where  principal =2');
	   $consulta->execute();
	   $registros = $consulta->fetchAll();
       return $registros;
	   
   }
   public static function getId ($email){
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare('select id from usuario where  email = :email');
	   $consulta->bindParam(':email', $email);
	   $consulta->execute();
	   $id= $consulta->fetch();
	   return $id['id'];
   }
	
	  public function valiSesion($user,$pass){
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare('select id,rol from usuario where email = :email and pass = :pass');
	   $consulta->bindParam(':email', $user);
	   $consulta->bindParam(':pass', $pass);
	   $consulta->execute();
	   $registro = $consulta->fetch();
	   if ($registro){return $registro;}
	   else{return false;}

	   
   }

   public function valiSena($email){
   	$explode = explode("@", $email);
	if ($explode[1] == "misena.edu.co") {
		return true;
	} else {
		return false;
	}
   }
   
     public static function valMail ($email){
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare('select id from usuario where  email = :email');
	   $consulta->bindParam(':email', $email);
	   $consulta->execute();
	   $registro= $consulta->fetch();
	   return $registro;
	   
   }

    public static function mTest ($id){
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare('select nombre,email,rol,p_profile from usuario where  id = :id');
	   $consulta->bindParam(':id', $id);
	   $consulta->execute();
	   $registro= $consulta->fetchAll();
	   return $registro;
		
	}
	public static function getProfile ($id){
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare('select usuario.nombre nombre,usuario.apellido apellido ,usuario.email email,usuario.rol rol,usuario.p_profile foto, 
		(select grupos.nombre from grupos inner join usuario_grupo on grupos.id = usuario_grupo.id_grupos
		where usuario_grupo.id_usuario= :id  and  grupos.principal=1) grupo_p,
		(select grupos.nombre from grupos inner join usuario_grupo on grupos.id = usuario_grupo.id_grupos
		where usuario_grupo.id_usuario= :id  and  grupos.principal=2) grupo_s ,ciudades.nombre ciudad,ciudades.idciudad idC,departamento.nombre departamento from usuario inner join
	   		ciudades on usuario.ciudad = ciudades.idciudad inner join departamento
	   		on ciudades.idDepartamento = departamento.idDepartamento
	   		 where  usuario.id = :id');
	   $consulta->bindParam(':id', $id);
	   $consulta->execute();
	   $registro= $consulta->fetchAll();
	   return $registro;
		
	}

    /**
     * @param $id1
     * @param $id2
     * @param $desde
     * @return array
     */
    public static function getHome ($id1, $id2, $desde){

	   $conexion = new Conexion();
	   $consulta = $conexion->prepare('select usuario.id id, publicaciones.id id_pub , usuario.nombre nombre, grupos.nombre grupo, publicaciones.texto post ,usuario.p_profile foto ,publicaciones.creacion fecha from usuario inner join publicaciones on publicaciones.id_usuarios = usuario.id inner join grupos on publicaciones.id_grupo = grupos.id inner join usuario_grupo on usuario.id = usuario_grupo.id_usuario where publicaciones.id_grupo = :id1 or publicaciones.id_grupo = :id2 group by publicaciones.id desc LIMIT '.$desde.' , 20');
	   $consulta->bindParam(':id1', $id1);
	   $consulta->bindParam(':id2', $id2);
	   //$consulta->bindParam(':desde', $desde);
	   $consulta->execute();
	   $registro= $consulta->fetchAll();
	   return $registro;


	}

	public static function getPGpo ($idGpo,$desde){
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare('select  usuario.id id,publicaciones.id id_pub , usuario.nombre nombre, grupos.nombre grupo, publicaciones.texto post ,usuario.p_profile foto ,publicaciones.creacion fecha from usuario inner join publicaciones on publicaciones.id_usuarios = usuario.id inner join grupos on publicaciones.id_grupo = grupos.id inner join usuario_grupo on usuario.id = usuario_grupo.id_usuario where publicaciones.id_grupo = :idGpo   group by publicaciones.id desc  LIMIT '.$desde.' , 20');
	   $consulta->bindParam(':idGpo', $idGpo);
	   $consulta->execute();
	   $registro= $consulta->fetchAll();
	   return $registro;


	}

	public static function getComPost ($id_P){
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare('select publicaciones_comentario.id idC ,usuario.id id, usuario.nombre nombre, publicaciones_comentario.comentario comen, usuario.p_profile fotoC, publicaciones_comentario.creacion fecha from publicaciones_comentario inner join usuario on publicaciones_comentario.usuarios_id = usuario.id inner join publicaciones on publicaciones.id= publicaciones_comentario.publicaciones_id where publicaciones.id = :id_p order by publicaciones_comentario.creacion ; ');
	   $consulta->bindParam(':id_p', $id_P);
	   $consulta->execute();
	   $registro= $consulta->fetchAll();
	   return $registro;
		
	}

		public static function getGpo ($id){
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare(' select grupos.nombre grupos,grupos.id id, grupos.descripcion descr,grupos.principal principal from grupos inner join usuario_grupo on grupos.id = usuario_grupo.id_grupos where usuario_grupo.id_usuario = :id');
	   $consulta->bindParam(':id', $id);
	   $consulta->execute();
	   $registro= $consulta->fetchAll();
	   return $registro;
}

public static function getGpo1 ($id){
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare(' select nombre,imagen,principal from grupos where id = :id');
	   $consulta->bindParam(':id', $id);
	   $consulta->execute();
	   $registro= $consulta->fetchAll();
	   return $registro;
}

public static function difFecha ($fecha){
	    $datetime1 = new DateTime(''.$fecha);
	    $datetime1->add(new DateInterval('PT2H'));
		$datetime2 = new DateTime();
		$time = '';
		$semanas=0;
		$interval = $datetime1->diff($datetime2);
		if($interval->format('%y')>0)
		{	
			if($interval->format('%y')==1){$time = $interval->format('Hace %y año');}
			else {$time = $interval->format('Hace %y años');}			
		}
		elseif($interval->format('%m')>0)
		{
			if($interval->format('%m')==1){$time = $interval->format('Hace %m mes');}
			else {$time = $interval->format('Hace %m meses');}
		}
		elseif($interval->format('%a')>6)
		{
			$semanas=$interval->format('%a')/7;
			$sem=explode('.',$semanas);
			if($sem[0]==1){$time = $interval->format('Hace '.$sem[0].' semana');}
			else {$time = ('Hace '.$sem[0].' Semanas');}
		}
		elseif($interval->format('%a')>0)
		{
			if($interval->format('%a')==1){$time = $interval->format('Ayer');}
			else {$time = $interval->format('Hace %a dias');}

		}elseif($interval->format('%h')>0)
		{
		if($interval->format('%h')==1){$time = $interval->format('Hace %h hora');}
		else {$time = $interval->format('Hace %h horas');}
	 	}elseif($interval->format('%i')>0)
		{
		if($interval->format('%i')==1){$time = $interval->format('Hace %i minuto');}
		else {$time = $interval->format('Hace %i minutos');}
		}elseif($interval->format('%s')>=0)
		{
		if($interval->format('%s')==0){$time = $interval->format('En este momento');}
		elseif($interval->format('%s')==1){$time = $interval->format('Hace %s segundo');}
		else {$time = $interval->format('Hace %s segundos');}
		}
	    return $time;

	}

	public static function getBib ($id1,$id2){
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare('SELECT bibliotecas.nombre nombre, cate_biblio.nombre cat, grupos.nombre grupo, usuario.nombre nom , usuario.apellido  ape,
			bibliotecas.creacion fecha, bibliotecas.src source from cate_biblio 
			inner join bibliotecas on cate_biblio.id =bibliotecas.categ
			inner join biblioteca_grupos on bibliotecas.id = biblioteca_grupos.id_biblioteca 
			inner join grupos on biblioteca_grupos.id_grupo = grupos.id
			inner join usuario on biblioteca_grupos.id_usuario =usuario.id
			where grupos.id = :id1 or grupos.id =:id2
			order by bibliotecas.creacion desc');
				   $consulta->bindParam(':id1', $id1);
				   $consulta->bindParam(':id2', $id2);
	   $consulta->execute();
	   $registro= $consulta->fetchAll();
	   return $registro;
}

public static function getBibTiny ($id1,$id2){
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare(' SELECT bibliotecas.nombre nombre, cate_biblio.nombre cat, grupos.nombre grupo, usuario.nombre nom , usuario.apellido  ape,
			bibliotecas.creacion fecha, bibliotecas.src source from cate_biblio 
			inner join bibliotecas on cate_biblio.id =bibliotecas.categ
			inner join biblioteca_grupos on bibliotecas.id = biblioteca_grupos.id_biblioteca 
			inner join grupos on biblioteca_grupos.id_grupo = grupos.id
			inner join usuario on biblioteca_grupos.id_usuario =usuario.id
			where grupos.id = :id1 or grupos.id =:id2
			order by bibliotecas.creacion desc  LIMIT 5 ;');
				   $consulta->bindParam(':id1', $id1);
				   $consulta->bindParam(':id2', $id2);
	   $consulta->execute();
	   $registro= $consulta->fetchAll();
	   return $registro;
}

public static function getCatBib (){
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare(' select id , nombre FROM cate_biblio');
	   $consulta->execute();
	   $registro= $consulta->fetchAll();
	   return $registro;
}

public static function getUsers ($id){
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare('select usuario.id id ,usuario.nombre nom_u , usuario.apellido ape_u , usuario.p_profile foto_u from usuario inner join usuario_grupo on usuario_grupo.id_usuario = usuario.id where usuario_grupo.id_grupos =:id');
	   $consulta->bindParam(':id', $id);
	   $consulta->execute();
	   $registro= $consulta->fetchAll();
	   return $registro;
}

public static function getCiudad (){
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare(' select idCiudad id, nombre FROM ciudades');
	   $consulta->execute();
	   $registro= $consulta->fetchAll();
	   return $registro;
}
public static function getDepart (){
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare(' select idDepartamento id , nombre FROM departamento');
	   $consulta->execute();
	   $registro= $consulta->fetchAll();
	   return $registro;
}

 public static function getMsj ($envio,$envian){
   	$conexion = new Conexion();
	   $consulta = $conexion->prepare("select entrada.id idI, entrada.nombre nombreI,salida.id idS, salida.nombre nombreS, mensajes.texto, 								mensajes.est_in inbox,mensajes.creacion fecha  from mensajes
										inner join msj_user on msj_user.id_msj = mensajes.id
										inner join usuario entrada on entrada.id = msj_user.user_in
										inner join usuario salida on salida.id = msj_user.user_out
										where  (msj_user.user_out = :in and msj_user.user_in = :self) or (msj_user.user_out = :self and msj_user.user_in = :in)
										order by mensajes.creacion");
	   $consulta->bindParam(':in', $envian);
	   $consulta->bindParam(':self', $envio);
	   $consulta->execute();
	   $registros = $consulta->fetchAll();
       return $registros;
	   
   }

   public static function securePass ($token,$id){
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare(' select id FROM recover where token = :token and id_user = :id');
	   $consulta->bindParam(':token', $token);
	   $consulta->bindParam(':id', $id);
	   $consulta->execute();
	   $registro= $consulta->fetchAll();
	   return $registro;
}

public static function modalMsj ($id){
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare('select substring(mensajes.texto,1,10) mensaje, mensajes.creacion fecha,usuario.nombre nombre,usuario.p_profile foto,usuario.id id from mensajes
									inner join msj_user on msj_user.id_msj = mensajes.id
									inner join usuario on mensajes.est_out = usuario.id
									where mensajes.est_in = :id
									group by usuario.nombre
									order by mensajes.creacion desc
									limit 6');
	   $consulta->bindParam(':id', $id);
	   $consulta->execute();
	   $registro= $consulta->fetchAll();
	   return $registro;
}

public static function priMsj ($id){
	   $conexion = new Conexion();
	   $consulta = $conexion->prepare('select substring(mensajes.texto,1,15) mensaje, mensajes.creacion fecha,usuario.nombre nombre,usuario.p_profile foto,usuario.id id from mensajes
									inner join msj_user on msj_user.id_msj = mensajes.id
									inner join usuario on mensajes.est_out = usuario.id
									where mensajes.est_in =  :id
									group by usuario.nombre
									order by mensajes.creacion desc
									');
	   $consulta->bindParam(':id', $id);
	   $consulta->execute();
	   $registro= $consulta->fetchAll();
	   return $registro;
}

public static function getOfert($gpo){
    $conexion = new Conexion();
    $consulta = $conexion->prepare('select * from ofert_lab where grupo = :gpo order by creacion desc limit 3');
    $consulta->bindParam(':gpo',$gpo);
    $consulta->execute();
    $registros=$consulta->fetchAll();
    return $registros;
}

    public static function cNoti($id){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('select count(mensajes.visto) from mensajes 
				inner join msj_user on mensajes.id = msj_user.id_msj
				inner join usuario on usuario.id = msj_user.user_in
				where mensajes.visto = 1 and usuario.id= :id');
        $consulta->bindParam(':id',$id);
        $consulta->execute();
        $registros=$consulta->fetch();
        return $registros[0];
    }

    public static  function  sinNoti($id){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('UPDATE mensajes SET visto=0 WHERE  mensajes.est_in = :id');
        $consulta->bindParam(':id',$id);
        $consulta->execute();


}


}