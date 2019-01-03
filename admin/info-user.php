<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 14/12/2017
 * Time: 11:00 PM
 */

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=reporte_usuarios.xls");
header("Pragma: no-cache");
header("Expires: 0");
require_once '../control/getAdmin.php';
if(isset($_POST['infuser'])) {
    $num = $_POST['nU'];

    echo "

<h1>Informe usuarios</h1>

<table cellspacing='0' cellpadding='0'>
 <tr>


				
					<tr>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Email</th>
						<th>Rol</th>
						<th>Ingreso</th>
						<th>Programa</th>
						<th>Curso</th>
						<th>Ciudad</th>
						<th>Departamento</th>
					</tr>
				
					<tr>";
    $resBib = getAdmin::getAllUsers($num);foreach ($resBib as $b) {
        echo "<tr>
		              <td>{$b['nombre']}</td>
		              <td>{$b['apellido']}</td>
		              <td>{$b['email']}</td>
		              <td>{$b['rol']}</td>
		              <td>{$b['ingreso']}</td>
		              <td>{$b['grupo_p']}</td>
		              <td>{$b['grupo_s']}</td>
		              <td>{$b['ciudad']}</td>
		              <td>{$b['departamento']}</td>
		            </tr>";
    }
    echo "</table>";
}