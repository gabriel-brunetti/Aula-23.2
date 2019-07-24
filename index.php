<?php 
	function getContatos(){
		$json = file_get_contents('contatos.json');
		return json_decode($json,true);
	}

	function createContato($nome,$email){
		$json = file_get_contents('contatos.json');
		$contatos = json_decode($json,true);
		$contatos[] = [
			'nome' => $nome,
			'email' => $email
		];
		$json = json_encode($contatos);
		file_put_contents('contatos.json',$json);
	}

	if($_POST){
		createContato($_POST['nome'],$_POST['email']);
	}

	$contatos = getContatos();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<style>
		.container {
			margin-top: 30px;

		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<ul class="col-md-4 list-group">
				<?php foreach($contatos as $c): ?>
				<li class="list-group-item">
					<span><?= $c['nome']; ?></span>
					: 
					<span><?= $c['email']; ?></span>
				</li>
				<?php endforeach; ?>
			</ul>
			<form action="index.php" method="post" class="col-md-8">
				<div class="form-group">
					<label for="nome">Nome:</label>
					<input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome">
				</div>
				
				<div class="form-group">
					<label for="email">Email:</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="Digite o e-mail">
				</div>
				
				<button class="btn btn-primary" type="submit">Salvar</button>
			</form>
		</div>
	</div>
	
</body>
</html>