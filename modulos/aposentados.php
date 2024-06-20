<p style="text-align:center"><img src="<?= SITE ?>/images/icones-grupo/normal/aposentados.png"/></p>
<div style="padding:10px;">
	<p style="text-align:center">Nesta página estão os Aposentados do <strong>Exército Brasileiro</strong>, que reconhece e agradece os serviços prestados à instituição.</p>
	<div class="text-center">
		<?php
			$seleciona = $db->prepare("SELECT * FROM alistados as a, patentes as b WHERE a.status = 3 AND b.pat_id = a.patente ORDER BY b.pat_ordem DESC");
			$seleciona->execute();
			foreach($seleciona->fetchAll() as $a){
				echo "<img src=\"https://www.habbo.com.br/habbo-imaging/avatarimage?img_format=png&amp;user=".$a['nome']."&head_direction=3&gesture=sml\" data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" style=\"height:110px; width:64px\" title=\"".$a['nome']." - ".$a['pat_nome']."\">";
			}
		?>	
	</div>
</div>