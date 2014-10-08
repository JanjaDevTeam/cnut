function validaFormRegistro() {
	var nome = document.forms['registro']['nome'].value;
	var email  = document.forms['registro']['email'].value;
	var senha  = document.forms['registro']['senha'].value;
	var senha2 = document.forms['registro']['senha2'].value;


	if (nome.length == 0) {
		alert("Informe seu nome.");
		return false;
	}

	if (email.length == 0) {
		alert('Informe seu email');
		return false;
	}

	if (senha.length < 6) {
		alert('A senha deve ter no mínimo 6 caracteres.');
		return false;
	}

	if (senha != senha2) {
		alert('As senhas devem ser iguais.');
		return false;
	}

	
	return true;
}

function validaFormEmail() {
	var email  = document.forms['formEmail']['email'].value;
	if (email.length == 0) {
		alert('Informe seu email');
		return false;
	}

	return true;
}


function validaRecuperarSenha() {

	var senha  = document.forms['formRecuperarSenha']['senha'].value;
	var senha2 = document.forms['formRecuperarSenha']['senha2'].value;

	if (senha.length < 6) {
		alert('A senha deve ter no mínimo 6 caracteres.');
		return false;
	}

	if (senha != senha2) {
		alert('As senhas devem ser iguais.');
		return false;
	}

	
	return true;
}



function validateFormProjeto () {
	
	var nome = document.forms['formProjeto']['nome'].value;
	if (nome.length == 0) {
		alert("Seu projeto precisa de um nome.");
		return false;
	}
	
	var descricao = tinyMCE.get('inputDescricao').getContent();
	if (descricao.length == 0) {
		alert("Descreva seu projeto.");
		return false;
	}
	
	var frase = document.forms['formProjeto']['frase'].value;
	if (frase.length == 0) {
		alert("Escolha uma frase de efeito.");
		return false;
	}
	
	var valor = document.forms['formProjeto']['valor'].value;
	if (valor.length == 0) {
		alert("Informe o valor.");
		return false;
	}

	if (typeof valor != 'number' && valor % 1!= 0) {
		alert("O valor deve ser um número inteiro");
		return false;
	}
	
	var prazo = document.forms['formProjeto']['prazo'].value;
	if (prazo.length == 0) {
		alert("Informe o prazo para arrecadar o valor.");
		return false;
	}
	if (typeof prazo != 'number' && prazo % 1!= 0 || prazo > 60) {
		alert("O prazo deve ser um número inteiro menor ou igual a 60");
		return false;
	}
	
	var video = document.forms['formProjeto']['video'].value;
	if (video.length == 0) {
		alert("Informe o video do youtube.");
		return false;
	}
	
	return true;
}



function validaTermos() {
	var box = document.forms['termos']['box'].checked;
	if (box == false) {
		alert('Leia e aceite os termos.');
		return false;
	}

	return true;
}
