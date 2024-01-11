<?php

	/*
	- $_POST['exame'] = ['acido_urico', 'aslo', ...] <-> Este array será criado nessa página e será enviado para a página exame_criar.
	- $_POST['exame'] -> armazena os nomes dos exames que o usuario clicar no checkbox.
	- Exemplo em caso do fucionario marcar acido_urico e aslo: $_POST['exame'] = ['acido_urico', 'aslo'];
	- Esta página é dividida em três partes: 1 - Atualização de dados do paciente.
										 	 2 - Parte se seleção para criar o exame.
											 3 - Parte de Exibição dos exames criados pelo paciente.
	*/
		
	// inclusão do template para inicio da sessão
	require_once('startsession.php');
		
	// inclusão do template cabeçalho
	$page_title = 'Paciente';
	require_once('header.php');
		
	//inclusão do template barra de navegação
	require_once('barranavegacao.php');
		
	// Constantes com informações das imagens
	require_once('variaveis.php');
	
	// Constantes de conexão com o banco de dados
	require_once('conexao.php');
		
	// aqui se abre uma conexão com o banco de dados.
	$dbc = mysqli_connect(SERVIDOR, USUARIO, SENHA, BANCO_DE_DADOS) or die ('Erro ao conectar ao banco de dados!');
		
	// Verifica se a variavel de sessão foi criada. Se a variavel de sessão ainda não foi criada. nenhum código será exibido.
	if (isset($_SESSION['usuario_id'])) {
							    
		// condição verdadeira quando o clicado no botão submit
		// 1ª parte - Parte que cuida sobre as informações cadastrais do paciente e atualizado dos dados do mesmo. submit -> Salvar
		if( isset($_POST['submit'] ) )  {
										
			$id_funcionario = $_SESSION['usuario_id'];
														
			$id_paciente     = mysqli_real_escape_string($dbc, trim($_POST['id_paciente']));
			$nome            = mysqli_real_escape_string($dbc, trim($_POST['nome']));
			$data_nascimento = mysqli_real_escape_string($dbc, trim($_POST['data_nascimento']));
			$endereco        = mysqli_real_escape_string($dbc, trim($_POST['endereco']));
			$telefone        = mysqli_real_escape_string($dbc, trim($_POST['telefone']));
			$cartao_sus      = mysqli_real_escape_string($dbc, trim($_POST['cartao_sus']));
																							
			if($_POST['submit'] == 'salvar') {
													
				// consulta para atualizar os dados do paciente.
				$consulta = "UPDATE pacientes set nome = '$nome', data_nascimento='$data_nascimento', endereco = '$endereco', 
											telefone='$telefone', cartao_sus = '$cartao_sus'  where id_paciente='" . $id_paciente . "'";
				// realiza a consulta
				mysqli_query($dbc, $consulta) or die ('Erro ao realizar consulta no banco de dados 1!');
			} 
		} 
		
		else {
			
			// condição verdadeira so p variavel get foi setada. Variavel criada na página pacientes.php
			if (isset($_GET['id_paciente'])) {
			
				//Seto a variavel de sessão com o id do paciente
				$_SESSION['id_paciente'] = $_GET['id_paciente'];
			}
											
			// String de consulta ao banco de dados baseado o id_cliente que vem da página pacientes.
			$consulta = "SELECT id_paciente, nome, data_nascimento, endereco, telefone, cartao_sus, paciente_login, paciente_senha FROM pacientes WHERE id_paciente='" . $_SESSION['id_paciente'] . "'";
											
			// Executa a consulta no banco de dados.
			$tabela = mysqli_query($dbc, $consulta) or die('Erro ao realizar consulta no banco de dados 2');
											
			// captura a primeira e unica linha da tabela e armazena na variavel $row
			$row = mysqli_fetch_array($tabela); // essa tabela só vai ter uma linha
								
			// insiro as informções nos dados para preencher o formulário
			if($row != NULL) {
						
				$id_paciente     = $row['id_paciente'];
				$nome            = $row['nome'];
				$data_nascimento = $row['data_nascimento'];
				$endereco        = $row['endereco'];
				$telefone        = $row['telefone'];
				$cartao_sus      = $row['cartao_sus'];
				$paciente_login  = $row['paciente_login'];
				$paciente_senha  = $row['paciente_senha'];
			} 
			
			else {
						
				echo '<p class="error">Erro ao acessar as informações do paciente.</p>';
			}//#else
		} //# else - Condição executada para mostra uma lista com todos os pacientes cadastrados.
?>								

<!-- Formulário para atualizar dados do paciente. formulário direcionado para a mesma página -->
<form method="post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
	<table>
		<tr>
			<td class="text-success">ID do paciente:</td>
			<td><input type="text" id="id_paciente" name="id_paciente" value="<?php if (!empty($id_paciente)) echo $id_paciente;  ?>" readonly class="form-control form-control-sm"/></td>
		</tr>
		<tr>
			<td class="text-success">Nome:</td>
			<td><input type="text" id="nome" name="nome" value="<?php if (!empty($nome)) echo $nome;  ?>" class="form-control form-control-sm" /></td>
		</tr>
		<tr>
			<td class="text-success">Data de nascimento:</td>
			<td><input type="text" id="data_nascimento" name="data_nascimento" value="<?php if (!empty($data_nascimento)) echo $data_nascimento;  ?>" class="form-control form-control-sm"/></td>
		</tr>
		<tr>
			<td class="text-success">Endereço:</td>
			<td><input type="text" id="endereco" name="endereco" value="<?php if (!empty($endereco)) echo $endereco;  ?>" class="form-control form-control-sm"/></td>
		</tr>
		<tr>
			<td class="text-success">Telefone:</td>
			<td><input type="text" id="telefone" name="telefone" value="<?php if (!empty($telefone)) echo $telefone;  ?>" class="form-control form-control-sm"/></td>
		</tr>
		<tr>
			<td class="text-success">Cartao do sus:</td>
			<td><input type="text" id="cartao_sus" name="cartao_sus" value="<?php if (!empty($cartao_sus)) echo $cartao_sus;  ?>" class="form-control form-control-sm"/></td>
		</tr>
		<tr>
			<td class="text-success">Login:</td>
			<td><input type="text" id="paciente_login" name="paciente_login" value="<?php if (!empty($paciente_login)) echo $paciente_login;  ?>" class="form-control form-control-sm" disabled/></td>
		</tr>
		<tr>
			<td class="text-success">Senha:</td>
			<td><input type="text" id="paciente_senha" name="paciente_senha" value="<?php if (!empty($paciente_senha)) echo $paciente_senha;  ?>" class="form-control form-control-sm" disabled/></td>
		</tr>
		<tr>
			<td class="text-success">Exames a serem feitos:</td>
			<td colspan="3"><input type="text" id="exames_fazer" name="exames_fazer" class="form-control form-control-sm" /></td>
		</tr>
		<tr>
			<!-- Botão salvar faz uma chamada recursiva para a própria página -->
			<td><input type="submit" value="salvar" name="submit" class="btn btn-success" /> </td>
		</tr>
	</table>	
	<hr/>
</form>
									
<!--2ª Parte - Criação de exames-->
<!-- Formulário para criação do exame. Formulário é direcionado para outra página -->
<form method="post" action="exame_criar.php">
											
	<table class="table table-borderless table-striped table-hover table-sm">
												
		<caption>Selecione o(s) exame(s) que deseja criar</caption>
		<!-- 1ª LINHA-->
		<tr>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="acido_urico"></td>
			<td>Ácido Úrico.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="colesterol_hdl" ></td>
			<td>Colesterol - HDL.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="glicemia_pos_prandial"></td>
			<td>Glicemia Pós-Prandial.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="sodio_serico" ></td>
			<td>Sódio Sérico.</td>
		</tr>
				
		<!-- 2ª LINHA-->
		<tr>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="amilase_total" ></td>
			<td>Amilase Total.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="colesterol_vldl" ></td>
			<td>Colesterol - VLDL.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="glicose"></td>
			<td>Glicose.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="tgo"></td>
			<td>TGO.</td>
		</tr>
				
		<!-- 3ª LINHA-->
		<tr>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="aslo"></td>
			<td>Aslo (Anti-Estreptolosina O).</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="hematocritoe"></td>
			<td>Eritograma - Hematócrito.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="grupo_sanguineo"></td>
			<td>Grupo Sanguíneo.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="tgp"></td>
			<td>TGP.</td>
		</tr>
				
		<!-- 4ª LINHA-->
		<tr>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="beta_hcg" ></td>
			<td>Beta HCG.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="hemoglobinae"></td>
			<td>Eritograma - Hemoglobina.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="glicemia_jejum"></td>
			<td>Glicemia em Jejum.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="triguicerides"></td>
			<td>Triguicerides.</td>
		</tr>
				
		<!-- 5ª LINHA-->
		<tr>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="bilirrubinas_totais_e_fracoes" ></td>
			<td>Billirrubinas Totais e Frações.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="fezes_3_amostras"></td>
			<td>Fezes 3 Amostras.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="gama_gt"></td>
			<td>Gama GT.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="troponina"></td>
			<td>Troponina.</td>
		</tr>
				
		<!-- 6ª LINHA-->
		<tr>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="calcio" ></td>
			<td>Cálcio.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="fostafase_alcalina"></td>
			<td>Fostafase Alcalina.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="hemograma"></td>
			<td>Hemograma.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="teste_rapido_zika"></td>
			<td>Teste Rápido para Zika.</td>
		</tr>
				
		<!-- 7ª LINHA-->
		<tr>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="ckmb"></td>
			<td>CKMB.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="fezes"></td>
			<td>Fezes.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="lipase" ></td>
			<td>Lipase.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="tap"></td>
			<td>TAP (Tempo e Atividade de Protrombina).</td>
		</tr>
				
		<!-- 8ª LINHA-->
		<tr>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="cloro" ></td>
			<td>Cloro.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="ferro_serico" ></td>
			<td>Férro Sérico.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="proteinas_totais_e_fracoes" ></td>
			<td>Proteínas Totais e Frações.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="ttpa"></td>
			<td>TTPA (Tempo Tromboplastina Parcial Ativada).</td>
		</tr>
		<!-- 9ª LINHA -->
		<tr class="text-danger b">
			<td><input type="checkbox" id="exame[]" name="exame[]" value="coagulograma"></td>
			<td>Coagulograma.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="fator_r"></td>
			<td>Fator R (Reumatóide).</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="pcr"></td>
			<td>PCR (Proteína C Reativa).</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="ureia"></td>
			<td>Ureia.</td>
		</tr>
		<!-- 10ª LINHA -->
		<tr>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="creatinina" ></td>
			<td>Creatinina.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="fosforo" ></td>
			<td>Fósforo.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="potassio" ></td>
			<td>Potássio.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="vhs"></td>
			<td>VHS (Velocidade de Hemossedimentação).</td>
		</tr>
		<!-- 11 LINHA -->
		<tr>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="colesterol_total"></td>
			<td>Colesterol Total.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="ggt" ></td>
			<td>Gama Glutamil Transferase (GGT).</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="sumario_urina"></td>
			<td>Sumário de Urina.</td>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="vdrl"></td>
			<td>V.D.R.L.</td>
		</tr>
		<!-- 12 LINHA -->
		<tr>
			<td><input type="checkbox" id="exame[]" name="exame[]" value="ck_total"></td>
			<td>CK Total (Creatina Quinase).</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>
	<!-- BOTÃO SUBMIT -->
	<table>
		<tr>
			<!-- Ao clicar no botão o array será enviado para a página exame_criar.php -->
			<td><input type="submit" id="submit" name="submit" value="Criar" class="btn btn-success" /></td>
		</tr>
	</table>								
	<hr/>
</form>

<?php
	// 3ª Parte - parte para visualização dos exames do paciente.
	//String de consulta ao banco de dados. Essa consulta faz uma consulta na tabela << exames >>
	$consulta =  "select * from exames where id_paciente =" . $id_paciente;
								
	// executa a consulta e armazena a tabela na variável tabela
	$tabela = mysqli_query($dbc, $consulta) or die('Erro ao realizar a consulta no banco de dados');
					
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
				echo '<td><a href="visualizarexame.php?nome_documento=' . $row['documento']  . '" class="btn-sm border-0 rounded" > Exibir Documento.</a></td>';
			echo '</tr>';
		}//#while	
		echo '</tbody>';	
	echo '</table>';
					
	mysqli_close($dbc);
?>

<?php
	}//#if session
?>
	
<?php
  	// Insert the page footer
	require_once('rodape.php');
?>