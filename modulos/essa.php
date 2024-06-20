<?php
	if (isset($_POST['nome']) AND !empty($_POST['nome']) AND isset($_POST['email']) AND !empty($_POST['email']) AND isset($_POST['nickname']) AND !empty($_POST['nickname'])) {
		$mensagemInscricao = '<h1>Ficha de inscrição - EsSA</h1>
		<p><b>Nome:</b> '.$_POST['nome'].'
		<p><b>Nick:</b> '.$_POST['nickname'].'
		<p><b>"Qual é a função de um Aluno da EsSA?"</b> '.$_POST['perg_1'].'
		<p><b>"Cite pelo menos uma regra do Treinamento Básico I."</b> '.$_POST['perg_2'].'
		<p><b>"Como reconhecer o Oficial Responsável pelo Treinamento?"</b> '.$_POST['perg_3'].'
		<p><b>"O que são as siglas de treinamento?"</b> '.$_POST['perg_4'].'
		<p><b>"Caso o treinador peça para você avaliar ele de forma específica você faria? Justifique."</b> '.$_POST['perg_5'].'
		<hr>';
		$site_functions->mail('essa@exercitobrhb.com', "exbrhbessa@gmail.com", "INSCRIÇÃO - {$_POST['nickname']}", $mensagemInscricao);
		
		$mensagemConfirmacao = '<meta charset="UTF-8"><div id=":lw" class="a3s aXjCH m15d9a3a1471d0cb2"><div style="margin: 0; padding: 0;"><table style="min-width: 348px;" border="0" width="100%" cellspacing="0" cellpadding="0"><tbody><tr align="center"><td width="32px">&nbsp;</td><td><table style="max-width: 600px;" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td><table border="0" width="100%" cellspacing="0" cellpadding="0"><tbody><tr><td align="left"><span style="font-family: Titillium Web,sans-serif; font-size: 20px; color: #202020; font-weight: bold; line-height: 1.5; padding: 4px 0;">Ex&eacute;rcito Brasileiro - Habbo</span></td><td align="right"><img class="CToWUd" style="display: block; width: 32px; height: 32px;" src="https://exercitobrhb.com/images/icones-grupo/normal/aberto.png" width="32" height="32"/></td></tr></tbody></table></td></tr><tr><td><table style="min-width: 332px; max-width: 600px; border: 1px solid #f0f0f0; border-bottom: 0; border-top-left-radius: 3px; border-top-right-radius: 3px;" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#242722"><tbody><tr><td colspan="3" height="12px">&nbsp;</td></tr><tr><td width="32px">&nbsp;</td><td style="font-family: monospace; font-size: 24px; color: #ffffff; line-height: 1.25; min-width: 300px;"><span style="font-weight: 800;">Escola de Sargentos das Armas - Habbo</span><br/><small><strong>Prova enviada com sucesso!</strong></small></td><td width="32px">&nbsp;</td></tr><tr><td colspan="3" height="18px">&nbsp;</td></tr></tbody></table></td></tr><tr><td><table style="min-width: 332px; max-width: 600px; border: 1px solid #f0f0f0; border-bottom: 1px solid #c0c0c0; border-top: 0; border-bottom-left-radius: 3px; border-bottom-right-radius: 3px;" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#FAFAFA"><tbody><tr><td rowspan="3" width="32px">&nbsp;</td><td>&nbsp;</td><td rowspan="3" width="32px">&nbsp;</td></tr><tr><td><table style="min-width: 300px;" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;color:#202020;line-height:1.5;padding-bottom:4px;text-align:justify;">Olá, '.$_POST['nickname'].'!<br><br>Recebemos sua prova da <span class="il">EsSA</span>!<br><br>Lembre-se que você só poderá receber os resultados caso pague os 10 câmbios.<br>Caso tenha algum problema, contate um oficial.</td><tr><td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;color:#202020;line-height:1.5;padding-top:18px;padding-bottom:18px;">Atenciosamente, Oficiais Superiores.</td></tr></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style="max-width: 600px; font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 10px; color: #bcbcbc; line-height: 1.5;">&nbsp;</td></tr><tr><td><table style="font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 10px; color: #666666; line-height: 18px; padding-bottom: 10px;"><tbody><tr><td>Este e-mail &eacute; autom&aacute;tico, utilizando uma tecnologia pr&oacute;pria do ExBR. <strong>Por favor, n&atilde;o responda. Arquivos anexados n&atilde;o ser&atilde;o aceitos.</strong></td></tr><tr><td><div style="direction: ltr; text-align: left;">&copy; '.date('Y').' Ex&eacute;rcito Brasileiro Habbo - Marechal Cmdte-Anonimo - <strong><a href="https://exercitobrhb.com/">https://exercitobrhb.com/</a></strong></div><div style="display: none!important; max-height: 0px; max-width: 0px;">et:127</div></td></tr></tbody></table></td></tr></tbody></table></td><td width="32px">&nbsp;</td></tr></tbody></table></div></div>';
		$site_functions->mail("nao-responda@exercitobrhb.com", $_POST['email'], "CONFIRMAÇÃO - ESSA", $mensagemConfirmacao);

		echo "<script>alert('SUA INSCRIÇÃO FOI FEITA COM SUCESSSO! Enviamos um e-mail para você no endereço que você nos enviou.');</script><script>location.href='https://exercitobrhb.com/conteudo/escolas-institutos/essa'</script>";
	}
?>
<div class="row">
	<div class="col-md-4 d-flex align-items-center justify-content-center flex-column">
		<p class="text-center mb-3"><img src="https://exercitobrhb.com/arquivos/2017/09/simbolo_esa2.gif"></p>
		<button class="btn btn-primary btn_verde_oliva waves_btn mt-3" type="button" data-bs-toggle="modal" data-bs-target="#modalInscri">Inscrever-se</button>
	</div>
	<div class="col-md-8">
		<h1 style="font-size:45px;"><b>ESCOLA DE SARGENTOS DAS ARMAS</b></h1>
		<p style="text-align:justify">A Escola de Sargentos das Armas do Exército Brasileiro ou EsSA é um período de formação do Praça para exercer a patente de 3° Sargento. O convocado recebe aulas preparatórias e auxilia Treinamentos a fim de obter mais experiência.</p>
		<p style="text-align:justify">O Concurso possibilita o ingresso de pessoas no Exército Brasileiro a partir de uma patente mais elevada, evitando o alistamento. Caso o Aluno atinja a média, exercerá a patente de 3° Sargento. Caso contrário, poderá exercer a patente de Cabo ou ingressar diretamente na EsSA. Para aplicação da prova é necessário o pagamento de 10 câmbios, realizados antes do início da aplicação.</p>
	</div>
</div>
<div class="modal modal-exbr fade" id="modalInscri" tabindex="-1" aria-labelledby="modalInscriLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title text-dark fs-5" id="modalInscriLabel">Prova da EsSA</h1>
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
						<label for="perg_1" class="form-label">Qual é a função de um Aluno da EsSA?</label>
						<input type="text" name="perg_1" class="form-control" id="perg_1" required>
					</div>
					<div class="mb-3">
						<label for="perg_2" class="form-label">Cite pelo menos uma regra do Treinamento Básico I.</label>
						<input type="text" name="perg_2" class="form-control" id="perg_2" required>
					</div>
					<div class="mb-3">
						<label for="perg_3" class="form-label">Como reconhecer o Oficial Responsável pelo Treinamento?</label>
						<input type="text" name="perg_3" class="form-control" id="perg_3" required>
					</div>
					<div class="mb-3">
						<label for="perg_4" class="form-label">O que são as siglas de treinamento?</label>
						<input type="text" name="perg_4" class="form-control" id="perg_4" required>
					</div>
					<div class="mb-3">
						<label for="perg_5" class="form-label">Caso o treinador peça para você avaliar ele de forma específica você faria? Justifique.</label>
						<input type="text" name="perg_5" class="form-control" id="perg_5" required>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" required>
						<label class="form-check-label" for="flexCheckDefault">
							Compreendo que ao enviar as minhas respostas da prova só terei o resultado da mesma após o pagamento de 10c.
						</label>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary waves_btn" data-bs-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-primary waves_btn">Enviar</button>
				</div>
			</form>
		</div>
	</div>
</div>