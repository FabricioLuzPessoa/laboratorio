<?php

	// inclusão do template para inicio da sessão
	require_once('startsession.php');

	// inclusão das contantes de conexão
	require_once('conexao.php');
		
	// inclusão do template cabeçalho
	$page_title = 'Pacientes';
	require_once('header.php');
		
	//inclusão do template barra de navegação
	require_once('barranavegacao.php');
		
	// SE SESSÃO USUARIO CRIADA.
	if( isset($_SESSION['usuario_id']) ) {
			
		// aqui se abre uma conexão com o banco de dados.
		$dbc = mysqli_connect(SERVIDOR, USUARIO, SENHA, BANCO_DE_DADOS) or die ('Erro ao conectar ao banco de dados!');
				
		// CONDIÇÃO VERDADEIRA SE O CLIENTE CLICOU NO BOTÃO SUBMIT PESQUISAR
		if(isset($_POST['submit'])) {		
					
			// captura a informação do formulário	
			$cartao_sus = mysqli_real_escape_string($dbc, trim($_POST['cartao_sus']));
							
							
			// SE CARTÃO VAZIO
			if(empty($cartao_sus)) {
							
				// consulta por todos os pacientes
				$consulta = "SELECT id_paciente, nome, data_nascimento, endereco, telefone, cartao_sus FROM pacientes ORDER BY nome";
			} else {
								
				// consulta apenas pelo paciente que tenha o cartão do sus cadastrado
				$consulta = "SELECT id_paciente, nome, data_nascimento, endereco, telefone, cartao_sus FROM pacientes where cartao_sus = " . $cartao_sus;
			}
		
		} else {
						
			// consulta realizada a primeira vez que o usuário entrar nessa página e ainda não clicou no botão submit
			$consulta = "SELECT id_paciente, nome, data_nascimento, endereco, telefone, cartao_sus FROM pacientes ORDER BY nome";
		}//#else
				
		// EXECUTA A CONSULTA E ARMAZENA NA VARIAVEL TABELA
		$tabela = mysqli_query($dbc, $consulta) or die('Erro ao realizar a consulta no banco de dados');
?>

<!--HTML puro, apenas para gerar um formulário para a página-->
<form method="post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">

	<table>
		<tr>
			<td class="text-success"> Pesquise pelo Cartão do SUS:                                          </td>
			<td><input type="text"  id="cartao_sus" name="cartao_sus" class="form-control form-control-sm" 
			oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />     </td> <!-- Campo de Texto -->
			<td><input type="submit" name="submit"   value="Pesquisar" class="btn btn-success" />           </td> <!-- Botão de pesquisar -->
		</tr>
	</table>
</form>
<hr/>

<?php
  
	// Start generating the table of results - Comece a gerar a tabela de resultados. Aqui eu mostro a tabelas com todos os pacientes cadastrados.
	echo '<table border="0" cellpadding="1" class="table table-borderless table-hover table-sm w-50">';
		// Generate the search result headings - Gere os títulos dos resultados da pesquisa. 
		echo '<thead class="thead-dark">';
			echo '<tr class="table-success">';
			echo 	   '<th>Nome               </th> 
						<th>Data de Nascimento </th> 
						<th>Cartão do SUS      </th>
						<th>                   </th>
						<th>				   </th>';
						
			echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		while($row = mysqli_fetch_array($tabela)) {
			echo '<tr>';
					
				echo '<td>' . $row['nome'] .            '</td>';
				echo '<td>' . $row['data_nascimento'] . '</td>';
				echo '<td>' . $row['cartao_sus'] .      '</td>';
				// faz um redirecionamento para a página paciente com o id do paciente.
				echo '<td><a href="paciente.php?id_paciente='. $row['id_paciente'] .' " class="btn-sm border rounded"> Visualizar</a></td>'; // LINK PARA A PÁGINA PACIENTE COM AS INFORMAÇÕES DO PACIENTE.
				// O ID DO PACIENTE É ENVIADO ATRAVÉS DO PROTOCOLO GET. NA PAGINA PACIENTE, ESSE VALOR PODERÁ SER OBTIDO ATRÁVES DA VARIAVEL GET. EX: $GET['ID_PAGIENTE'].
				echo '<td>
						<a href="#">
							<img src="./img/excluir.svg" title="Apagar Registro" onclick="excluir('.$row['id_paciente'].')" class="btn btn-danger btn-lg text-danger border rounded"/>
						</a>
					  </td>';
			echo '</tr>';
		}//#while
		echo '</tbody>';
	echo '</table>';
	}//#session
?>
<script src="pacientedelete.js"></script>
<?php
	// Insert the page footer
	require_once('rodape.php');
?>