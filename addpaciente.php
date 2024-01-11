<?php

	// inclusão do template para inicio da sessão
	require_once('startsession.php');
	
	// inclusão do template cabeçalho
	$page_title = 'Cadastrar Paciente';
	require_once('header.php');
	
	//inclusão do template barra de navegação
	require_once('barranavegacao.php');
					
	require_once('variaveis.php');
	require_once('conexao.php');
							
	// if verdadeiro se a sessão tiver sido criada
	if( isset($_SESSION['usuario_id']) ) {

		function geraSenha($tamanho, $maiusculas, $minusculas, $numeros, $simbolos) {
				
			//Caracteres de cada tipo
			$lmin = 'abcdefghijklmnpqrstuvwxyz';
			$lmai = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';
			$num  = '123456789';
			$simb = '!@#$%*-';

			// Variaveis internas
			$retorno    = '';
			$caracteres = '';

			// Agrupamos todos os caracteres que poderão ser utilizados
			if ($minusculas) $caracteres .= $lmin;
			if ($maiusculas) $caracteres .= $lmai;
			if ($numeros)    $caracteres .= $num;
			if ($simbolos)   $caracteres .= $simb;

			// Calculamos o total de caracteres possíveis
			$len = strlen($caracteres); // recebe uma string e retorna o tamanho dela

			for ($n = 1; $n <= $tamanho; $n++) {
				// Criamos um número aleatório de 1 até $len para pegar um dos caracteres
				$rand = mt_rand(1, $len);
				// Concatenamos um dos caracteres na variável $retorno
				$retorno .= $caracteres[$rand-1];
			}
				
			return $retorno;
		
		}
		
		if( isset($_POST['submit']) ) {
								
			// conecta ao banco de dados
			$dbc = mysqli_connect(SERVIDOR, USUARIO, SENHA, BANCO_DE_DADOS) or die ('Erro ao conectar ao banco de dados!');
								
			// capture os dados digitados pelo funcionário
			$nome            = mysqli_real_escape_string($dbc, trim($_POST['nome']));
			$data_nascimento = mysqli_real_escape_string($dbc, trim($_POST['data_nascimento']));
			$data_nascimento = date('d/m/Y', strtotime($data_nascimento));
			$endereco        = mysqli_real_escape_string($dbc, trim($_POST['endereco']));
			$telefone        = mysqli_real_escape_string($dbc, trim($_POST['telefone']));
			$cartao_sus      = mysqli_real_escape_string($dbc, trim($_POST['cartao_sus']));
			$paciente_login  = strtoupper(substr($nome, 0, 1)) . geraSenha(5, true, false, true, false);
			$paciente_senha  = geraSenha(6, true, false, true, false);
					
			// condição verdadeira se nenhum dos campos estiverem vazio.								
			if( !empty($nome) && !empty($data_nascimento) && !empty($endereco) && !empty($telefone) && !empty($cartao_sus) ) {
								
				// String de inserção do registro no banco de dados	
				$consulta = "INSERT INTO pacientes (nome, data_nascimento, endereco, telefone, cartao_sus, paciente_login, paciente_senha ) 
				VALUES ('$nome', '$data_nascimento', '$endereco', '$telefone', '$cartao_sus', '$paciente_login', '$paciente_senha')";
						
				// Executa a consulta 							
				$exec = mysqli_query($dbc, $consulta) or die ('Erro ao inserir dados do banco de dados!');
				
				// fecho a conexão com o banco de dados
				mysqli_close($dbc);
									
				echo '<p class="ok">Paciente cadastrado com sucesso!</p>';
							
				$nome            = '';
				$data_nascimento = '';
				$endereco        = '';
				$telefone        = '';
				$cartao_sus      = '';
				$login           = '';
				$senha           = '';
									
			} else {
									
				// informa ao funcionário que ele deve preencher todos os dados.
				echo '<p class="error"> Você deve preencher todos os dados para cadastramento do paciente! </p>';
			}

		}//#submit
?>

<!-- Formulário para cadastro de paciente -->
<form method="post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
	<fieldset>
		<legend class="text-dark font-weight-bold"> Preencha os campos para cadastrar o paciente.</legend>
		<table>
			<tr>
				<td class="text-success">Nome:</td>
				<td><input type="text" id="nome" name="nome" class="form-control form-control-sm" /></td>
			</tr>
			<tr>
				<td class="text-success">Data de Nascimento:</td>
				<td><input type="date" id="data_nascimento" name="data_nascimento" class="form-control form-control-sm" /></td>
			</tr>
			<tr>
				<td class="text-success"> Endereço:</td>
				<td><input type="text" id="endereco" name="endereco" class="form-control form-control-sm" /></td>
			</tr>
			<td class="text-success">Telefone:</td>
				<td><input type="text" id="telefone" name="telefone" class="form-control form-control-sm" maxlength=15 onkeypress="mascara()"/></td>
			</tr>
			<tr>
				<td class="text-success">Cartão do Sus:</td>
				<td><input type="text" id="cartao_sus" name="cartao_sus" class="form-control form-control-sm" /></td>
			</tr>
			<tr>
				<!-- Botão faz uma chamada recursiva para a mesma página -->
				<td><input type="submit" value="Cadastrar" name="submit" class="btn btn-success" /></td>
			</tr>
		</table>
	</fieldset>
</form>
<script src="mascara.js"></script>

<?php	
	}//#session			
?>	

<?php
	// Insert the page footer
	require_once('rodape.php');
?>




