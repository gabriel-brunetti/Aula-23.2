<?php 
	// Definindo uma constante para o nome do arquivo
	define('ARQUIVO','funcionarios.json');

	// Função para validar dados do post
	function errosNoPost(){
		$erros =[];
		if(!isset($_POST['nome']) || $_POST['nome']==''){
			$erros[] = 'errNome';
		}

		if(!isset($_POST['email']) || $_POST['email']==''){
			$erros[] = 'errEmail';
		}

		return $erros;
	}

	// Carregando o conteúdo do arquivo (string json) para uma variável
	function getFuncionarios(){
		$json = file_get_contents(ARQUIVO);
		$funcionarios = json_decode($json,true);
		return $funcionarios;
	}
	
	// Função que adiciona funcionario ao json
	function addFuncionario($nome,$email){

		// Carregando os funcionarios
		$funcionarios = getFuncionarios();

		// Adicionando um novo funcionario ao array de funcionarios
		$funcionarios[] = [
			'nome' => $nome,
			'email' => $email
		];
		
		// Transformando o array funcionarios numa string json
		$json = json_encode($funcionarios);

		// Salvar a string json no arquivo
		file_put_contents(ARQUIVO,$json); 
	}
	
	// Verificando o post
	$erros = errosNoPost();

	if($_POST){

		if(count($erros) == 0){

			// Adicionar funcionario ao arquivo json
			addFuncionario($_POST['nome'],$_POST['email']);
		
		}
	} else {
		$erros = [];
	}

	$funcionarios = getFuncionarios();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	
</head>
<body>
	<ul>
		<?php foreach($funcionarios as $c): ?>
		<li>
			<span><?= $c['nome'];  ?></span> : 
			<span><?= $c['email'];  ?></span>
		</li>
		<?php endforeach; ?>
	</ul>
	<form action="index.php" method="post">
		<input <?= (in_array('errNome',$erros)?'style="border:red 1px solid"':''); ?> type="text" name="nome" id="nome" placeholder="Digite o nome">
		<input  type="email" name="email" id="email" placeholder="Digite o e-mail">
		<button type="submit">Salvar</button>
	</form>
</body>
</html>