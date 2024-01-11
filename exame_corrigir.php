<?php

	/*
	- $_POST = ( [acido_urico] -> 30 [aslo] -> 20 ). <-> esse array vem da página exame_verificar.php -> Ele vem serializado e codificado
	- Página onde o funcionário recebe as informações do exame e digita no sistema.
	- Recebe um array $_POST['exame'] com referência aos exames que irei criar.
	- Crio um novo array com chave/valor. 
	- Exemplo em caso do funcionario ter preenchido acido_urico e aslo: $_POST[ (acido_urico) -> 30, (aslo)-> 20];
	- Recebe isso: $_POST['exame'] = (acido_urico, aslor,...)  
	- Envia isso:   $_POST[ (acido_urico) -> 30, (aslo)-> 20];
	*/
		 
	// inclusão do template para inicio da sessão
	require_once('startsession.php');
		
	// inclusão do template cabeçalho
	$page_title = 'Insira as informações necessarias para a criacao do(s) relatório(s).';
	require_once('header.php');
		
	//inclusão do template barra de navegação
	require_once('barranavegacao.php');
		
	require_once('variaveis.php');
	require_once('conexao.php');

	// Verifica se a variavel de sessão foi criada. Se a variavel de sess�o ainda n�o foi criada. nenhum c�digo ser� exibido.
	if (isset($_SESSION['usuario_id'])) {

		// Faço um laço para percorrer o array vindo da pagina paciente para criar um formulário para o funcionário preencher os dados do exame.
		for($i = 0; $i < count( $_SESSION['array_exames'] ); $i++) {
																	
			$teste =  $_SESSION['array_exames'][$i];
?>					

<!-- ENVIA DADOS DO FORMULÁRIO  -->			
<form method="post" action = "exame_verificar.php">

<?php					
	if($teste == 'acido_urico') {
?>

<table class="">
	<legend class="text-primary h6">Informe os valores para o exame Acido Urico:</legend>
	<tr>
		<td >Acido Urico:</td>
		<td><input type="text" id="acido_urico" name="acido_urico" value="<?php echo $_SESSION['valores_exames']['acido_urico'];  ?>" /></td> <!-- chave: acido_urico. valor= 30 / acido_urico = 30 -->
	</tr>
</table>
					
<?php					
	}else if($teste == 'aslo') {
?>

<table class="">
	<legend class="h6 text-primary">informe os valores do exame ASLO:</legend>
	<tr>
		<td>ASLO:</td>
		<td><input type="text" id="aslo" name="aslo" value="<?php echo $_SESSION['valores_exames']['aslo'];  ?>"  /></td>
	</tr>
</table>

<?php						
	} else if($teste == 'beta_hcg') {
?>						

<table class="">
	<legend class="h6 text-primary">informe os valores do exame BETA HCG:</legend>
	<tr>
		<td>BETA HCG:</td>	
		<td><input type="radio" name="beta_hcg" value="NEGATIVO"  <?php if($_SESSION['valores_exames']['beta_hcg'] == "NEGATIVO") echo "checked"; ?>  > NEGATIVO </input> </td>
		<td><input type="radio" name="beta_hcg" value="POSITIVO"  <?php if($_SESSION['valores_exames']['beta_hcg'] == "POSITIVO") echo "checked"; ?> > POSITIVO </input><br/> </td>
	</tr>
</table>

<?php
	} else if($teste == 'ckmb') {
?>						

<table>
	<legend class="h6 text-primary">informe os valores do exame CKMB:</legend>
	<tr class="">
		<td>CKMB:</td>
		<td><input type="text" id="ckmb" name="ckmb" value="<?php echo $_SESSION['valores_exames']['ckmb'];  ?>" /></td>
	</tr>
</table>

<?php
	} else if($teste == 'ck_total') {
?>						

<table class="">
	<legend class="h6 text-primary">informe os valores do exame CK TOTAL:</legend>
	<tr>
		<td>CK TOTAL:</td>
		<td><input type="text" id="ck_total" name="ck_total" value="<?php echo $_SESSION['valores_exames']['ck_total'];  ?>" /></td>
	</tr>
</table>

<?php
	}  else if($teste == 'coagulograma') {
?>						

<table class="">
	<legend class="h6 text-primary">informe os valores do exame TS:</legend>
	<tr>
		<td>TS:</td>
		<td><input type="text" id="ts" name="ts"/ value="<?php echo $_SESSION['valores_exames']['ts'];  ?>"></td>
	</tr>
	
	<tr>
		<td>TC:</td>
		<td><input type="text" id="tc" name="tc" value="<?php echo $_SESSION['valores_exames']['tc'];  ?>"/></td>
	</tr>
</table>

<?php
	} else if($teste == 'colesterol_total') {
?>						

<table class="">
	<legend class="h6 text-primary">informe os valores do exame Colesterol:</legend>
	<tr>
		<td>Colesterol:</td>
		<td><input type="text" id="colesterol_total" name="colesterol_total" value="<?php echo $_SESSION['valores_exames']['colesterol_total'];  ?>" /></td>
	</tr>
</table>

<?php
	} else if($teste == 'creatinina') {
?>						

<table class="">
	<legend class="h6 text-primary">informe os valores do exame Creatina:</legend>
	<tr>
		<td>Creatinina:</td>
		<td><input type="text" id="creatinina" name="creatinina" value="<?php echo $_SESSION['valores_exames']['creatinina'];  ?>" /></td>
	</tr>
</table>

<?php
	}   else if($teste == 'hematocritoe') {
?>						

<table class="">
	<legend class="h6 text-primary">informe os valores do exame Hematocrito:</legend>
	<tr>
		<td>Hemat�crito (%):</td>
		<td><input type="text" id="hematocritoe" name="hematocritoe" value="<?php echo $_SESSION['valores_exames']['hematocritoe'];  ?>"/></td>
	</tr>
</table>

<?php
	} else if($teste == 'hemoglobinae') {
?>						

<table class="">
	<legend class="h6 text-primary">informe os valores do exame Hemoglobina:</legend>
	<tr>
		<td>Hemoglobina (g%):</td>
		<td><input type="text" id="hemoglobinae" name="hemoglobinae" value="<?php echo $_SESSION['valores_exames']['hemoglobinae'];  ?>"/></td>
	</tr>
</table>

<?php
	} else if($teste == 'fator_r') {
?>						

<table class="">
	<legend class="h6 text-primary">informe os valores do exame Fator Reumatoide:</legend>
	<tr>
		<td>FR (Fator Reumat�ide):</td>
		<td><input type="text" id="fator_r" name="fator_r" value="<?php echo $_SESSION['valores_exames']['fator_r'];  ?>"/></td>
	</tr>
</table>

<?php
	} else if($teste == 'fezes') {
?>						

<table class="">
	<legend class="h6 text-primary">informe os valores do exame Helminstoscopia:</legend>
	<tr>
		<td>Helmintoscopia:</td>
		<td><input type="radio" id="amostra_helmintoscopia" name="amostra_helmintoscopia" value="NEGATIVO"  <?php if($_SESSION['valores_exames']['amostra_helmintoscopia'] == "NEGATIVO") echo "checked"; ?>  > Negativo</input></td>
		<td><input type="radio" id="amostra_helmintoscopia" name="amostra_helmintoscopia" value="POSITIVO"  <?php if($_SESSION['valores_exames']['amostra_helmintoscopia'] == "POSITIVO") echo "checked"; ?>  > Positivo:</input><br/></td>
		<td><input type="text" id="obs1" name="obs1" value="<?php echo $_SESSION['valores_exames']['obs1'];  ?>"/></td>
	</tr>

	<tr>
		<td>Protozooscopia:</td>
		<td><input type="radio" name="amostra_protozooscopia" value="NEGATIVO" <?php if($_SESSION['valores_exames']['amostra_protozooscopia'] == "NEGATIVO") echo "checked"; ?> > Negativo  </input></td>
		<td><input type="radio" name="amostra_protozooscopia" value="POSITIVO" <?php if($_SESSION['valores_exames']['amostra_protozooscopia'] == "POSITIVO") echo "checked"; ?> > Positivo: </input></td>
		<td><input type="text" id="obs2" name="obs2" value="<?php echo $_SESSION['valores_exames']['obs2'];  ?>"/></td>
	</tr>
</table>

<?php
	} else if($teste == 'fezes_3_amostras') {
?>						
	
<table class="">
	<legend class="h6 text-primary">informe os valores do exame Fezes 3 Amostras:</legend>
	<tr>
		<td>1� Amostra:</td>
	</tr>

	<tr>
		<td>Helmintoscopia:</td>
		<td><input type="radio" name="amostra_1_helmintoscopia" value="NEGATIVO" <?php if($_SESSION['valores_exames']['amostra_1_helmintoscopia'] == "NEGATIVO") echo "checked"; ?> >Negativo</input></td>
		<td><input type="radio" name="amostra_1_helmintoscopia" value="POSITIVO" <?php if($_SESSION['valores_exames']['amostra_1_helmintoscopia'] == "POSITIVO") echo "checked"; ?> >Positivo</input><br/></td>
		<td><input type="text"  id="helmintoscopia_1_positivo"  name="helmintoscopia_1_positivo" value="<?php echo $_SESSION['valores_exames']['helmintoscopia_1_positivo'];  ?>" /></td>
	</tr>

	<tr>
		<td>Protozooscopia:</td>
		<td><input type="radio" name="amostra_1_protozooscopia" value="NEGATIVO" <?php if($_SESSION['valores_exames']['amostra_1_protozooscopia'] == "NEGATIVO") echo "checked"; ?> >Negativo</input></td>
		<td><input type="radio" name="amostra_1_protozooscopia" value="POSITIVO" <?php if($_SESSION['valores_exames']['amostra_1_protozooscopia'] == "POSITIVO") echo "checked"; ?> >Positivo</input></td>
		<td><input type="text"  id="protozooscopia_1_positivo"  name="protozooscopia_1_positivo" value="<?php echo $_SESSION['valores_exames']['protozooscopia_1_positivo'];  ?>" /></td>
	</tr>

	<tr>
		<td>2� Amostra:</td>
	</tr>

	<tr>
		<td>Helmintoscopia:</td>
		<td><input type="radio" name="amostra_2_helmintoscopia" value="NEGATIVO" <?php if($_SESSION['valores_exames']['amostra_2_helmintoscopia'] == "NEGATIVO") echo "checked"; ?> >Negativo</input></td>
		<td><input type="radio" name="amostra_2_helmintoscopia" value="POSITIVO" <?php if($_SESSION['valores_exames']['amostra_2_helmintoscopia'] == "POSITIVO") echo "checked"; ?> >Positivo</input><br/></td>
		<td><input type="text"  id="helmintoscopia_2_positivo"  name="helmintoscopia_2_positivo" value="<?php echo $_SESSION['valores_exames']['helmintoscopia_2_positivo']; ?>" /></td>
	</tr>

	<tr>
		<td>Protozooscopia:</td>
		<td><input type="radio" name="amostra_2_protozooscopia" value="NEGATIVO" value="NEGATIVO" <?php if($_SESSION['valores_exames']['amostra_2_protozooscopia'] == "NEGATIVO") echo "checked"; ?> >Negativo</input></td>
		<td><input type="radio" name="amostra_2_protozooscopia" value="POSITIVO" value="NEGATIVO" <?php if($_SESSION['valores_exames']['amostra_2_protozooscopia'] == "POSITIVO") echo "checked"; ?> >Positivo</input></td>
		<td><input type="text"  id="protozooscopia_2_positivo"  name="protozooscopia_2_positivo" value="<?php echo $_SESSION['valores_exames']['protozooscopia_2_positivo']; ?>" /></td>
	</tr>

	<tr>
		<td>3� Amostra:</td>
	</tr>

	<tr>
		<td>Helmintoscopia:</td>
		<td><input type="radio" name="amostra_3_helmintoscopia" value="NEGATIVO" <?php if($_SESSION['valores_exames']['amostra_3_helmintoscopia'] == "NEGATIVO") echo "checked"; ?> >Negativo</input></td>
		<td><input type="radio" name="amostra_3_helmintoscopia" value="POSITIVO" <?php if($_SESSION['valores_exames']['amostra_3_helmintoscopia'] == "POSITIVO") echo "checked"; ?> >Positivo</input><br/></td>
		<td><input type="text"  id="helmintoscopia_3_positivo"  name="helmintoscopia_3_positivo" value="<?php echo $_SESSION['valores_exames']['helmintoscopia_3_positivo']; ?>" /></td>
	</tr>
	
	<tr>
		<td>Protozooscopia:</td>
		<td><input type="radio" name="amostra_3_protozooscopia" value="NEGATIVO" value="NEGATIVO" <?php if($_SESSION['valores_exames']['amostra_3_protozooscopia'] == "NEGATIVO") echo "checked"; ?> >Negativo</input></td>
		<td><input type="radio" name="amostra_3_protozooscopia" value="POSITIVO" value="NEGATIVO" <?php if($_SESSION['valores_exames']['amostra_3_protozooscopia'] == "POSITIVO") echo "checked"; ?> >Positivo</input></td>
		<td><input type="text"  id="protozooscopia_3_positivo"  name="protozooscopia_3_positivo" value="<?php echo $_SESSION['valores_exames']['protozooscopia_3_positivo']; ?>" /></td>
	</tr>
</table>

<?php
	} else if($teste == 'fostafase_alcalina') {
?>						

<table class="">
	<legend class="h6 text-primary">informe os valores do exame Fostafase Alcalina:</legend>
	<tr>
		<td>Fostafase Alcalina:</td>
		<td><input type="text" id="fostafase_alcalina" name="fostafase_alcalina" value="<?php echo $_SESSION['valores_exames']['fostafase_alcalina'];  ?>" /></td>
	</tr>
</table>

<?php
	}  else if($teste == 'glicemia_jejum') {
?>						

<table class="">
	<legend class="h6 text-primary">informe os valores do exame Glicemia em Jejum:</legend>
	<tr>
		<td>Glicemia em Jejum:</td>
		<td><input type="text" id="glicemia_jejum" name="glicemia_jejum" value="<?php echo $_SESSION['valores_exames']['glicemia_jejum'];  ?>" /></td>
	</tr>
</table>

<?php
	} else if($teste == 'glicemia_pos_prandial') {
?>						

<table class="">
	<legend class="h6 text-primary">informe os valores do exame Pos-Prandial:</legend>
	<tr>
		<td>Glicemia Pós-Prandial:</td>
		<td><input type="text" id="glicemia_pos_prandial" name="glicemia_pos_prandial" value="<?php echo $_SESSION['valores_exames']['glicemia_pos_prandial'];  ?>" /></td>
	</tr>
</table>

<?php
	}  else if($teste == 'gama_gt') {
?>						

<table class="">
	<legend class="h6 text-primary">informe os valores do exame Gama GT:</legend>
	<tr>
		<td>GAMA GT:</td>
		<td><input type="text" id="gama_gt" name="gama_gt" value="<?php echo $_SESSION['valores_exames']['gama_gt'];  ?>" /></td>
	</tr>
</table>

<?php
	} else if($teste == 'glicose') {
?>						

<table class="">
	<legend class="h6 text-primary">informe os valores do exame Glicose:</legend>
	<tr>
		<td>Glicose:</td>
		<td><input type="text" id="glicose" name="glicose" value="<?php echo $_SESSION['valores_exames']['glicose'];  ?>" /></td>
	</tr>
</table>

<?php
	} else if($teste == 'grupo_sanguineo') {
?>						

<table class="">
	<legend class="h6 text-primary">informe os valores do exame Grupo Sanguineo:</legend>
	<tr>
		<td>Grupo Sanguíneo:</td>
		<td><input type="radio" id="grupo_sanguineo" name="grupo_sanguineo" value="A"  <?php if($_SESSION['valores_exames']['grupo_sanguineo'] == "A")  echo "checked"; ?> > A  </input></td>
		<td><input type="radio" id="grupo_sanguineo" name="grupo_sanguineo" value="AB" <?php if($_SESSION['valores_exames']['grupo_sanguineo'] == "AB") echo "checked"; ?> > AB </input></td>
		<td><input type="radio" id="grupo_sanguineo" name="grupo_sanguineo" value="B"  <?php if($_SESSION['valores_exames']['grupo_sanguineo'] == "B")  echo "checked"; ?> > B  </input></td>
		<td><input type="radio" id="grupo_sanguineo" name="grupo_sanguineo" value="O"  <?php if($_SESSION['valores_exames']['grupo_sanguineo'] == "O")  echo "checked"; ?> > O  </input></td>
	</tr>
		
	<tr>
		<td>Fator RH:</td>
		<td><input type="radio" id="frh" name="frh" value="NEGATIVO" <?php if($_SESSION['valores_exames']['frh'] == "NEGATIVO")  echo "checked"; ?> >NEGATIVO</input></td>
		<td><input type="radio" id="trh" name="frh" value="POSITIVO" <?php if($_SESSION['valores_exames']['frh'] == "POSITIVO")  echo "checked"; ?> >POSITIVO</input></td>
	</tr>
</table>

<?php
	} else if($teste == 'hemograma') {
?>						

<table class="">
	<legend class="h6 text-primary">informe os valores do exame Hemograma:</legend>
	<tr>
		<th>Eritrograma:</th>
	</tr>

	<tr>
		<td>Hemat�crito(%):</td>
		<td><input type="text" id="hematocrito" name="hematocrito" value="<?php echo $_SESSION['valores_exames']['hematocrito']; ?>" /></td>
		<td >Hem�cias(milh�es/mm�):</td>
		<td><input type="text" id="hemacias" name="hemacias" value="<?php echo $_SESSION['valores_exames']['hemacias']; ?>" /></td>	
	</tr>

	<tr>
		<td>Hemoglobina(g%):</td>
		<td><input type="text" id="hemoglobina" name="hemoglobina" value="<?php echo $_SESSION['valores_exames']['hemoglobina']; ?>" /></td>
		<td >RDW:</td>
		<td><input type="text" id="rdw" name="rdw" value="<?php echo $_SESSION['valores_exames']['rdw']; ?>" /></td>	
	</tr>		

	<tr>
		<th>Leucograma:</th>
	</tr>
	<tr>
		<td>Leuc�citos:</td>
		<td><input type="text" id="leucocitos" name="leucocitos" value="<?php echo $_SESSION['valores_exames']['leucocitos']; ?>"/></td>
		<td></td>
		<td></td>
	</tr>
	
	<tr> 
		<td>Basófilos:</td>
		<td><input type="text" id="basofilos_relativo" name="basofilos_relativo" value="<?php echo $_SESSION['valores_exames']['basofilos_relativo']; ?>" /></td>
		<td>Bastonetes:</td>
		<td><input type="text" id="bastonetes_relativo" name="bastonetes_relativo" value="<?php echo $_SESSION['valores_exames']['bastonetes_relativo']; ?>" /></td>
	</tr>
	
	<tr>	
		<td>Eosinófilos:</td>
		<td><input type="text" id="eosinofilos_relativo" name="eosinofilos_relativo" value="<?php echo $_SESSION['valores_exames']['eosinofilos_relativo']; ?>" /></td>
		<td>Segmentados:</td>
		<td><input type="text" id="segmentados_relativo" name="segmentados_relativo" value="<?php echo $_SESSION['valores_exames']['segmentados_relativo']; ?>" /></td>
	</tr>
	
	<tr>	
		<td>Mielócitos:</td>
		<td><input type="text" id="mielocitos_relativo" name="mielocitos_relativo" value="<?php echo $_SESSION['valores_exames']['mielocitos_relativo']; ?>" /></td>
		<td>Linfócitos:</td>
		<td><input type="text" id="linfocitos_relativo" name="linfocitos_relativo" value="<?php echo $_SESSION['valores_exames']['linfocitos_relativo']; ?>" /></td>
	</tr>
	
	<tr>	
		<td>Metamielócitos:</td>
		<td><input type="text" id="metamielocitos_relativo" name="metamielocitos_relativo" value="<?php echo $_SESSION['valores_exames']['metamielocitos_relativo']; ?>" /></td>
		<td>Monocótos:</td>
		<td><input type="text" id="monocitos_relativo" name="monocitos_relativo" value="<?php echo $_SESSION['valores_exames']['monocitos_relativo']; ?>" /></td>
	</tr>
	
	<tr>	
		<td>Plaquetas:</td>
		<td><input type="text" id="plaquetas" name="plaquetas" value="<?php echo $_SESSION['valores_exames']['plaquetas']; ?>" /></td>
	</tr>
</table>

<?php
	} else if($teste == 'pcr') {
?>						

<table class="border-2 border-bottom border-success">
	<legend class="h6 text-primary">informe os valores do exame PCR:</legend>
	<tr>
		<td>PCR (Prote�na C Reativa)</td>
		<td><input type="text" id="pcr" name="pcr" value="<?php echo $_SESSION['valores_exames']['pcr']; ?>" /></td>
	</tr>
</table>

<?php
	} else if($teste == 'sumario_urina') {
?>						

<table class="border-2 border-bottom border-success">
	<legend class="h6 text-primary">informe os valores do exame Exame Fisico:</legend>
	<tr>
		<th>Exame Fisico:</th>
	</tr>
	
	<tr>
		<td>Volume (ml):</td>
		<td><input type="text" id="volume" name="volume" value="<?php echo $_SESSION['valores_exames']['volume']; ?>" /></td>
		<td>Densidade:</td>
		<td><input type="text" id="densidade" name="densidade" value="<?php echo $_SESSION['valores_exames']['densidade']; ?>" /></td>
	</tr>
	
	<tr>
		<td>Cor:</td>
		<td><input type="text" id="cor" name="cor" value="<?php echo $_SESSION['valores_exames']['cor']; ?>" /></td>
		<td>Aspecto:</td>
		<td><input type="text" id="aspecto" name="aspecto" value="<?php echo $_SESSION['valores_exames']['aspecto']; ?>" /></td>
	</tr>
	
	<tr>
		<td>pH - Rea��o:</td>
		<td><input type="text" id="ph_reacao" name="ph_reacao" value="<?php echo $_SESSION['valores_exames']['ph_reacao']; ?>" /></td>
	</tr>

	<tr>
		<th>Exame Quimico:</th>
	</tr>
	
	<tr>
		<td>Proteinas:</td>
		<td><input type="text" id="proteinas" name="proteinas" value="<?php echo $_SESSION['valores_exames']['proteinas']; ?>" /></td>
		<td>Hemoglobina:</td>
		<td><input type="text" id="hemoglobina" name="hemoglobina" value="<?php echo $_SESSION['valores_exames']['hemoglobina']; ?>" /></td>
	</tr>
	
	<tr>
		<td>Glicose:</td>
		<td><input type="text" id="glicosex" name="glicosex" value="<?php echo $_SESSION['valores_exames']['glicosex']; ?>" /></td>
		<td>Cetona:</td>
		<td><input type="text" id="cetona" name="cetona" value="<?php echo $_SESSION['valores_exames']['cetona']; ?>" /></td>
	</tr>
	
	<tr>
		<td>Bilirrubinas:</td>
		<td><input type="text" id="bilirrubinas" name="bilirrubinas" value="<?php echo $_SESSION['valores_exames']['bilirrubinas']; ?>" /></td>
		<td>Urobilinogênio:</td>
		<td><input type="text" id="urobilinogenio" name="urobilinogenio" value="<?php echo $_SESSION['valores_exames']['urobilinogenio']; ?>" /></td>
	</tr>
	
	<tr>
		<td>Nitrito:</td>
		<td><input type="text" id="nitrito" name="nitrito" value="<?php echo $_SESSION['valores_exames']['nitrito']; ?>" /></td>
	</tr>
	
	<tr>
		<td>Microscopia do Sedimento:</td>
	</tr>	

	<tr>
		<td>Celulas Epiteliais</td>
		<td><input type="text" id="celulas_epiteliais" name="celulas_epiteliais" value="<?php echo $_SESSION['valores_exames']['celulas_epiteliais']; ?>" /></td>
	</tr>
	
	<tr>
		<td>Piocitos</td>
		<td><input type="text" id="piocitos" name="piocitos" value="<?php echo $_SESSION['valores_exames']['piocitos']; ?>" /></td>
	</tr>
	
	<tr>
		<td>Hemacias</td>
		<td><input type="text" id="hemacias" name="hemacias" value="<?php echo $_SESSION['valores_exames']['hemacias']; ?>" /></td>
	</tr>
	
	<tr>
		<td>Bacterias</td>
		<td><input type="text" id="bacterias" name="bacterias" value="<?php echo $_SESSION['valores_exames']['bacterias']; ?>" /></td>
	</tr>
	
</table>

<?php
	} else if($teste == 'tap') {
?>						

<table class="">
	
	<tr>
		<td>Tempo (Plasma paciente):</td>
		<td><input type="text" id="tap" name="tap" value="<?php echo $_SESSION['valores_exames']['tap']; ?>" /></td>
	</tr>
	<tr>
		<td>RNI:</td>
		<td><input type="text" id="rni" name="rni" value="<?php echo $_SESSION['valores_exames']['rni']; ?>" /></td>
	</tr>
</table>

<?php
	}else if($teste == 'ttpa') {
?>						

<table class="">
	<tr>
		<td>TTPA (Tempo Tromboplastina Parcial Ativada):</td>
		<td><input type="text" id="ttpa" name="ttpa" value="<?php echo $_SESSION['valores_exames']['ttpa']; ?>" /></td>
	</tr>
</table>

<?php
	} else if($teste == 'teste_rapido_zika') {
?>						

<table class="">
	<tr>
		<td>ZIKA IgC:</td>
		<td><input type="radio" name="zika_igc" value="NEGATIVO" <?php if($_SESSION['valores_exames']['zika_igc'] == "NEGATIVO")  echo "checked"; ?> > NEGATIVO </input></td>
		<td><input type="radio" name="zika_igc" value="POSITIVO" <?php if($_SESSION['valores_exames']['zika_igc'] == "POSITIVO")  echo "checked"; ?> > POSITIVO </input><br/></td>
	</tr>
	<tr>
		<td>ZIKA IgM:</td>
		<td><input type="radio" name="zika_igm" value="NEGATIVO" <?php if($_SESSION['valores_exames']['zika_igm'] == "NEGATIVO")  echo "checked"; ?> > NEGATIVO </input></td>
		<td><input type="radio" name="zika_igm" value="POSITIVO" <?php if($_SESSION['valores_exames']['zika_igm'] == "POSITIVO")  echo "checked"; ?> > POSITIVO </input><br/></td>
	</tr>
</table>

<?php
	} else if($teste == 'tgo') {
?>						

<table class="">
	<legend class="h6 text-primary">informe os valores do exame TGO:</legend>
	<tr>
		<td>TGO:</td>
		<td><input type="text" id="tgo" name="tgo" value="<?php echo $_SESSION['valores_exames']['tgo']; ?>" /><br/></td>
	</tr>
</table>

<?php
	} else if($teste == 'tgp') {
?>						

<table class="">
	<legend class="h6 text-primary">informe os valores do exame TGP:</legend>
	<tr>
		<td>TGP:</td>
		<td><input type="text" id="tgp" name="tgp" value="<?php echo $_SESSION['valores_exames']['tgp']; ?>" /><br/></td>
	</tr>
</table>

<?php
	} else if($teste == 'triguicerides') {
?>						

<table class="">
	<legend class="h6 text-primary">informe os valores do exame Triguicerides:</legend>
	<tr>
		<td>Triguicerides:</td>
		<td><input type="text" id="triguicerides" name="triguicerides" value="<?php echo $_SESSION['valores_exames']['triguicerides']; ?>" /></td>
	</tr>
</table>

<?php
	} else if($teste == 'troponina') {
?>						

<table class="">
	<legend class="h6 text-primary">informe os valores do exame Troponina:</legend>
	<tr>
		<td>Troponina:</td>
		<td><input type="radio" id="troponina" name="troponina" value="NEGATIVO" <?php if($_SESSION['valores_exames']['troponina'] == "NEGATIVO")  echo "checked"; ?> >NEGATIVO</input></td>
		<td><input type="radio" id="troponina" name="troponina" value="POSITIVO" <?php if($_SESSION['valores_exames']['troponina'] == "POSITIVO")  echo "checked"; ?> >POSITIVO</input> </td>
	</tr>
</table>

<?php
	} else if($teste == 'ureia') {
?>						

<table class="">
	<legend class="h6 text-primary">informe os valores do exame Ureia:</legend>
	<tr>
		<td>Ureia:</td>
		<td><input type="text" id="ureia" name="ureia" value="<?php echo $_SESSION['valores_exames']['ureia']; ?>" /></td>
	</tr>
</table>

<?php
	} else if($teste == 'vdrl') {
?>						

<table class="">
	<legend class="h6 text-primary">informe os valores do exame VDRL:</legend>
	<tr>
		<td>V.D.R.L:</td>
		<td><input type="radio" id="vdrl"  name="vdrl"  value="N�O REAGENTE" <?php if($_SESSION['valores_exames']['vdrl'] == "N�O REAGENTE")  echo "checked"; ?> > N�O REAGENTE </input></td>
		<td><input type="radio" id="vdrl"  name="vdrl"  value="REAGENTE"     <?php if($_SESSION['valores_exames']['vdrl'] == "REAGENTE")  echo "checked"; ?> >     REAGENTE:    </input><br/></td>
		<td><input type="text"  id="valor" name="valor" value="<?php echo $_SESSION['valores_exames']['valor']; ?>" /></td>
	</tr>
</table>

<?php
	} else if($teste == 'vhs') {
?>						

<table class="">
	<legend class="h6 text-primary">informe os valores do exame VHS:</legend>
	<tr>
		<td>VHS (Velocidade de Hemossedimentação):</td>
		<td><input type="text" id="vhs" name="vhs" value="<?php echo $_SESSION['valores_exames']['vhs']; ?>" /></td>
	</tr>
</table>

<?php
	} else if($teste == 'colesterol_hdl') {
?>

<table>
	<legend class="h6 text-primary">informe os valores do exame Colesterol - HDL:</legend>
	<tr>
		<td>Colesterol - HDL: </td>
		<td><input type="text" id="colesterol_hdl" name="colesterol_hdl" value="<?php echo $_SESSION['valores_exames']['colesterol_hdl']; ?>" /></td>
	</tr>
</table>

<?php
	} else if($teste == 'colesterol_vldl') {
?>

<table>
	<legend class="h6 text-primary">informe os valores do exame Colesterol - HDL:</legend>
	<tr>
		<td>Colesterol - VLDL: </td>
		<td><input type="text" id="colesterol_vldl" name="colesterol_vldl" value="<?php echo $_SESSION['valores_exames']['colesterol_vldl']; ?>" /></td>
	</tr>
</table>

<?php
	} else if($teste == 'sodio_serico') {
?>

<table>
	<legend class="h6 text-primary">informe os valores do exame Colesterol - HDL:</legend>
	<tr>
		<td>Sodio Serico: </td>
		<td><input type="text" id="sodio_serico" name="sodio_serico" value="<?php echo $_SESSION['valores_exames']['sodio_serico']; ?>" /></td>
	</tr>
</table>

<?php
	} else if($teste == 'potassio') {
?>

<table>
	<legend class="h6 text-primary">informe o valor do exame Potassio:</legend>
	<tr>
		<td>Potassio: </td>
		<td><input type="text" id="potassio" name="potassio" value="<?php echo $_SESSION['valores_exames']['potassio']; ?>" /></td>
	</tr>
</table>

<?php
	} else if($teste == 'cloro') {
?>

<table>
	<legend class="h6 text-primary">informe o valor do exame Cloro:</legend>
	<tr>
		<td>Potassio: </td>
		<td><input type="text" id="cloro" name="cloro" value="<?php echo $_SESSION['valores_exames']['cloro']; ?>"/></td>
	</tr>
</table>

<?php
	} else if($teste == 'calcio') {
?>

<table>
	<legend class="h6 text-primary">informe o valor do exame Calcio:</legend>
	<tr>
		<td>Calcio: </td>
		<td><input type="text" id="calcio" name="calcio" value="<?php echo $_SESSION['valores_exames']['calcio']; ?>" /></td>
	</tr>
</table>

<?php
	} else if($teste == 'ferro_serico') {
?>

<table>
	<legend class="h6 text-primary">informe o valor do exame Ferro Serico:</legend>
	<tr>
		<td>Ferro Serico: </td>
		<td><input type="text" id="ferro_serico" name="ferro_serico" value="<?php echo $_SESSION['valores_exames']['ferro_serico']; ?>" /></td>
	</tr>
</table>

<?php
	} else if($teste == 'fosforo') {
?>

<table>
	<legend class="h6 text-primary">informe o valor do exame Fosforo:</legend>
	<tr>
		<td>Fosforo: </td>
		<td><input type="text" id="fosforo" name="fosforo" value="<?php echo $_SESSION['valores_exames']['fosforo']; ?>" /></td>
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
		<td><input type="text" id="ggt" name="ggt" value="<?php echo $_SESSION['valores_exames']['ggt']; ?>" /></td>
	</tr>
</table>

<!-- PROTEINAS TOTAIS E FRAÇÕES -->
<?php
	} else if($teste == 'proteinas_totais_e_fracoes') {
?>
<table>
	<legend class="h6 text-primary">informe o valor do exame Proteinas Totais e Fracoes:</legend>
	<tr>
		<td>Proteina Total: </td>
		<td><input type="text" id="proteina_total" name="proteina_total" value="<?php echo $_SESSION['valores_exames']['proteina_total']; ?>" class="form-control form-control-sm"/></td>
	</tr>
	<tr>
		<td>Albumina: </td>
		<td><input type="text" id="albumina" name="albumina" value="<?php echo $_SESSION['valores_exames']['albumina']; ?>" class="form-control form-control-sm"/></td>
	</tr>
	<tr>
		<td>Globulina: </td>
		<td><input type="text" id="globulina" name="globulina" value="<?php echo $_SESSION['valores_exames']['globulina']; ?>" class="form-control form-control-sm"/></td>
	</tr>
	<tr>
		<td>Relacao A/G: </td>
		<td><input type="text" id="relacao_a_g" name="relacao_a_g" value="<?php echo $_SESSION['valores_exames']['relacao_a_g']; ?>" class="form-control form-control-sm"/></td>
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
		<td><input type="text" id="amilase_total" name="amilase_total" value="<?php echo $_SESSION['valores_exames']['amilase_total'];  ?>" /></td>
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
		<td><input type="text" id="lipase" name="lipase" value="<?php echo $_SESSION['valores_exames']['lipase'];  ?>" /></td>
	</tr>
</table>

<!-- BILIRRUBINAS TOTAIS E FRA�OES -->
<?php
	} else if($teste == 'bilirrubinas_totais_e_fracoes') {
?>
<table>
	<legend class="h6 text-primary">informe o valor do exame Billirrubinas Totais e Fracoes:</legend>
	<tr>
		<td>Bilirrubina Direta: </td>
		<td><input type="text" id="bilirrubina_direta" name="bilirrubina_direta" class="form-control form-control-sm" value="<?php echo $_SESSION['valores_exames']['bilirrubina_direta'];  ?>" /></td>
	</tr>
	<tr>
		<td>Bilirrubina Indireta: </td>
		<td><input type="text" id="bilirrubina_indireta" name="bilirrubina_indireta" class="form-control form-control-sm" value="<?php echo $_SESSION['valores_exames']['bilirrubina_indireta'];  ?>" /></td>
	</tr>
	<tr>
		<td>Bilirrubina Total: </td>
		<td><input type="text" id="bilirrubina_total" name="bilirrubina_total" class="form-control form-control-sm" value="<?php echo $_SESSION['valores_exames']['bilirrubina_total'];  ?>" /></td>
	</tr>
</table>

<?php
		}//#ultimo else if
	} //#if for
?>

<table class="table w-auto table-borderless">
	<tr>
		<td>
			<span style="font-weight: bold;"> Selecione o Bioquimico: </span>	
		</td>
	
		<td>
			<select id="nomebioquimico" name="nomebioquimico" class="form-control form-control-sm">
				
				<option value='hernandoluis' <?php if($_SESSION['valores_exames']['nomebioquimico'] == "hernandoluis")  echo "selected"; ?> >Hernando Luis                </option>
				<option value='joaocarlos'   <?php if($_SESSION['valores_exames']['nomebioquimico'] == "joaocarlos")    echo "selected"; ?> >Joao Carlos                  </option>
				<option value='marlonsouza'  <?php if($_SESSION['valores_exames']['nomebioquimico'] == "marlonsouza")   echo "selected"; ?> >Marlon Souza Silva           </option>
				<option value='rafaelameira' <?php if($_SESSION['valores_exames']['nomebioquimico'] == "rafaelameira")  echo "selected"; ?> >Rafaela Ramona Meira Azevedo </option>
				<option value='valneisilva'  <?php if($_SESSION['valores_exames']['nomebioquimico'] == "valneisilva")   echo "selected"; ?> >Valnei Silva Lima Junior     </option>
			</select>
		</td>
	</tr>

	<tr>
		<td>
			<span style="font-weight: bold;">Solicitante:</span>
		</td>
		
		<td>
			<input type="text" id="solicitante" name="solicitante" value="<?php if (!empty($_SESSION['valores_exames']['solicitante'])) echo $_SESSION['valores_exames']['solicitante'];  ?>" class="form-control form-control-sm"/>
		</td>
	</tr>
</table>
	
<!--botão redireciona a página para a página exame_verificar.php-->
<input type="submit" id="submit" name="submit" value="Vizualizar Relatorio" class="btn-sm btn-success" />

</form>

<?php
	} //#if session 
?>

<?php
	// Insert the page footer
	require_once('rodape.php');

	//print_r ($_SESSION['valores_exames']);
?>

