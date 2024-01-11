var request = null;
try {
	request = new XMLHttpRequest();
} catch (trymicrosoft) {
	try {
		request = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (othermicrosoft) {
		try {
			request = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (failed) {
			request = null;
		}
	}
}

function excluir(idPac, nomePaciente){
	let valor = confirm("Tem certeza que deseja excluir o paciente?");
	if(valor) {
		let idPaciente = idPac;
		let url        = "excluirpaciente.php"; // url do script backend
		url            = url + "?dummy=" + new Date().getTime();
		request.open("POST", url, true);// Define o protocolo para enviar os dados, a url php e que a informação será enviada de forma assincrona
		request.onreadystatechange = mensagem; // Método chamado quando o objeto request tiver a resposta do servidor.
		request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		request.send("variavel=" + idPaciente );
	} else {
		alert("Ação cancelada!");
	}
}

function mensagem() {
	if (request.readyState == 4) {  // Estado de prontidão: 1 iniciado, 2 trabalhando, 3 trabalhando, 4 tudo ok
		if(request.status == 200) {
			let msg = request.responseText;
			alert(msg);
			location.reload();
		} else {
			alert("O status não é 200 não meu querido, se liga!")
		}
		
	}
}

