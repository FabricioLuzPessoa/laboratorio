<?php

	/*
	- Está página recebe um array com nomes dos exames a serem criados, adiciona valor a esses exames e passa para página exame_verificar.php
	- $_POST['exame'] = [acido_urico, aslor,...] <-> esse array vem da página paciente.php.
	- Crio um novo array com chave/valor. 
	- Recebe isso:  $_POST['exame'] = (acido_urico, aslor,...)  
	- Envia isso:   $_POST[ (acido_urico) -> 30, (aslo)-> 20];
	*/
		 
	// inclusão do template para inicio da sessão
	require_once('startsession.php');
		
	// inclusão do template cabeçalho
	$page_title = 'Insira as informações necessárias para a criação do(s) relatório(s)';
	require_once('header.php');
		
	//inclusão do template barra de navegação
	require_once('barranavegacao.php');
		
	require_once('variaveis.php');
	require_once('conexao.php');

	//print_r ($_POST);
		
	// Verifica se a variavel de sessão foi criada. Se a variavel de sessão ainda não foi criada. nenhum código será exibido.
	if (isset($_SESSION['usuario_id'])) {

		// CRIEI UM ARRAY DE SESSÃO PARA ARZEMANAR OS EXAMES QUE VOU USAR PARA CORRIGIR.
		$_SESSION['array_exames'] = $_POST['exame'];
		
		
		// Faço um laço para percorrer o array vindo da pagina paciente para criar um formulário para o funcionário preencher os dados do exame.
		for($i = 0; $i < count( $_POST['exame'] ); $i++) {
																	
			$teste =  $_POST['exame'][$i];
?>					

<!-- ENVIA DADOS DO FORMULÁRIO  -->			
<form method="post" action = "exame_verificar.php">

<!-- ÁCIDO ÚRICO -->
<?php					
	if($teste == 'acido_urico') {
?>
<table>
	<legend class="text-primary h6">Informe os valores para o exame Ácido Úrico:</legend>
	<tr>
		<td >Ácido Úrico:</td>
		<td><input type="text" id="acido_urico" name="acido_urico"/></td> <!-- chave: acido_urico. valor= 30 / acido_urico = 30 -->
	</tr>
</table>

<!-- ASLO -->					
<?php					
	}else if($teste == 'aslo') {
?>
<table>
	<legend class="h6 text-primary">informe os valores do exame ASLO:</legend>
	<tr>
		<td>ASLO:</td>
		<td><input type="text" id="aslo" name="aslo"/></td>
	</tr>
</table>

<!-- BETA HCG -->
<?php						
	} else if($teste == 'beta_hcg') {
?>						
<table class="">
	<legend class="h6 text-primary">informe os valores do exame BETA HCG:</legend>
	<tr>
		<td>BETA HCG:</td>	
		<td><input type="radio" name="beta_hcg" value="NEGATIVO"  checked  >NEGATIVO</input> </td>
		<td><input type="radio" name="beta_hcg" value="POSITIVO"           >POSITIVO</input><br/> </td>
	</tr>
</table>

<!-- CKMB -->
<?php
	} else if($teste == 'ckmb') {
?>						
<table>
	<legend class="h6 text-primary">informe os valores do exame CKMB:</legend>
	<tr class="">
		<td>CKMB:</td>
		<td><input type="text" id="ckmb" name="ckmb" /></td>
	</tr>
</table>

<!-- CK TOTAL -->
<?php
	} else if($teste == 'ck_total') {
?>						
<table class="">
	<legend class="h6 text-primary">informe os valores do exame CK TOTAL:</legend>
	<tr>
		<td>CK TOTAL:</td>
		<td><input type="text" id="ck_total" name="ck_total" /></td>
	</tr>
</table>

<!-- COAGULOGRAMA -->
<?php
	}  else if($teste == 'coagulograma') {
?>						
<table class="">
	<legend class="h6 text-primary">informe os valores do exame TS:</legend>
	<tr>
		<td>TS:</td>
		<td><input type="text" id="ts" name="ts"/></td>
	</tr>
	
	<tr>
		<td>TC:</td>
		<td><input type="text" id="tc" name="tc"/></td>
	</tr>
</table>

<!-- COLESTEROL TOTAL -->
<?php
	} else if($teste == 'colesterol_total') {
?>						
<table class="">
	<legend class="h6 text-primary">informe os valores do exame Colesterol:</legend>
	<tr>
		<td>Colesterol:</td>
		<td><input type="text" id="colesterol_total" name="colesterol_total" /></td>
	</tr>
</table>

<!-- CREATINA -->
<?php
	} else if($teste == 'creatinina') {
?>						
<table class="">
	<legend class="h6 text-primary">informe os valores do exame Creatina:</legend>
	<tr>
		<td>Creatinina:</td>
		<td><input type="text" id="creatinina" name="creatinina" /></td>
	</tr>
</table>

<!-- HEMATÓCRITO -->
<?php
	}   else if($teste == 'hematocritoe') {
?>						
<table class="">
	<legend class="h6 text-primary">informe os valores do exame Hematócrito:</legend>
	<tr>
		<td>Hematócrito (%):</td>
		<td><input type="text" id="hematocritoe" name="hematocritoe"/></td>
	</tr>
</table>

<!-- HEMOGLOBINA -->
<?php
	} else if($teste == 'hemoglobinae') {
?>						
<table class="">
	<legend class="h6 text-primary">informe os valores do exame Hemoglobina:</legend>
	<tr>
		<td>Hemoglobina (g%):</td>
		<td><input type="text" id="hemoglobinae" name="hemoglobinae"/></td>
	</tr>
</table>

<!-- FATOR REUMATÓIDE -->
<?php
	} else if($teste == 'fator_r') {
?>						
<table class="">
	<legend class="h6 text-primary">informe os valores do exame Fator Reumatóide:</legend>
	<tr>
		<td>FR (Fator Reumatóide):</td>
		<td><input type="text" id="fator_r" name="fator_r"/></td>
	</tr>
</table>

<!-- FEZES -->
<?php
	} else if($teste == 'fezes') {
?>						
<table class="">
	<legend class="h6 text-primary">informe os valores do exame Helminstoscopia:</legend>
	<tr>
		<td>Helmintoscopia:</td>
		<td><input type="radio" id="amostra_helmintoscopia" name="amostra_helmintoscopia" value="NEGATIVO"  checked  > Negativo </input></td>
		<td><input type="radio" id="amostra_helmintoscopia" name="amostra_helmintoscopia" value="POSITIVO"           > Positivo: </input><br/></td>
		<td><input type="text" id="obs1" name="obs1"/></td>
	</tr>

	<tr>
		<td>Protozooscopia:</td>
		<td><input type="radio" name="amostra_protozooscopia" value="NEGATIVO" checked  > Negativo  </input></td>
		<td><input type="radio" name="amostra_protozooscopia" value="POSITIVO"          > Positivo: </input></td>
		<td><input type="text" id="obs2" name="obs2" /></td>
	</tr>
</table>

<!-- FEZES 3 AMOSTRAS -->
<?php
	} else if($teste == 'fezes_3_amostras') {
?>						
<table class="">
	<legend class="h6 text-primary">informe os valores do exame Fezes 3 Amostras:</legend>
	<tr>
		<td>1ª Amostra:</td>
	</tr>

	<tr>
		<td>Helmintoscopia:</td>
		<td><input type="radio" name="amostra_1_helmintoscopia" value="NEGATIVO"  checked  >Negativo</input></td>
		<td><input type="radio" name="amostra_1_helmintoscopia" value="POSITIVO" >Positivo</input><br/></td>
		<td><input type="text" id="helmintoscopia_1_positivo" name="helmintoscopia_1_positivo"/></td>
	</tr>

	<tr>
		<td>Protozooscopia:</td>
		<td><input type="radio" name="amostra_1_protozooscopia" value="NEGATIVO" checked  >Negativo</input></td>
		<td><input type="radio" name="amostra_1_protozooscopia" value="POSITIVO" >Positivo</input></td>
		<td><input type="text" id="protozooscopia_1_positivo" name="protozooscopia_1_positivo"/></td>
	</tr>

	<tr>
		<td>2ª Amostra:</td>
	</tr>

	<tr>
		<td>Helmintoscopia:</td>
		<td><input type="radio" name="amostra_2_helmintoscopia" value="NEGATIVO"  checked  >Negativo</input></td>
		<td><input type="radio" name="amostra_2_helmintoscopia" value="POSITIVO" >Positivo</input><br/></td>
		<td><input type="text" id="helmintoscopia_2_positivo" name="helmintoscopia_2_positivo"/></td>
	</tr>

	<tr>
		<td>Protozooscopia:</td>
		<td><input type="radio" name="amostra_2_protozooscopia" value="NEGATIVO" checked  >Negativo</input></td>
		<td><input type="radio" name="amostra_2_protozooscopia" value="POSITIVO" >Positivo</input></td>
		<td><input type="text" id="protozooscopia_2_positivo" name="protozooscopia_2_positivo"/></td>
	</tr>

	<tr>
		<td>3ª Amostra:</td>
	</tr>

	<tr>
		<td>Helmintoscopia:</td>
		<td><input type="radio" name="amostra_3_helmintoscopia" value="NEGATIVO"  checked  >Negativo</input></td>
		<td><input type="radio" name="amostra_3_helmintoscopia" value="POSITIVO" >Positivo</input><br/></td>
		<td><input type="text" id="helmintoscopia_3_positivo" name="helmintoscopia_3_positivo"/></td>
	</tr>
	
	<tr>
		<td>Protozooscopia:</td>
		<td><input type="radio" name="amostra_3_protozooscopia" value="NEGATIVO" checked  >Negativo</input></td>
		<td><input type="radio" name="amostra_3_protozooscopia" value="POSITIVO" >Positivo</input></td>
		<td><input type="text" id="protozooscopia_3_positivo" name="protozooscopia_3_positivo"/></td>
	</tr>
</table>

<!-- FOSFATASE ALCALINA -->
<?php
	} else if($teste == 'fostafase_alcalina') {
?>						
<table class="">
	<legend class="h6 text-primary">informe os valores do exame Fostafase Alcalina:</legend>
	<tr>
		<td>Fostafase Alcalina:</td>
		<td><input type="text" id="fostafase_alcalina" name="fostafase_alcalina"/></td>
	</tr>
</table>

<!-- GLICEMIA EM JEJUM -->
<?php
	}  else if($teste == 'glicemia_jejum') {
?>						
<table class="">
	<legend class="h6 text-primary">informe os valores do exame Glicemia em Jejum:</legend>
	<tr>
		<td>Glicemia em Jejum:</td>
		<td><input type="text" id="glicemia_jejum" name="glicemia_jejum" /></td>
	</tr>
</table>

<!-- GLICEMIA PÓS-PRANDIAL -->
<?php
	} else if($teste == 'glicemia_pos_prandial') {
?>						
<table class="">
	<legend class="h6 text-primary">informe os valores do exame Pós-Prandial:</legend>
	<tr>
		<td>Glicemia Pós-Prandial:</td>
		<td><input type="text" id="glicemia_pos_prandial" name="glicemia_pos_prandial" /></td>
	</tr>
</table>

<!-- GAMA GT -->
<?php
	}  else if($teste == 'gama_gt') {
?>						
<table class="">
	<legend class="h6 text-primary">informe os valores do exame Gama GT:</legend>
	<tr>
		<td>GAMA GT:</td>
		<td><input type="text" id="gama_gt" name="gama_gt"  /></td>
	</tr>
</table>

<!-- GLICOSE -->
<?php
	} else if($teste == 'glicose') {
?>						
<table class="">
	<legend class="h6 text-primary">informe os valores do exame Glicose:</legend>
	<tr>
		<td>Glicose:</td>
		<td><input type="text" id="glicose" name="glicose" /></td>
	</tr>
</table>

<!-- GRUPO SANGUÍNEO -->
<?php
	} else if($teste == 'grupo_sanguineo') {
?>						
<table class="">
	<legend class="h6 text-primary">informe os valores do exame Grupo Sanguíneo:</legend>
	<tr>
		<td>Grupo Sanguíneo:</td>
		<td><input type="radio" id="grupo_sanguineo" name="grupo_sanguineo" value="A" checked>A</input></td>
		<td><input type="radio" id="grupo_sanguineo" name="grupo_sanguineo" value="AB">AB</input></td>
		<td><input type="radio" id="grupo_sanguineo" name="grupo_sanguineo" value="B">B</input></td>
		<td><input type="radio" id="grupo_sanguineo" name="grupo_sanguineo" value="O">O</input></td>
	</tr>
		
	<tr>
		<td>Fator RH:</td>
		<td><input type="radio" id="frh" name="frh" value="NEGATIVO" checked > NEGATIVO </input></td>
		<td><input type="radio" id="trh" name="frh" value="POSITIVO"         > POSITIVO </input></td>
	</tr>
</table>

<!-- HEMOGRAMA -->
<?php
	} else if($teste == 'hemograma') {
?>						
<table class="">
	<legend class="h6 text-primary">informe os valores do exame Hemograma:</legend>
	<tr>
		<th>Eritrograma:</th>
	</tr>

	<tr>
		<td>Hematócrito(%):</td>
		<td><input type="text" id="hematocrito" name="hematocrito" /></td>
		<td >Hemácias(milhões/mm³):</td>
		<td><input type="text" id="hemacias" name="hemacias" /></td>	
	</tr>

	<tr>
		<td>Hemoglobina(g%):</td>
		<td><input type="text" id="hemoglobina" name="hemoglobina" /></td>
		<td >RDW:</td>
		<td><input type="text" id="rdw" name="rdw" /></td>	
	</tr>		

	<tr>
		<th>Leucograma:</th>
	</tr>
	<tr>
		<td>Leucócitos:</td>
		<td><input type="text" id="leucocitos" name="leucocitos"/></td>
		<td></td>
		<td></td>
	</tr>
	
	<tr> 
		<td>Basófilos:</td>
		<td><input type="text" id="basofilos_relativo" name="basofilos_relativo"/></td>
		<td>Bastonetes:</td>
		<td><input type="text" id="bastonetes_relativo" name="bastonetes_relativo"/></td>
	</tr>
	
	<tr>	
		<td>Eosinófilos:</td>
		<td><input type="text" id="eosinofilos_relativo" name="eosinofilos_relativo"/></td>
		<td>Segmentados:</td>
		<td><input type="text" id="segmentados_relativo" name="segmentados_relativo"/></td>
	</tr>
	
	<tr>	
		<td>Mielócitos:</td>
		<td><input type="text" id="mielocitos_relativo" name="mielocitos_relativo"/></td>
		<td>Linfócitos:</td>
		<td><input type="text" id="linfocitos_relativo" name="linfocitos_relativo"/></td>
	</tr>
	
	<tr>	
		<td>Metamielócitos:</td>
		<td><input type="text" id="metamielocitos_relativo" name="metamielocitos_relativo"/></td>
		<td>Monocítos:</td>
		<td><input type="text" id="monocitos_relativo" name="monocitos_relativo"/></td>
	</tr>
	
	<tr>	
		<td>Plaquetas:</td>
		<td><input type="text" id="plaquetas" name="plaquetas"></td>
	</tr>
</table>

<!-- PCR (PROTEÍNA C REATIVA) -->
<?php
	} else if($teste == 'pcr') {
?>						
<table class="">
	<legend class="h6 text-primary">informe os valores do exame PCR:</legend>
	<tr>
		<td>PCR (Proteína C Reativa)</td>
		<td><input type="text" id="pcr" name="pcr" ></td>
	</tr>
</table>

<!-- SUMARIO DE URINA -->
<?php
	} else if($teste == 'sumario_urina') {
?>						
<table class="border-2 border-bottom border-success">
	<legend class="h6 text-primary">informe os valores do exame Exame Físico:</legend>
	<tr>
		<th>Exame Físico:</th>
	</tr>
	
	<tr>
		<td>Volume (ml):</td>
		<td><input type="text" id="volume" name="volume"/></td>
		<td>Densidade:</td>
		<td><input type="text" id="densidade" name="densidade"/></td>
	</tr>
	
	<tr>
		<td>Cor:</td>
		<td><input type="text" id="cor" name="cor"/></td>
		<td>Aspecto:</td>
		<td><input type="text" id="aspecto" name="aspecto"/></td>
	</tr>
	
	<tr>
		<td>pH - Reação:</td>
		<td><input type="text" id="ph_reacao" name="ph_reacao"/></td>
	</tr>

	<tr>
		<th>Exame Químico:</th>
	</tr>
	
	<tr>
		<td>Proteinas:</td>
		<td><input type="text" id="proteinas" name="proteinas" value="AUSENTE"/></td>
		<td>Hemoglobina:</td>
		<td><input type="text" id="hemoglobina" name="hemoglobina" value="AUSENTE"/></td>
	</tr>
	
	<tr>
		<td>Glicose:</td>
		<td><input type="text" id="glicosex" name="glicosex" value="AUSENTE"/></td>
		<td>Cetona:</td>
		<td><input type="text" id="cetona" name="cetona" value="AUSENTE"/></td>
	</tr>
	
	<tr>
		<td>Bilirrubinas:</td>
		<td><input type="text" id="bilirrubinas" name="bilirrubinas" value="AUSENTE"/></td>
		<td>Urobilinogênio:</td>
		<td><input type="text" id="urobilinogenio" name="urobilinogenio" value="VESTÍGIOS"/></td>
	</tr>
	
	<tr>
		<td>Nitrito:</td>
		<td><input type="text" id="nitrito" name="nitrito" value="NEGATIVO"/></td>
	</tr>
	
	<tr>
		<td>Microscopia do Sedimento:</td>
	</tr>	

	<tr>
		<td>Células Epiteliais</td>
		<td><input type="text" id="celulas_epiteliais" name="celulas_epiteliais" value="ALGUMAS"/></td>
	</tr>
	
	<tr>
		<td>Piócitos</td>
		<td><input type="text" id="piocitos" name="piocitos" value="02 P/ CAMPO EM MÉDIA" /></td>
	</tr>
	
	<tr>
		<td>Hemácias</td>
		<td><input type="text" id="hemacias" name="hemacias" value="05 P/ CAMPO EM MÉDIA"/></td>
	</tr>
	
	<tr>
		<td>Bactérias</td>
		<td><input type="text" id="bacterias" name="bacterias" value="VARIAS" /></td>
	</tr>
</table>

<!-- TAP -->
<?php
	} else if($teste == 'tap') {
?>						
<table class="">
	
	<tr>
		<td>Tempo (Plasma paciente):</td>
		<td><input type="text" id="tap" name="tap"/></td>
	</tr>
	<tr>
		<td>RNI:</td>
		<td><input type="text" id="rni" name="rni"/></td>
	</tr>
</table>

<!-- TTPA - TEMPO TROMBOPLASTINA PARCIAL ATIVADA -->
<?php
	}else if($teste == 'ttpa') {
?>						
<table class="">
	<tr>
		<td>TTPA (Tempo Tromboplastina Parcial Ativada):</td>
		<td><input type="text" id="ttpa" name="ttpa"/></td>
	</tr>
</table>

<!-- TESTE RAPIDO ZIKA -->
<?php
	} else if($teste == 'teste_rapido_zika') {
?>						
<table class="">
	<tr>
		<td>ZIKA IgC:</td>
		<td><input type="radio" name="zika_igc" value="NEGATIVO"  checked  >Negativo</input></td>
		<td><input type="radio" name="zika_igc" value="POSITIVO" >Positivo</input><br/></td>
	</tr>
	<tr>
		<td>ZIKA IgM:</td>
		<td><input type="radio" name="zika_igm" value="NEGATIVO"  checked  >Negativo</input></td>
		<td><input type="radio" name="zika_igm" value="POSITIVO" >Positivo</input><br/></td>
	</tr>
</table>

<!-- TGO -->
<?php
	} else if($teste == 'tgo') {
?>						
<table class="">
	<legend class="h6 text-primary">informe os valores do exame TGO:</legend>
	<tr>
		<td>TGO:</td>
		<td><input type="text" id="tgo" name="tgo" /><br/></td>
	</tr>
</table>

<!-- TGP -->
<?php
	} else if($teste == 'tgp') {
?>						
<table class="">
	<legend class="h6 text-primary">informe os valores do exame TGP:</legend>
	<tr>
		<td>TGP:</td>
		<td><input type="text" id="tgp" name="tgp" /><br/></td>
	</tr>
</table>

<!-- TRIGUICERIDES -->
<?php
	} else if($teste == 'triguicerides') {
?>						
<table class="">
	<legend class="h6 text-primary">informe os valores do exame Triguicerides:</legend>
	<tr>
		<td>Triguicerides:</td>
		<td><input type="text" id="triguicerides" name="triguicerides" /></td>
	</tr>
</table>

<!-- TROPONINA -->
<?php
	} else if($teste == 'troponina') {
?>						
<table class="">
	<legend class="h6 text-primary">informe os valores do exame Troponina:</legend>
	<tr>
		<td>Troponina:</td>
		<td><input type="radio" id="troponina" name="troponina" value="NEGATIVO"	 checked>Negativo</input></td>
		<td><input type="radio" id="troponina" name="troponina" value="POSITIVO">Positivo</input> </td>
	</tr>
</table>

<!-- UREIA -->
<?php
	} else if($teste == 'ureia') {
?>						
<table class="">
	<legend class="h6 text-primary">informe os valores do exame Ureia:</legend>
	<tr>
		<td>Ureia:</td>
		<td><input type="text" id="ureia" name="ureia" /></td>
	</tr>
</table>

<!-- VDRL -->
<?php
	} else if($teste == 'vdrl') {
?>						
<table class="">
	<legend class="h6 text-primary">informe os valores do exame VDRL:</legend>
	<tr>
		<td>V.D.R.L:</td>
		<td><input type="radio" id="vdrl" name="vdrl" value="NÃO REAGENTE"  checked  >NÃO REAGENTE</input></td>
		<td><input type="radio" id="vdrl" name="vdrl" value="REAGENTE" >REAGENTE:</input><br/></td>
		<td><input type="text" id="valor" name="valor"/></td>
	</tr>
</table>

<!-- VHS -->
<?php
	} else if($teste == 'vhs') {
?>						
<table>
	<legend class="h6 text-primary">informe os valores do exame VHS:</legend>
	<tr>
		<td>VHS (Velocidade de Hemossedimentação):</td>
		<td><input type="text" id="vhs" name="vhs"/></td>
	</tr>
</table>

<!-- COLESTEROL HDL -->
<?php
	} else if($teste == 'colesterol_hdl') {
?>
<table>
	<legend class="h6 text-primary">informe o valor do exame Colesterol - HDL:</legend>
	<tr>
		<td>Colesterol - HDL: </td>
		<td><input type="text" id="colesterol_hdl" name="colesterol_hdl"/></td>
	</tr>
</table>

<!-- COLESTERO VLDL -->
<?php
	} else if($teste == 'colesterol_vldl') {
?>
<table>
	<legend class="h6 text-primary">informe o valor do exame Colesterol - VLDL:</legend>
	<tr>
		<td>Colesterol - VLDL: </td>
		<td><input type="text" id="colesterol_vldl" name="colesterol_vldl"/></td>
	</tr>
</table>

<!-- SÓDIO SÉRICO -->
<?php
	} else if($teste == 'sodio_serico') {
?>
<table>
	<legend class="h6 text-primary">informe o valor do exame Sódio Sérico:</legend>
	<tr>
		<td>Sódio Sérico: </td>
		<td><input type="text" id="sodio_serico" name="sodio_serico"/></td>
	</tr>
</table>

<!-- POTÁSSIO -->
<?php
	} else if($teste == 'potassio') {
?>
<table>
	<legend class="h6 text-primary">informe o valor do exame Potássio:</legend>
	<tr>
		<td>Potássio: </td>
		<td><input type="text" id="potassio" name="potassio"/></td>
	</tr>
</table>

<!-- CLORO -->
<?php
	} else if($teste == 'cloro') {
?>
<table>
	<legend class="h6 text-primary">informe o valor do exame Cloro:</legend>
	<tr>
		<td>Cloro: </td>
		<td><input type="text" id="cloro" name="cloro"/></td>
	</tr>
</table>

<!-- CALCIO -->
<?php
	} else if($teste == 'calcio') {
?>
<table>
	<legend class="h6 text-primary">informe o valor do exame Cálcio:</legend>
	<tr>
		<td>Cálcio: </td>
		<td><input type="text" id="calcio" name="calcio"/></td>
	</tr>
</table>

<!-- FERRO SÉRICO -->
<?php
	} else if($teste == 'ferro_serico') {
?>
<table>
	<legend class="h6 text-primary">informe o valor do exame Férro Sérico:</legend>
	<tr>
		<td>Férro Sérico: </td>
		<td><input type="text" id="ferro_serico" name="ferro_serico"/></td>
	</tr>
</table>

<!-- FÓSFORO -->
<?php
	} else if($teste == 'fosforo') {
?>
<table>
	<legend class="h6 text-primary">informe o valor do exame Fósforo:</legend>
	<tr>
		<td>Fósforo: </td>
		<td><input type="text" id="fosforo" name="fosforo"/></td>
	</tr>
</table>

<!--GAMA GLUTAMIL TRANSFERASE (GGT)-->
<?php
	} else if($teste == 'ggt') {
?>
<table>
	<legend class="h6 text-primary">informe o valor do exame Gama Glutamil Transferase (GGT):</legend>
	<tr>
		<td>Gama Glutamil Transferase: </td>
		<td><input type="text" id="ggt" name="ggt"/></td>
	</tr>
</table>

<!-- PROTEINAS TOTAIS E FRAÇÕES -->
<?php
	} else if($teste == 'proteinas_totais_e_fracoes') {
?>
<table>
	<legend class="h6 text-primary">informe o valor do exame Proteínas Totais e Frações:</legend>
	<tr>
		<td>Proteína Total: </td>
		<td><input type="text" id="proteina_total" name="proteina_total" class="form-control form-control-sm"/></td>
	</tr>
	<tr>
		<td>Albumina: </td>
		<td><input type="text" id="albumina" name="albumina" class="form-control form-control-sm"/></td>
	</tr>
	<tr>
		<td>Globulina: </td>
		<td><input type="text" id="globulina" name="globulina" class="form-control form-control-sm"/></td>
	</tr>
	<tr>
		<td>Relação A/G: </td>
		<td><input type="text" id="relacao_a_g" name="relacao_a_g" class="form-control form-control-sm"/></td>
	</tr>
</table>

<!--AMILASE TOTAL-->
<?php
	} else if($teste == 'amilase_total') {
?>
<table>
	<legend class="h6 text-primary">informe o valor do exame Amilase Total:</legend>
	<tr>
		<td>Resultado: </td>
		<td><input type="text" id="amilase_total" name="amilase_total"/></td>
	</tr>
</table>

<!--LIPASE-->
<?php
	} else if($teste == 'lipase') {
?>
<table>
	<legend class="h6 text-primary">informe o valor do exame Lipase:</legend>
	<tr>
		<td>Resultado: </td>
		<td><input type="text" id="lipase" name="lipase"/></td>
	</tr>
</table>

<!-- BILIRRUBINAS TOTAIS E FRAÇOES -->
<?php
	} else if($teste == 'bilirrubinas_totais_e_fracoes') {
?>
<table>
	<legend class="h6 text-primary">informe os valores do exame Billirrubinas Totais e Frações:</legend>
	<tr>
		<td>Bilirrubina Direta: </td>
		<td><input type="text" id="bilirrubina_direta" name="bilirrubina_direta" class="form-control form-control-sm"/></td>
	</tr>
	<tr>
		<td>Bilirrubina Indireta: </td>
		<td><input type="text" id="bilirrubina_indireta" name="bilirrubina_indireta" class="form-control form-control-sm"/></td>
	</tr>
	<tr>
		<td>Bilirrubina Total: </td>
		<td><input type="text" id="bilirrubina_total" name="bilirrubina_total" class="form-control form-control-sm"/></td>
	</tr>
</table>

<?php
		}//#ultimo else if
	} //#if for
?>

<table class="table w-auto table-borderless">
	<tr>
		<td>
			<span style="font-weight: bold;"> Selecione o Bioquímico: </span>	
		</td>
	
		<td>
			<select id="nomebioquimico" name="nomebioquimico" class="form-control form-control-sm">
				
				<option value='hernandoluis'>Hernando Luis               </option>
				<option value='joaocarlos'  >João Carlos                 </option>
				<option value='marlonsouza' >Marlon Souza Silva          </option>
				<option value='rafaelameira'>Rafaela Ramona Meira Azevedo</option>
				<option value='valneisilva' >Valnei Silva Lima Júnior    </option>
			</select>
		</td>
	</tr>

	<tr>
		<td>
			<span style="font-weight: bold;">Solicitante:</span>
		</td>
		
		<td>
			<input type="text" id="solicitante" name="solicitante" class="form-control form-control-sm"/>
		</td>
	</tr>
</table>

<!--botão redireciona a página para a página exame_verificar.php-->
<input type="submit" id="submit" name="submit" value="Vizualizar Relatório" class="btn-sm btn-success" />

</form>

<?php
	} //#if session 
?>

<?php
	// Insert the page footer
	require_once('rodape.php');
?>	