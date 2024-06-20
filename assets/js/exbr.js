function pesquisarMilitar() {
	let input = document.querySelector("#pesquisaMilitar");
	let militar = input.value;

	if (militar !== '') {
		let wrapperResultado = document.querySelector("#wrapperResultado");
		wrapperResultado.classList.remove("d-none");

		let loading = `
			<div class="col-sm-12 col-md-2 my-2 d-flex justify-content-center align-items-center">
				<div class="spinner-border text-primary" role="status">
					<span class="visually-hidden">Loading...</span>
				</div>
			</div>
			<div class="col-sm-12 col-md-10 my-2">
				<h5>Estamos varrendo nossos registros em busca de ${militar}...</h5>
			</div>
		`;
		wrapperResultado.innerHTML = loading;

		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				wrapperResultado.classList.add("d-flex");

				let reponse = JSON.parse(xhttp.response);
				wrapperResultado.innerHTML = montaResultado(reponse);
				var listaTooltip = document.querySelectorAll('[data-bs-toggle="tooltip"]')
				var listaTooltip = [...listaTooltip].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))				
			} else if (this.readyState == 4 && this.status == 404) {
				wrapperResultado.classList.add("d-flex");
				
				wrapperResultado.innerHTML = naoEncontrado(militar);
			}
		};
		var url = `struct/ajax/pesquisa.php`;
		xhttp.open("POST", url, true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
		xhttp.send(`militar=${militar}`);		
	}
}

function enter(event) {
	var key = event.which || event.keyCode;
	if (key == 13) {
		pesquisarMilitar();
	}
}

function montaResultado(objeto) {
	let personagem = `background: url(https://www.habbo.com.br/habbo-imaging/avatarimage?user=${objeto.nome}&direction=3&head_direction=3&gesture=sml&size=l) center 35% no-repeat, url(https://exercitobrhb.com//images/perfil/bg_exbr.png) center center no-repeat;width:120px;height:120px;`;
	let nome = '';
	let idade = '';
	let siglas = '';
	let palestra = '';
	let ultimapromo = '';
	let promovidopor = '';
	let cp = '';
	let patrocinador = '';
	let status = '';

	if (objeto.sobrenome != '' && objeto.sobrenome != undefined) {
		nome = `<b>Nome</b>: ${objeto.sobrenome}<br>`;
	}

	if (objeto.idade != '' && objeto.idade != undefined) {
		idade = `<b>Idade</b>: ${objeto.idade}<br>`;
	}

	if (objeto.treino != '' && objeto.treino != undefined && objeto.treino != '* ' && objeto.patente <= 9) {
		treino = objeto.treino.replace("<", "&lt;");
		treino = treino.replace(">", "&gt;");
		siglas = `<b>Treino</b>: ${treino}<br>`;
	}

	if (objeto.treino2 != '' && objeto.treino2 != undefined && objeto.treino2 != '* ' && objeto.patente <= 9) {
		treino2 = objeto.treino2.replace("<", "&lt;");
		treino2 = treino2.replace(">", "&gt;");
		palestra = `<b>Palestra</b>: ${treino2}<br>`;
	}

	if (objeto.ultimapromo !== '') {
		ultimapromo = `<b>Última promoção</b>: ${objeto.ultimapromo}<br>`;
	}

	if (objeto.patente != 23) {
		promovidopor = `<b>Promovido por</b>: ${objeto.promovidopor}<br>`;
		if (objeto.patrocinador == 'sim') {
			patrocinador = `<b>Patrocinador</b><br>`;
		}
	}

	if (objeto.patente > 12) {
		cp = `<b>Companhia</b>: ${objeto.cp}<br>`;
	}

	if (objeto.status == 0) {
		status = `<b>Status</b>: Ativo<br>`;
	} else if (objeto.status == 1) {
		status = `<b>Status</b>: Demitido - ${objeto.motivo}<br>`;
	} else if (objeto.status == 3) {
		status = `<b>Status</b>: Aposentado<br>`;
	} else {
		status = `<b>Status</b>: Insigne<br>`;
	}

	if (objeto.honraria_1 != 'nao' || objeto.honraria_2 != 'nao' || objeto.honraria_3 != 'nao') {
		imagens_honrarias = '';

		if (objeto.honraria_1 != 'nao') {
			if (objeto.honraria_1 == 1) {
				texto_honraria = 'Grã-Cruz (Ordem Militar do Cruzeiro do Sul)';
			} if (objeto.honraria_1 == 2) {
				texto_honraria = 'Comendador (Ordem Militar do Cruzeiro do Sul)';
			} if (objeto.honraria_1 == 3) {
				texto_honraria = 'Cavaleiro (Ordem Militar do Cruzeiro do Sul)';
			}

			imagens_honrarias += `<img src="https://exercitobrhb.com/images/site/honraria_1.png" class="img-honraria-pesquisa" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="${texto_honraria}">`;
		}

		if (objeto.honraria_2 != 'nao') {
			if (objeto.honraria_1 == 1) {
				texto_honraria = 'Grã-Cruz (Ordem Militar de Avis)';
			} if (objeto.honraria_1 == 2) {
				texto_honraria = 'Comendador (Ordem Militar de Avis)';
			} if (objeto.honraria_1 == 3) {
				texto_honraria = 'Cavaleiro (Ordem Militar de Avis)';
			}

			imagens_honrarias += `<img src="https://exercitobrhb.com/images/site/honraria_2.png" class="img-honraria-pesquisa" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="${texto_honraria}">`;
		}

		if (objeto.honraria_3 != 'nao') {
			if (objeto.honraria_1 == 1) {
				texto_honraria = 'Grã-Cruz (Ordem da Torre e Espada, Da Infantaria, Lealdade e Mérito)';
			} if (objeto.honraria_1 == 2) {
				texto_honraria = 'Comendador (Ordem da Torre e Espada, Da Infantaria, Lealdade e Mérito)';
			} if (objeto.honraria_1 == 3) {
				texto_honraria = 'Cavaleiro (Ordem da Torre e Espada, Da Infantaria, Lealdade e Mérito)';
			}

			imagens_honrarias += `<img src="https://exercitobrhb.com/images/site/honraria_3.png" class="img-honraria-pesquisa" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="${texto_honraria}">`;
		}

		honrarias = `<div class="d-flex flex-row mt-2 w-100 justify-content-center align-items-center">${imagens_honrarias}</div>`;
	} else {
		honrarias = '';
	}

	let resultado = `
		<div class="col-sm-12 col-lg-4 d-flex-pesquisa flex-column margin-pesquisa justify-content-center align-items-center">
			<div class="rounded-circle border border-3 border-white pixelated_rendering" style="${personagem}"></div>
			${honrarias}
		</div>
		<div class="col-sm-12 col-lg-8 mb-sm-1">
			<h2>${objeto.nome}</h2>
			<b>Patente</b>: ${objeto.pat_nome}<br>
			${nome}
			${idade}
			${siglas}
			${palestra}
			${ultimapromo}
			${promovidopor}
			${cp}
			${patrocinador}
			${status}
			<div>
				<span class="badge bg_badge"><a href="/perfil/${objeto.nome}" class="text-white text-decoration-none" target="_blank">Perfil</a></span>
				<span class="badge bg_badge"><a href="javascript:void(0);" class="text-white text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalRegistro">Registro Militar</a></span>
			</div>
		</div>
	`;
	document.querySelector("#imagemRegistro").src = `/struct/carteirinha.php?usuario=${objeto.nome}`;

	return resultado;
}

function naoEncontrado(nome) {
	let resultado = `
		<div class="col-sm-12 col-md-2 my-2 d-flex justify-content-center align-items-center">
			<img src="https://exercitobrhb.com/images/icons/inexistente.png">
		</div>
		<div class="col-sm-12 col-md-10 my-2">
			<h4>Registro Inexistente</h4>
			<p>${nome} não é alistado no Exército Brasileiro.</p>
		</div>
	`;
	return resultado;
}

function htmlEntities(str) {
	return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

function alertar(titulo, mensagem, cor) {
	let wrapper_aviso = document.querySelector("#wrapper_aviso");
	let aviso = document.querySelector("#alert_exbr");
	let aviso_titulo = document.querySelector("#alert_title");
	let aviso_mensagem = document.querySelector("#alert_message");
	let btn_fechar = document.querySelector("#alert_close");

	aviso_titulo.innerHTML = titulo;
	aviso_mensagem.innerHTML = mensagem;
	aviso.classList.add("alert-"+cor);
	wrapper_aviso.classList.remove("d-none");
	btn_fechar.onclick = function() {;setTimeout(function(){ document.querySelector("#wrapper_aviso").classList.add("d-none") }, 150)};
}

document.addEventListener('DOMContentLoaded', function() {
	let btnPesquisaMilitar = document.querySelector("#btnPesquisaMilitar");
	if (typeof btnPesquisaMilitar == 'object') {
		btnPesquisaMilitar.onclick = function() {pesquisarMilitar()};
	}
	let pesquisaMilitar = document.querySelector("#pesquisaMilitar");
	if (typeof btnPesquisaMilitar == 'object') {
		pesquisaMilitar.onkeypress = function() {enter(event)};
	}
});

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))

Waves.attach('.waves_btn', 'waves-float');
Waves.init();