<?php 
	if (!isset($page_title))
		$page_title = 'Efetivo Militares Mapa';
	$content_only = isset($_SERVER['HTTP_CONTENT_ONLY']) && $_SERVER['HTTP_CONTENT_ONLY'] == 1;

	if ($content_only)
		header('Page_Title: ' . $page_title);
	else {
?>

<!DOCTYPE html PUBLIC "-//w3c//DTD XHTML 1.o Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-bt" xml:lang="pt-br">	
	<head>			
		<link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet" type='text/css'>	
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>		
		<meta  http-equiv="content-Type" content="text/html" charset="utf-8">		
		<title><?php $page_title ?></title>		
	</head>
	<body>
		<header>
			<div id="header">
				<h1 id="h1-header" align="center">Mapa Efetivo Militares BMPR</h1>
			</div>
		</header>
		<main>
<?php } ?>
</br>	
</br>
