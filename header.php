<?php
	/* Inicia o HTML com o cabeçalho e o corpo da página */
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">

	<head>
  				
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<?php
			echo '<title>Exames - ' . $page_title . '</title>'; // nome exibido no título
		?>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
		integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"/>
	</head>
	<body>
		
		<div class="container-fluid	p-0 m-0">
		
		<?php
  
			echo '<h3 class="text-white bg-success py-3 m-0">Exames - ' . $page_title . '</h3>'; // nome exibido no corpo
		?>
