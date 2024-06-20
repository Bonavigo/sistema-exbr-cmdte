<?php
	$cp = $db->prepare("SELECT * FROM alistados as a INNER JOIN visuais as b on a.nome = b.vis_nick INNER JOIN patentes as c on a.patente = c.pat_id WHERE a.cp = '3ª CP' and a.status = 0 order by pat_id DESC");

	$cp->execute();
?>
<div>
	<div class="row">
		<div class="px-5 py-4">
			<h1><b>3ª Companhia</b></h1>
			<h6>A Terceira Companhia tem como objetivo:</h6>
			<ul>
				<li>Criação e execução de eventos rápidos, internos e externos do ExBR.</li>
				<li>Criação e idealização de eventos esporádicos dentro do ExBR.</li>
				<li>Criação e idealização de eventos com parceiros.</li>
			</ul>
		</div>
	</div>
</div>
<br>
<div class="text-center">
	<h5>MEMBROS DA TERCEIRA COMPANHIA</h5>
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