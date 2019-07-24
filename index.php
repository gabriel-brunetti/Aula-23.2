<?php 
	// Definindo uma constante para o nome do arquivo
	define('ARQUIVO','contatos.json');

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
	function getContatos(){
		$json = file_get_contents(ARQUIVO);
		$contatos = json_decode($json,true);
		return $contatos;
	}
	
	// Função que adiciona contato ao json
	function addContato($nome,$email){

		// Carregando os contatos
		$contatos = getContatos();

		// Adicionando um novo contato ao array de contatos
		$contatos[] = [
			'nome' => $nome,
			'email' => $email
		];
		
		// Transformando o array contatos numa string json
		$json = json_encode($contatos);

		// Salvar a string json no arquivo
		file_put_contents(ARQUIVO,$json); 
	}
	
	// Verificando o post
	$erros = errosNoPost();

	if($_POST){

		if(count($erros) == 0){

			// Adicionar contato ao arquivo json
			addContato($_POST['nome'],$_POST['email']);
		
		}
	} else {
		$erros = [];
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
	
</head>
<body>
	<ul>
		<?php foreach($contatos as $c): ?>
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