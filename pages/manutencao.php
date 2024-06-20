<?php
	if (!$_DATABASE) {
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Estamos em Manutenção - Exército Brasileiro do Habbo</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo SITE; ?>/images/icons/favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="Exército Brasileiro - Habbo - Marechal Cmdte-Anonimo - Desde 2021, a melhor instituição militar do Habbo BR/PT. Construa sua carreira, divirta-se e tenha a experiência real de ser um militar.">
	<meta property="og:site_name" content="ExBR - Marechal Cmdte-Anonimo"/>
	<meta property="og:title" content="ExBR Habbo"/>
	<meta property="og:url" content="<?php echo SITE; ?>"/>
	<meta property="og:locale" content="pt_BR">
	<meta property="og:description" content="Desde 2021 a melhor instituição militar do Habbo BR/PT. Construa sua carreira, divirta-se e tenha a experiência real de ser um militar." />
	<meta property="og:image" content="<?php echo SITE; ?>/assets/icone_card.png" />
	<meta name="theme-color" content="#36581c">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo SITE; ?>/assets/css/waves.min.css">
	<link rel="stylesheet" href="<?php echo SITE; ?>/assets/css/custom.css">
</head>
<body class="bg-tom height_100vh d-flex justify-content-center align-items-center text-white container">
	<div>
		<h3><b>Ops, parece que os fios que estavam no subsolo do Quartel General superaqueceram.</b></h3>
		<h5>Pausa para manutenção. Voltaremos em breve.<h5>
		<a role="button" class="btn btn-primary waves_btn" href="https://diario.exercitobrhb.com/">Que tal acessar as últimas notícias enquanto isso?</a>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<script src="<?php echo SITE; ?>/assets/js/waves.min.js"></script>
	<script>
		Waves.attach('.waves_btn', 'waves-float');
		Waves.init();
	</script>
</body>
</html>