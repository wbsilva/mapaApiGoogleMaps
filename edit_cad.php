<?php
	require_once("header.php");
	session_start();
	include_once("conexao.php");
	$id = filter_input (INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
	$result_cad = "SELECT * FROM markers WHERE id = '$id'";
	$resultado_cad = mysqli_query($conn, $result_cad);
	$row_cad = mysqli_fetch_assoc($resultado_cad);
?>
<!DOCTYPE html>
  <head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<title>Editar</title>
	</head>
	<body>		
		<div class="row">
			<div class="form-group col-md-5 offset-md-5">
				<input type="button"  id="btn-voltar" value="Voltar" class="btn btn-primary" onClick="Voltar()">
			</div>
		</div>
		<br><br>		
		<?php
		if(isset($_SESSION['msg'])){
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
		?>		
		<div class="row">		
      		<div class="form-group col-md-5 offset-md-3">
			  <h1>Editar Cadastro</h1>
				<form method="POST" action="proc_edit_cad.php">
					<div class="form-group">
						<input type="hidden" name="id" value="<?php echo $row_cad ['id']; ?>">
						<label>Nome: </label>
						<input type="text" name="name" class="form-control" value="<?php echo $row_cad ['name']; ?>">							
					</div>
					<div class="form-group">
						<label>Endereço: </label>
						<input type="text" name="address" class="form-control" value="<?php echo $row_cad ['address']; ?>">						
					</div>
					<div class="form-group">
						<label>Latitude: </label>
						<input type="text" name="lat" class="form-control" value="<?php echo $row_cad ['lat']; ?>">					
					</div>
					<div class="form-group">
						<label>Longitude: </label>
						<input type="text" name="lng" class="form-control" value="<?php echo $row_cad ['lng']; ?>">					
					</div>
					<div class="form-group">
						<label>Total efetivo:</label>						
						<input name="totalEfetivo" type="number" class="form-control" id="totalEfetivo" value="<?php echo $row_cad ['total_efetivo']; ?>">						
					</div>
					<div class="form-group">
						<label>Afastados:</label>								
						<input name="afastado" type="number" class="form-control" id="afastado" value="<?php echo $row_cad ['afastado']; ?>">								
              		</div>  
					<div class="form-group">
						<label>Afastados (%): </label>
						<input type="text" name="afastado" class="form-control" value="<?php echo $row_cad ['afastado']; ?>">					
					</div>
					<div class="form-group">
					<label>Níveis de Risco: </label>			
					<select required id="type" name="type" class="form-control">
						<option value="">Selecione nível de risco ...</option>
						<option value="0">Nível azul - Dentro da normalidade</option>
						<option value="1">Nível amarelo - Atenção</option>
						<option value="2">Nível vermelho - Perigo</option>
						<option value="3">Nível preto - Crítico</option>			  
					</select>					
					</div>
					<div class="form-group">
						<label>Estado</label>
						<select name="estado_id" id="estado_id" class="form-control">
							<option value="">Selecione</option>
							<?php
								$result_estado = "SELECT * FROM estados est ORDER BY estado_nome ASC";
								$resultado_estado = mysqli_query($conn, $result_estado);
								while($row_estado = mysqli_fetch_array($resultado_estado)){
									echo '<option value="'.$row_estado['id'].'">'.$row_estado['estado_nome'].'</option>';
								}
							?>
						</select>										
					</div>
					<br><br>
					<div class="row">			
						<div id="btn-cadastrar" class="form-group col-md-5 offset-md-5">
							<button type="submit" class="btn btn-success" value="Editar">Enviar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<?php require_once("footer.php");	?>	  
	</body>
</html>