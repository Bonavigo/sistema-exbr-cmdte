<div class="row">
	<div class="col-md-4">
		<p style="text-align:center">
			<img class="img-fluid" src="<?= SITE ?>/images/site/espcex.png">
		</p>
	</div>
	<div class="col-md-8">
		<h1 style="font-size:45px;"><b>ESCOLA PREPARATÓRIA DE CADETES DO EXÉRCITO</b></h1>
		<p style="text-align:justify">
			A <b>Escola Preparatória de Cadetes do Exército</b>, mais conhecida como EsPCEx, é um período em que o Aluno convocado recebe aulas e realiza atividades para se tornar um Cadete. Após receber as devidas aulas e completar as atividades, o Aluno realiza uma prova, respondendo questões baseadas na experiência diária a bordo e conhecimentos adquiridos com as explicações das aulas. Caso aprovado, o Aluno assume a patente de Cadete; caso reprovado, o Aluno retorna à patente de 3° Sargento. A Escola Preparatória de Cadetes do Exército foi criada para proporcionar uma melhor preparação para os Alunos assumirem o seguinte posto, formando Cadetes mais qualificados e preparados para a próxima Academia Militar.
		</p>
	</div>
	<div>
		<?php
			$seleciona = $db->prepare("SELECT * FROM alistados WHERE status = 0 AND patente = 10 ORDER BY id DESC");
			$seleciona->execute();

			foreach($seleciona->fetchAll() as $a){
				echo "<img src=\"https://www.habbo.com.br/habbo-imaging/avatarimage?img_format=png&amp;user=".$a['nome']."&head_direction=3&gesture=sml\" data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" style=\"height:110px; width:64px\" title=\"".$a['nome']." - [EPC] Aluno\">";
			}
		?>
	</div>
</div>