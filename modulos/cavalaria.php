<?php
	if (isset($_POST['nome']) AND !empty($_POST['nome']) AND isset($_POST['email']) AND !empty($_POST['email']) AND isset($_POST['nickname']) AND !empty($_POST['nickname'])) {
		$mensagemInscricao = '<h1>Ficha de inscrição - Cavalaria</h1>
		<p><b>Nome:</b> '.$_POST['nome'].'
		<p><b>Nick:</b> '.$_POST['nickname'].'
		<p><b>Idade:</b> '.$_POST['idade'].'
		<p><b>Patente:</b> '.$_POST['patente'].'
		<p><b>Microfone?:</b> '.$_POST['microfone'].'
		<p><b>Motivo de participação:</b> '.$_POST['textinho'].'</p>
		<hr>';
		$site_functions->mail($_POST['email'], "cavalaria@exercitobrhb.com", "INSCRIÇÃO - {$_POST['nickname']}", $mensagemInscricao);
		
		$mensagemConfirmacao = '<meta charset="UTF-8"><div id=":lw" class="a3s aXjCH m15d9a3a1471d0cb2"> <div style="margin: 0; padding: 0;"> <table style="min-width: 348px;" border="0" width="100%" cellspacing="0" cellpadding="0"> <tbody> <tr align="center"> <td width="32px">&nbsp;</td><td> <table style="max-width: 600px;" border="0" cellspacing="0" cellpadding="0"> <tbody> <tr> <td> <table border="0" width="100%" cellspacing="0" cellpadding="0"> <tbody> <tr> <td align="left"><span style="font-family: Titillium Web,sans-serif; font-size: 20px; color: #202020; font-weight: bold; line-height: 1.5; padding: 4px 0;">Ex&eacute;rcito Brasileiro - Habbo</span></td><td align="right"><img class="CToWUd" style="display: block; width: 32px; height: 32px;" src="https://exercitobrhb.com/images/icones-grupo/normal/aberto.png" width="32" height="32"/></td></tr></tbody> </table> </td></tr><tr> <td> <table style="min-width: 332px; max-width: 600px; border: 1px solid #f0f0f0; border-bottom: 0; border-top-left-radius: 3px; border-top-right-radius: 3px;" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#242722"> <tbody> <tr> <td colspan="3" height="12px">&nbsp;</td></tr><tr> <td width="32px">&nbsp;</td><td style="font-family: monospace; font-size: 24px; color: #ffffff; line-height: 1.25; min-width: 300px;"><span style="font-weight: 800;">CAVALARIA</span><br/><small><strong>Inscrição realizada com sucesso!</strong></small></td><td width="32px">&nbsp;</td></tr><tr> <td colspan="3" height="18px">&nbsp;</td></tr></tbody> </table> </td></tr><tr> <td> <table style="min-width: 332px; max-width: 600px; border: 1px solid #f0f0f0; border-bottom: 1px solid #c0c0c0; border-top: 0; border-bottom-left-radius: 3px; border-bottom-right-radius: 3px;" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#FAFAFA"> <tbody> <tr> <td rowspan="3" width="32px">&nbsp;</td><td>&nbsp;</td><td rowspan="3" width="32px">&nbsp;</td></tr><tr> <td> <table style="min-width: 300px;" border="0" cellspacing="0" cellpadding="0"> <tbody> <tr> <td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;color:#202020;line-height:1.5;padding-bottom:4px;text-align:justify;">Olá, '.$_POST['nickname'].'!<br><br>Recebemos sua inscrição para a <span class="il">Cavalaria</span>!<br>Nós tentamos selecionar os Praças mais presentes e capacitados para fazerem parte da próxima turma.<br><br>As aulas serão a noite, mas há reposições durante o dia para quem estuda/trabalha. Nós não obrigamos ninguém a entrar, porém todos que não forem interessados em participar serão reprovados.<br><br>Após a divulgação dos alunos todos devem confirmar com algum Oficial responsável sua vaga, ou a mesma será substituida na 2° chamada. Após confirmar, você deve passar seu WhatsApp para receber todas as inscrições, além de juntar-se ao Grupo do Habbo e ícone no TeamSpeak.<br><br>Desejamos uma boa sorte em sua vaga! A <span class="il">cavalaria</span> está cada vez se tornando mais admirada e divertida! Contamos com sua presença. Caso tenha dúvidas, fale com um dos reponsáveis.</td><tr> <td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;color:#202020;line-height:1.5;padding-top:18px;padding-bottom:18px;">Atenciosamente, Responsáveis da Cavalaria.</td></tr></tr></tbody> </table> </td></tr></tbody> </table> </td></tr><tr> <td style="max-width: 600px; font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 10px; color: #bcbcbc; line-height: 1.5;">&nbsp;</td></tr><tr> <td> <table style="font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 10px; color: #666666; line-height: 18px; padding-bottom: 10px;"> <tbody> <tr> <td>Este e-mail &eacute; autom&aacute;tico, utilizando uma tecnologia pr&oacute;pria do ExBR. <strong>Por favor, n&atilde;o responda. Arquivos anexados n&atilde;o ser&atilde;o aceitos.</strong></td></tr><tr> <td> <div style="direction: ltr; text-align: left;">&copy; '.date('Y').' Ex&eacute;rcito Brasileiro Habbo - Marechal Cmdte-Anonimo - <strong><a href="https://exercitobrhb.com/">https://exercitobrhb.com/</a></strong></div><div style="display: none!important; max-height: 0px; max-width: 0px;">et:127</div></td></tr></tbody> </table> </td></tr></tbody> </table> </td><td width="32px">&nbsp;</td></tr></tbody> </table> </div></div>';
		$site_functions->mail("nao-responda@exercitobrhb.com", $_POST['email'], "CONFIRMAÇÃO - CAVALARIA", $mensagemConfirmacao);

		echo "<script>alert('SUA INSCRIÇÃO FOI FEITA COM SUCESSSO! Enviamos um e-mail para você no endereço que você nos enviou. Fique atento nos meios de comunicação para verificar se você foi selecionado.');</script><script>location.href='https://exercitobrhb.com/conteudo/grupos/cavalaria'</script>";
	}
?>
<img class="img-fluid mb-3" src="https://exercitobrhb.com/images/paginas/grupos/cavalaria.png">
<div>
	<p>A Cavalaria do Exército Brasileiro é composta por regimentos e batalhões especializados em operações de reconhecimento, comunicação, união, trabalho em equipe, e mobilidade tática. Os Praças da cavalaria são treinados para operar com cavalos, tornando-se uma força versátil.</p>
	<p>Além disso, este curso é famoso por manter algumas tradições e cerimônias, que promove uma dinâmica de apresentação de alta qualidade, desempenhando um papel importante na defesa da instituição, tanto em termos de missões de combate quanto na representação cerimonial, mantendo viva a tradição da equitação militar e contribuindo para a capacidade de mobilidade e prontidão das forças armadas brasileiras.</p>
	<p>Pré-requisitos de inscrição:</p>
	<p>- Ser no mínimo Aluno da EsSA. (Cabos poderão se inscrever mediante autorização do Comandante)</p>
	<p>- Possuir cavalo.</p>
	<p>- Ter Discord, Whatsapp e ser ativo no TeamSpeak.</p>
</div>
<div class="w-100 d-flex align-items-center justify-content-center my-5">
	<button class="btn btn-primary btn_verde_oliva waves_btn" type="button" data-bs-toggle="modal" data-bs-target="#modalInscri">Inscrever-se</button>
</div>
<div class="row">
	<div class="col-sm-12 col-md-6">
		<p class="w-100 text-center">Crinas</p>
		<img src="https://exercitobrhb.com/images/paginas/grupos/crinas.png">
	</div>
	<div class="col-sm-12 col-md-6">
		<p class="w-100 text-center">Selas</p>
		<p class="w-100 text-center"><img src="https://exercitobrhb.com/images/paginas/grupos/selas.png"></p>
	</div>
</div>
<div class="row mt-5">
	<div class="col-sm-12 col-md-6">
		<p class="w-100 text-center">Cores permitidas para cavalos</p>
		<img src="https://exercitobrhb.com/images/paginas/grupos/cores_cavalo.png">
	</div>
	<div class="col-sm-12 col-md-6">
		<p class="w-100 text-center">Cores permitidas para crinas</p>
		<img src="https://exercitobrhb.com/images/paginas/grupos/cores_crina.png">
	</div>
</div>
<div class="modal modal-exbr fade" id="modalInscri" tabindex="-1" aria-labelledby="modalInscriLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title text-dark fs-5" id="modalInscriLabel">Inscrição</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="POST" action="#">
				<div class="modal-body text-dark">
					<div class="mb-3">
						<label for="nome" class="form-label">Seu nome real (Ex.: Bruno)</label>
						<input type="text" name="nome" class="form-control" id="nome" required>
					</div>
					<div class="mb-3">
						<label for="email" class="form-label">E-mail</label>
						<input type="email" name="email" class="form-control" id="email" required>
					</div>
					<div class="mb-3">
						<label for="nickname" class="form-label">Nickname</label>
						<input type="text" name="nickname" class="form-control" id="nickname" required>
					</div>
					<div class="mb-3">
						<label for="idade" class="form-label">Idade</label>
						<input type="text" name="idade" class="form-control" id="idade" required>
					</div>
					<div class="mb-3">
						<label for="patente" class="form-label">Patente</label>
						<select class="form-select" aria-label="Escolha sua patente" name="patente" id="patente" required>
							<option selected>Escolha sua patente</option>
							<option value="Aluno da EsSA">Aluno da EsSA</option>
							<option value="3° Sargento">3° Sargento</option>
							<option value="2° Sargento">2° Sargento</option>
							<option value="1° Sargento">1° Sargento</option>
							<option value="Subtenente">Subtenente</option>
							<option value="Aluno da EsPCEx">Aluno da EsPCEx</option>
							<option value="Cadete">Cadete</option>
						</select>
					</div>
					<div class="mb-3">
						<label for="microfone" class="form-label">Tem microfone?</label>
						<select class="form-select" aria-label="Tem microfone?" name="microfone" id="microfone" required>
							<option value="Sim" selected>Sim</option>
							<option value="Não">Não</option>
						</select>
					</div>
					<div class="mb-3">
						<label for="cavalo" class="form-label">Nome do cavalo</label>
						<input type="text" name="cavalo" class="form-control" id="cavalo" required>
					</div>
					<div class="mb-3">
						<label for="print" class="form-label">Print do cavalo</label>
						<input type="text" name="print" class="form-control" id="print" required>
					</div>
					<div class="mb-3">
						<label for="textinho" class="form-label">Porque você quer participar dessa cavalaria? Ficou sabendo por onde?</label>
						<input type="text" name="textinho" class="form-control" id="textinho" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary waves_btn" data-bs-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-primary waves_btn">Inscrever-me</button>
				</div>
			</form>
		</div>
	</div>
</div>