<?php

	/*
	-- Recebe um array serializado e codificado através do método get e armazena em banco de dados.
	-- Faço uma consulta na tabela pacientes para capturar dados do registro.
	*/

	// inclusão do template para inicio da sessão
	require_once('startsession.php');
	require_once('variaveis.php');
	require_once('conexao.php');
		
	$get    = $_GET['array'];        // recebo o array codificado e serializado. -> Array Codificado e Serializado
	$decode = urldecode($get);       // decodifica o valor passado pelo link     -> Decodifica;
	$slash  = stripslashes($decode); // limpa a string de antes de "             -> Limpa a String
	$array  = unserialize($slash);   // transforma a string em um array          -> Desserializa.
		
	// conecto ao banco de dados
	$dbc = mysqli_connect(SERVIDOR, USUARIO, SENHA, BANCO_DE_DADOS) or die ('Erro ao conectar ao banco de dados!');
		
	// String de consulta ao banco de dados baseado o id_cliente que vem da página pacientes.
	$consulta = "SELECT id_paciente, nome, data_nascimento, endereco, telefone, cartao_sus FROM pacientes WHERE id_paciente='" . $_SESSION['id_paciente'] . "'";
		
	// Executa a consulta no banco de dados.
	$tabela = mysqli_query($dbc, $consulta) or die('Erro ao realizar consulta no banco de dados');
		
	// captura a primeira e unica linha da tabela e armazena na variavel $row
	$row = mysqli_fetch_array($tabela); // essa tabela só vai ter uma linha
		
	if($row != NULL) {
				
		$id_paciente     = $row['id_paciente'];
		$nome            = $row['nome'];
		$data_nascimento = $row['data_nascimento'];
		$endereco        = $row['endereco'];
		$telefone        = $row['telefone'];
		$cartao_sus      = $row['cartao_sus'];
	} 
	
	else {
						
		echo '<p class="error">Erro ao acessar as informações do paciente.</p>';
	}

	$id_funcionario  = $_SESSION['usuario_id'];
	$nome_bioquimico = $array['nomebioquimico'];
			
	// String para armazenar o exame na tabela do bioquimico. EXAMES PENDENTES
	$consulta = "INSERT INTO exames_pendentes (documento, data_inclusao, id_paciente, nome_paciente, id_funcionario, identificacao_bioquimico )
	VALUES ('$slash', NOW(), '$id_paciente', '$nome', '$id_funcionario','$nome_bioquimico' )";
	
	// executa o comnado da consulta.
	mysqli_query($dbc, $consulta) or die('Erro ao acessar o banco de dados!');
		
	//redireciona para a pagina do paciente.
	$url_paciente = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/paciente.php';
	header('Location: ' . $url_paciente); // redireciona para a página do paciente
?>