<?php
	$slides = $db->query("SELECT * FROM slides WHERE slide_status = 'ativo' ORDER BY slide_ordem");
	$slides = $slides->fetchAll();

	$pracaDestaque = $db->query("SELECT * FROM destaques as a, patentes as b WHERE a.tipo = 'praca' AND a.patente = b.pat_id ORDER by a.id DESC LIMIT 1");
	$pracaDestaque = $pracaDestaque->fetch();

	$oficialDestaque = $db->query("SELECT * FROM destaques as a, patentes as b WHERE a.tipo = 'oficial' AND a.patente = b.pat_id ORDER by a.id DESC LIMIT 1");
	$oficialDestaque = $oficialDestaque->fetch();

	$soldados = $db->query("SELECT id, nome, patente FROM alistados WHERE patente = '1' ORDER BY id DESC LIMIT 4");
	$soldados = $soldados->fetchAll();

	$avisos = $db->query("SELECT * FROM avisos ORDER BY id DESC");
	$avisos = $avisos->fetchAll();

	$emblema_gratis = $db->query("SELECT * FROM mercado_gratis as a, perfil_emblemas as b WHERE b.pemb_id = a.g_emb_id AND g_status = 'ativo' ORDER BY a.g_emb_id DESC");
	$oferta = $emblema_gratis->fetch();

	$acessoRapido = $db->query("SELECT * FROM acesso_rapido WHERE ac_status = 'ativo' ORDER BY ac_id");
	$acessoRapido = $acessoRapido->fetchAll();

	$ultimas_noticias = $diariodb->query("SELECT * FROM dbr_noticias WHERE not_status = 'ativo' ORDER BY not_id DESC LIMIT 3");
	$ultimas_noticias = $ultimas_noticias->fetchAll();

	$oficiais = $db->query("SELECT * FROM alistados as a INNER JOIN patentes as b ON b.pat_id = a.patente LEFT JOIN visuais as c ON c.vis_nick = a.nome WHERE patente > 11 AND status = 0 AND b.pat_tipo_geral = 'oficial' ORDER BY b.pat_ordem DESC, substr(ultimapromo, 7, 4), substr(ultimapromo, 4, 2), substr(ultimapromo, 1, 2)");
	$oficiais = $oficiais->fetchAll();

	$alistadosNum = $db->query("SELECT count(*) FROM alistados");
	$alistadosNum = $alistadosNum->fetch();

	$alistadosAtivos = $db->query("SELECT count(*) FROM alistados WHERE status = 0");
	$alistadosAtivos = $alistadosAtivos->fetch();

	$alistadosInativos = $db->query("SELECT count(*) FROM alistados WHERE status <> 0");
	$alistadosInativos = $alistadosInativos->fetch();

	$relatoriosNum = $db->query("SELECT count(*) FROM relatorios");
	$relatoriosNum = $relatoriosNum->fetch();

	$forumNum = $grupodb->query("SELECT count(*) FROM forum");
	$forumNum = $forumNum->fetch();

	$emblemasNum = $db->query("SELECT count(*) FROM perfil_emblemas");
	$emblemasNum = $emblemasNum->fetch();

	if (!empty($_POST['nickname_mercado_gratis'])) {
		$usuario_emblema = strip_tags(trim($_POST['nickname_mercado_gratis']));

		$pesquisa_existencia = $db->prepare("SELECT id, nome FROM alistados WHERE nome = :usuario AND status <> 1");
		$pesquisa_existencia->bindValue(":usuario", $usuario_emblema);
		$pesquisa_existencia->execute();
		$dados_pesquisa_emb = $pesquisa_existencia->fetch();

		if ($pesquisa_existencia->rowCount() > 0) {
			$inserir = $db->prepare("INSERT INTO perfil_emblemas_alistados (pemb_id, id, pea_token, pea_mes, pea_ano) VALUES (:pemb_id, :id, :peatoken, :pea_mes, :pea_ano)");
			$inserir->bindValue(":pemb_id", $oferta['g_emb_id']);
			$inserir->bindValue(":id", $dados_pesquisa_emb['id']);
			$inserir->bindValue(":peatoken", $dados_pesquisa_emb['id'].'-'.$oferta['g_emb_id']);
			$inserir->bindValue(":pea_mes", date('m'));
			$inserir->bindValue(":pea_ano", date('y'));
			$inserir->execute();
			echo "<script>location.href='".SITE."/index.php?sucesso_emblema';</script>";
		} else {
			echo "<script>location.href='".SITE."/index.php?erro_emblema';</script>";
		}
	}

	$aniversariantes = $db->prepare("SELECT * FROM aniversarios as a, alistados as b WHERE a.aniver_usuario = b.nome AND (b.status = 0 OR b.status = 3) AND a.aniver_status = 'ativo' AND a.aniver_data = :data");
	$aniversariantes->bindValue(":data", date("d/m"));
	$aniversariantes->execute();
	$aniversariantes = $aniversariantes->fetchAll();
?>
<style>
	<?php if ($emblema_gratis->rowCount() >= 1) { ?>
	.mercado-gratis-emblema {
		background: url(<?php echo $oferta['pemb_imagem']; ?>) center no-repeat, linear-gradient(to bottom, #1c1c1c 0%, #171717 100%);
	}
	<?php } ?>
</style>
<section class="container mb-3">
	<div class="row">
		<div class="col-sm-12 col-md-6 col-lg-7 mb-3">
			<div class="card card-bope">
				<img src="https://exercitobrhb.com/images/site/fundo_caixa.png" class="card-img-top">
				<div class="card-body card-body-bope">
					<h5 class="card-title">Seja bem-vindo ao Exército Brasileiro do Habbo!</h5>
					<p class="card-text">
						O ExBR é uma das Instituições mais preocupadas com o avanço do militarismo, conduzindo a simulação militar no Habbo Hotel.<br>
						Sinta-se à vontade para olhar nosso site e ver mais sobre nossa Instituição.
					</p>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-6 col-lg-5">
			<div class="border border-3 border-preta rounded">
				<div id="carouselMain" class="carousel slide carousel_banner" data-bs-ride="carousel">
					<div class="carousel-inner">
						<?php
							$i = 0;
							foreach ($slides as $slide) {
								if ($i == 0) {
									$active = ' active';
								} else {
									$active = '';
								}
								echo '
									<div class="carousel-item carousel_banner'.$active.'">
										<a href="'.$slide['slide_link'].'" target="_blank"><img class="d-block carousel_banner" src="'.$slide['slide_imagem'].'" alt="'.$slide['slide_alt'].'" title="'.$slide['slide_titulo'].'"></a>
									</div>
								';
								$i++;
							}
						?>
					</div>
					<button class="carousel-control-prev" type="button" data-bs-target="#carouselMain" data-bs-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#carouselMain" data-bs-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</button>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="container">
	<div class="row">
		<div class="col-sm-12 col-md-3">
			<div class="card card-bope mb-3">
				<div class="card-body card-body-bope rounded-3 caixa-destaque d-flex flex-column align-items-center justify-content-center">
					<div class="membro-destaque" style="background: url(https://www.habbo.com.br/habbo-imaging/avatarimage?user=<?= $pracaDestaque['usuario'] ?>&action=std&direction=2&head_direction=3&gesture=sml&size=l) center -40px;"></div>
					<h5 class="texto-destaque my-1 fw-bold">Praça Destaque</h5>
					<h5 class="text-center"><a href="<?php echo SITE.'/perfil/'.$pracaDestaque['usuario']; ?>" target="_blank" class="texto-destaque"><?= $pracaDestaque['usuario'] ?></a></h5>
				</div>
			</div>
			<?php
				foreach ($avisos as $aviso) {
				?>
					<div class="card card-bope mb-3">
						<div class="card-body card-body-bope rounded-3">
							<div class="wrapper_aviso_grande">
								<div class="personagem_avisos" style="background: url(https://www.habbo.com.br/habbo-imaging/avatarimage?hb=image&user=<?php echo $aviso['nome']; ?>&head_direction=2&direction=2&head_direction=2&size=m) -10px -20px, url(/images/brasil50.png) center center no-repeat, #355414;">
								</div>
								<div>
									<a href="<?php echo SITE.'/perfil/'.$aviso['nome']; ?>" class="text-decoration-none text-white" target="_blank"><span class="badge bg_badge"><?php echo $aviso['nome']; ?></span></a>
									<small>Aviso Militar</small>
								</div>
							</div>
							<div class="aviso_menor">
								<span class="badge bg_badge"><?php echo $aviso['nome']; ?></span><br>
								<small>Aviso Militar</small>
							</div>
							<br>
							<p class="card-text clearfix fonte_aviso"><?php echo $aviso['aviso']; ?></p>
						</div>
					</div>
				<?php
				}
			?>
			<a class="btn btn-primary btn-bluewood p-3 mb-3 waves_btn w-100" role="button" href="<?php echo SITE; ?>/melhoresdasemana.php" target="_blank">
				<h5 class="texto_sombreado">MELHORES DA SEMANA</h5>
				<small>Confira o Ranking dos Melhores da Semana</small>
			</a>
			<div class="card card-bope mb-3">
				<div class="card-header card-header-bope">
					Grupos Externos
				</div>
				<div class="card-body card-body-bope text-center">
					<h5 class="card-title text-light">Especialize-se em uma área militar, construa e sua carreira.</h5>
					<p class="card-text text-white">Aumente suas funções e adquira experiência, você pode participar de quantos grupos desejar.</p>
					<a href="<?= SITE ?>/conteudo/externos/grupos" class="btn btn-primary btn_verde_oliva waves_btn" target="_blank">Saiba mais</a>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-6">
			<div class="card card-bope mb-3">
				<img src="https://exercitobrhb.com/images/site/fundo_caixa.png" class="card-img-top">
				<div class="card-body card-body-bope">
					<h5 class="card-title">Pesquisa Militar</h5>
					<p class="card-text">Você pode pesquisar em nossos registros aqui.</p>
					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="Nome do Militar" id="pesquisaMilitar">
						<button class="btn btn-primary btn-bluewood d-flex waves_btn" type="button" id="btnPesquisaMilitar"><i class="material-icons">search</i></button>
					</div>
					<div id="wrapperResultado" class="row background_resultado mx-1 p-3 d-none"></div>
				</div>
			</div>
			<div class="modal modal-exbr fade" id="modalRegistro" tabindex="-1" aria-labelledby="modalRegistroLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Registro Militar</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body p-0">
							<img src="" class="w-100" id="imagemRegistro">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary waves_btn" data-bs-dismiss="modal">Fechar</button>
						</div>
					</div>
				</div>
			</div>
			<!--<div class="card card-bope mb-3">
				<div class="card-header card-header-bope">
					Últimas Notícias
				</div>
				<div class="list-group list-group-noticias w-auto">
					<?php
						foreach ($ultimas_noticias as $ultima_noticia) {
							echo '
								<a href="https://diario.exercitobrhb.com/noticias/'.$ultima_noticia['not_id'].'/'.$site_functions->stringToUrl($ultima_noticia['not_titulo']).'" target="_blank" class="list-group-item list-group-item-action d-flex gap-3 py-3 waves_btn">
									<div class="icon-noticia flex-shrink-0" style="background: url('.$ultima_noticia['not_avatar'].') center no-repeat;"></div>
									<div class="d-flex gap-2 w-100 justify-content-between">
										<div>
											<h6 class="mb-0">'.$ultima_noticia['not_titulo'].'</h6>
											<p class="mb-0 opacity-75">'.$ultima_noticia['not_descricao'].'</p>
										</div>
									</div>
									<small class="opacity-50 text-nowrap d-sm-none d-md-block">'.date('d/m', $ultima_noticia['not_data']).'</small>
								</a>
							';
						}
					?>
				</div>
			</div>-->
			<div class="card_ts mb-3 py-5 px-4 rounded">
				<b class="text-white d-block">Conheça o TeamSpeak!</b>
				<span class="text-warning d-block">JOGUE FALANDO POR VOZ!</span>
				<small class="text-white d-block">Leve e seguro, acesse nosso servidor. (exercitobrhb ou 45.42.160.40:9020)</small>
				<small class="d-block mt-2"><a href="<?php echo SITE; ?>/conteudo/teamspeak" class="text-white text-decoration-none" target="_blank">Saiba mais</a></small>
			</div>
			<div class="box_ad rounded mb-3">
				<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5267622704318534" crossorigin="anonymous"></script>
				<p class="text-center w-100 mb-0"><ins class="adsbygoogle w-100" style="display:block" data-ad-client="ca-pub-5267622704318534" data-ad-slot="7163285553" data-ad-format="auto" data-full-width-responsive="true"></ins></p>
				<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
			</div>
		</div>
		<div class="col-sm-12 col-md-3">
			<div class="card card-bope mb-3">
				<div class="card-body card-body-bope rounded-3 caixa-destaque d-flex flex-column align-items-center justify-content-center">
					<div class="membro-destaque" style="background: url(https://www.habbo.com.br/habbo-imaging/avatarimage?user=<?= $oficialDestaque['usuario'] ?>&action=std&direction=4&head_direction=3&gesture=sml&size=l) center -40px;"></div>
					<h5 class="texto-destaque my-1 fw-bold">Oficial Destaque</h5>
					<h5 class="text-center"><a href="<?php echo SITE.'/perfil/'.$oficialDestaque['usuario']; ?>" target="_blank" class="texto-destaque"><?= $oficialDestaque['usuario'] ?></a></h5>
				</div>
			</div>
			<div class="card card-bope mb-3">
				<div class="card-header card-header-bope">
					Acesso Rápido
				</div>
				<div class="list-group list-group-bope w-auto">
					<?php
						foreach ($acessoRapido as $acesso) {
							echo '
								<a href="'.$acesso['ac_link'].'" target="_blank" class="list-group-item list-group-item-action d-flex gap-3 py-3 waves_btn">
									<div class="icon-lista-generica flex-shrink-0"></div>
									<div class="d-flex gap-2 w-100 justify-content-between">
										<div>
											<h6 class="mb-0">'.$acesso['ac_titulo'].'</h6>
											<p class="mb-0 opacity-75">'.$acesso['ac_desc'].'</p>
										</div>
									</div>
								</a>
							';
						}
					?>
				</div>
			</div>
			<?php if ($emblema_gratis->rowCount() >= 1) { ?>
			<div class="card card-bope card-mercado-gratis mb-3">
				<div class="d-flex justify-content-center align-items-center mt-1 mb-2">
					<div class="me-3">
						<div class="mercado-gratis-emblema" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo $oferta['pemb_desc']; ?>"></div>
					</div>
					<div>
						<b><?= $oferta['pemb_titulo'] ?></b><br>
						<small>Emblema grátis</small>
					</div>
				</div>
				<div class="row mt-1">
					<?php if ($oferta['g_disponivel'] == 1) { ?>
						<script src="assets/js/countdown.js"></script>
						<script>
							const efcc_countdown = new countdown({
								target: '.countdown',
								dayWord: ' dias',
								hourWord: ' horas',
								minWord: ' minutos',
								secWord: ' segundos'
							});
						</script>
						<h5 class="text-center">Disponível em:</h5>
						<div class="countdown text-center" data-date="<?php echo date('d-m-Y', $oferta['timestamp']); ?>" data-time="<?php echo date('H:i', $oferta['timestamp']); ?>">
							<small class="day"><span class="num"></span><span class="word"></span>,</small>
							<small class="hour"><span class="num"></span><span class="word"></span>,</small>
							<small class="min"><span class="num"></span><span class="word"></span> e</small>
							<small class="sec"><span class="num"></span><span class="word"></span></small>
						</div>
					<?php } else if ($oferta['g_disponivel'] == 2) { ?>
					<div class="col-sm-12">
						<form action="#" method="POST">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Digite seu nick..." name="nickname_mercado_gratis" minlength="2" maxlength="15" required>
								<button class="btn btn-primary btn-bluewood d-flex waves_btn" type="submit"><i class="material-icons">send</i></button>
							</div>
						</form>
					</div>
					<?php } else { ?>
						<h5 class="text-center">Emblema esgotado!</h5>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
			<div class="card card-bope card_novos_membros text-center mb-3">
				<?php
					if (count($soldados) > 0) {
						foreach ($soldados as $soldado) {
							echo '<img class="novo_membro" src="https://www.habbo.com.br/habbo-imaging/avatarimage?user='.$soldado['nome'].'&action=wav&direction=3&head_direction=3&gesture=sml&size=b" data-bs-toggle="tooltip" data-bs-placement="bottom" title="'.$soldado['nome'].'">';
						}
					}
				?>
			</div>
			<?php
				if (count($aniversariantes) > 0) {
			?>
				<!--<div class="card card-bope card_aniversariante mb-3">
					<strong>Feliz Aniversário!</strong>
					<?php
						$i = 0;
						$iPenultimo = count($aniversariantes) - 1;
						foreach($aniversariantes as $aniversariante){
							$i++;
							echo $aniversariante['aniver_usuario'];
							if ($i < $iPenultimo){
								echo ", ";
							} else if ($i == $iPenultimo){
								echo " e ";
							}
						}
					?>
				</div>-->
			<?php
				}
			?>
		</div>
	</div>
</section>
<section class="bg_fundo_infos">
	<div class="container">
		<div class="row py-4">
		<div class="col-sm-12 col-md-4 text-center text-white">
				<h2><i class="fas fa-crosshairs"></i><h2>
				<h3>SIMULAÇÃO REALÍSTICA</h3>
				<p>O Exército Brasileiro se preocupa em gerar uma experiência inovador e única para seus militares.</p>
			</div>
			<div class="col-sm-12 col-md-4 text-center text-white">
				<h2><i class="fas fa-globe-americas"></i></h2>
				<h3>COMUNIDADE MUNDIAL</h3>
				<p>Nossa comunidade é composta por pessoas de todo o mundo. Todos os membros do Exército Brasileiro possuem idade e interesses parecidos com o seus.</p>
			</div>
			<div class="col-sm-12 col-md-4 text-center text-white">
				<h2><i class="far fa-compass"></i></h2>
				<h3>AMPLA EXPERIÊNCIA</h3>
				<p>Aqui você aprenderá sobre as forças armadas reais, fará moedas, ganhará promoções, nomeações, e aprenderá habilidades básicas que poderá usar para o mundo real.</p>
			</div>
		</div>
	</div>
</section>
<section class="bg-tom">
	<div class="container py-3 text-center">
		<img src="https://exercitobrhb.com/images/logos/logo_exercito.png" class="brasao">
		<div class="my-2 pb-5">
			<?php
				error_reporting(0);
				$oficiaisLista = array();

				foreach($oficiais as $oficial){
					$oficiaisLista[$oficial['pat_categoria']][] = array("nome" =>$oficial['nome'], "patente" => $oficial['pat_id'], "patente_nome" => $oficial['pat_nome'], "estrelas" => $oficial['pat_estrelas'], "visual" => $oficial['vis_figure']);
				}
				$categorias = array("oficial_general", "oficial_superior", "oficial_intermediario", "oficial_subalterno", "aspirante");

				foreach($categorias as $categoria){
					foreach($oficiaisLista[$categoria] as $oficial_cdo){
						if ($oficial_cdo['visual']) {
							$figure = "https://www.habbo.com.br/habbo-imaging/avatarimage?figure=".$oficial_cdo['visual']."&head_direction=3";
						} else {
							$figure = "https://www.habbo.com.br/habbo-imaging/avatarimage?user=".$oficial_cdo['nome']."&head_direction=3";
						}

						echo "
						<div class=\"d-inline-block oficais_corpo_de_oficais\">
							<a href=\"/perfil/".$oficial_cdo['nome']."\" target=\"_blank\"><img data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"".$oficial_cdo['patente_nome'].", ".$oficial_cdo['nome']."\" src=\"".$figure."\" /></a>
						</div>
						";
					}	
					echo "<br>";
				}
				error_reporting(E_ALL);
			?>
		</div>
		<h4 class="text-center text-white">- CORPO DE OFICIAIS -</h4>
	</div>
</section>
<section class="bg_fundo_estatisticas mb-4">
	<div class="container">
		<div class="row py-4">
			<div class="col-sm-12 col-md-4 text-center text-white">
				<h3><?= $alistadosNum["count(*)"]; ?> militares</h3>
				<p>Atualmente contamos com <?= $alistadosNum["count(*)"]; ?> alistados, com cerca de <?= $alistadosAtivos["count(*)"]; ?> ativos e <?= $alistadosInativos["count(*)"]; ?> inativos.</p>
			</div>
			<div class="col-sm-12 col-md-4 text-center text-white">
				<h3>Inovação</h3>
				<p>Um dos grandes diferenciais do Exército Brasileiro é sua capacidade de inovar no militarismo, com novos grupos, funções, sites e sistemas.</p>
			</div>
			<div class="col-sm-12 col-md-4 text-center text-white">
				<h3><?= $emblemasNum["count(*)"] ?> emblemas</h3>
				<p>Para completar seu perfil no ExBR, você pode colecionar emblemas!</p>
			</div>
		</div>
	</div>
</section>
<section class="mb-3">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 box_ad rounded">
				<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=" crossorigin="anonymous"></script>
				<p class="text-center w-100 mb-0"><ins class="adsbygoogle w-100" style="display:block" data-ad-client="" data-ad-slot="" data-ad-format="auto" data-full-width-responsive="true"></ins></p>
				<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
			</div>
		</div>
	</div>
</section>
<?php
	if (isset($_GET['sucesso_emblema'])) {
		$alerta_user = "alertar('Emblema adquirido com sucesso!', 'Você adquiriu o emblema do Mercado Grátis com sucesso!', 'success');";
	}
	if (isset($_GET['erro_emblema'])) {
		$alerta_user = "alertar('Erro ao adquirir emblema!', 'Você precisa ser alistado no Exército Brasileiro com status Ativo, Aposentado ou Insigne para pegar emblemas!', 'danger');";
	}
?>