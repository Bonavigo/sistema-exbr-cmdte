<div class="row">
	<div class="col-sm-12">
		<div class="text-center mb-2">
			<img class="img-fluid mb-2" src="https://exercitobrhb.com/images/icones-grupo/normal/monitores.png">
			<h2><b>MONITORES</b></h2>
		</div>
		<p style="text-align:justify">
			Os Monitores são os praças escolhidos para ficarem responsáveis pelo envio de seus próprios treinamentos, tendo como preferência o Treinamento Básico I. Para isso funcionar, o Exército Brasileiro possui um sistema de wireds, proporcionando uma maior liberdade nesta questão do envio do treino.
		</p>
		<p style="text-align:justify">
			Para fazer parte basta ter um microfone, chamar um oficial no TeamSpeak e ser, no mínimo, Terceiro Sargento.
		</p>
	</div>
	<div class="col-sm-12">
		<?php
			$seleciona = $grupodb->prepare("SELECT * from usuarios WHERE status = 'Ativo' AND status_mon IN ('Ativo','Semi-ausente','Ausente','JA','V','Destaque')");
			$seleciona->execute();

			foreach($seleciona->fetchAll() as $a){
				echo "<img src=\"https://www.habbo.com.br/habbo-imaging/avatarimage?img_format=png&amp;user=".$a['nome']."&head_direction=3&gesture=sml\" data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" style=\"height:110px; width:64px\" title=\"Monitor ".$a['nome']."\">";
			}
		?>
	</div>
</div>