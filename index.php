<?php
	/*
	--  Página de Login do sistema. Página onde as variaveis de sessões e cookies são criados.--
	-> Verifica se o usuario tem acesso ao sistema.
	-> Se tiver, cria uma sessão a um cookie para o usuário.
	*/
	// inclusão do template para inicio da sessão
	require_once('startsession.php');
	// inclusão das contantes de conexão
	require_once('conexao.php');
				
	$mensagem_erro = "";
	$mensagem_erro_paciente = "                   ";
		
	// SE SESSÃO NÃO SETADA -> VERDADEIRO
	if (!isset($_SESSION['usuario_id'])) {
			
		// verifica se o usuário clicou no formulário. Bloco de código executado apenas se o usuário preencheu o formulário com o login e a senha e clicou em ok
		if(isset($_POST['submit'])) {

			// conecta ao banco de dados
			$dbc = mysqli_connect(SERVIDOR, USUARIO, SENHA, BANCO_DE_DADOS ) or die('Erro ao concectar ao banco de dados');
			
			// ENTRAR NO SISTEMA
			if($_POST['submit'] == 'Entrar') {
				
				// obtém os dados de login digitados pelo usuário
				$funcionario_login = mysqli_real_escape_string($dbc, trim($_POST['login'])); // LOGIN. trim -> Retira espaço no início e final de uma string.
				$funcionario_senha = mysqli_real_escape_string($dbc, trim($_POST['senha'])); // SENHA. mysql_real_escape_string -> escapa caracteres especiais.
				// Condição verdadeira se os campos de login e senha tiverem preenchidos. Se algum dos campos estiver vazio, um erro será emitido.
				if(!empty($funcionario_login)  && !empty($funcionario_senha)) {
								
					//procura o nome e a senha no banco de dados
					$consulta = "SELECT id_funcionario, login, profissao, identificacao FROM funcionarios WHERE BINARY login = '$funcionario_login' AND BINARY senha = SHA('$funcionario_senha') ";
										
					// executa a consulta.
					$dados = mysqli_query($dbc, $consulta) or die('Erro ao acessar o banco de dados'); 
										
					// condição verdadeira se for encontrado apenas um usuário.
					if(mysqli_num_rows($dados) == 1) {
											
						// o login foi bem sucedido, portanto definir os cookies de ID e o nome do usuário e redirecionar para a home page.
						$row = mysqli_fetch_array($dados); // CAPTURA A PRIMEIRA LINHA DA TABELA
													
						// criação da sessão
						$_SESSION['usuario_id']    = $row['id_funcionario']; // $_SESSION[] = {usuario_id -> gilmar };
						$_SESSION['login']         = $row['login'];          // $_SESSION[] = {(usuario_id -> gilmar), (login -> gilmar)}
						$_SESSION['profissao']     = $row['profissao'];      // $_SESSION[] = {(usuario_id -> gilmar), (login -> gilmar), (profissao -> digitador)}
						$_SESSION['identificacao'] = $row['identificacao'];  //
													
						// criação do cookie
						setcookie('usuario_id', $row['id_funcionario'], time() + (2 * 24 * 60 * 60)); // o ultimo numero representa o numero de dias.
						setcookie('login', $row['login'], time() + (2 * 24 * 3600));
													
						// Crio uma url para redirecionar a página atual para a páginla do painel principal.
						$url_painel_principal = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/painelprincipal.php';

						header('Location: ' . $url_painel_principal); // função que recebe um link e redireciona a página para esse link
					} else {
											
						// o nome ou senha estão incorretos, portanto, exibir uma mensagem de erro
						$mensagem_erro = 'Dados de login incorreto, digite novamente.';
					}
				} else {
								
					// o nome ou a senha não foram digitados, portanto exibir uma mensagem de erro.
					$mensagem_erro = 'Preencha os campos para fazer login.';
				}	
			} 
			
			// CONSULTAR EXAME
			if($_POST['submit'] == 'Consultar') {
				
				// Obtém os dados inseridos pelo paciente 
				$paciente_login = mysqli_real_escape_string($dbc, trim($_POST['pacienteLogin'])); // LOGIN. trim -> Retira espaço no início e final de uma string.
				$paciente_senha = mysqli_real_escape_string($dbc, trim($_POST['pacienteSenha'])); // SENHA. mysql_real_escape_string -> escapa caracteres especiais.

				$mensagem_erro_paciente = "Estranho";

				if(!empty($paciente_login)  && !empty($paciente_senha)) {
					$mensagem_erro_paciente = "Estamos chegando lá";	
					//procura o nome e a senha no banco de dados
					$stringConsulta = "SELECT id_paciente, paciente_login, paciente_senha FROM pacientes WHERE BINARY paciente_login = '$paciente_login' AND BINARY paciente_senha = '$paciente_senha' ";

					// executa a consulta.
					$registro = mysqli_query($dbc, $stringConsulta) or die('Erro ao acessar o banco de dados');

					// condição verdadeira se for encontrado apenas um usuário.
					if(mysqli_num_rows($registro) == 1) {
              			// o login foi bem sucedido, portanto definir os cookies de ID e o nome do usuário e redirecionar para a home page.
						$row = mysqli_fetch_array($registro); // CAPTURA A PRIMEIRA LINHA DA TABELA

            			// Criar as sessões.
						$_SESSION['paciente_id']       = $row['id_paciente'];
						$_SESSION['paciente_login']    = $row['id_paciente'];
						$_SESSION['paciente_senha']    = $row['id_paciente'];

						// Crio uma url para redirecionar a página atual para a páginla do painel principal.
						$url_mostrar_exames = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/exame_consultar.php';

						header('Location: ' . $url_mostrar_exames); // função que recebe um link e redireciona a página para esse link

        			} else {
            			// o nome ou senha estão incorretos, portanto, exibir uma mensagem de erro
						$mensagem_erro_paciente = 'Dados de consulta incorreto, digite novamente.';
        			}
				} else {
					// o nome ou a senha não foram digitados, portanto exibir uma mensagem de erro.
					$mensagem_erro_paciente = 'Preencha os campos para fazer a consulta.';
				}
			}
		} //#  submit - Formulário
	} //# sessão - Verificação da sessão. 

	// inclusão do template cabeçalho
	// Aqui começa a ser desenvolvida a página html.
	$page_title = 'Login';
	require_once('header.php');
		
	// se a sessão estiver vazia, exibir mensagem de erro (se houver) e o formulário de login; caso contrário, confirmar login - condição verdadeira se a sessão ainda não estiver sido definida.
	// SE SESSÃO VAZIA
	if(empty($_SESSION['usuario_id'])) {
				
		echo '<p class="error">' . $mensagem_erro . '</p>'; // na primeira vez não é exibido nada pq mensagem_erro é uma string vazia.
?>

<!--Redirecionamento recursivo para a mesma página-->
<div class="d-flex justify-content-between align-items-center">
	<div>
		<form method="post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
					
			<fieldset>
				<legend class="text-success"> Digite seu login e senha para entrar no programa. </legend>
				<table>
					<tr>
						<td class="text-success">Login:</td>
						<td class="text-success"><input type="text" id="login" name="login" class="form-control form-control-sm" /></td> <!-- $_POST['submit'] = {(login -> bri)} -->
					</tr>
					<tr>
						<td class="text-success">Senha:</td>
						<td class="text-success"><input type="password" id="senha" name="senha" class="form-control form-control-sm"  /></td> <!-- $_POST['submit'] = {(senha -> derivada)} -->
					</tr>
					<tr>
						<!--Botão com chamada recursiva-->
						<td colspan="2"><input type="submit" value="Entrar" name="submit"  class="btn btn-success"/></td>
					</tr>
				</table>
			</fieldset>
		</form>
	</div>
	<div class="border rounded p-2 m-2 text-white bg-secondary bg-gradient">
		<form method="post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
			<fieldset>
				<legend class="">Consultar Exame</legend>
				<table>
					<tr>
						<td colspan="2"><?php echo $mensagem_erro_paciente; ?></td>
					</tr>
					<tr>
						<td> Login: </td>
						<td> <input type="text" id="pacienteLogin" name="pacienteLogin" class="form-control form-control-sm" /> </td>
					</tr>
					<tr>
						<td> Senha: </td>
						<td> <input type="text" id="pacienteSenha" name="pacienteSenha" class="form-control form-control-sm" /> </td>
					</tr>
					<tr>
						<!--BOTÃO PARA CONSULTAR EXAME DO PACIENTE-->
						<td colspan="2"><input type="submit" value="Consultar" id="submit" name="submit"  class="btn btn-light mx-auto"/></td>
					</tr>	
				</table>
			</fieldset>
		</form>		
	</div>	
</div>
			
<?php
			
	} //#if - que verifica se a variavel de sessão está vazia  
	
	else { // código executado se a variavel de sessão não estiver vazia
				
		// confirma o login bem sucedido
		echo '<span class="text-success h6">Você está logado como: ' . $_SESSION['login'] . '. ' . '</span><a href="logout.php" class="h1"> Sair </a> &nbsp;&nbsp;&nbsp;&nbsp;'; // cada simbolo desse representa um espaço.
		echo '<a href ="painelprincipal.php" class="h1"> Painel Principal. </a>' ;
	}
?>
	   
<?php
  
	// Insert the page footer
	require_once('rodape.php');
?>
