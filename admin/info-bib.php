<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 14/12/2017
 * Time: 11:00 PM
 */

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=reporte_Biblioteca.xls");
header("Pragma: no-cache");
header("Expires: 0");
require_once '../control/getAdmin.php';
if(isset($_POST['infbib'])) {
    $num = $_POST['nB'];

    echo "

<h1>Informe bibliotecas</h1>

<table cellspacing='0' cellpadding='0'>
 <tr>


				
					<tr>
						<th>Nombre Archivo</th>
						<th>Categoria</th>
						<th>Grupos</th>
						<th>Subido por</th>
						<th>Fecha</th>
						<th>Origen</th>
					</tr>
				
					<tr>";
					  $resBib = getAdmin::getBibTT($num);foreach ($resBib as $b) {
		            echo "<tr>
		              <td>{$b['nombre']}</td>
		              <td>{$b['cat']}</td>
		              <td>{$b['grupo']}</td>
		              <td>{$b['nom']}".' '."{$b['ape']}</td>
		              <td>{$b['fecha']}</td>
		              <td>{$b['source']}</a></td>
		            </tr>";
		              }
					echo "</table>";
}