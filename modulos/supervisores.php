<div class="row">
	<div class="col-sm-12">
		<div class="text-center mb-2">
			<img class="img-fluid mb-2" src="https://exercitobrhb.com/images/icones-grupo/normal/supervisores.png">
			<h2><b>SUPERVISORES</b></h2>
		</div>
		<p style="text-align:justify">
			Os Supervisores são os Praças escolhidos a dedo para se responsabilizarem em supervisionar todo o Quartel General. Possuem a função de esclarecer qualquer dúvida e aplicar Treinamentos Extras para fortalecer o conhecimento dos demais.
		</p>
		<p style="text-align:justify">
			Para fazer parte basta chamar um oficial no TeamSpeak, e, no mínimo, ser Terceiro Sargento.
		</p>
	</div>
	<div class="col-sm-12">
		<?php
			$seleciona = $grupodb->prepare("SELECT * from usuarios WHERE status = 'Ativo' AND status_super IN ('Ativo','Semi-ausente','Ausente','JA','V','Destaque')");
			$seleciona->execute();

			foreach($seleciona->fetchAll() as $a){
				echo "<img src=\"https://www.habbo.com.br/habbo-imaging/avatarimage?img_format=png&amp;user=".$a['nome']."&head_direction=3&gesture=sml\" data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" style=\"height:110px; width:64px\" title=\"Supervisor ".$a['nome']."\">";
			}
		?>
	</div>
</div>