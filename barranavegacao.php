<?php
	/*
	Página responsavel por mostrar a barra de navegação baseado no valor da sessão.
	Se a sessão não existir, mostra o link para o funcionário fazer o login.
	Esta página não faz bloqueio de acesso a outras partes do programa.
	*/
  
	// Generate the navigation menu
	echo '<p class="text-dark p-2 m-0" style="background-color:#628a4c;">';
  
	// condição verdadeira se a variavel login da sessão já estiver sido definida.
	if (isset($_SESSION['login']) and $_SESSION['profissao'] == 'digitador' ) {
		// DIGITADOR
		echo '<a href = "painelprincipal.php" class="text-white"> Painel Principal.                              </a>  &nbsp;&nbsp;&nbsp;&nbsp;' ;
		echo '<a href = "pacientes.php"       class="text-white"> Pacientes.                                     </a>  &nbsp;&nbsp;&nbsp;&nbsp;' ;
		echo '<a href = "logout.php"          class="text-white"> Sair do programa. (' . $_SESSION['login'] . ') </a>';
  	} 
	
	else if (isset($_SESSION['login']) and $_SESSION['profissao'] == 'bioquimico' ) {
		// BIOQUIMICO
		echo '<a href = "painelprincipal.php" class="text-white"> Painel Principal.                              </a>  &nbsp;&nbsp;&nbsp;&nbsp;' ;
		echo '<a href = "pacientes.php"       class="text-white"> Pacientes.                                     </a>  &nbsp;&nbsp;&nbsp;&nbsp;' ;
		echo '<a href = "logout.php"          class="text-white"> Sair do programa. (' . $_SESSION['login'] . ') </a>';
	} 
	
	else {
				
		echo '<p class="text-primary h6">Faça <a href="index.php" class="btn border">login.</a> para ter acesso ao sistema</p>';
	}
  
	echo '</p>';
?>