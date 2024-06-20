<?php
	$ac = $db->prepare("SELECT * FROM alistados as a INNER JOIN visuais as b on a.nome = b.vis_nick INNER JOIN patentes as c on a.patente = c.pat_id WHERE a.cp = '1ª CP' and a.status = 0 order by pat_id DESC");
	$ac->execute();
?>
<div style="/*background: url(https://exercitobrhb.com/images/black-1024x543.jpg), #171717; background-size: cover;*/">
	<div class="row">
		<div class="px-5 py-4">
				<h1><b>1ª Companhia</b></h1>
				<h6>A Primeira Companhia tem como objetivo:</h6>
				<ul>
					<li>Toda a logística no que se refere a manutenção e execução dos trabalhos dentro Exército Brasileiro do Habbo.</li>
					<li>Coordenação das demais Companhias.</li>
					<li>Formação de membros do Alto Comando e futuros Oficiais Superiores.</li>
				</ul>
			</div>
		</div>
	</div>
<br>
<div class="text-center">
	<h5>MEMBROS DO ALTO COMANDO</h5>
	<div class="text-center">
		<div class="container">
			<?php
				foreach($ac->fetchAll() as $a){
					if ($a['nome'] == 'Anonimo') {
						echo '<img class="img-fluid" src="https://www.habbo.com.br/habbo-imaging/avatarimage?user=Cmdte-Anonimo&action=std&direction=2&head_direction=3&gesture=std&size=m">
							<h5><b>Anonimo</b></h5>
							<span>Marechal</span>';
					} else {
						echo '<img class="img-fluid" src="https://www.habbo.com.br/habbo-imaging/avatarimage?figure='.$a['vis_figure'].'&action=std&direction=2&head_direction=3&gesture=std&size=m">
							<h4><b>'.$a['nome'].'</b></h4>
							<h5>'.$a['pat_nome'].'</h5>';
					}
					
					echo "<br>";
				}
			?>
		</div>
	</div>
</div>