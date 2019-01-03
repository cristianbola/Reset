<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 14/12/2017
 * Time: 11:00 PM
 */

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=reportes_Sesion.xls");
header("Pragma: no-cache");
header("Expires: 0");
require_once '../control/getAdmin.php';
if(isset($_POST['infsesion'])) {
    $num = $_POST['nS'];

    echo "

<h1>Informes de inicio de sesion</h1>

<table cellspacing='0' cellpadding='0'>
 <tr>


				
					<tr>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Rol</th>
						<th>Email</th>
						<th>Inicio sesion</th>
						
					</tr>
				
					<tr>";
    $resBib = getAdmin::logSesions($num);foreach ($resBib as $b) {
        echo "<tr>
		              <td>{$b['nombre']}</td>
		              <td>{$b['apellido']}</td>
		              <td>{$b['rol']}</td>
		              <td>{$b['email']}</td>
		              <td>{$b['inicio']}</td>
		              
		            </tr>";
    }
    echo "</table>";
}