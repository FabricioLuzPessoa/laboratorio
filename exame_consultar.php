<?php
	
	require_once('startsession.php');

	if (isset($_SESSION['paciente_id'])) {
		
		
		// inclusão das contantes de conexão
		require_once('conexao.php');
		// conecta ao banco de dados
		$dbc = mysqli_connect(SERVIDOR, USUARIO, SENHA, BANCO_DE_DADOS ) or die('Erro ao concectar ao banco de dados');
		//String de consulta ao banco de dados. Essa consulta faz uma consulta na tabela << exames >>
		$stringConsulta =  "select * from exames where id_paciente =" . $_SESSION['paciente_id'];
		// executa a consulta e armazena a tabela na variável tabela
		$tabela = mysqli_query($dbc, $stringConsulta) or die('Erro ao realizar a consulta no banco de dados');
		echo '<table border="0" cellpadding="1" class="table table-borderless table-hover table-sm w-50">';
			
			echo '<thead class="thead-dark">';
				echo '<tr class="table-success">'; // 1ª Linha - Cabeçalho
					echo '<th>Documento       </th>';
					echo '<th>Data de Inclusão</th>';
					echo '<th>                </th>';
				echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
			
			while($row = mysqli_fetch_array($tabela)) {
				
				echo '<tr>';
					echo '<td>' . $row['documento'] .     '</td>';
					echo '<td>' . $row['data_inclusao'] . '</td>';
					echo '<td><a href="exame_exibir.php?nome_documento=' . $row['documento']  . '" class="btn-sm border-0 rounded" > Exibir Documento.</a></td>';
				echo '</tr>';
			}//#while	
			echo '</tbody>';	
		echo '</table>';
						
		mysqli_close($dbc);
	
	} else {
		echo "Sem permissão!";
	}
	
?>