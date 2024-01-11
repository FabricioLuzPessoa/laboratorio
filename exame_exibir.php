<?php

	// inclusão do template para inicio da sessão
	require_once('startsession.php');
		
	if (isset($_SESSION['paciente_id'])) {
		
			// apenas o nome do documento vindo pelo get
			$nome_documento = $_GET['nome_documento'];
			
			header('Content-Type: application/pdf');
			header("Content-Disposition: inline; filename=".basename($nome_documento));
			header('Content-disposition:inline; filename="' . $nome_documento . '"');
			
			@readfile('exames/' . $nome_documento);
			
			echo $nome_documento;
	} else {
        echo 'Você não tem permissão para vizualizar este exame.';
    }
	
	
	

?>

