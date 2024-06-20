<?php if ($path AND $modulo_frame) { ?>
	<?php
		$pracaDestaque = $db->query("SELECT * FROM destaques as a, patentes as b WHERE a.tipo = 'praca' AND a.patente = b.pat_id ORDER by a.id DESC LIMIT 1");
		$pracaDestaque = $pracaDestaque->fetch();

		$oficialDestaque = $db->query("SELECT * FROM destaques as a, patentes as b WHERE a.tipo = 'oficial' AND a.patente = b.pat_id ORDER by a.id DESC LIMIT 1");
		$oficialDestaque = $oficialDestaque->fetch();

		$soldados = $db->query("SELECT id, nome, patente FROM alistados WHERE patente = '1' ORDER BY id DESC LIMIT 4");
		$soldados = $soldados->fetchAll();

		$acessoRapido = $db->query("SELECT * FROM acesso_rapido WHERE ac_status = 'ativo' ORDER BY ac_id");
		$acessoRapido = $acessoRapido->fetchAll();
	?>
	<section class="container mb-3">
		<div class="row">
			<div class="col-sm-12 col-md-8 mb-3">
				<div class="card card-bope mb-3">
					<div class="card-header card-header-bope">
						<?php echo $pagina['pag_titulo']; ?>
					</div>
					<div class="card-body card-body-bope">
						<?php
							if (!empty($pagina['pag_arquivo_php']) AND file_exists($path) AND is_readable($path)) {
								require_once($path);
							} else if (!empty($pagina['pag_texto'])) {
								echo $pagina['pag_texto'];
							}
						?>
					</div>
				</div>
				<div class="d-flex justify-content-center box_ad rounded">
					<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1724764367903153" crossorigin="anonymous"></script>
					<p class="text-center w-100 mb-0"><ins class="adsbygoogle w-100" style="display:block" data-ad-client="ca-pub-1724764367903153" data-ad-slot="9979004513" data-ad-format="auto" data-full-width-responsive="true"></ins></p>
					<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
				</div>
			</div>
			<div class="col-sm-12 col-md-4">
				<div class="card card-bope mb-3">
					<div class="card-body card-body-bope rounded-3 caixa-destaque d-flex flex-column align-items-center justify-content-center">
						<div class="membro-destaque" style="background: url(https://www.habbo.com.br/habbo-imaging/avatarimage?user=<?= $pracaDestaque['usuario'] ?>&action=std&direction=2&head_direction=3&gesture=sml&size=l) center -40px;"></div>
						<h5 class="texto-destaque my-1 fw-bold">Praça Destaque</h5>
						<h5 class="text-center"><a href="<?php echo SITE.'/perfil/'.$pracaDestaque['usuario']; ?>" target="_blank" class="texto-destaque"><?= $pracaDestaque['pat_nome']; ?> <?= $pracaDestaque['usuario'] ?></a></h5>
					</div>
				</div>
				<div class="card card-bope mb-3">
					<div class="card-body card-body-bope rounded-3 caixa-destaque d-flex flex-column align-items-center justify-content-center">
						<div class="membro-destaque" style="background: url(https://www.habbo.com.br/habbo-imaging/avatarimage?user=<?= $oficialDestaque['usuario'] ?>&action=std&direction=2&head_direction=3&gesture=sml&size=l) center -40px;"></div>
						<h5 class="texto-destaque my-1 fw-bold">Oficial Destaque</h5>
						<h5 class="text-center"><a href="<?php echo SITE.'/perfil/'.$oficialDestaque['usuario']; ?>" target="_blank" class="texto-destaque"><?= $oficialDestaque['pat_nome']; ?> <?= $oficialDestaque['usuario'] ?></a></h5>
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
				<div class="card card-bope card_novos_membros text-center mb-3">
					<?php
						if (count($soldados) > 0) {
							foreach ($soldados as $soldado) {
								echo '<img class="novo_membro" src="https://www.habbo.com.br/habbo-imaging/avatarimage?user='.$soldado['nome'].'&action=wav&direction=3&head_direction=3&gesture=sml&size=b" data-bs-toggle="tooltip" data-bs-placement="bottom" title="'.$soldado['nome'].'">';
							}
						}
					?>
				</div>
				<div class="d-flex justify-content-center box_ad rounded">
					<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=" crossorigin="anonymous"></script>
					<p class="text-center w-100 mb-0"><ins class="adsbygoogle w-100" style="display:block" data-ad-client="" data-ad-slot="" data-ad-format="auto" data-full-width-responsive="true"></ins></p>
					<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
				</div>
			</div>
		</div>
	</section>
<?php } ?>