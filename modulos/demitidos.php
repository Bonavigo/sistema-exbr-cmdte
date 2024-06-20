<?php
	$marechais = $db->prepare("SELECT * FROM alistados WHERE status = 1 AND patente = 23 ORDER BY id DESC");
	$marechais->execute();
	$marechais = $marechais->fetchAll();

	$gdes = $db->prepare("SELECT * FROM alistados WHERE status = 1 AND patente = 22 ORDER BY id DESC");
	$gdes->execute();
	$gdes = $gdes->fetchAll();

	$gdds = $db->prepare("SELECT * FROM alistados WHERE status = 1 AND patente = 21 ORDER BY id DESC");
	$gdds->execute();
	$gdds = $gdds->fetchAll();

	$gdbs = $db->prepare("SELECT * FROM alistados WHERE status = 1 AND patente = 20 ORDER BY id DESC");
	$gdbs->execute();
	$gdbs = $gdbs->fetchAll();

	$cel = $db->prepare("SELECT * FROM alistados WHERE status = 1 AND patente = 19 ORDER BY id DESC");
	$cel->execute();
	$cel = $cel->fetchAll();

	$tencel = $db->prepare("SELECT * FROM alistados WHERE status = 1 AND patente = 18 ORDER BY id DESC");
	$tencel->execute();
	$tencel = $tencel->fetchAll();

	$maj = $db->prepare("SELECT * FROM alistados WHERE status = 1 AND patente = 17 ORDER BY id DESC");
	$maj->execute();
	$maj = $maj->fetchAll();

	$cap = $db->prepare("SELECT * FROM alistados WHERE status = 1 AND patente = 16 ORDER BY id DESC");
	$cap->execute();
	$cap = $cap->fetchAll();

	$pt = $db->prepare("SELECT * FROM alistados WHERE status = 1 AND patente = 15 ORDER BY id DESC");
	$pt->execute();
	$pt = $pt->fetchAll();

	$st = $db->prepare("SELECT * FROM alistados WHERE status = 1 AND patente = 14 ORDER BY id DESC");
	$st->execute();
	$st = $st->fetchAll();

	$asp = $db->prepare("SELECT * FROM alistados WHERE status = 1 AND patente = 13 ORDER BY id DESC");
	$asp->execute();
	$asp = $asp->fetchAll();

	$cad = $db->prepare("SELECT * FROM alistados WHERE status = 1 AND patente = 11 ORDER BY id DESC");
	$cad->execute();
	$cad = $cad->fetchAll();

	$aln = $db->prepare("SELECT * FROM alistados WHERE status = 1 AND patente = 10 ORDER BY id DESC");
	$aln->execute();
	$aln = $aln->fetchAll();

	$subten = $db->prepare("SELECT * FROM alistados WHERE status = 1 AND patente = 9 ORDER BY id DESC");
	$subten->execute();
	$subten = $subten->fetchAll();

	$psgt = $db->prepare("SELECT * FROM alistados WHERE status = 1 AND patente = 8 ORDER BY id DESC");
	$psgt->execute();
	$psgt = $psgt->fetchAll();

	$ssgt = $db->prepare("SELECT * FROM alistados WHERE status = 1 AND patente = 7 ORDER BY id DESC");
	$ssgt->execute();
	$ssgt = $ssgt->fetchAll();

	$tsgt = $db->prepare("SELECT * FROM alistados WHERE status = 1 AND patente = 6 ORDER BY id DESC");
	$tsgt->execute();
	$tsgt = $tsgt->fetchAll();

	$essa = $db->prepare("SELECT * FROM alistados WHERE status = 1 AND patente = 5 ORDER BY id DESC");
	$essa->execute();
	$essa = $essa->fetchAll();

	$cb = $db->prepare("SELECT * FROM alistados WHERE status = 1 AND patente = 3 ORDER BY id DESC");
	$cb->execute();
	$cb = $cb->fetchAll();
?>

<h3>Marechal ★★★★★</h3>
<?php
	foreach ($marechais as $marechal) {
		echo "<p class=\"mb-0\">".$marechal['nome']."</p>";
	}
?>

<h3 class="mt-3">General-de-Exército ★★★★</h3>
<?php
	foreach ($gdes as $gde) {
		echo "<p class=\"mb-0\">".$gde['nome']." - ".$gde['ultimapromo']." - ".$gde['promovidopor']." - ".$gde['motivo']."</p>";
	}
?>

<h3 class="mt-3">General-de-Divisão ★★★</h3>
<?php
	foreach ($gdds as $gdd) {
		echo "<p class=\"mb-0\">".$gdd['nome']." - ".$gdd['ultimapromo']." - ".$gdd['promovidopor']." - ".$gdd['motivo']."</p>";
	}
?>

<h3 class="mt-3">General-de-Brigada ★★</h3>
<?php
	foreach ($gdbs as $gdb) {
		echo "<p class=\"mb-0\">".$gdb['nome']." - ".$gdb['ultimapromo']." - ".$gdb['promovidopor']." - ".$gdb['motivo']."</p>";
	}
?>

<h3 class="mt-3">Coronel ★</h3>
<?php
	foreach ($cel as $coronel) {
		echo "<p class=\"mb-0\">".$coronel['nome']." - ".$coronel['ultimapromo']." - ".$coronel['promovidopor']." - ".$coronel['motivo']."</p>";
	}
?>

<h3 class="mt-3">Tenente-Coronel</h3>
<?php
	foreach ($tencel as $tenentecoronel) {
		echo "<p class=\"mb-0\">".$tenentecoronel['nome']." - ".$tenentecoronel['ultimapromo']." - ".$tenentecoronel['promovidopor']." - ".$tenentecoronel['motivo']."</p>";
	}
?>

<h3 class="mt-3">Major</h3>
<?php
	foreach ($maj as $major) {
		echo "<p class=\"mb-0\">".$major['nome']." - ".$major['ultimapromo']." - ".$major['promovidopor']." - ".$major['motivo']."</p>";
	}
?>

<h3 class="mt-3">Capitão</h3>
<?php
	foreach ($cap as $capitao) {
		echo "<p class=\"mb-0\">".$capitao['nome']." - ".$capitao['ultimapromo']." - ".$capitao['promovidopor']." - ".$capitao['motivo']."</p>";
	}
?>

<h3 class="mt-3">Primeiro Tenente</h3>
<?php
	foreach ($pt as $primeirotenente) {
		echo "<p class=\"mb-0\">".$primeirotenente['nome']." - ".$primeirotenente['ultimapromo']." - ".$primeirotenente['promovidopor']." - ".$primeirotenente['motivo']."</p>";
	}
?>

<h3 class="mt-3">Segundo Tenente</h3>
<?php
	foreach ($st as $segundotenente) {
		echo "<p class=\"mb-0\">".$segundotenente['nome']." - ".$segundotenente['ultimapromo']." - ".$segundotenente['promovidopor']." - ".$segundotenente['motivo']."</p>";
	}
?>

<h3 class="mt-3">Aspirante-a-Oficial</h3>
<?php
	foreach ($asp as $aspirante) {
		echo "<p class=\"mb-0\">".$aspirante['nome']." - ".$aspirante['ultimapromo']." - ".$aspirante['promovidopor']." - ".$aspirante['motivo']."</p>";
	}
?>

<h3 class="mt-3">Cadete</h3>
<?php
	foreach ($cad as $cadete) {
		echo "<p class=\"mb-0\">".$cadete['nome']." - ".$cadete['ultimapromo']." - ".$cadete['promovidopor']." - ".$cadete['motivo']."</p>";
	}
?>

<h3 class="mt-3">Aluno da EsPCEx</h3>
<?php
	foreach ($aln as $aluno) {
		echo "<p class=\"mb-0\">".$aluno['nome']." - ".$aluno['ultimapromo']." - ".$aluno['promovidopor']." - ".$aluno['motivo']."</p>";
	}
?>

<h3 class="mt-3">Subtenente</h3>
<?php
	foreach ($subten as $subtenente) {
		echo "<p class=\"mb-0\">".$subtenente['nome']." - ".$subtenente['ultimapromo']." - ".$subtenente['promovidopor']." - ".$subtenente['motivo']."</p>";
	}
?>

<h3 class="mt-3">Primeiro Sargento</h3>
<?php
	foreach ($psgt as $primeirosargento) {
		echo "<p class=\"mb-0\">".$primeirosargento['nome']." - ".$primeirosargento['ultimapromo']." - ".$primeirosargento['promovidopor']." - ".$primeirosargento['motivo']."</p>";
	}
?>

<h3 class="mt-3">Segundo Sargento</h3>
<?php
	foreach ($ssgt as $segundosargento) {
		echo "<p class=\"mb-0\">".$segundosargento['nome']." - ".$segundosargento['ultimapromo']." - ".$segundosargento['promovidopor']." - ".$segundosargento['motivo']."</p>";
	}
?>

<h3 class="mt-3">Terceiro Sargento</h3>
<?php
	foreach ($tsgt as $terceirosargento) {
		echo "<p class=\"mb-0\">".$terceirosargento['nome']." - ".$terceirosargento['ultimapromo']." - ".$terceirosargento['promovidopor']." - ".$terceirosargento['motivo']."</p>";
	}
?>

<h3 class="mt-3">Aluno da EsSA</h3>
<?php
	foreach ($essa as $alunoessa) {
		echo "<p class=\"mb-0\">".$alunoessa['nome']." - ".$alunoessa['ultimapromo']." - ".$alunoessa['promovidopor']." - ".$alunoessa['motivo']."</p>";
	}
?>

<h3 class="mt-3">Cabo</h3>
<?php
	foreach ($cb as $cabo) {
		echo "<p class=\"mb-0\">".$cabo['nome']." - ".$cabo['ultimapromo']." - ".$cabo['promovidopor']." - ".$cabo['motivo']."</p>";
	}
?>

<h3 class="mt-3">Soldado ★</h3>
<?php
	foreach ($solest as $soldadoestrela) {
		echo "<p class=\"mb-0\">".$soldadoestrela['nome']." - ".$soldadoestrela['ultimapromo']." - ".$soldadoestrela['promovidopor']." - ".$soldadoestrela['motivo']."</p>";
	}
?>

<h3 class="mt-3">Soldado</h3>
<?php
	foreach ($sol as $soldado) {
		echo "<p class=\"mb-0\">".$soldado['nome']." - ".$soldado['ultimapromo']." - ".$soldado['promovidopor']." - ".$soldado['motivo']."</p>";
	}
?>