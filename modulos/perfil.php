<?php
	$usuarioPesquisado = explode("/", $_SERVER['REQUEST_URI'])[2];

	if ($usuarioPesquisado == 'Cmdte-Anonimo') {
		$usuarioPesquisado = "Anonimo";
	}

	$pesquisa = $db->prepare("SELECT * FROM alistados as a, patentes as b WHERE nome = :usuario AND b.pat_id = a.patente");
	$pesquisa->bindValue(':usuario', $usuarioPesquisado);
	$pesquisa->execute();

	$dadosUsuario = $pesquisa->fetch();
	$qtdUsuario = $pesquisa->rowCount();

	if ($qtdUsuario >= 1) {
		$basicData = $site_functions->curl("https://habbo.com.br/api/public/users?name=$usuarioPesquisado");
		$dataCriacao = explode("T", $basicData->memberSince);
		$dataCriacao = $dataCriacao[0];
		$dataCriacao = explode("-", $dataCriacao);
		$dataCriacao = "$dataCriacao[2]/$dataCriacao[1]/$dataCriacao[0]";

		$db->query("UPDATE `alistados` SET `uniqueId` = '$basicData->uniqueId' WHERE `id` = ".$dadosUsuario['id']);

		if (!empty($basicData->uniqueId)) {
			if ($basicData->profileVisible == true) {
				$advancedData = $site_functions->curl("https://www.habbo.com.br/api/public/users/{$basicData->uniqueId}/profile");

				foreach($advancedData->badges as $b){
					$emblemasSelecionados[] = $b;
				}

				foreach($advancedData->rooms as $h){
					$roomsSelecionados[] = $h->name;
				}

				foreach($advancedData->groups as $i){
					$groupsSelecionados[] = $i->name;
				}

				$atualiza = $db->prepare("UPDATE alistados SET perfil_emblemas = :pemblemas, perfil_grupos = :pgrupos, perfil_quartos = :pquartos WHERE id = :id");
				$atualiza->bindValue(':pemblemas', json_encode($emblemasSelecionados));
				$atualiza->bindValue(':pgrupos', json_encode($groupsSelecionados));
				$atualiza->bindValue(':pquartos', json_encode($roomsSelecionados));
				$atualiza->bindValue(':id', $dadosUsuario['id']);
				$atualiza->execute();
			}
		}

		$contaPerfil = $db->prepare("UPDATE alistados SET perfil_acessos = perfil_acessos + 1 WHERE id = :id");
		$contaPerfil->bindValue(':id', $dadosUsuario['id']);
		$contaPerfil->execute();

		$emblemas = $db->prepare("SELECT * FROM perfil_emblemas_alistados as a, perfil_emblemas as b WHERE a.id = :id AND b.pemb_id = a.pemb_id AND b.pemb_status = 'ativo' AND b.pemb_raro = '0' order by a.pea_id DESC");
		$emblemas->bindValue(':id', $dadosUsuario['id']);
		$emblemas->execute();
		$emblemasQtd = $emblemas->rowCount();
		$emblemas = $emblemas->fetchAll();

		$emblemas2 = $db->prepare("SELECT * FROM perfil_emblemas_alistados as a, perfil_emblemas as b WHERE a.id = :id AND b.pemb_id = a.pemb_id AND b.pemb_status = 'ativo' AND b.pemb_raro = '1' order by a.pea_id DESC");
		$emblemas2->bindValue(':id', $dadosUsuario['id']);
		$emblemas2->execute();
		$emblemasQtd2 = $emblemas2->rowCount();
		$emblemas2 = $emblemas2->fetchAll();

		$historico_promo = $db->prepare("SELECT * FROM diario_oficial_acoes as a, patentes as b WHERE d_promo_id = :id AND b.pat_id = a.d_promo_patente ORDER BY d_id DESC");
		$historico_promo->bindValue(':id', $dadosUsuario['id']);
		$historico_promo->execute();
		$historico_promo = $historico_promo->fetchAll();

		$medalhas = $db->prepare("SELECT * FROM medalhas a INNER JOIN medalhas_alistados b ON b.alistado_id = :id AND b.med_id = a.med_id WHERE a.med_status = 'ativo' order by a.med_ordem DESC");
		$medalhas->bindValue(':id', $dadosUsuario['id']);
		$medalhas->execute();
		$medalhas = $medalhas->fetchAll();

		$titulos = $db->prepare("SELECT * FROM perfil_titulos a INNER JOIN perfil_titulos_alistados b ON b.id = :id AND b.ptit_id = a.ptit_id WHERE a.ptit_status = 'ativo' order by a.ptit_id DESC");
		$titulos->bindValue(':id', $dadosUsuario['id']);
		$titulos->execute();
		$titulos = $titulos->fetchAll();
?>
		<section class="row mx-1">
			<div class="col-sm-6">
				<div class="bg-tom2 row rounded-3 py-3 mb-3">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xl-4 d-flex align-items-center justify-content-center">
						<div class="avatar-perfil mb-3" style="background: url(https://www.habbo.com.br/habbo-imaging/avatarimage?user=<?= $dadosUsuario['nome'] ?>&action=std&direction=2&head_direction=2&gesture=sml&size=l) center -40px;"></div>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 d-flex flex-column align-items-center justify-content-center">
						<p class="bg-tom w-100 mb-2 p-2 rounded-3"><i class="bi bi-person-circle me-1"></i> <?= $dadosUsuario['nome'] ?></p>
						<p class="bg-tom w-100 mb-2 p-2 rounded-3"><i class="bi bi-person-add me-1"></i> Criado em <?= $dataCriacao ?></p>
						<p class="bg-tom w-100 mb-2 p-2 rounded-3"><i class="bi bi-person-badge me-1"></i> Alistado em <?= $dadosUsuario['registrado'] ?></p>
						<p class="bg-tom w-100 mb-2 p-2 rounded-3"><i class="bi bi-file-medical me-1"></i> <?= $dadosUsuario['pat_nome'] ?> <img src="<?= $dadosUsuario['pat_distintivo'] ?>" style="height: 20px;"></p>
					</div>
				</div>
				<div class="bg-tom2 row rounded-3 mb-3">
					<div class="header-caixas-perfil">
						Emblemas raros
					</div>
					<div class="body-caixas-perfil caixa-emblemas">
						<?php
							foreach ($emblemas2 as $emblemararo) {
								$link = $emblemararo['pemb_imagem'];
								$tooltip = $emblemararo['pemb_titulo'].' - '.$emblemararo['pemb_desc'];
								echo "<img src=\"$link\" class=\"perfil-emblema-raro\" data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" data-bs-title=\"$tooltip\">";
							}
						?>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="bg-tom2 caixa-direita row rounded-3 mb-3">
					<div class="header-caixas-perfil">
						Histórico
					</div>
					<div class="body-caixas-perfil caixa-grande-perfil">
						<?php
							foreach ($historico_promo as $historico) {
								$data = $historico['d_data'];
								$patente_nova = $historico['pat_nome'];
								$quempromoveu =  $historico['d_oficial'];

								if ($historico['d_tipo'] == 'promocao') {
									$palavra = "promoveu";
									$frase = "$data - $quempromoveu promoveu $usuarioPesquisado para $patente_nova";
								} else if ($historico['d_tipo'] == 'alistamento') {
									$frase = "$quempromoveu alistou $usuarioPesquisado.";
								} else {
									$frase = "$data - $quempromoveu rebaixou $usuarioPesquisado para $patente_nova";
								}

								echo "<p class=\"bg-tom2 w-100 mb-2 p-2 rounded-3\">$frase.</p>";
							}
						?>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="bg-tom2 row rounded-3 mb-3">
					<div class="header-caixas-perfil">
						Honrarias
					</div>
					<div class="body-caixas-perfil caixa-grande-perfil d-flex flex-column align-items-center">
						<?php
							if ($dadosUsuario['honraria_1'] <> "nao") {
								$nome = 'Ordem do Cruzeiro do Sul';

								if ($dadosUsuario['honraria_1'] == 1) {
									$grau = "<img src=\"https://exercitobrhb.com/images/paginas/honraria/gra.png\" class=\"perfil-emblema-honraria me-2\">";
									$texto = 'Grã-Cruz';
								} else if($dadosUsuario['honraria_1'] == 2) {
									$grau = "<img src=\"https://exercitobrhb.com/images/paginas/honraria/comendador.png\" class=\"perfil-emblema-honraria me-2\">";
									$texto = 'Comendador';
								} else if($dadosUsuario['honraria_1'] == 3) {
									$grau = "<img src=\"https://exercitobrhb.com/images/paginas/honraria/cavaleiro.png\" class=\"perfil-emblema-honraria me-2\">";
									$texto = 'Cavaleiro';
								}
								$descricao = '<p class="mt-1 mb-0">'.$grau.$texto.'</p>';

								echo "
								<div class=\"bg-tom2 row w-100 mb-2 p-2 rounded-3\">
									<div class=\"col-3 d-flex justify-content-center align-items-center\">
										<img src=\"https://exercitobrhb.com/images/paginas/honraria/honraria_1.png\" class=\"perfil-honraria\">
									</div>
									<div class=\"col-9 d-flex flex-column justify-content-center\">
										<p class=\"fw-bold mb-0\">$nome</p>
										$descricao
									</div>
								</div>";
							}

							if ($dadosUsuario['honraria_2'] <> "nao") {
								$nome = 'Ordem Militar de Avis';

								if ($dadosUsuario['honraria_2'] == 1) {
									$grau = "<img src=\"https://exercitobrhb.com/images/paginas/honraria/gra.png\" class=\"perfil-emblema-honraria me-2\">";
									$texto = 'Grã-Cruz';
								} else if($dadosUsuario['honraria_2'] == 2) {
									$grau = "<img src=\"https://exercitobrhb.com/images/paginas/honraria/comendador.png\" class=\"perfil-emblema-honraria me-2\">";
									$texto = 'Comendador';
								} else if($dadosUsuario['honraria_2'] == 3) {
									$grau = "<img src=\"https://exercitobrhb.com/images/paginas/honraria/cavaleiro.png\" class=\"perfil-emblema-honraria me-2\">";
									$texto = 'Cavaleiro';
								}
								$descricao = '<p class="mt-1 mb-0">'.$grau.$texto.'</p>';

								echo "
								<div class=\"bg-tom2 row w-100 mb-2 p-2 rounded-3\">
									<div class=\"col-3 d-flex justify-content-center align-items-center\">
										<img src=\"https://exercitobrhb.com/images/paginas/honraria/honraria_2.png\" class=\"perfil-honraria\">
									</div>
									<div class=\"col-9 d-flex flex-column justify-content-center\">
										<p class=\"fw-bold mb-0\">$nome</p>
										$descricao
									</div>
								</div>";
							}

							if ($dadosUsuario['honraria_3'] <> "nao") {
								$nome = 'Ordem da Torre e Espada, Da Infantaria, Lealdade e Mérito';

								if ($dadosUsuario['honraria_3'] == 1) {
									$grau = "<img src=\"https://exercitobrhb.com/images/paginas/honraria/gra.png\" class=\"perfil-emblema-honraria me-2\">";
									$texto = 'Grã-Cruz';
								} else if($dadosUsuario['honraria_3'] == 2) {
									$grau = "<img src=\"https://exercitobrhb.com/images/paginas/honraria/comendador.png\" class=\"perfil-emblema-honraria me-2\">";
									$texto = 'Comendador';
								} else if($dadosUsuario['honraria_3'] == 3) {
									$grau = "<img src=\"https://exercitobrhb.com/images/paginas/honraria/cavaleiro.png\" class=\"perfil-emblema-honraria me-2\">";
									$texto = 'Cavaleiro';
								}
								$descricao = '<p class="mt-1 mb-0">'.$grau.$texto.'</p>';

								echo "
								<div class=\"bg-tom2 row w-100 mb-2 p-2 rounded-3\">
									<div class=\"col-3 d-flex justify-content-center align-items-center\">
										<img src=\"https://exercitobrhb.com/images/paginas/honraria/honraria_3.png\" class=\"perfil-honraria\">
									</div>
									<div class=\"col-9 d-flex flex-column justify-content-center\">
										<p class=\"fw-bold mb-0\">$nome</p>
										$descricao
									</div>
								</div>";
							}
						?>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="bg-tom2 caixa-direita row rounded-3 mb-3">
					<div class="header-caixas-perfil">
						Emblemas
					</div>
					<div class="body-caixas-perfil caixa-emblemas caixa-grande-perfil">
						<?php
							foreach ($emblemas as $emblema) {
								$link = $emblema['pemb_imagem'];
								$tooltip = $emblema['pemb_titulo'].' - '.$emblema['pemb_desc'];
								echo "<img src=\"$link\" class=\"perfil-emblema\" data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" data-bs-title=\"$tooltip\">";
							}
						?>
					</div>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="bg-tom2 row rounded-3 mb-3">
					<div class="header-caixas-perfil">
						Títulos
					</div>
					<div class="body-caixas-perfil caixa-grande-perfil d-flex flex-column align-items-center">
						<?php
							foreach ($titulos as $titulo) {
								$nome = $titulo['ptit_titulo'];
								$descricao = $titulo['ptit_desc'];
								$imagem = $titulo['ptit_imagem'];
								
								if (!empty($imagem2)) {
									$imagem2 = '<br>'.$titulo['ptit_imagem2'];
								} else {
									$imagem2 = '';
								}

								echo "
								<div class=\"bg-tom2 caixa-titulo row w-100 mb-2 p-2 rounded-3\">
									<div class=\"col-3 d-flex justify-content-center align-items-center\">
										<img src=\"$imagem\" class=\"perfil-medalha\">
									</div>
									<div class=\"col-9 d-flex flex-column justify-content-center\">
										<p class=\"mb-0 fw-bold\">$nome</p>
										$descricao$imagem2
									</div>
								</div>";
							}
						?>
					</div>
				</div>
			</div>
		</section>
<?php
	} else {
?>
		<section class="row my-3">
			<div class="col-2 d-flex justify-content-center align-content-center">
				<img src="https://exercitobrhb.com/images/icons/inexistente.png"> 
			</div>
			<div class="col-10 d-flex align-content-center">
				<h3>Este usuário não existe!</h3>
			</div>
		</section>
		<?php
	}
?>