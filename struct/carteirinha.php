<?php
	error_reporting(0);

	$user = "PREFIXO_admin";
	$pass = "SENHA_DO_BANCO";
	$conn = new PDO('mysql:host=localhost;dbname=PREFIXO_exercito;charset=utf8', $user, $pass);

	$usuario = $_GET['usuario'];

	if (strlen($usuario) < 2 OR strlen($usuario) > 15) {
		$usuario = "Anonimo";
	} else if ($usuario == 'Cmdte-Anonimo') {
		$usuario = "Anonimo";
	}

	$usuarioInfo = $conn->query("SELECT * FROM alistados as a INNER JOIN patentes as b ON a.patente = b.pat_id WHERE a.nome = '$usuario'");
	$usuarioInfoF = $usuarioInfo->fetchAll(PDO::FETCH_ASSOC);

	foreach ($usuarioInfoF as $row) {
		//Verificação das patentes
		if (!empty($row['T12'])) {
			$treino = "*";
		} else if (!empty($row['I1'])) {
			$treino = "<I1>";
		} else if (!empty($row['I2'])) {
			$treino = "<I2>";
		} else if (!empty($row['Tc1'])) {
			$treino = "<Tc1>";
		} else if (!empty($row['Tc2'])) {
			$treino = "<Tc2>";
		} else if (!empty($row['T1'])) {
			$treino = "<T1>";
		} else if (!empty($row['T2'])) {
			$treino = "<T2>";
		} else if (!empty($row['T3'])) {
			$treino = "<T3>";
		} else if (!empty($row['T4'])) {
			$treino = "<T4>";
		} else if (!empty($row['TP1'])) {
			$treino = "<Tp1>";
		} else if (!empty($row['TP2'])) {
			$treino = "<Tp2>";
		} else if (!empty($row['R'])) {
			$treino = $row['R'];
		}
				
		if ($row['status'] == 0 AND $row['pat_id'] <> 22) { //Se for ativo e nço for o marechal
			if ($row['pat_tipo_geral'] == "praca") { //Praça ativo
				$resultado[] = array("nome" => $row['nome'], "patente" => $row['pat_nome'], "treino" => $treino, "promovido" => $row['ultimapromo'], "status" => "ativo", "promovidopor" => $row['promovidopor']);
			} else if ($row['pat_tipo_geral'] == "oficial") { //Oficial ativo
				$resultado[] = array("nome" => $row['nome'], "patente" => $row['pat_nome'], "cp" => $row['cp'], "promovido" => $row['ultimapromo'], "status" => "ativo", "promovidopor" => $row['promovidopor']);
			}	
		} else if ($row['status'] == 1) { //Se for demitido
			if ($row['pat_tipo_geral'] == "praca") { //Praça demitido
				$resultado[] = array("nome" => $row['nome'], "patente" => $row['pat_nome'], "treino" => $treino, "promovido" => $row['ultimapromo'], "status" => "demitido", "motivo" => $row['motivo'], "promovidopor" => $row['promovidopor']);
			} else if ($row['pat_tipo_geral'] == "oficial") { //Oficial demitido
				$resultado[] = array("nome" => $row['nome'], "patente" => $row['pat_nome'], "cp" => $row['cp'], "promovido" => $row['ultimapromo'], "status" => "demitido", "motivo" => $row['motivo'], "promovidopor" => $row['promovidopor']);
			}		
		} else if ($row['status'] == 3) { //Se for aposentado, tecnicamente ele entço foi oficial, entço aparecerç tudo de um oficial
			$resultado[] = array("nome" => $row['nome'], "patente" => $row['pat_nome'], "cp" => $row['cp'], "promovido" => $row['ultimapromo'], "status" => "aposentado", "promovidopor" => $row['promovidopor']);
		} else if ($row['pat_id'] == 22) { //Se for o marechal
			$resultado[] = array("nome" => $row['nome'], "patente" => $row['pat_nome'], "status" => "ativo");
		}
		
	}

	$imagem = imagecreatefrompng("../images/registromilitar.png");
	$logocanto = imagecreatefrompng("../images/icones-grupo/normal/aberto.png");

	foreach($resultado as $a) {};

	if ($usuarioInfo->rowCount() == 0) {
		header("Location: error");
		exit;
	}

	header("Content-type:image/png");

	$image_url = "https://www.habbo.com.br/habbo-imaging/avatarimage?user=".$a['nome']."&direction=3&head_direction=3";
	$ch = curl_init();
	$timeout = 0;
	curl_setopt ($ch, CURLOPT_URL, $image_url);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);

	$image = curl_exec($ch);
	curl_close($ch);

	$avatar = imagecreatefromstring($image);

	// Cor de saçda
	$cor = imagecolorallocate( $imagem, 0, 0, 0 );
	// $corSegunda = imagecolorallocate($imagem, 91, 192, 222 );
	$corSegunda = imagecolorallocate( $imagem, 0, 0, 0 );
	$corAtivo = imagecolorallocate($imagem, 0, 204, 51);
	$corInativo = imagecolorallocate($imagem, 217, 0, 0);

	imagecopymerge($imagem, $avatar, 39, 45, 0, 0, 64, 110, 100);
	imagecopymerge($imagem, $logocanto, 360, 5, 0, 0, 40, 40, 40);
	
	// Escrever nome
	imagettftext($imagem, 13, 0, 119, 18, $cor, "{$_SERVER['DOCUMENT_ROOT']}/assets/legado/font/roboto/Roboto-Bold.ttf",  "EXÉRCITO BRASILEIRO");
	imagettftext($imagem, 12, 0, 119, 40, $cor, "{$_SERVER['DOCUMENT_ROOT']}/assets/legado/font/roboto/Roboto-Light.ttf",  "IDENTIFICAÇÃO MILITAR");

	imagettftext($imagem, 9, 0, 135, 60, $corSegunda, "{$_SERVER['DOCUMENT_ROOT']}/assets/legado/font/roboto/Roboto-Medium.ttf",  "NOME");
	imagettftext($imagem, 11, 0, 135, 80, $corSegunda, "{$_SERVER['DOCUMENT_ROOT']}/assets/legado/font/roboto/Roboto-Bold.ttf",  $a['nome']);

	imagettftext($imagem, 9, 0, 135, 110, $corSegunda, "{$_SERVER['DOCUMENT_ROOT']}/assets/legado/font/roboto/Roboto-Medium.ttf",  "PATENTE");
	imagettftext($imagem, 11, 0, 135, 130, $corSegunda, "{$_SERVER['DOCUMENT_ROOT']}/assets/legado/font/roboto/Roboto-Bold.ttf",  $a['patente']);

	if (!empty($a['promovidopor'])) {
		imagettftext($imagem, 9, 0, 135, 160, $corSegunda, "{$_SERVER['DOCUMENT_ROOT']}/assets/legado/font/roboto/Roboto-Medium.ttf",  "PROMOVIDO POR");
		imagettftext($imagem, 11, 0, 135, 180, $corSegunda, "{$_SERVER['DOCUMENT_ROOT']}/assets/legado/font/roboto/Roboto-Bold.ttf",  $a['promovidopor']);
	}

	if (!empty($a['treino'])) {
		imagettftext($imagem, 9, 0, 316, 110, $corSegunda, "{$_SERVER['DOCUMENT_ROOT']}/assets/legado/font/roboto/Roboto-Medium.ttf",  "TREINOS");
		imagettftext($imagem, 11, 0, 316, 130, $corSegunda, "{$_SERVER['DOCUMENT_ROOT']}/assets/legado/font/roboto/Roboto-Bold.ttf",  $a['treino']);
	}

	if (!empty($a['promovido'])) {
		imagettftext($imagem, 7, 0, 10, 185, $cor, "{$_SERVER['DOCUMENT_ROOT']}/assets/legado/font/roboto/Roboto-Light.ttf",  "ÚLTIMA PROMOÇÃO");
		imagettftext($imagem, 11, 0, 10, 205, $cor, "{$_SERVER['DOCUMENT_ROOT']}/assets/legado/font/roboto/Roboto-Medium.ttf",  $a['promovido']);
	}


	imagettftext($imagem, 7, 0, 290, 185, $cor, "{$_SERVER['DOCUMENT_ROOT']}/assets/legado/font/roboto/Roboto-Light.ttf",  "STATUS");

	if ($a['status'] == "ativo") {
		imagettftext($imagem, 14, 0, 290, 205, $corAtivo, "{$_SERVER['DOCUMENT_ROOT']}/assets/legado/font/roboto/Roboto-Bold.ttf",  "Ativo");
	} else if ($a['status'] == "aposentado") {
		imagettftext($imagem, 14, 0, 290, 205, $corAtivo, "{$_SERVER['DOCUMENT_ROOT']}/assets/legado/font/roboto/Roboto-Bold.ttf",  "Aposentado");
	} else if ($a['status'] == "demitido") {
		imagettftext($imagem, 14, 0, 290, 205, $corInativo, "{$_SERVER['DOCUMENT_ROOT']}/assets/legado/font/roboto/Roboto-Bold.ttf",  "Demitido");
	}

	imagepng($imagem);
?>