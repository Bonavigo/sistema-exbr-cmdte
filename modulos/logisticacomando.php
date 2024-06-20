<?php
	$ac = $db->prepare("SELECT * FROM alistados as a INNER JOIN visuais as b on a.nome = b.vis_nick INNER JOIN patentes as c on a.patente = c.pat_id WHERE a.cp = '1ª CP' and a.status = 0 order by pat_id DESC");

	$ac->execute();
?>
<div>
	<div class="row">
		<div class="col-md-12">
			<div class="container">
				<br><br>
				<center><h2><b>Departamento de Logística e Comando (DeLC)</b></h2></center>
				<h6>O Departamento de Logística e Comando tem como objetivo:</h6>
				<ul>
					<li>Toda a logística no que se refere a manutenção e execução dos trabalhos dentro Exército Brasileiro.</li>
					<li>Coordenação dos demais Departamentos.</li>
					<li>Formação de membros do Alto Comando e futuros Oficiais Superiores.</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<br>