<div class="row">
	<div class="col-sm-12">
		<div class="text-center mb-2">
			<img class="img-fluid mb-2" src="https://exercitobrhb.com/images/icones-grupo/normal/ajudantes.png">
			<h2><b>AJUDANTES</b></h2>
		</div>
		<p style="text-align:justify">
			São guardiões do TeamSpeak. São eles que monitoram, ajudam os praças que têm dificuldades em relação ao uso do TeamSpeak e supervisionam o cumprimento das regras.
		</p>
		<p style="text-align:justify">
			Para fazer parte basta ter um microfone, chamar um oficial no TeamSpeak e ser, no mínimo, Aluno da EsSA.
		</p>
	</div>
	<div class="col-sm-12">
		<?php
			$seleciona = $grupodb->prepare("SELECT * from usuarios WHERE status = 'Ativo' AND status_ajud IN ('Ativo','Semi-ausente','Ausente','JA','V','Destaque')");
			$seleciona->execute();

			foreach($seleciona->fetchAll() as $a){
				echo "<img src=\"https://www.habbo.com.br/habbo-imaging/avatarimage?img_format=png&amp;user=".$a['nome']."&head_direction=3&gesture=sml\" data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" style=\"height:110px; width:64px\" title=\"Ajudantes ".$a['nome']."\">";
			}
		?>
	</div>
</div>