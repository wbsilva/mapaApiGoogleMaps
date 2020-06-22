<?php
include_once("conexao.php");

$name = filter_input (INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$address = filter_input (INPUT_POST, 'address', FILTER_SANITIZE_STRING);
$lat = filter_input (INPUT_POST, 'lat', FILTER_SANITIZE_STRING);
$lng = filter_input (INPUT_POST, 'lng', FILTER_SANITIZE_STRING);
$totalEfetivo = filter_input (INPUT_POST, 'totalEfetivo', FILTER_SANITIZE_STRING);
$afastado = filter_input (INPUT_POST, 'afastado', FILTER_SANITIZE_STRING);
$percentoAfastado = filter_input (INPUT_POST, 'percentoAfastado', FILTER_SANITIZE_STRING);
$type = filter_input (INPUT_POST, 'type', FILTER_SANITIZE_STRING);
$estado_id = filter_input (INPUT_POST, 'estado_id', FILTER_SANITIZE_STRING);

$query_cad = "INSERT INTO markers(estado_id, name, address, lat, lng, total_efetivo, afastado, percento_afastado, type, created) 
			VALUES ('$estado_id', '$name', '$address', '$lat', '$lng', '$totalEfetivo', '$afastado', '$percentoAfastado', '$type', NOW())";

$resultado_query = mysqli_query($conn, $query_cad);

if(mysqli_insert_id($conn)){
	echo true;	
}else{
	echo false;		
}
?>