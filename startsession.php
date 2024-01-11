<?php
  
	/*
	-- Página responsavel por criar as sessões das pessoas que vão ter acesso ao sistema.
	-- Se a variavel user_id da sessão não tiver sido setada, analiso o segundo if, caso contrario finalizo o script.
	-- Em caso do segundo if ser verdadeiro, analiso o segundo if
	*/
		
	// é uma função predefinida do php. que tem como objetivo criar uma sessão.
	session_start();

	// se as variaveis de sessão não foram definidas, tenta definir com cookies
	if ( !isset($_SESSION['usuario_id']) ) {
    
		// se os cookies estiverem definidos, eu recrio as variaveis de sessão.
		if (isset($_COOKIE['ususario_id']) && isset($_COOKIE['login'])) {
     
			$_SESSION['usuario_id']    = $_COOKIE['usuario_id'];
			$_SESSION['login']         = $_COOKIE['login'];
			$_SESSION['profissao']     = $_COOKIE['profissao'];
			$_SESSION['identificacao'] = $_COOKIE['identificacao'];
		}
 	}
?>
