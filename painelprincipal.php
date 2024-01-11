<?php 
	/*
		- Página responsavel para direcionar o funcionário para outras partes do sistema.
	*/
	// inclusão do template para inicio da sessão
	require_once('startsession.php');
	
	// inclusão do template cabeçalho
	$page_title = 'Painel Principal';
	require_once('header.php');
	
	//inclusão do template barra de navegação
	require_once('barranavegacao.php');
	
	// condição verdadeira se existir uma sessão com nome do usuário e a profissão dele for digitador.
	if( isset($_SESSION['usuario_id']) and $_SESSION['profissao'] == 'digitador' ) {
			
		echo '<p> <a href="addpaciente.php"  class="text-success"> Cadastrar Paciente. </a></p>';
		echo '<p> <a href="pacientes.php"    class="text-success"> Pacientes.          </a></p>';
		echo '<p> <a href="alterarsenha.php" class="text-success"> Alterar Senha.      </a></p>';
		echo '<hr/>';
			
	} else if ( isset($_SESSION['usuario_id']) and $_SESSION['profissao'] == 'bioquimico' ) {
		
		echo '<p> <a href="addpaciente.php"      class="text-success"> Cadastrar Paciente. </a></p>';
		echo '<p> <a href="exames_pendentes.php" class="text-success"> Verificar Exame(s). </a></p>';
		echo '<p> <a href="pacientes.php"        class="text-success"> Pacientes.          </a></p>';
		echo '<p> <a href="alterarsenha.php"     class="text-success"> Alterar Senha.      </a></p>';
		echo '<hr/>';
	}
?>		
	
<?php
  	// Insert the page footer
	require_once('rodape.php');
?>