<?php

		// se o usuário estiver logado, apagar as variáveis de sessão para fazer logout
		session_start();
		
		if(isset($_SESSION['usuario_id'])) {
			
				// apagar as variaveis de sessão limpando o array $_SESSION
				$_SESSION = array();
			
				// apaga o cookie de sessão, definindo seu prazo de validade com um tempo negativo
				if( isset($_COOKIE[session_name()] ) ) {
				
							setcookie(session_name(),'',time()-1);
				}
			
				// destroi a sessão
				session_destroy();
				
				// cria uma url para a página de login: index.php
				$url_index = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
			
				// função que executa a url.
				header('Location: ' . $url_index);
				
		}
		
		
		
?>