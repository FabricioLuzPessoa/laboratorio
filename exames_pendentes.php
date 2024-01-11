<?php

	/*
		-- Faz uma consulta na tabela exames_pendentes e exibe os resultados em lista, com link
		-- Preciso fazer uma consulta na tabela exames_pendentes e mostrar apenas os exames do bioquimico.
	*/

	// inclusão do template para inicio da sessão
	require_once('startsession.php');
		
	// inclusão das contantes de conexão
	require_once('conexao.php');
		
	// inclusão do template cabeçalho
	$page_title = 'Publicar Exame(s)';
	require_once('header.php');
		
	//inclusão do template barra de navegação
	require_once('barranavegacao.php');
		
	if( isset($_SESSION['usuario_id']) ) {
			
		// aqui se abre uma conexão com o banco de dados.
		$dbc = mysqli_connect(SERVIDOR, USUARIO, SENHA, BANCO_DE_DADOS) or die ('Erro ao conectar ao banco de dados!');
				
		// consulta por todos os pacientes
		$consulta = "SELECT id_exame_pendente, documento, data_inclusao, identificacao_bioquimico FROM exames_pendentes where identificacao_bioquimico = '" . $_SESSION['identificacao'] . "'";
				
		// executa a consulta
		$tabela = mysqli_query($dbc, $consulta) or die('Erro ao realizar a consulta no banco de dados');
			
		// Start generating the table of results - Comee a gerar a tabela de resultados. Aqui eu mostro a tabelas com todos os pacientes cadastrados.
		echo '<table border="0" cellpadding="1">';
		
			// Generate the search result headings - Gere os títulos dos resultados da pesquisa. 
			echo '<tr class="heading">';
			echo 	 '<td>id</td>';
			echo     '<td>data</td>';
			echo '</tr>';
		
			while($row = mysqli_fetch_array($tabela)) {
					
				echo '<tr>';
						echo '<td>' . $row['id_exame_pendente'] . '</td>';
						echo '<td>' . $row['data_inclusao'] . '</td>';		
						// faz um redirecionamento para a página paciente com o id do paciente.
						echo '<td><a href="exames_pendentes_verificar.php?id_exame_pendente=' . $row['id_exame_pendente'] . ' "> Visualizar</a></td>';
				echo '</tr>';
			}
		echo '</table>';
	}
?>

<?php
		// Insert the page footer
		require_once('rodape.php');
?>