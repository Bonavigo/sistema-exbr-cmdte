<?php
	require_once('app/general.php');

	if ($_GET['caminho'] && $_GET['caminhoSub']){
		$pesquisar = $site_functions->filtro($_GET['caminhoSub']);
		$pesquisarPai = $site_functions->filtro($_GET['caminho']);
		$caminhoGet = $site_functions->filtro($_GET['caminho']);
	} else if ($_GET['caminho'] && !$_GET['caminhoSub']){
		$pesquisar = $site_functions->filtro($_GET['caminho']);
		$pesquisarPai = $site_functions->filtro($_GET['caminho']);
	} else {
		$caminhoGet = "principal";
		$pesquisar = "principal";
	}

	$menus = $db->query("SELECT * FROM menu WHERE menu_status = 'ativo' ORDER BY menu_ordem");
	$menus = $menus->fetchAll();

	$submenus = $db->query("SELECT * FROM paginas WHERE pag_status = 'ativo'");
	$submenus = $submenus->fetchAll();

	$paginas = $db->prepare("SELECT * FROM paginas as a, menu as b WHERE a.pag_status = 'ativo' AND a.pag_caminho = :pagina AND a.pag_id_menu = b.menu_id LIMIT 1");
	$paginas->bindValue(':pagina', $pesquisar);
	$paginas->execute();
	$pagina = $paginas->fetch();

	if ($pesquisar == 'principal') {
		$path = 'modulos/inicial.php';
	} else if ($paginas->rowCount() == 0) {
		$path = false;
		require('pages/nao_encontrado.php');
		exit();
	} else {
		$path = "modulos/{$pagina['pag_arquivo_php']}";
		$modulo_frame = true;
		if (file_exists($path) AND is_readable($path)) {
		} else {
			require('pages/nao_encontrado.php');
			exit();
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Exército Brasileiro - Habbo Hotel</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo SITE; ?>/images/icons/favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="Exército Brasileiro - Habbo - Cmdte-Anonimo - Desde 2023, a melhor instituição militar do Habbo BR/PT. Construa sua carreira, divirta-se e tenha a experiência real de ser um militar.">
	<meta property="og:site_name" content="ExBR - Marechal Cmdte-Anonimo"/>
	<meta property="og:title" content="ExBR Habbo"/>
	<meta property="og:url" content="<?php echo SITE; ?>"/>
	<meta property="og:locale" content="pt_BR">
	<meta property="og:description" content="Desde 2023, a melhor instituição militar do Habbo BR/PT. Construa sua carreira, divirta-se e tenha a experiência real de ser um militar." />
	<meta property="og:image" content="<?php echo SITE; ?>/assets/icone_card.png" />
	<meta name="theme-color" content="#000">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo SITE; ?>/assets/css/waves.min.css">
	<link rel="stylesheet" href="<?php echo SITE; ?>/assets/css/custom.css?time=<?php echo time(); ?>">
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://kit.fontawesome.com/5bb1d8cb3e.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-xl navbar-dark bg-tom2">
			<div class="container container-fluid">
				<a class="navbar-brand d-xsm-flex d-sm-flex d-md-flex d-xl-none" href="#">Exército Brasileiro Habbo</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbar">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<?php
							foreach($submenus as $sub){
								$submenusArray[] = $sub['pag_id_menu'];
							}

							foreach($menus as $menu){
								if($pesquisarPai == $menu['menu_caminho']){
									$active = " active";
								} else {
									$active = null;
								}

								if (!in_array($menu['menu_id'], $submenusArray)){
									if(!$menu['menu_caminho']){
										$linkMenu = $menu['menu_link'];
									}else{
										$linkMenu = SITE."/conteudo/".$menu['menu_caminho'];
									}
									echo "<li class=\"nav-item\">
										<a class=\"nav-link$active\" href=\"".$linkMenu."\">".$menu['menu_nome']."</a>
									</li>";
								} else {
									echo "<li class=\"nav-item dropdown\">
									<a class=\"nav-link dropdown-toggle$active\" href=\"#\" role=\"button\" id=\"menu".$menu['menu_id']."\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">".$menu['menu_nome']."</a>
									<ul class=\"dropdown-menu\" aria-labelledby=\"menu".$menu['menu_id']."\">";

									foreach($submenus as $sub){
										if ($sub['pag_id_menu'] == $menu['menu_id']) {
											if (!empty($sub['pag_link']) AND !empty($sub['pag_titulo'])) {
												$linkSubMenu = $sub['pag_link'];
											} else {
												$linkSubMenu = SITE."/conteudo/".$menu['menu_caminho']."/".$sub['pag_caminho'];
											}
											echo "<li><a class=\"dropdown-item\" href=\"$linkSubMenu\">".$sub['pag_titulo']."</a><li>";
										}
									}

									echo "</ul>
									</li>";
								}
							}
						?>
					</ul>
					<div class="d-flex">
						<a class="btn btn-primary waves_btn" href="https://login.exercitobrhb.com" target="_blank">Painel</a>
					</div>
				</div>
			</div>
		</nav>
	</header>
	<main class="site_body pt-3 pb-3">
		<div class="container d-none mb-3" id="wrapper_aviso">
			<div class="alert alert-dismissible fade show" role="alert" id="alert_exbr">
				<strong id="alert_title"></strong><br>
				<span id="alert_message"></span>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" id="alert_close"></button>
			</div>			
		</div>
		<?php
			if ($path) {
				if (!$modulo_frame) {
					require_once($path);
				} else {
					require_once('struct/modulo_frame.php');
				}
			}
		?>
	</main>
	<footer>
		<div class="bg-tom p-4">
			<div class="container">
				<div class="row">
					<div class="col-12 col-md">
						<img class="mb-2" src="https://exercitobrhb.com/images/icones-grupo/normal/aberto.png">
						<small class="d-block text-light">© 2023 – <?php echo date("Y"); ?></small>
						<small class="d-block mb-3 text-light">Desenvolvido por <a target="_blank" class="text-white fw-bold text-decoration-none" href="https://github.com/Bonavigo">Bona</a> com base no trabalho feito por joaoguarana e Gaker.</small>
					</div>
					<div class="col-6 col-md">
						<h5 class="text-light">Siga o ExBR!</h5>
						<ul class="list-unstyled text-small">
							<li class="mb-1"><a target="_blank" class="text-white text-decoration-none" href="https://www.instagram.com/">Instagram</a></li>
						</ul>
					</div>
					<div class="col-6 col-md">
						<h5 class="text-light">Links Úteis</h5>
						<ul class="list-unstyled text-small">
							<li class="mb-1"><a target="_blank" class="text-white text-decoration-none" href="https://treinos.exercitobrhb.com/">Segunda Companhia</a></li>
							<li class="mb-1"><a target="_blank" class="text-white text-decoration-none" href="https://eventos.exercitobrhb.com/">Terceira Companhia</a></li>
							<li class="mb-1"><a target="_blank" class="text-white text-decoration-none" href="https://login.exercitobrhb.com/">Painel</a></li>
						</ul>
					</div>
					<div class="col-6 col-md">
						<h5 class="text-light">Feito com</h5>
						<ul class="list-unstyled text-small">
							<li class="mb-1"><a target="_blank" class="text-white text-decoration-none" href="https://getbootstrap.com">Bootstrap</a></li>
							<li class="mb-1"><a target="_blank" class="text-white text-decoration-none" href="https://github.com/fians/Waves">Waves</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="bg-tom2">
			<div class="container">
				<div class="row p-3 text-white text-center">
					<p class="m-0">© 2023 - <?php echo date("Y"); ?> Exército Brasileiro Habbo - Marechal Cmdte-Anonimo - <a href="https://habbo.com.br/" target="_blank" class="text-decoration-none fw-bold text-light">Habbo.com.br</a>.</p>
				</div>
			</div>
		</div>
	</footer>
	<!--<div class="div_radio">
		<div class="upper_radio">
			<a href="https://exercitobrhb.com/radio.php" target="_blank" class="buttons_radio text-decoration-none" id="nome_radio">Rádio Brasileira</a>
			<a href="javascript:void(0)" onclick="trocar_radio()" class="buttons_radio text-decoration-none">Trocar Rádio</a>
		</div>
		<div class="wrapper_radio z-depth-3" id="radio">
			<div class="controles">
				<div class="marquee_wrapper">
					<marquee class="marquee" scrolldelay="200" truespeed="" id="marquee_radio"><span>Rádio Brasileira</span></marquee>
				</div>
				<div class="wrapper_btn_controles">
					<button class="button_controle waves_btn" id="btn_control" onclick="player()"><i id="icon_control" class="fas fa-play"></i></button>
					<button class="button_controle waves_btn"><i class="fas fa-volume-up"></i> <i class="fas fa-minus" onclick="abaixar()"></i> <i class="fas fa-plus" onclick="aumentar()"></i></button>
					<audio id="player_audio" data-radio="rbr" data-status="pausada" src="https://ssl.painelcast.com:6964/;"></audio>
				</div>
			</div>
		</div>
	</div>-->
	<script src="https://login.exercitobrhb.com/js/radio.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<script src="<?= SITE ?>/assets/js/waves.min.js"></script>
	<script src="<?= SITE ?>/assets/js/exbr.js?time=<?php echo time(); ?>"></script>
	<script>
		//trocar_radio();
		const LINK_SITE = "<?php echo SITE; ?>";

		<?php
			if (isset($alerta_user)) {
				echo $alerta_user;
			}
		?>
	</script>
</body>
</html>