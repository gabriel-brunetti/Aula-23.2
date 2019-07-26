<?php

	// Incluindo funções
	include('./inc/functions.php');

	// Iniciando session
	session_start();

	// Bloqueando acesso de visitante que não estiver logado
	if(!$_SESSION['logado']){
		header('location: login.php');
		die();
	}

	// Carregando dados do funcionário
	$f = getFuncionario($_SESSION['email']) 


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	ALOOO VOCÊ, <?= $f['nome'] ?>!!!
</body>
</html>