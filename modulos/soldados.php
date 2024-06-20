<?php
	$sol = $db->prepare("SELECT * FROM alistados WHERE status = 0 AND patente = 1 ORDER BY id DESC");
	$sol->execute();
	$sol = $sol->fetchAll();

	$solest = $db->prepare("SELECT * FROM alistados WHERE status = 0 AND patente = 2 ORDER BY id DESC");
	$solest->execute();
	$solest = $solest->fetchAll();
?>

<h3>Soldado ★</h3>
<?php
	foreach ($solest as $soldadoestrela) {
		echo "<p class=\"mb-0\">".$soldadoestrela['nome']." - ".$soldadoestrela['ultimapromo']." - ".$soldadoestrela['promovidopor']."</p>";
	}
?>

<h3 class="mt-3">Soldado</h3>
<?php
	foreach ($sol as $soldado) {
		echo "<p class=\"mb-0\">".$soldado['nome']." - ".$soldado['ultimapromo']." - ".$soldado['promovidopor']."</p>";
	}
?>