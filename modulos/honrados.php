<section class="my-5">
	<div class="row">
		<div class="col-sm-12 col-md-4 text-center">
			<img src="<?= SITE ?>/images/paginas/honraria/honraria_1.png" class="img-fluid">
		</div>
		<div class="col-sm-12 col-md-8">
			<h3>Ordem do Cruzeiro do Sul</h3>
			<p>Esta é a mais alta e honorífica Ordem Militar, que visa agraciar os combatentes do Exército Brasileiro que abnegaram seus confortos em prol do desenvolvimento e progresso da maior potência militar do Habbo Hotel. Seus esforços e atitudes honram, a cada dia, os servidores que compõe esse corpo militar.</p>
		</div>
	</div>
	<div class="text-center my-3">
		<div class="mb-3">
			<img src="<?= SITE ?>/images/paginas/honraria/gra.png" class="mb-1">
			<small class="d-block">Grã-Cruz:</small>
			<div class="my-1">
				<?php
					$honraria_1 = $db->query("SELECT a.nome, b.pat_nome FROM alistados as a INNER JOIN patentes as b ON a.patente = b.pat_id WHERE honraria_1 = '1' ORDER BY a.id, a.patente ASC");
					$honraria_1 = $honraria_1->fetchAll();
					foreach ($honraria_1 as $honrado) {
						echo "<a href=\"".SITE."/perfil/{$honrado['nome']}\" target=\"_blank\"><img src=\"https://www.habbo.com.br/habbo-imaging/avatarimage?user={$honrado['nome']}&head_direction=3\"  data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"{$honrado['nome']}\"></a>";
					}
				?>
			</div>
		</div>
		<div class="mb-3">
			<img src="<?= SITE ?>/images/paginas/honraria/comendador.png" class="mb-1">
			<small class="d-block">Comendador:</small>
			<div class="my-1">
				<?php
					$honraria_1 = $db->query("SELECT a.nome, b.pat_nome FROM alistados as a INNER JOIN patentes as b ON a.patente = b.pat_id WHERE honraria_1 = '2' ORDER BY a.id, a.patente ASC");
					$honraria_1 = $honraria_1->fetchAll();
					foreach ($honraria_1 as $honrado) {
						echo "<a href=\"".SITE."/perfil/{$honrado['nome']}\" target=\"_blank\"><img src=\"https://www.habbo.com.br/habbo-imaging/avatarimage?user={$honrado['nome']}&head_direction=3\"  data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"{$honrado['nome']}\"></a>";
					}
				?>
			</div>
		</div>
		<div class="mb-3">
			<img src="<?= SITE ?>/images/paginas/honraria/cavaleiro.png" class="mb-1">
			<small class="d-block">Cavaleiro:</small>
			<div class="my-1">
				<?php
					$honraria_1 = $db->query("SELECT a.nome, b.pat_nome FROM alistados as a INNER JOIN patentes as b ON a.patente = b.pat_id WHERE honraria_1 = '3' ORDER BY a.id, a.patente ASC");
					$honraria_1 = $honraria_1->fetchAll();
					foreach ($honraria_1 as $honrado) {
						echo "<a href=\"".SITE."/perfil/{$honrado['nome']}\" target=\"_blank\"><img src=\"https://www.habbo.com.br/habbo-imaging/avatarimage?user={$honrado['nome']}&head_direction=3\"  data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"{$honrado['nome']}\"></a>";
					}
				?>
			</div>
		</div>
	</div>
</section>
<section class="my-5">
	<div class="row">
		<div class="col-sm-12 col-md-4 text-center">
			<img src="<?= SITE ?>/images/paginas/honraria/honraria_2.png" class="img-fluid">
		</div>
		<div class="col-sm-12 col-md-8">
			<h3>Ordem Militar de Avis</h3>
			<p>Esta é a Ordem que visa galardoar todos os combatentes do Exército Brasileiro que são sempre ativos e contribuem, a cada dia, para o crescimento desta potência militar. Sua presença e o seu trabalho dignificam esta Instituição, e temos orgulho em tê-lo em nosso Quadro Militar.</p>
		</div>
	</div>
	<div class="text-center my-3">
		<div class="mb-3">
			<img src="<?= SITE ?>/images/paginas/honraria/gra2.png" class="mb-1">
			<small class="d-block">Grã-Cruz:</small>
			<div class="my-1">
				<?php
					$honraria_2 = $db->query("SELECT a.nome, b.pat_nome FROM alistados as a INNER JOIN patentes as b ON a.patente = b.pat_id WHERE honraria_2 = '1' ORDER BY a.id, a.patente ASC");
					$honraria_2 = $honraria_2->fetchAll();
					foreach ($honraria_2 as $honrado) {
						echo "<a href=\"".SITE."/perfil/{$honrado['nome']}\" target=\"_blank\"><img src=\"https://www.habbo.com.br/habbo-imaging/avatarimage?user={$honrado['nome']}&head_direction=3\"  data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"{$honrado['nome']}\"></a>";
					}
				?>
			</div>
		</div>
		<div class="mb-3">
			<img src="<?= SITE ?>/images/paginas/honraria/comendador2.png" class="mb-1">
			<small class="d-block">Comendador:</small>
			<div class="my-1">
				<?php
					$honraria_2 = $db->query("SELECT a.nome, b.pat_nome FROM alistados as a INNER JOIN patentes as b ON a.patente = b.pat_id WHERE honraria_2 = '2' ORDER BY a.id, a.patente ASC");
					$honraria_2 = $honraria_2->fetchAll();
					foreach ($honraria_2 as $honrado) {
						echo "<a href=\"".SITE."/perfil/{$honrado['nome']}\" target=\"_blank\"><img src=\"https://www.habbo.com.br/habbo-imaging/avatarimage?user={$honrado['nome']}&head_direction=3\"  data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"{$honrado['nome']}\"></a>";
					}
				?>
			</div>
		</div>
		<div class="mb-3">
			<img src="<?= SITE ?>/images/paginas/honraria/cavaleiro2.png" class="mb-1">
			<small class="d-block">Cavaleiro:</small>
			<div class="my-1">
				<?php
					$honraria_2 = $db->query("SELECT a.nome, b.pat_nome FROM alistados as a INNER JOIN patentes as b ON a.patente = b.pat_id WHERE honraria_2 = '3' ORDER BY a.id, a.patente ASC");
					$honraria_2 = $honraria_2->fetchAll();
					foreach ($honraria_2 as $honrado) {
						echo "<a href=\"".SITE."/perfil/{$honrado['nome']}\" target=\"_blank\"><img src=\"https://www.habbo.com.br/habbo-imaging/avatarimage?user={$honrado['nome']}&head_direction=3\"  data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"{$honrado['nome']}\"></a>";
					}
				?>
			</div>
		</div>
	</div>
</section>
<section class="my-5">
	<div class="row">
		<div class="col-sm-12 col-md-4 text-center">
			<img src="<?= SITE ?>/images/paginas/honraria/honraria_3.png" class="img-fluid">
		</div>
		<div class="col-sm-12 col-md-8">
			<h3>Ordem da Torre e Espada, Da Infantaria, Lealdade e Mérito</h3>
			<p>Esta é a Ordem que visa galardoar os bravos combatentes nossos, que não temem as guerras e não fogem às lutas. Estes, são bravos e destemidos. A Infantaria e a Espada, as suas armas; a Torre o seu abrigo; e a Lealdade e o Mérito o seu lema.</p>
		</div>
	</div>
	<div class="text-center my-3">
		<div class="mb-3">
			<img src="<?= SITE ?>/images/paginas/honraria/gra3.png" class="mb-1">
			<small class="d-block">Grã-Cruz:</small>
			<div class="my-1">
				<?php
					$honraria_3 = $db->query("SELECT a.nome, b.pat_nome FROM alistados as a INNER JOIN patentes as b ON a.patente = b.pat_id WHERE honraria_3 = '1' ORDER BY a.id, a.patente ASC");
					$honraria_3 = $honraria_3->fetchAll();
					foreach ($honraria_3 as $honrado) {
						echo "<a href=\"".SITE."/perfil/{$honrado['nome']}\" target=\"_blank\"><img src=\"https://www.habbo.com.br/habbo-imaging/avatarimage?user={$honrado['nome']}&head_direction=3\"  data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"{$honrado['nome']}\"></a>";
					}
				?>
			</div>
		</div>
		<div class="mb-3">
			<img src="<?= SITE ?>/images/paginas/honraria/comendador3.png" class="mb-1">
			<small class="d-block">Comendador:</small>
			<div class="my-1">
				<?php
					$honraria_3 = $db->query("SELECT a.nome, b.pat_nome FROM alistados as a INNER JOIN patentes as b ON a.patente = b.pat_id WHERE honraria_3 = '2' ORDER BY a.id, a.patente ASC");
					$honraria_3 = $honraria_3->fetchAll();
					foreach ($honraria_3 as $honrado) {
						echo "<a href=\"".SITE."/perfil/{$honrado['nome']}\" target=\"_blank\"><img src=\"https://www.habbo.com.br/habbo-imaging/avatarimage?user={$honrado['nome']}&head_direction=3\"  data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"{$honrado['nome']}\"></a>";
					}
				?>
			</div>
		</div>
		<div class="mb-3">
			<img src="<?= SITE ?>/images/paginas/honraria/cavaleiro3.png" class="mb-1">
			<small class="d-block">Cavaleiro:</small>
			<div class="my-1">
				<?php
					$honraria_3 = $db->query("SELECT a.nome, b.pat_nome FROM alistados as a INNER JOIN patentes as b ON a.patente = b.pat_id WHERE honraria_3 = '3' ORDER BY a.id, a.patente ASC");
					$honraria_3 = $honraria_3->fetchAll();
					foreach ($honraria_3 as $honrado) {
						echo "<a href=\"".SITE."/perfil/{$honrado['nome']}\" target=\"_blank\"><img src=\"https://www.habbo.com.br/habbo-imaging/avatarimage?user={$honrado['nome']}&head_direction=3\"  data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"{$honrado['nome']}\"></a>";
					}
				?>
			</div>
		</div>
	</div>
</section>
