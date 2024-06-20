<?php
	/*
		Programado por Bona com base no trabalho feito por Gaker e joaoguarana.
	*/

	date_default_timezone_set('America/Sao_Paulo');
	DEFINE('SITE', 'https://'.$_SERVER['HTTP_HOST']);

	$_DATABASE = array(
		'user' => 'USUARIO_BANCO',
		'password' => 'SENHA_BANCO',
		'database' => 'PREFIXO_exercito',
		'database_grupo' => 'PREFIXO_pracas',
		'database_dh' => 'PREFIXO_diario',
		'host' => 'localhost',
		'encoding' => 'utf8mb4'
	);

	try {
		$db = new PDO("mysql:host={$_DATABASE['host']};dbname={$_DATABASE['database']};charset={$_DATABASE['encoding']}", $_DATABASE['user'], $_DATABASE['password']);
		$grupodb = new PDO("mysql:host={$_DATABASE['host']};dbname={$_DATABASE['database_grupo']};charset={$_DATABASE['encoding']}", $_DATABASE['user'], $_DATABASE['password']);
		$diariodb = new PDO("mysql:host={$_DATABASE['host']};dbname={$_DATABASE['database_dh']};charset={$_DATABASE['encoding']}", $_DATABASE['user'], $_DATABASE['password']);

		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$grupodb->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$diariodb->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		require('class/site.class.php');
		$site_functions = new Site();
	} catch (PDOException $e) {
		require('pages/erro.php');
		exit();
	}

	$site_functions->limpaGlobais();
	$site_functions->verificaIP();

	//insira aqui a lógica pra manutenção
	if (1 !== 1) {
		require('pages/manutencao.php');
		exit();
	}
?>