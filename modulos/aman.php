<div class="row">
	<div class="col-md-4">
		<p style="text-align:center">
			<img class="img-fluid" src="<?= SITE ?>/images/site/aman.png">
		</p>
	</div>
	<div class="col-md-8">
		<h1 style="font-size:45px;"><b>ACADEMIA MILITAR DAS AGULHAS NEGRAS</b></h1>
		<p style="text-align:justify">A <b>Academia Militar das Agulhas Negras</b> é um período em que o Cadete recebe aulas e realiza atividades para se tornar um Oficial. Após receber as devidas aulas e completar as atividades, o Cadete realiza uma prova, respondendo questões baseadas na experiência diária no Exército Brasileiro e conhecimentos adquiridos com as explicações das aulas. Caso aprovado, o Cadete assume a patente de Aspirante-a-Oficial, ingressando no Corpo de Oficiais; caso reprovado, o Cadete retorna à patente de 2º Sargento. A Academia Militar das Agulhas Negras foi criada para proporcionar uma melhor preparação para os Cadetes assumirem o posto de Oficial e deixá-los preparados para as novas funções.</p>
	</div>
	<div>
		<?php
			$seleciona = $db->prepare("SELECT * FROM alistados WHERE status = 0 AND patente = 11 ORDER BY id DESC");
			$seleciona->execute();

			foreach($seleciona->fetchAll() as $a){
				echo "<img src=\"https://www.habbo.com.br/habbo-imaging/avatarimage?img_format=png&amp;user=".$a['nome']."&head_direction=3&gesture=sml\" data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" style=\"height:110px; width:64px\" title=\"".$a['nome']." - Cadete\">";
			}
		?>
	</div>
</div>