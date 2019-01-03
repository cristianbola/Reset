<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 02/12/2017
 * Time: 10:47 PM
 */
include_once ("connect.php");
class getAdmin
{
//seccion de llenado de datos de administrador
    public static function getInfo ($id){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('select nombre, apellido,email,rol,p_profile from usuario where  id = :id');
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        $registro= $consulta->fetchAll();
        return $registro;

    }

    public static function getGpo ($id){
        $conexion = new Conexion();
        $consulta = $conexion->prepare(' select grupos.nombre nombre,grupos.id id, grupos.descripcion descr from grupos inner join usuario_grupo on grupos.id = usuario_grupo.id_grupos where usuario_grupo.id_usuario = :id');
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        $registro= $consulta->fetchAll();
        return $registro;
    }

    public static function getAll (){
        $conexion = new Conexion();
        $consulta = $conexion->prepare(' SELECT id,nombre from grupos ');
        $consulta->execute();
        $registro= $consulta->fetchAll();
        return $registro;
    }

    public static function getUser (){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('select usuario.id idUser,usuario.nombre nombre, usuario.apellido apellido, usuario.p_profile foto,usuario.creacion fecha,
                                                (select grupos.nombre  from grupos inner join usuario_grupo on grupos.id = usuario_grupo.id_grupos where usuario_grupo.id_usuario = idUser and grupos.principal =1) grupo1, 
                                                (select grupos.nombre  from grupos inner join usuario_grupo on grupos.id = usuario_grupo.id_grupos where usuario_grupo.id_usuario = idUser and grupos.principal =2) grupo2
                                                from usuario order by usuario.creacion desc
                                                limit 3');
        $consulta->execute();
        $registro= $consulta->fetchAll();
        return $registro;
    }

    public static function bibTiny (){
        $conexion = new Conexion();
        $consulta = $conexion->prepare(' SELECT nombre, src from bibliotecas order by creacion desc limit 5 ');
        $consulta->execute();
        $registro= $consulta->fetchAll();
        return $registro;
    }
//Seccion de administracion de grupos

    public static function setGPO ($nom,$desc,$tG,$urlG){
        $conexion = new Conexion();
        $consulta = $conexion->prepare(' INSERT INTO grupos (nombre, slug, descripcion, principal) VALUES (:nom, :url, :descr,:tg);');
        $consulta->bindParam(':nom', $nom);
        $consulta->bindParam(':url', $urlG);
        $consulta->bindParam(':descr', $desc);
        $consulta->bindParam(':tg', $tG);
        $consulta->execute();

    }

    public static function infoGMod ($id){
        $conexion = new Conexion();
        $consulta = $conexion->prepare(' SELECT id,nombre,slug,descripcion,principal from grupos where id = :id ');
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        $registro= $consulta->fetchAll();
        return $registro;
    }

    public static function updateGPO ($nom,$desc,$tG,$urlG,$id){
        $conexion = new Conexion();
        $consulta = $conexion->prepare(' UPDATE grupos SET nombre=:nom, slug=:url, descripcion=:descr, principal=:tg WHERE  id=:id;');
        $consulta->bindParam(':nom', $nom);
        $consulta->bindParam(':url', $urlG);
        $consulta->bindParam(':descr', $desc);
        $consulta->bindParam(':tg', $tG);
        $consulta->bindParam(':id', $id);
        $consulta->execute();

    }

    public static function delGpo ($id){
        $conexion = new Conexion();
        $consulta = $conexion->prepare(' DELETE FROM grupos WHERE  id=:id; ');
        $consulta->bindParam(':id', $id);
        $consulta->execute();
           }


           //seccion de bibliotecas

    public static function getBibT ($pg){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT bibliotecas.id id,bibliotecas.nombre nombre, cate_biblio.nombre cat, grupos.nombre grupo, usuario.nombre nom , usuario.apellido  ape,
			bibliotecas.creacion fecha, bibliotecas.src source from cate_biblio 
			inner join bibliotecas on cate_biblio.id =bibliotecas.categ
			inner join biblioteca_grupos on bibliotecas.id = biblioteca_grupos.id_biblioteca 
			inner join grupos on biblioteca_grupos.id_grupo = grupos.id
			inner join usuario on biblioteca_grupos.id_usuario =usuario.id
			order by bibliotecas.creacion desc limit '.$pg.',12');
        $consulta->execute();
        $registro= $consulta->fetchAll();
        return $registro;
    }

    public static function getBibTT ($num){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT bibliotecas.id id,bibliotecas.nombre nombre, cate_biblio.nombre cat, grupos.nombre grupo, usuario.nombre nom , usuario.apellido  ape,
			bibliotecas.creacion fecha, bibliotecas.src source from cate_biblio 
			inner join bibliotecas on cate_biblio.id =bibliotecas.categ
			inner join biblioteca_grupos on bibliotecas.id = biblioteca_grupos.id_biblioteca 
			inner join grupos on biblioteca_grupos.id_grupo = grupos.id
			inner join usuario on biblioteca_grupos.id_usuario =usuario.id
			order by bibliotecas.creacion desc limit '.$num);
        $consulta->execute();
        $registro= $consulta->fetchAll();
        return $registro;
    }

    public static function delBib ($id){
        $conexion = new Conexion();
        $consulta1 = $conexion->prepare(' DELETE FROM biblioteca_grupos WHERE  id_biblioteca=:id1; ');
        $consulta1->bindParam(':id1', $id);
        $consulta1->execute();
        $consulta = $conexion->prepare(' DELETE FROM bibliotecas WHERE  id=:id; ');
        $consulta->bindParam(':id', $id);
        $consulta->execute();
    }

    //seccion de Administracion de publicaciones

    public static function getPubli ($idGpo,$desde){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('select  usuario.id id,publicaciones.id id_pub , usuario.nombre nombre, grupos.nombre grupo, publicaciones.texto post ,usuario.p_profile foto ,publicaciones.creacion fecha from usuario inner join publicaciones on publicaciones.id_usuarios = usuario.id inner join grupos on publicaciones.id_grupo = grupos.id inner join usuario_grupo on usuario.id = usuario_grupo.id_usuario where publicaciones.id_grupo = :idGpo   group by publicaciones.id desc  LIMIT '.$desde.' , 5');
        $consulta->bindParam(':idGpo', $idGpo);
        $consulta->execute();
        $registro= $consulta->fetchAll();
        return $registro;


    }

    public static function getComents ($id_P){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('select publicaciones_comentario.id idC ,usuario.id id, usuario.nombre nombre, publicaciones_comentario.comentario comen, usuario.p_profile fotoC, publicaciones_comentario.creacion fecha from publicaciones_comentario inner join usuario on publicaciones_comentario.usuarios_id = usuario.id inner join publicaciones on publicaciones.id= publicaciones_comentario.publicaciones_id where publicaciones.id = :id_p order by publicaciones_comentario.creacion ; ');
        $consulta->bindParam(':id_p', $id_P);
        $consulta->execute();
        $registro= $consulta->fetchAll();
        return $registro;

    }

    public static function getNombreGpo ($id){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('select nombre from grupos where id = :id ');
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        $registro= $consulta->fetchAll();
        return $registro[0];

    }

    public static function getAllUsers ($num){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('select usuario.id idu,usuario.nombre nombre,usuario.apellido apellido ,usuario.email email,rol.nombre rol,usuario.creacion ingreso, 
		(select grupos.nombre from grupos inner join usuario_grupo on grupos.id = usuario_grupo.id_grupos
		where usuario_grupo.id_usuario= idu  and  grupos.principal=1) grupo_p,
		(select grupos.nombre from grupos inner join usuario_grupo on grupos.id = usuario_grupo.id_grupos
		where usuario_grupo.id_usuario= idu  and  grupos.principal=2) grupo_s ,ciudades.nombre ciudad,departamento.nombre departamento from usuario inner join
	   		ciudades on usuario.ciudad = ciudades.idciudad inner join departamento
	   		on ciudades.idDepartamento = departamento.idDepartamento
	   		 inner join rol on usuario.rol = rol.id limit '.$num);
        $consulta->execute();
        $registro= $consulta->fetchAll();
        return $registro;
    }

    public static function logSesions ($num){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('select usuario.nombre nombre, usuario.apellido apellido, rol.nombre rol, usuario.email email, log_sesion.creacion inicio from usuario
                    inner join rol on rol.id = usuario.rol
                    inner join log_sesion on log_sesion.usuario = usuario.id limit '.$num);
        $consulta->execute();
        $registro= $consulta->fetchAll();
        return $registro;

    }
}

