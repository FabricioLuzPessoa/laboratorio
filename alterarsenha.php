<?php

			// inclusão do template para inicio da sessão
			require_once('startsession.php');
			
			// inclusão das contantes de conexão
			require_once('conexao.php');
			
			// inclusão do template cabeçalho
			$page_title = 'Painel Principal';
			require_once('header.php');
			
			//inclusão do template barra de navegação
			require_once('barranavegacao.php');
			
			if( isset($_SESSION['usuario_id']) ) {
				
					if( isset( $_POST['submit'] ) ){
						
							// conecta ao banco de dados
							$dbc = mysqli_connect(SERVIDOR, USUARIO, SENHA, BANCO_DE_DADOS) or die ('Erro ao conectar ao banco de dados!');
						
							//captura os dados digitados pelo funcionário
							$nova_senha = mysqli_real_escape_string( $dbc, trim($_POST['nova_senha']) );
							$nova_senha2 = mysqli_real_escape_string( $dbc, trim($_POST['nova_senha2']) );
							
							if(!empty( $nova_senha ) && !empty( $nova_senha2 ) && ($nova_senha == $nova_senha2) ){
								
								// fazer a alteração no banco de dados
								$consulta = "UPDATE funcionarios SET senha = SHA('"  . $nova_senha . "') where id_funcionario =" . $_SESSION['usuario_id'];
								
								// realiza a mudança nos dados do banco de dados
								$resultado = mysqli_query($dbc, $consulta) or die ('Erro ao realizar mudança na tabela');
								
								// fecha a conexão com o banco de dados
								mysqli_close($dbc);

								echo '<p class="ok"> Senha alterada com sucesso. </p>';
								
								$nova_senha = "";
								$nova_senha2="";
							
							} else {
								
								echo '<p class="error"> Erro ao alterar senha. </p>';
								
								$nova_senha = "";
								$nova_senha2="";
							}
															
								
					}
			
?>
					<form method="post" action="<?php  echo $_SERVER['PHP_SELF']; ?>">
					
							<fieldset>
							
										<legend> Digite as informações para redefinição da senha </legend>
									
										<table>
											<tr>
												<td>Nova Senha:</td>
												<td><input type="password" id="nova_senha" name="nova_senha" value="<?php if( !empty($nova_senha) ) echo $nova_senha ?>"></td>
											</tr>
											<tr>
												<td>Repita a Nova Senha:</td>
												<td><input type="password" id="nova_senha2" name="nova_senha2" value="<?php if( !empty($nova_senha2) ) echo $nova_senha2 ?>"></td>
											</tr>
											<tr>
												<td><input type="submit" value="Alterar Senha" name="submit" /></td>
											</tr>
										</table>
					
						</fieldset>
					</form>

<?php 

			}
?>
<?php
  
			// Insert the page footer
			require_once('rodape.php');
?>