<?php
	require_once("../../app/general.php");
	if (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' AND $_POST['militar']) {
		$militar = strip_tags(trim($_POST['militar']));
		
		if ($militar == "Cmdte-Anonimo") {
			$militar = "Anonimo";
		}

		$termo = $militar.'%';

		$pesquisa = $db->prepare("SELECT a.nome, a.patente, b.pat_nome, b.pat_estrelas, a.registrado, a.ultimapromo, a.promovidopor, a.status, a.cp, a.motivo, a.treino2, a.treino, a.fatd, a.patrocinador, a.honraria_1, a.honraria_2, a.honraria_3, a.sobrenome, a.idade FROM alistados as a INNER JOIN patentes as b ON a.patente = b.pat_id WHERE nome LIKE :militar LIMIT 1");
		$pesquisa->bindValue(':militar', $termo);
		$pesquisa->execute();
		$data = $pesquisa->fetch(PDO::FETCH_ASSOC);

		if ($pesquisa->rowCount() >= 1) {
			$estrelas = array(0 => "", 1 => " ★", 2 => " ★★", 3 => " ★★★", 4 => " ★★★★", 5 => " ★★★★★");
			$data['pat_nome'] .= $estrelas[$data['pat_estrelas']];

			if ($data['dados_2'] == 'desativado') {
				$data['sobrenome'] = '';
				$data['idade'] = '';
			}

			if (empty($data['treino']) AND $data['treino2'] == "*") {
				unset($data['treino']);
				unset($data['treino2']);
			} else if (!empty($data['treino2']) AND $data['treino2'] !== "*") {
				$data['treino2'] = $data['treino2'];
			} else if (!empty($data['treino']) AND $data['treino2'] == "*") {
				unset($data['treino2']);
			}

			echo json_encode($data);
		} else {
			header("HTTP/1.0 404 Not Found");
		}
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>