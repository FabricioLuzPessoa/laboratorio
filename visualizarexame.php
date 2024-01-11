<?php

	// inclusão do template para inicio da sessão
	require_once('startsession.php');
	
	//inclusão do template barra de navegação
	require_once('barranavegacao.php');
	
	if (isset($_SESSION['usuario_id'])) {
		
			// apenas o nome do documento vindo pelo get
			$nome_documento = $_GET['nome_documento'];
			
			header('Content-Type: application/pdf');
			header("Content-Disposition: inline; filename=".basename($nome_documento));
			header('Content-disposition:inline; filename="' . $nome_documento . '"');
			
			@readfile('exames/' . $nome_documento);
			
			echo $nome_documento;
	}
	
	
	

?>

