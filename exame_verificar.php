<?php

	/*
		- Exibe como será o exame e envia o array para a página "exame_armazenar", onde os dados serão salvo em banco de dados
		- O mesmo array POST que vem de exame_criar é repasado para exame_armazenar.
		- RECEBE ESTE ARRAY de EXAME_CRIAR $_POST = ( [acido_urico] -> 30 [aslo] -> 20 ).
	*/
		
	// inclusão do template para inicio da sessão
	require_once('startsession.php');
		
	// inclusão do template cabeçalho
	$page_title = 'Verifique as informações antes de enviar para o Bioquímico';
	require_once('header.php');
		
	//inclusão do template barra de navegação
	require_once('barranavegacao.php');
		
	require_once('variaveis.php');
	require_once('conexao.php');
		
	// conecto ao banco de dados
	$dbc = mysqli_connect(SERVIDOR, USUARIO, SENHA, BANCO_DE_DADOS) or die ('Erro ao conectar ao banco de dados!');

	// CRIAÇÃO DE ARRAY COM VALORES DOS EXAMES
	$_SESSION['valores_exames'] = $_POST;
 		
	// Verifica se a variavel de sessão foi criada. Se a variavel de sessão ainda não foi criada. nenhum código será exibido.
	if (isset($_SESSION['usuario_id'])) {
		
		// String de consulta ao banco de dados baseado o id_cliente que vem da página paciente.
		$consulta = "SELECT id_paciente, nome, data_nascimento, endereco, telefone, cartao_sus FROM pacientes WHERE id_paciente='" . $_SESSION['id_paciente'] . "'";
		
		// Executa a consulta no banco de dados.
		$tabela = mysqli_query($dbc, $consulta) or die('Erro ao realizar consulta no banco de dados');
		
		// captura a primeira e unica linha da tabela e armazena na variavel $row
		$row = mysqli_fetch_array($tabela); // essa tabela só vai ter uma linha

		if($row != NULL) {
				
			$id_paciente     = $row['id_paciente'];
			$nome            = $row['nome'];
			$data_nascimento = $row['data_nascimento'];
			$endereco        = $row['endereco'];
			$telefone        = $row['telefone'];
			$cartao_sus      = $row['cartao_sus'];
		} 
		
		else {
				
			echo '<p class="error">Erro ao acessar as informações do paciente.</p>';
		}
		
		$pagina_html = '<html>
			<head>
				<style>
					html, body {
						font-family: sans-serif;
						font-size:   110%;
						line-height: 2.1;
						border:      1px;
					}
					
					body {
						padding:      0px;
						margin-left:  200;
						margin-right: 200px;
					}
					
					.centralizar {
						text-align: center;	
					}
					
					.fontemenor {
						font-size:   80%;
						font-family: courier-news;	
					}
					
					.margin {
						margin-left:  0%;
						margin-right: 0%;
					}
					
					.negrito {
						font-weight: bold;
					}
				</style>
				
				<script src="scripts.js"></script>
			</head>		
										
			<body>
			
				<div class="margin">
					<p class="centralizar">
						Hospital Municipal de Livramento de N. Senhora/BA <br/>
						Laboratório de Análise Clínicas.
					</p>
					
					<p class="centralizar"> Av. Presidente Vargas, 829 – Livramento de Nossa Senhora – BA </p>
					
					<table class="table table-sm table-borderless w-auto lh-1">  
						<tr>
							<td> Nome:     </td>
							<td> '.$nome.'.</td>
						</tr>  
						<tr>
							<td>Material:</td>
							<td>Sangue.   <td>
						</tr>              
						<tr>
							<td>Data:</td>
							<td>'.date('d/m/y').'.</td>
						</tr>	
						<tr>
							<td>Solicitante:</td>
							<td>'.$_POST['solicitante'].'.</td>
						</tr>
					</table>
					
					<hr/><p class="centralizar">  RESULTADO DE EXAME  </p><hr/>';

	// ÁCIDO ÚRICO.
	if( isset($_POST['acido_urico']) ) {
	
		$pagina_html .= '<p>
			ÁCIDO ÚRICO: <span id="acido_urico">' . $_POST['acido_urico'] . '</span> mg/dL   <br/>
			<div class="fontemenor">
				VALOR DE REFERÊNCIA : 			   <br/>
				Adultos 						   <br/>
				MASCULINO 2,5 a 7,0 mg/dL          <br/>
				FEMININO 1,5 a 6,0 mg/dL           <br/>
				Crianças 						   <br/>	
				MASCULINO 1,5 a 6,0 mg/dL 		   <br/>	
				FEMININO 0,5 a 5,0 mg/dL           <br/>
				MÉTODO: ENZIMÁTICO-COLORIMÉTRICO   <br/>
			</div>
		</p>';
	}	 

	// ASLO
	if( isset($_POST['aslo']) ) {
		// verificar qual a informação a ser alterada no aslo.	
		$pagina_html.= '<p>
			ASLO ( Anti-Estreptolisina O)..Inferior a 200 UI/mL <br/>
			<div class="fontemenor">
				VALOR DE REFERÊNCIA :  < 200 UI/ML                                  <br/>
				MÉTODO: AGLUTINAÇÃO DO LÁTEX ( QUALITATIVO E SEMI-QUANTITATIVO)     <br/>
			</div>
		</p>';
	} 

	// BETA HCG
	if( isset($_POST['beta_hcg']) ) {
	
		$pagina_html .= '<p>
			BETA HCG....................' . $_POST['beta_hcg'] . '.<br/>
			<div class="fontemenor">
				VALOR DE REFERÊNCIA:  NEGATIVO.	<br/>
			</div>
		</p>';
	} 

	// CKMB
	if( isset($_POST['ckmb']) ) {
	
		$pagina_html .= '<p>
			CKMB: '. $_POST['ckmb'] . ' U/L. <br/>                    
			<div class="fontemenor">
				VALOR DE REFERÊNCIA : 00  A 25 UL
				MÉTODO: CINÉTICO - UV.
			</div>
		</p>';
	}  

	// CK TOTAL
	if( isset($_POST['ck_total']) ) {
	
		$pagina_html .= '<p>
			CK Total (Creatina Quinase): ' . $_POST['ck_total'] . ' U/L. <br/>
			<div class="fontemenor">
				VALOR DE REFERÊNCIA :                                                                                                                                                                                                                               
				HOMEM : 26 A 190U/L.
				MULHER: 26 A 155U/L.
				MÉTODO: CINÉTICO - UV.
			</div>
		</p>';
	} 

	// COAGULOGRAMA
	if( isset($_POST['ts']) ) {
	
		// esse if  representa o exame de coagulograma. COAGULOGRAMA.
		$pagina_html .= '<p>
			Coagulograma												
		</p>
		
		<p>
			TS: ' . $_POST['ts'] . '.
			<div class="fontemenor">
				VALORES DE REFERÊNCIA: ATÉ 03 MINUTOS.	
			</div>
		</p>
		
		<p>
			TC: ' . $_POST['tc'] . '. <br/>                 
			<div class="fontemenor">
				VALORES DE REFERÊNCIA: 05 A 10 MINUTOS. <br/>	
				MÉTODO : LEE E WHITE.
			</div>
		</p>';
	} 

	// COLESTEROL TOTAL
	if( isset($_POST['colesterol_total']) ) {
	
		$pagina_html .= '<p>
										
			COLESTEROL TOTAL: '. $_POST['colesterol_total'] .' mg/dL.											<br/>
			<div class="fontemenor">	
				AMOSTRA: SORO.																					<br/>
				METODO: COLORIMETRICO ENZIMATICO.  																<br/><br/>
				VALORES DE REFERENCIA:																			<br/>
				0 A 2 ANOS:																						<br/>		
				&nbsp;&nbsp;&nbsp;&nbsp;Não existem valores de referência estabelecidos para essa faixa etária. <br/>
				2 A 19 ANOS:																					<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;Com jejum: Inferior a 170 mg/dL. Sem jejum: Inferior a 170 mg/dL.       <br/>
				SUPERIOR A 19 ANOS:                  															<br/>			
				&nbsp;&nbsp;&nbsp;&nbsp;Com jejum: Inferior a 190 mg/dl. Sem jejum: Inferior a 190 mg/dL.       <br/>		
			</div>	
		</p>';
	}

	// CREATINA
	if( isset($_POST['creatinina']) ) {
	
		$pagina_html .= '<p>
			CREATININA: ' . $_POST['creatinina'] . ' mg/dL.
			<div class="fontemenor">
				VALOR DE REFERÊNCIA : 0,4 A 1,3 MG/DL. <br/>
				MÉTODO : CINÉTICO –COLORIMÉTRICO.
			</div>
		</p>';
	} // Consertar isso aqui e verificar os dados a serem inseridos

	// HEMATÓCRITO
	if( isset($_POST['hematocritoe']) ) {
	
		$pagina_html .= '<p>
			Hematócrito (%): ' . $_POST['hematocritoe'] . '. <br/>
			<div class="fontemenor">	
				Valores de referência: <br/>
				Masculino: 42 a 50. <br/>
				Feminino: 36 a 47. <br/>
			</div>	
		</p>';
	}

	// HEMOGLOBINA
	if( isset($_POST['hemoglobinae']) ) {
	
		$pagina_html .= '<p>
			Hemoglobina (g%): ' . $_POST['hemoglobinae'] . '. <br/>
			<div class="fontemenor">	
				Valores de referência:     <br/>
				Masculino: 13,50 a 17,50.  <br/>
				Feminino: 12,00 a 16,00.
			</div>	
		</p>';
	}

	// FR - FATOR REUMATOIDE - VERIFICAR O FUNCIONAMENTO
	if( isset($_POST['fator_r']) ) {
	
		// Ver com gilmar como funciona o fator reumatoide	
		$pagina_html .= '<p>
														
		FR (Fator Reumatóide)..........Inferior a 08  UI/mL                     
		<div class="fontemenor">
			VALOR DE REFERÊNCIA  :  NEGATIVO  ( < 08 UI/ML)					 <br/>
			MÉTODO: AGLUTINAÇÃO DO LÁTEX ( QUALITATIVO E SEMI-QUANTITATIVO)  <br/>
		</div>
		</p>' ;
	}

	// FEZES.
	if( isset($_POST['amostra_protozooscopia']) ) {
		// Esse if representa o exame de fezes. FEZES
		$pagina_html .= '<p>
		Resultado de Parasitologico de Fezes: <br/><br/>';
		// Se negativo, mostra apenas no nome negativo. Caso contrário, mostre o que o usuário digitou.
		if($_POST['amostra_helmintoscopia'] == 'NEGATIVO'){
			
			$pagina_html .= ' Helmintoscopia: ' . $_POST['amostra_helmintoscopia'] . '. <br/>';
		} 
		
		else {
				
		$pagina_html .= ' Helmintoscopia: ' . $_POST['obs1'] . '. <br/>';
		}
		
		// Se negativo, mostra apenas no nome negativo. Caso contrário, mostre o que o usuário digitou.		
		if($_POST['amostra_protozooscopia'] == 'NEGATIVO'){
			
			$pagina_html .= ' Protozooscopia: ' . $_POST['amostra_protozooscopia'] . '. <br/>';
		} 
		
		else {
			
			$pagina_html .= ' Protozooscopia: ' . $_POST['obs2'] . '. <br/>';
		}
		
		$pagina_html .= '</p>';
	}
	
	// FEZES 3 AMOSTRAS.
	if( isset($_POST['amostra_1_protozooscopia']) ) {
	
		// Esse if representa o exame de fezes para 3 amostras.
		$pagina_html .= '<p>
		Resultado de Parasitologico de Fezes: <br/><br/>';
		//Primeira Amostra
		if($_POST['amostra_1_helmintoscopia'] == 'NEGATIVO'){ 
			
			$pagina_html .= ' Helmintoscopia: ' . $_POST['amostra_1_helmintoscopia'] . '. <br/>';
		} else {
				
			$pagina_html .= ' Helmintoscopia: ' . $_POST['helmintoscopia_1_positivo'] . '. <br/>';
		}
		
		if($_POST['amostra_1_protozooscopia'] == 'NEGATIVO'){
			
			$pagina_html .= ' Protozooscopia: ' . $_POST['amostra_1_protozooscopia'] . '. <br/>';
		} else {
				
			$pagina_html .= ' Protozooscopia: ' . $_POST['protozooscopia_1_positivo'] . '. <br/>';
		}
		
		// Segunda Amostra
		if($_POST['amostra_2_helmintoscopia'] == 'NEGATIVO'){
			
			$pagina_html .= ' Helmintoscopia: ' . $_POST['amostra_2_helmintoscopia'] . '. <br/>';
		} else {
				
			$pagina_html .= ' Helmintoscopia: ' . $_POST['helmintoscopia_2_positivo'] . '. <br/>';
		}
		
		if($_POST['amostra_2_protozooscopia'] == 'NEGATIVO'){
			
			$pagina_html .= ' Protozooscopia: ' . $_POST['amostra_2_protozooscopia'] . '. <br/>';
		} else {
				
			$pagina_html .= ' Protozooscopia: ' . $_POST['protozooscopia_2_positivo'] . '. <br/>';
		}
		
		// Terceira Amostra
		if($_POST['amostra_3_helmintoscopia'] == 'NEGATIVO'){
			
			$pagina_html .= ' Helmintoscopia: ' . $_POST['amostra_3_helmintoscopia'] . '. <br/>';
		} else {
				
			$pagina_html .= ' Helmintoscopia: ' . $_POST['helmintoscopia_3_positivo'] . '. <br/>';
		}
		
		if($_POST['amostra_3_protozooscopia'] == 'NEGATIVO'){
			
			$pagina_html .= ' Protozooscopia: ' . $_POST['amostra_3_protozooscopia'] . '. <br/>';
		} else {
				
			$pagina_html .= ' Protozooscopia: ' . $_POST['protozooscopia_3_positivo'] . '. <br/>';
		}
		$pagina_html .= '</p>';
	}

	// FOSFATASE ALCALINA
	if( isset($_POST['fostafase_alcalina']) ) {
	
		$pagina_html .= '<p>
			FOSFATASE ALCALINA: ' .$_POST['fostafase_alcalina'].' U/L. 
			<div class="fontemenor">	
				AMOSTRA: SORO.                                    <br/>
				MÉTODO: CINÉTICO COLORIMÉTRICO.                   <br/>
				VALOR DE REFERÊNCIA:                              <br/>
				0 A 14 DIAS: 82 a 249 U/L.                        <br/>
				15 DIAS A 1 ANO: 122 a 473 U/L.                   <br/><br/>
				Sexo Feminino:                                    <br/>
				1  a 9 anos:  149 a 301 U/L.                      <br/>
				10 a 12 anos: 127 a 326 U/L.                      <br/>
				13 a 14 anos: 62  a 212 U/L.                      <br/>
				15 a 16 anos: 52  a 120 U/L.                      <br/>
				17 a 18 anos: 45  a 97  U/L.					  <br/>
				Adultos:      25  a 100 U/L.					  <br/>
				Sexo Masculino:                                   <br/>
				1  a 9 anos:  149 a 301 U/L.                      <br/>
				10 a 12 anos: 127 a 326 U/L.                      <br/>
				13 a 14 anos: 129 a 437 U/L.                      <br/>
				15 a 16 anos: 78  a 268 U/L.                      <br/>
				17 a 18 anos: 40  a 129  U/L.					  <br/>
				Adultos:      25  a 100 U/L.					  <br/>
			</div>	
		</p>';
	}

	// GAMA GT
	if( isset($_POST['gama_gt']) ) {
		
		$pagina_html .= '<p>
		GAMA GT: ' . $_POST['gama_gt'] . ' U/L.   <br/>
		<div class="fontemenor">
			VALOR DE REFERÊNCIA:             <br/> 
			MULHERES:07  A 32 UNIDADES/L.    <br/>
			HOMENS: 11 A 50 UNIDADES/L.      <br/>
			MÉTODO: CINÉTICO - UV.           <br/>
		</div>
		</p>';
	}

	// GLICEMIA EM JEJUM
	if( isset($_POST['glicemia_jejum']) ) {
	
		$pagina_html .= '<p>
		GLICEMIA EM JEJUM: ' . $_POST['glicemia_jejum'] . '. mg/dL <br/>
		<div class="fontemenor">
			VALOR DE REFERÊNCIA : 70 A 100MG/DL. <br/>
			MÉTODO: ENZIMÁTICO-COLORIMÉTRICO. <br/>
		</div>
		</p>';
	}

	// GLICEMIA PÓS-PRANDIAL
	if( isset($_POST['glicemia_pos_prandial']) ) {
	
		$pagina_html .= '<p>
		GLICEMIA  PÓS - PRANDIAL: ' . $_POST['glicemia_pos_prandial'] . '.  mg/dL <br/>
		<div class="fontemenor">
			MÉTODO: ENZIMÁTICO-COLORIMÉTRICO.	 <br/>
		</div>
		</p>';
	}

	// GLICOSE
	if( isset($_POST['glicose']) ) {
	
		$pagina_html .= '<p>
		GLICOSE: ' . $_POST['glicose'] . '  mg/dL. <br/>
		<div class="fontemenor">	
			VALOR DE REFERÊNCIA : 60 A 99 MG/DL.     <br/>
			MÉTODO: ENZIMÁTICO-COLORIMÉTRICO.    <br/>
		</div>	
		</p>';
	}

	// GRUPO SANGUÍNEO - AQUI EU POSSO COLOCAR TODOS OS GRUPOS ONDE A PESSOA SÓ PRECISA MARCAR
	if( isset($_POST['grupo_sanguineo']) ) {
	
		$pagina_html .= '<p>
			Grupo sanguíneo............ ”' . $_POST['grupo_sanguineo'] . '”. <br/>
			Fator Rh........................"' . $_POST['frh'] . '".
		</p>';
	}

	// HEMOGRAMA - O BRABO
	if( isset($_POST['hematocrito']) ) {
	
		// ERITOGRAMA//
		$hematocrito = str_replace(',', '.', $_POST['hematocrito']);
		$hemoglobina = str_replace(',', '.', $_POST['hemoglobina']);
		$hemacias =	   str_replace(',', '.', $_POST['hemacias']);
	
		$vcm =  str_replace('.', ',' , round (( $hematocrito / $hemacias ) * 10, 2));
		$hcm =  str_replace('.', ',', round(($hemoglobina/$hemacias) * 10, 2));
		$chgm = str_replace('.', ',', round(($hemoglobina/$hematocrito)*100, 2));
		//LEUCOGRAMA//
		$leucocitos =              str_replace(',' , '.', $_POST['leucocitos']);								
		$basofilos_relativo = 	   str_replace(',', '.', $_POST['basofilos_relativo']);
		$eosinofilos_relativo =    str_replace(',', '.', $_POST['eosinofilos_relativo']);
		$mielocitos_relativo =     str_replace(',', '.', $_POST['mielocitos_relativo']);
		$metamielocitos_relativo = str_replace(',', '.', $_POST['metamielocitos_relativo']);
		$bastonetes_relativo =     str_replace(',', '.', $_POST['bastonetes_relativo']);
		$segmentados_relativo =    str_replace(',', '.', $_POST['segmentados_relativo']);
		$linfocitos_relativo =     str_replace(',', '.', $_POST['linfocitos_relativo']);
		$monocitos_relativo =      str_replace(',', '.', $_POST['monocitos_relativo']);
		
		if($_POST['basofilos_relativo'] == '0' or $_POST['basofilos_relativo'] == null) {
			$basofilos_absoluto = '-';
		} 
	
		else {
			$basofilos_absoluto = str_replace('.', ',', round (($leucocitos / 100) *$basofilos_relativo, 2));
		}
	
		if($_POST['eosinofilos_relativo'] == '0' or $_POST['eosinofilos_relativo'] == null) {
			$eosinofilos_absoluto = '-';
		} 
	
		else {
			$eosinofilos_absoluto = str_replace('.', ',', round (($leucocitos / 100) *$eosinofilos_relativo, 2));
		}
		
		if($_POST['mielocitos_relativo'] == '0' or $_POST['mielocitos_relativo'] == null) {
			$mielocitos_absoluto = '-';
		} 
	
		else {
			$mielocitos_absoluto = str_replace('.', ',', round (($leucocitos / 100) *$mielocitos_relativo, 2));
		}
	
		if($_POST['metamielocitos_relativo'] == '0' or $_POST['metamielocitos_relativo'] == null) {
			$metamielocitos_absoluto = '-';
		} 
	
		else {
			$metamielocitos_absoluto = str_replace('.', ',', round (($leucocitos / 100) *$metamielocitos_relativo, 2));
		}

		if($_POST['bastonetes_relativo'] == '0' or $_POST['bastonetes_relativo'] == null) {
			$bastonetes_absoluto = '-';
		} 
	
		else {
			$bastonetes_absoluto = str_replace('.', ',', round (($leucocitos / 100) *$bastonetes_relativo, 2));
		}
	
		if($_POST['segmentados_relativo'] == '0' or $_POST['segmentados_relativo'] == null) {
			$segmentados_absoluto = '-';
		} 
	
		else {
			$segmentados_absoluto = str_replace('.', ',', round (($leucocitos / 100) *$segmentados_relativo, 2));
		}
	
		if($_POST['linfocitos_relativo'] == '0' or $_POST['linfocitos_relativo'] == null) {
			$linfocitos_absoluto = '-';
		} 
	
		else {
			$linfocitos_absoluto = str_replace('.', ',', round (($leucocitos / 100) *$linfocitos_relativo, 2));
		}
	
		if($_POST['monocitos_relativo'] == '0' or $_POST['monocitos_relativo'] == null) {
			$monocitos_absoluto = '-';
		} 
	
		else {
			$monocitos_absoluto = str_replace('.', ',', round (($leucocitos / 100) *$monocitos_relativo, 2));
		}
				
		// esse if representa a exame de hemograma. Ver com gilmar depois como que vai ser feito esse hemograma.
		$pagina_html .= '<p class="centralizar"> HEMOGRAMA </p>
														
		<table>
			<caption class="negrito">ERITOGRAMA</caption>
			<tr>
				<td></td>
				<td></td>
				<td rowspan="2">Valor Encontrado </td>
				<td></td> 
				<td colspan="2" align="center">Valor de referência</td>
			</tr>	
			
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td align="center">Masculino</td>
				<td align="center">Feminino</td>
			</tr>
			
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			
			<tr>
				<td colspan="2">Hematócrito (%)</td> 
				<td> ' . $_POST['hematocrito'] . '</td> 
				<td></td> 
				<td align="center">42% a 50%</td> 
				<td align="center">36% a 47%</td>
			</tr>
			
			<tr>
				<td colspan="2">Hemoglobina (g%)</td>
				<td>' . $_POST['hemoglobina'] . '</td>
				<td></td> 
				<td>13,50 a 17,50</td> 
				<td>12,00 a 16,00</td>
			</tr>
			
			<tr>
				<td colspan="2">Hemácias (milhões/mm³)</td>
				<td>' . $_POST['hemacias'] . '</td>
				<td></td> 
				<td align="center">4,30 a 5,70</td> 
				<td align="center">4,00 a 5,60</td>
			</tr>
			
			<tr>
				<td colspan="2">V C M (uu)</td>
				<td>' . $vcm . '</td>
				<td></td>
				<td colspan="2" align="center">80 a 100 </td>
			</tr>
			
			<tr>
				<td colspan="2">H C M (yy)</td>
				<td>' . $hcm . '</td>
				<td></td> 
				<td colspan="2" align="center">27 a 32 </td>
			</tr>
			
			<tr>
				<td colspan="2">C H G M (%)</td>
				<td>' . $chgm . '</td>
				<td></td> 
				<td colspan="2" align="center">32 a 36 </td>
			</tr>
			
			<tr>
				<td colspan="2">RDW</td>
				<td>' . $_POST['rdw'] . '</td>
				<td></td>
				<td align="center">10 a 15</td> 
				<td align="center">10 a 15</td>
			</tr>
		</table>
				
		<table>
		
			<caption class="negrito">LEUCOGRAMA</caption>
			
			<tr>
				<td colspan="2">Leucócitos (/mm³)</td> 
				<td>' . $_POST['leucocitos'] . '</td> 
				<td colspan="2">(4.000 - 10.000)</td> 
				<td></td>
			</tr>
			
			<tr>
				<td></td>
				<td></td>
				<td>Relativo</td>
				<td>Absoluto</td>
				<td rowspan="2">(%)</td>
				<td rowspan="2">/mm³</td>
			</tr>
			
			<tr></tr>
			
			<tr>
				<td></td>
				<td></td> 
				<td>(%)</td> 
				<td>(/mm³)</td>		
			</tr>
			
			<tr>
				<td colspan="2">Basófilos</td> 
				<td>' . $_POST['basofilos_relativo'] . '</td> 
				<td>' . $basofilos_absoluto . '</td> 
				<td>0 a 1</td> 
				<td>0 a 100</td>		
			</tr>
			
			<tr>
				<td colspan="2">Eosinófilos</td>
				<td>' . $_POST['eosinofilos_relativo'] . '</td> 
				<td>' . $eosinofilos_absoluto . '</td>
				<td>2 a 5</td>
				<td>100 a 500</td>		
			</tr>
			
			<tr>
				<td colspan="2">Mielócitos</td>
				<td>' . $_POST['mielocitos_relativo'] . '</td>
				<td>' . $mielocitos_absoluto . '</td>
				<td>0 a 0</td>
				<td>0</td>		
			</tr>
			
			<tr>
				<td colspan="2">Metamielócitos</td> 
				<td>' . $_POST['metamielocitos_relativo'] . '</td>
				<td>' . $metamielocitos_absoluto . '</td>
				<td>0 a 1</td>
				<td>0 a 100</td>		
			</tr>
			
			<tr>
				<td colspan="2">Bastonetes</td>
				<td>' . $_POST['bastonetes_relativo'] . '</td>
				<td>' . $bastonetes_absoluto . '</td>
				<td>0 a 5</td>
				<td>150 a 500</td>		
			</tr>
			
			<tr>
				<td colspan="2">Segmentados</td>
				<td>' . $_POST['segmentados_relativo'] . '</td>
				<td>' . $segmentados_absoluto . '</td>
				<td>54 a 62</td>
				<td>2700 a 6200</td>		
			</tr>
			
			<tr>
				<td colspan="2">Linfócitos</td>
				<td>' . $_POST['linfocitos_relativo'] . '</td>
				<td>' . $linfocitos_absoluto . '</td>
				<td>20 a 35</td>
				<td>1000 a 3500</td>		
			</tr>
			
			<tr>
				<td colspan="2">Monócitos</td>
				<td>' . $_POST['monocitos_relativo'] . '</td>
				<td>' . $monocitos_absoluto . '</td>
				<td>3 a 8</td>
				<td>1500 a 800</td>		
			</tr>
			
			<tr>
				<td>Plaquetas: </td> 
				<td> ' . $_POST['plaquetas'] . '000/mm³</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>					
		</table>';
	}

	// PCR - VERIFICAR COM GILMAR COMO É FEITO ESSE EXAME PCR
	if( isset($_POST['pcr']) ) {
		
		// verificar os dados do exame pcr
		$pagina_html .= '<p>
			PCR ( Proteína C Reativa)......Inferior a 06  mg/L                     <br/>
			<div class="fontemenor">																		
				VALOR DE REFERÊNCIA:  NEGATIVO ( < 06 mg/L)							<br/>	
				MÉTODO: AGLUTINAÇÃO DO LÁTEX  ( QUALITATIVO E SEMI-QUANTITATIVO)
			</div>
		</p>';
	}
	
	// URINA - ESSE IF REPRESENTA O EXAME DE URINA. VERIFICAR COM GILMAR COMO ELE É FEITO.
	if( isset($_POST['aspecto']) ) {
		
		// esse exame representa o condição do sumário de urina SUMARIO DE URINA
		$pagina_html .= '<p class="centralizar">  RESULTADO DE SUMÁRIO DE URINA  </p>
		<p>
												
			EXAME FÍSICO <br/>
											
			<table>
				<tr>
					<td>VOLUME:</td> 
					<td>' . $_POST['volume'] . ' ml.</td> 
					<td>COR:</td>
					<td>' . $_POST['cor'] . '.</td>
				</tr>
	
				<tr>
					<td>DENSIDADE:</td>
					<td>' . $_POST['densidade'] . '.</td>
					<td>ASPECTO:</td>
					<td>' . $_POST['aspecto'] . '.</td>
				</tr>
				
				<tr>
					<td>pH REAÇÃO:</td>
					<td>' . $_POST['ph_reacao'] . '.</td>
				</tr>
			</table>
		</p>
		
		<p>
											
			EXAME QUÍMICO <br/>
											
			<table>
				<tr>
					<td>PROTEINAS: </td> 
					<td>' . $_POST['proteinas'] . '.</td> 
					<td>HEMOGLOBINA:</td>
					<td>' . $_POST['hemoglobina'] . '.</td>
				</tr>
	
				<tr>
					<td>GLICOSE:</td> 
					<td>' . $_POST['glicosex'] . '.</td> 
					<td>CETONA:</td>
					<td>' . $_POST['cetona'] . '.</td>
				</tr>
				
				<tr>
					<td>BILIRRUBINAS:</td>
					<td>' . $_POST['bilirrubinas'] . '.</td>
					<td>UROBILINOGÊNIO:</td>
					<td>' . $_POST['urobilinogenio'] . '.</td>
				</tr>
				
				<tr>
					<td>NITRITO:</td> 
					<td>' . $_POST['nitrito'] . '.</td>
				</tr>
			</table>
		</p>
		
		<p>
			MICROSCOPIA DO SEDIMENTO <br/>
												
			<table>
												
				<tr>
					<td>CÉLULAS EPITELIAIS:</td>
					<td>' . $_POST['celulas_epiteliais'] . '.</td> 
				</tr>
														
				<tr>
					<td>PIÓCITOS:</td> 
					<td>' . $_POST['piocitos'] . '.</td> 
				</tr>
														
				<tr>
					<td>HEMÁCIAS:</td> 
					<td>' . $_POST['hemacias'] . '.</td> 
				</tr>
														
				<tr>
					<td>BACTÉRIAS :</td> 
					<td>' . $_POST['bacterias'] . '.</td>
				</tr>
			</table>
		</p>';
	}

	// TAP - TEMPO DE TROMPLOSPATIA ATIVADA
	if( isset($_POST['tap']) ) {
	
		$pagina_html .= '<p> Tempo e Atividade de Protrombina (TP):   																<br/><br/>
			TEMPO (plasma paciente): ' . $_POST['tap'] . ' segundos. <span class="fontemenor">(valor normal: 10 a 14 segundos)		<br/>
			RNI: ' . $_POST['rni'].'. <span class="fontemenor">TEMPO/ATIVIDADE (plasma controle do dia): 12 segundos/100%.</span>	<br/>
		</p>';
	}

	if( isset($_POST['ttpa']) ) {
	
		$pagina_html .= '<p>
			TEMPO TROMBOPLASTINA PARCIAL ATIVADA : ' . $_POST['ttpa'] .' SEGUNDOS.
			<div class="fontemenor">
				MÉTODO: COAGULOMETRICO.                           <br/>
				AMOSTRA:CITRATO.                                  <br/>
				VALOOR DE REFEÊNCIA: (2 MESES) 26 A 47 SEGUNDOS.  <br/>
				(5 MESES) 26 A 46.                                <br/>  
				(APARTIR DE 6 MESES E ADULTOS) 27 A 38.           <br/>
			</div>
		</p>';
	}

	// TESTE ZIKA
	if( isset($_POST['zika_igc']) ) {
		
		// esse if representa o TESTE RAPIDO ZIKA
		$pagina_html .= '<p class="centralizar">TESTE RÁPIDO QUALITATIVO PARA ZIKA</p>
		<p>
			ZIKA IgG: ' . $_POST['zika_igc'] . '. <br/>
			<div class="fontemenor">	
				VALOR DE REFERÊNCIA:  NEGATIVO.
			</div>	
		</p>
		
		<p>
			ZIKA IgM: ' . $_POST['zika_igm'] . '. <br/>
			<div class="fontemenor">	
				VALOR DE REFERÊNCIA:  NEGATIVO.
			</div>	
		</p>';
	}

	// TGO
	if( isset($_POST['tgo']) ) {
	
		$pagina_html .= '<p>
			TGO: '. $_POST['tgo'] .' U/mL. <br/>
			<div class="fontemenor">	
				VALOR DE REFERÊNCIA :04  A 36 UNIDADES/mL. <br/>
				MÉTODO: CINÉTICO - UV.
			</div>	
		</p>';
	}

	// TGP
	if( isset($_POST['tgp']) ) {
	
		$pagina_html .= '<p>
			TGP: '. $_POST['tgp'] .' U/mL. <br/>
			<div class="fontemenor">	
				VALOR DE REFERÊNCIA :04  A 32 UNIDADES/mL. <br/>
				MÉTODO: CINÉTICO - UV.
			</div>	
		</p>';
	}

	// TRIGUICERIDES
	if( isset($_POST['triguicerides']) ) {
	
		$pagina_html .= '<p>
									
		TRIGLICERIDES: '. $_POST['triguicerides'] .' mg/dL.               <br/>      
		<div class="fontemenor">	
			MÉTODO: ENZIMÁTICO-COLORIMÉTRICO.                             <br/>                                
			VALORES DE REFERENCIA:										  <br/>				
			MENOR QUE 10 ANOS: MENOR OU IGUAL A 100 mg/dL: DESEJAVEL.     <br/>
			MAIOR QUE 100 mg/dL       : AUMENTADO.                        <br/>
			10 A 19 ANOS     : MENOR OU IGUAL A 130 mg/dL: DESEJAVEL.     <br/>
			MAIOR QUE 130 mg/dL       : AUMENTADO.                        <br/>
			ADULTOS          : MENOR QUE 150 mg/dL       : OTIMO.         <br/> 
			150 A 200 mg/dL           : LIMITROFE.						  <br/>			
			201 A 499 mg/dL           : ALTO.                             <br/>
			MAIOR OU IGUAL A 500 mg/dL: MUITO ALTO.                       <br/>
		</div>
		</p>';
	}

	// TROPONINA
	if( isset($_POST['troponina']) ) {
	
		$pagina_html .= '<p>
			TROPONINA....................' . $_POST['troponina'] . '. <br/>
			<div class="fontemenor">
				VALOR DE REFERÊNCIA:  NEGATIVO. <br/>
			</div>
		</p>';
	}

	// UREIA
	if( isset($_POST['ureia']) ) {
	
		$pagina_html .= '<p>
		URÉIA: ' . $_POST['ureia'] . '  mg/dL.      <br/>
			<div class="fontemenor">
				VALOR DE REFERÊNCIA : 15 A 40 MG/DL.	<br/>
				MÉTODO: ENZIMÁTICO-UV.					<br/>
			</div>
		</p>';
	}

	// VDRL
	if( isset($_POST['vdrl']) ) {
	
		$pagina_html .= '<p>
		V.D.R.L <br/>';
		if($_POST['vdrl'] == 'NÃO REAGENTE') {

			$pagina_html .= 'RESULTADO: ' . $_POST['vdrl'] . '.';
	}	
	
	else {
			
		$pagina_html .= 'RESULTADO: ' . $_POST['valor'] . '.';
	}
												
	$pagina_html .= ' <div class="fontemenor" font="bold">
		NOTA: O RESULTADO LABORATORIAL INDICA O ESTADO SOROLOGICO DO INDIVIDUO
		E DEVE SER ASSOCIADO A S	UA HISTORIA CLINICA E/OU EPIDEMIOLOGICA.
	</div>
	</p>';
 } // de onde é essa chave gente ???

	// VHS
	if( isset($_POST['vhs']) ) {
	
		$pagina_html .= '<p>
			VHS(Velocidade de Hemossedimentação): ' . $_POST['vhs'] . ' mm na 1ªhora.   
			<div class="fontemenor">
				MÉTODO : WINTROBE. <br/>
				VALOR DE REFERÊNCIA: <br/>  
				HOMEM(1ª HORA) ATÉ 15 mm. <br/>   
				MULHER (1ª HORA) ATÉ 20 mm.  <br/>
				CRIANÇA(1ª HORA) ATÉ 20 mm.    <br/>
			</div>
		</p>';
	}

	// COLESTEROL HDL
	if( isset($_POST['colesterol_hdl']) ) {
	
		$pagina_html .= '<p>
										
			COLESTEROL - HDL : '. $_POST['colesterol_hdl'] .' mg/dL.										<br/>
			<div class="fontemenor">	
				AMOSTRA: SORO.																					<br/>
				METODO: COLORIMÉTRICO ENZIMATICO HOMOGENEO.														<br/><br/>
				VALORES DE REFERENCIA:																			<br/>
				0 A 2 ANOS:																						<br/>		
				&emsp;Não existem valores de referência estabelecidos para essa faixa etária. <br/>
				2 A 19 ANOS:																					<br/>
				&emsp;Com jejum: Inferior a 45 mg/dL. Sem jejum: Inferior a 45 mg/dL.         <br/>
				SUPERIOR A 19 ANOS:                  															<br/>			
				&emsp;Com jejum: Inferior a 40 mg/dl. Sem jejum: Inferior a 40 mg/dL.         <br/>		
			</div>
		</p>';
	}

	// COLESTEROL VLDL
	if( isset($_POST['colesterol_vldl']) ) {
	
		$pagina_html .= '<p>
										
			COLESTEROL - VLDL: '. $_POST['colesterol_vldl'] .' mg/dL.										<br/>
			<div class="fontemenor">	
				AMOSTRA: SORO.																					<br/>
				MÉTODO: CÁLCULO.                     													   <br/><br/>
				VALOR DE REFERÊNCIA:																			<br/>
				&nbsp;&nbsp;&nbsp;&nbsp; Para o teste realizado não dispomos de valor de referência, ficando a critério do médico solicitante sua interpretação. <br/><br/>
				NOTA:        																					          <br/>
				- Segundo o novo Consenso Brasileiro, não ha  mais valores de referência para a fraçãoVLDL do colesterol. <br/>
				- A interpretação clínica dos resultados devera levar em consideração o motivo da indicação do exame, o estado metabólico do paciente e estratificação do risco para estabelecimento das  <br/>
				metas terapêuticas.                                                                                       <br/>
				- VLDL calculado a partir da Formula de Martin.
			</div>
		</p>';
	}

	// SÓDIO SÉRICO
	if( isset($_POST['sodio_serico']) ) {
	
		$pagina_html .= '<p>
										
			SÓDIO SÉRICO: '. $_POST['sodio_serico'] .' mEq/L. <br/>
			<div class="fontemenor">	
				AMOSTRA: SORO.							      <br/>
				MÉTODO: ELETRODO SELETIVO DE ÍONS (ISE).      <br/><br/>
				VALOR DE REFERÊNCIA: 136,0 a 145,0 mEq/L.
			</div>
		</p>';
	}

	// POTASSIO
	if( isset($_POST['potassio']) ) {
	
		$pagina_html .= '<p>
										
			POTÁSSIO: '. $_POST['potassio'] .' mEq/L.         <br/>
			<div class="fontemenor">	
				AMOSTRA: SORO.							      <br/>
				MÉTODO: ELETRODO SELETIVO DE ÍONS (ISE).      <br/><br/>
				VALOR DE REFERÊNCIA: 3,9 a 5,1 mEq/L.
			</div>
		</p>';
	}

	// CLORO
	if( isset($_POST['cloro']) ) {
	
		$pagina_html .= '<p>
										
			CLORO: '. $_POST['cloro'] .' mEq/L.          <br/>
				<div class="fontemenor">	
					AMOSTRA: SORO.							 <br/>
					MÉTODO: ELETRODO SELETIVO/AUTOMATIZADO.  <br/><br/>
					VALOR DE REFERÊNCIA: 98,0 a 107,0 mEq/L.
			</div>
		</p>';
	}

	// CALCIO
	if( isset($_POST['calcio']) ) {
	
		$pagina_html .= '<p>
										
			CÁLCIO: '. $_POST['calcio'] .' mg/dL.        <br/>
			<div class="fontemenor">	
				AMOSTRA: SORO.							 <br/>
				MÉTODO: COLORIMÉTRICO.                   <br/><br/>
				VALOR DE REFERÊNCIA:                     <br/>
				ADULTO:   8,4 a 10,2 mg/dL.			     <br/>
				CRIANÇAS: 8,8 a 10,8 mg/dL.			     <br/>	
			</div>
		</p>';
	}

	// FÉRRO SÉRICO
	if( isset($_POST['ferro_serico']) ) {
	
		$pagina_html .= '<p>
										
			FÉRRO SÉRICO: '. $_POST['ferro_serico'] .' ug/dL. <br/>
			<div class="fontemenor">	
				AMOSTRA: SORO.								  <br/>
				MÉTODO: COLORIMÉTRICO.						  <br/><br/>
				VALOR DE REFERÊNCIA: 35,0 a 150,0 ug/dL.	  <br/>
			</div>
		</p>';
	}

	// FÓSFORO
	if( isset($_POST['fosforo']) ) {
	
		$pagina_html .= '<p>
										
			FÓSFORO: '. $_POST['fosforo'] .' mg/dL. <br/>
			<div class="fontemenor">	
				AMOSTRA: SORO.							 <br/>
				MÉTODO: MOLIBDATO UV.					 <br/><br/>
				VALOR DE REFERÊNCIA:				     <br/>
				ADULTO:  2,5 a 4,5 mg/dL.                <br/>
				CRIANÇA: 4,0 a 7,0 mg/dL.                <br/>
			</div>
		</p>';
	}

	// GAMA GLUTAMIL TRANSFERASE
	if( isset($_POST['ggt']) ) {
	
		$pagina_html .= '<p>
										
			Gama Glutamil Transferase: '. $_POST['ggt'] .' U/L.
			<div class="fontemenor">	
				AMOSTRA: SORO.					<br/>
				MÉTODO: CINÉTICO COLORIMÉTRICO.	<br/><br/>
				VALOR DE REFERÊNCIA:			<br/>
				Homens:   até 60,0 U/L.         <br/>
				Mulheres: até 43,0 U/L.         <br/>
			</div>
		</p>';
	}

	// PROTEINAS TOTAIS E FRAÇÕES.
	if( isset($_POST['proteina_total']) ) {
	
		$pagina_html .= '<p>
										
			<div class="text-center">PROTEÍNAS TOTAIS E FRAÇÕES.</div>                                      	
			Proteína Total...: '   . $_POST['proteina_total'] .' g/dL. <br/>
			Albumina..........: '  . $_POST['albumina']       .'  g/dL. <br/>
			Globulina..........: ' . $_POST['globulina']      .'  g/dL. <br/>
			Relação A/G.....: '    . $_POST['relacao_a_g']    .'  g/dL. <br/>
			<div class="fontemenor">	
				AMOSTRA: Soro.		             <br/>
				MÉTODO: Colorimétrico/Calculado. <br/><br/>
				Valor De Referência:             <br/>
				<span style="font-weight: bold"> Proteínas Totais: </span> <br/>
					&emsp; 5,7 a 8,2 g/dL.						           <br/>
				<span style="font-weight: bold"> Albumina: </span>         <br/>
					&emsp; 3,2 a 4,8 g/dL.                                 <br/>
				<span style="font-weight: bold"> Globulinas: </span>       <br/>
					&emsp; 2,0 a 4,1 g/dL. Relação A/G: > 1.0.
			</div>
		</p>';	
	}

	// AMILASE TOTAL
	if( isset($_POST['amilase_total']) ) {
	
		$pagina_html .= '<p>
										
			Amilase Total: '. $_POST['amilase_total'] .' U/L.
			
			<div class="fontemenor">	
				Amostra: Soro.					   <br/>
				Método:  Colorímetrico Enzimático. <br/><br/>
				Valor de Referência:			   <br/>
				&emsp; Inferior a 60,0 U/L.	
			</div>
		</p>';
	}

	// LIPASE
	if( isset($_POST['lipase']) ) {
	
		$pagina_html .= '<p>
										
			Lipase: '. $_POST['lipase'] .' U/L.
			
			<div class="fontemenor">	
				Amostra: Soro.					   <br/>
				Método:  Colorímetrico Enzimático. <br/><br/>
				Valor de Referência:			   <br/>
				&emsp; Inferior a 60,0 U/L.	
			</div>
		</p>';
	}

	// PROTEINAS TOTAIS E FRAÇÕES.
	if( isset($_POST['bilirrubina_direta']) ) {
	
		
		$pagina_html .= '<p>
										
			<div class="text-center">Bilirrubinas Totais e Frações.</div>                                      	
			Bilirrubina Direta......: ' . $_POST['bilirrubina_direta']   .' mg/dL. <br/>
			Bilirrubina Indireta...: '  . $_POST['bilirrubina_indireta'] .' mg/dL. <br/>
			Bilirrubina Total.......: ' . $_POST['bilirrubina_total']    .' mg/dL. <br/>
			<div class="fontemenor">	
				Amostra: SORO.		    <br/>
				Método:  COLORIMÉTRICO. <br/><br/>
				Valores de Referência:  <br/>
				<span style="font-weight: bold"> Bilirrubina Direta:  </span>  <br/>
				&emsp;Adultos:  0,0 - 0,3 mg/dL.					           <br/>
				&emsp;Neonatos: 0,0 - 0,6 mg/dL.                               <br/>
				<span style="font-weight: bold"> Bilirrubina Indireta: </span> <br/>
				&emsp;Adultos:  0,0 - 1,1 mg/dL.                               <br/>
				&emsp;Neonatos: 0,6 - 10,5 mg/dL.                              <br/>
				<span style="font-weight: bold"> Bilirrubina Total:    </span> <br/>
				&emsp;0,2 - 1,3 mg/dL.
			</div>
		</p>';
		
	}

	$nome_bioquimico = $_POST['nomebioquimico'];

	$pagina_html .=	'<div id="assinatura" class="centralizar" >
	<hr/>
	<img src="assinaturas/' . $nome_bioquimico . '.jpg">
	</div>
	</div>
	</body>
	</html>';

	echo $pagina_html;
		
	$array = serialize($_POST); // 1 - transforma o array em uma string
	$array = urlencode($array); // 2 - codifica a string para ser usada no link

	//$string_array = implode("|", $_POST);

	// ARMAZENAR EXAME
	echo '<a id="link" href="exame_armazenar.php?array=' . $array . ' " class="btn-sm border m-1 bg-light"> Enviar relatório para análise</a></td>';
	
	// CORRIGIR
	echo '<a id="link" href="exame_corrigir.php?array=' . $array . ' " class="btn-sm border m-1 bg-light" > Corrigir</a></td>';
?>	

<script src="exame_verificar.js" ></script>

<?php		

	}//#verificação de sessão
			
	// Insert the page footer
	require_once('rodape.php');
	//print_r ($_POST);	
?>