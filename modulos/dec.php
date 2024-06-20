<?php
	if (!empty($_POST['nick'])) {
		//$site_functions->mail();
	}
?>
<div class="row">
	<div class="col-md-3">
		<p style="text-align:center">
			<img alt="Escola de Comando e Estado Maior do Exército" width="71" height="99" src="<?= SITE ?>/arquivos/2021/04/dec.png" />
		</p>
	</div>
	<div class="col-md-9">
		<h1><b>DEC</b></h1>
		<h2>Departamento de Engenharia e Construção</h2>
	</div>
</div>
<table border="0" style="font-size: 13px;" cellpadding="3" class="table text-white">
	<tbody>
		<tr>
			<th colspan="2" style="text-align:center">Informações</th>
		</tr>
		<tr>
			<td scope="row" style="text-align:left; vertical-align:top">Sigla</td>
			<td style="text-align:left; vertical-align:top"><img class="thumbborder" src="//upload.wikimedia.org/wikipedia/commons/thumb/0/05/Flag_of_Brazil.svg/22px-Flag_of_Brazil.svg.png" style="height:15px; width:22px" /> DEC</td>
		</tr>
		<tr>
			<td scope="row" style="text-align:left; vertical-align:top">Corporação</td>
			<td style="text-align:left; vertical-align:top">Exército Brasileiro</td>
		</tr>
		<tr>
			<td scope="row" style="text-align:left; vertical-align:top">Subordinação</td>
			<td style="text-align:left; vertical-align:top">Departamento de Ensino Superior</td>
		</tr>
		<tr>
			<td scope="row" style="text-align:left; vertical-align:top">Missão</td>
			<td style="text-align:left; vertical-align:top">Engenharia militar</td>
		</tr>
		<tr>
			<td scope="row" style="text-align:left; vertical-align:top">Criação</td>
			<td style="text-align:left; vertical-align:top">Capitão dra.iamilis, 2021</td>
		</tr>
	</tbody>
</table>
<div class="d-flex justify-content-center align-items-center">
	<a role="button" class="btn btn-primary waves_btn" data-bs-toggle="modal" data-bs-target="#dec_inscr">Inscrever-se</a>
</div>
<div class="modal fade text-black" id="dec_inscr" tabindex="-1" aria-labelledby="dec_inscr" aria-hidden="true">
	<div class="modal-dialog">
		<form method="POST" action="#">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Ficha de Inscrição - DEC</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					...
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					<button type="button" class="btn btn-primary">Enviar</button>
				</div>
		</form>
		</div>
	</div>
</div>