<?php 

	// Incluindo arquivo de funções
	include('./inc/functions.php');

	if($_POST){
		
		// Verificando o post
		$erros = errosNoPost();

		// Verificando se arquivo chegou
		if($_FILES['foto']){
			if($_FILES['foto']['error'] == 0){
				// Salvar a foto de forma decente
				move_uploaded_file($_FILES['foto']['tmp_name'],'./fotos/'.$_FILES['foto']['name']);

				// Salvando o nome do arquivo definitivo
				$arquivo_def = './fotos/'.$_FILES['foto']['name'];
			} else {
				$erros[] = 'errUpload';
			}
		}

		if(count($erros) == 0){

			// Adicionar funcionario ao arquivo json
			addFuncionario($_POST['nome'],$_POST['email'],$_POST['senha'], $arquivo_def);
		
		}

	} else {

		// Garantindo que um vetor de erros exista
		// ainda que vazio quando não houver POST
		$erros = [];

	}

	// errNome será true se o campo nome for inválido e false se o campo estiver ok. 
		$errNome = in_array('errNome',$erros);

	// errEmail será true se o campo email for inválido e false se o campo estiver ok. 
		$errEmail = in_array('errEmail',$erros);

	// errSenha será ture se o campo senha for inválido e false se o campo estiver ok.
		$errSenha = in_array('errSenha',$erros);

	// errConf será true se o campo de confirmação for inválido e false se o campo estiver ok.
		$errConf = in_array('errConf',$erros);

	// Carregando vetor de funcionários
		$funcionarios = getFuncionarios();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Cadastro de Funcionários</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">	
</head>
<body>
	<div class="container">
		<div class="row">
			<ul class="col-sm-12 col-md-4 list-group">
				<!-- LISTA DOS FUNCIONÁRIOS CADASTRADOS -->
				<?php foreach($funcionarios as $c): ?>
				<li class="list-group-item">
					<img src="<?= $c['foto'];?>" alt="<?= $c['nome']; ?>" style="width:32px;border-radius:16px">
					<span><?= $c['nome'];  ?></span> : 
					<span><?= $c['email'];  ?></span>
				</li>
				<?php endforeach; ?>
			</ul>
			<form class="col-sm-12 col-md-8" action="cadastro.php" method="post" enctype="multipart/form-data">
			<!-- multipart/form-data formulário com várias partes (Separar o que é texto normal do que é/são arquivos) -->
				
				<div class="form-group">
					<label for="nome">Nome</label>
					<input value="" type="text" class="form-control <?= ($errNome?'is-invalid':'')?>" id="nome" name="nome" placeholder="Digite o nome do funcionário">
					<?php if($errNome): ?><div class="invalid-feedback">Preencha o nome corretamente.</div><?php endif; ?>
				</div>

				<div class="form-group">
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="foto" name="foto">
						<label class="custom-file-label" for="foto">Escolha uma foto bonita</label>
						<!-- css tradução campo bootstrap (para mudar o browse) -->
					</div>
				</div>
				
				<div class="form-group">
					<label for="email">E-mail</label>
					<input value="" type="email" class="form-control <?= ($errEmail?'is-invalid':'')?>" id="email" name="email" placeholder="Digite o e-mail do funcionário">
					<?php if($errEmail): ?><div class="invalid-feedback">Preencha o e-mail corretamente.</div><?php endif; ?>
				</div>
				
				<div class="form-group">
					<label value="" for="senha">Senha</label>
					<input type="password" class="form-control <?= ($errSenha?'is-invalid':'')?> " id="senha" name="senha" placeholder="Digite uma senha para o funcionário">
					<?php if($errSenha): ?><div class="invalid-feedback">Preencha a senha corretamente.</div><?php endif; ?>
				</div>

				<div class="form-group">
					<label value="" for="conf">Confirmação de Senha</label>
					<input type="password" class="form-control <?= ($errConf?'is-invalid':'')?>" id="conf" name="conf" placeholder="Confirme a senha">
					<?php if($errConf): ?><div class="invalid-feedback">Confirmação da senha inválida.</div><?php endif; ?>
				</div>

				<button class="btn btn-primary" type="submit">Salvar</button>
				
			</form>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>