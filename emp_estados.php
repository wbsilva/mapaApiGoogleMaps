<?php
include_once("conexao.php");

$estado_id = $_REQUEST['estado_id'];
//Pesquisar no bd
$result_markers = "SELECT * FROM markers WHERE estado_id = '$estado_id' ORDER BY id ASC";
$resultado_markers = mysqli_query($conn, $result_markers);

while($row_markers = mysqli_fetch_assoc($resultado_markers)){
	$resulta_markers[] = array(
		'id' => $row_markers['id'],
		'name' => $row_markers['name'],
		'address' => $row_markers['address'],
		'afastado' => $row_markers['afastado'],
		'total_efetivo' => $row_markers['total_efetivo']
	);
}

echo(json_encode($resulta_markers));