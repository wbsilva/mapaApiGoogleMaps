<?php
session_start();
ob_start();
include_once("conexao.php");

//Receber os dados do formulário
//$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$id = filter_input (INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$name = filter_input (INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$address = filter_input (INPUT_POST, 'address', FILTER_SANITIZE_STRING);
$lat = filter_input (INPUT_POST, 'lat', FILTER_SANITIZE_STRING);
$lng = filter_input (INPUT_POST, 'lng', FILTER_SANITIZE_STRING);
$afastado = filter_input (INPUT_POST, 'afastado', FILTER_SANITIZE_STRING);
$type = filter_input (INPUT_POST, 'type', FILTER_SANITIZE_STRING);
$estado_id = filter_input (INPUT_POST, 'estado_id', FILTER_SANITIZE_STRING);

//Atualiza os dados no bd
$result_markers = "UPDATE markers SET name='$name', address='$address', lat='$lat', lng='$lng', afastado='$afastado', type='$type', estado_id='$estado_id', modified=NOW() WHERE id='$id'";

$resultado_markers = mysqli_query($conn, $result_markers);
if(mysqli_affected_rows($conn)){
	echo '<script type="text/javascript">
            alert("Cadastro alterado com sucesso.");
            window.location="http://localhost/bmpr/";
        </script>';
	
	//$_SESSION['msg'] = "<span style='color: green';>cadastrado alterado com sucesso!</span>";
	//header("Location: index.php");
}else{
	echo '<script type="text/javascript">
        alert("Erro ao alterar cadastro.");
        window.location="http://localhost/bmpr/";
    </script>';
	//$_SESSION['msg'] = "<span style='color: red';>Erro ao cadastrar!</span>";
	//header("Location: edit_cad.php?id=$id");	
}