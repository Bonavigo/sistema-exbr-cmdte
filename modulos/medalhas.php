<?php
	$medalhas = $db->prepare("SELECT * FROM medalhas WHERE med_status = 'ativo' ORDER BY med_ordem DESC");
	$medalhas->execute();
	$medalhas = $medalhas->fetchAll();

	foreach ($medalhas as $medalha) {
		$nome = $medalha['med_nome'];
		if ($medalha['med_sobre'] == strip_tags($medalha['med_sobre'])) {
			$descricao = '<p class="text-center">'.$medalha['med_sobre'].'</p>';
		} else {
			$descricao = '';
		}
		$imagem = 'https://exercitobrhb.com/'.$medalha['med_url'];

		echo "
		<section class=\"row caixa-medalha-pagina-medalhas\">
			<div class=\"col-sm-4 d-flex justify-content-center\">
				<img src=\"$imagem\" class=\"imagem-medalha-pagina-medalhas\">
			</div>
			<div class=\"col-sm-8 d-flex flex-column justify-content-center\">
				<p class=\"text-center mb-0 fw-bold\">$nome</p>
				$descricao
			</div>
		</section>
		";
	}
?>