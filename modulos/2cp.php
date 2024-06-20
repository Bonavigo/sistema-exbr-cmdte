<?php
	$cp = $db->prepare("SELECT * FROM alistados as a INNER JOIN visuais as b on a.nome = b.vis_nick INNER JOIN patentes as c on a.patente = c.pat_id WHERE a.cp = '2ª CP' and a.status = 0 order by pat_id DESC");

	$cp->execute();
?>
<div style="/*background: url(https://exbrhbofc.net/images/paginas/2cp/bandeira_grupo.png), #171717; background-size: cover;*/">
	<div class="row">
		<div class="px-5 py-4">
		<h1><b>2ª Companhia</b></h1>
			<h6>A Segunda Companhia tem como objetivo:</h6>
			<ul>
				<li>Manutenção e atualização dos scripts de treinamentos do ExBR.</li>
				<li>Aplicação e avaliação de siglas para treinadores.</li>
				<li>Avaliação constante na execução de treinamentos da instituição.</li>
			</ul>
			<a href="http://treinos.exercitobrhb.com/" target="_blank" class="btn btn-secondary waves_btn">Acessar o site da 2ª CP</a>
		</div>
	</div>
</div>
<br>
<div class="text-center">
	<h5>MEMBROS DA SEGUNDA COMPANHIA</h5>
	<div class="text-center">
		<div class="container">
			<?php
				foreach($cp->fetchAll() as $a){
					echo '<img class="img-fluid" src="https://www.habbo.com.br/habbo-imaging/avatarimage?figure='.$a['vis_figure'].'&action=std&direction=2&head_direction=3&gesture=std&size=m">
						<h4><b>'.$a['nome'].'</b></h4>
						<h5>'.$a['pat_nome'].'</h5><br>';
				}
			?>
		</div>
	</div>
</div>