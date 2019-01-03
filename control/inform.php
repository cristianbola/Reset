<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
class inform {
	public function __construct() {
		
	}
	
	public static function mailRecover ($email,$idUser,$token){
		require_once 'gets.php';
		$datos= new gets();$nombre=$datos->mTest($idUser);foreach ($nombre as $n) {$nom=$n['nombre'];}
		$contenido = "<div style='font-size:15px;color:rgb(65,65,65);font-family:Arial,san-serif;text-align:center;padding:25px'>
                <table border='0' align='center'>
                   <tbody><tr>
                        <td>
                            <img alt='' style='width:150px' src='http://reset.hotsoft.com.co/img/logo.png' class='CToWUd'>
                        </td>
                        <td>
                            <p style='font:18px Arial,sans-serif;color:#333333;border-bottom:1px solid #ccc;margin:10px 20px 3px 20px;padding:0 0 3px 0'>
                                Haz solicitado recuperar tu contraseña
                                
                            </p>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <b>Asunto:</b>
                        </td>
                        <td>
                            Recuperacion de contraseña de RESET
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Hola {$nom}</b>
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <h3>Nos has notificado un porblema al iniciar sesion </h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <p style='background-color:rgba(242,242,242,0.62);border-radius:2px;padding:5px;max-width:100%'>
                                 y queremos ayudarte, por favor haz click en el siguiente link para poder<br> recuperar tu contraseña.<br>
								<a href='reset.hotsoft.com.co/resources/secure.php?fuckPass={$token}&idUser={$idUser}'>Click Aqui para recuperar contraseña</a>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <p style='font-size:11px;color:#333333;border-top:1px solid #ccc'>
                                <i>Este email es una notificación, por favor no responder a esta dirección.</i>
                            </p>
                        </td>
                    </tr>
                </tbody></table><div class='yj6qo'></div><div class='adL'>
            </div></div>";
            return $contenido;
		
	}
}
	
	?>