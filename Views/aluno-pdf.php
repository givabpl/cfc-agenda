<?php
	date_default_timezone_set("America/Sao_Paulo");
	require_once "vendor/autoload.php";
	$mpdf = new \Mpdf\mpdf;
	$mpdf->AddPage("P");
	$head = "<h1>Lista de Alunos</h1>";
	$head = $head . "Data:" . date("d/m/Y");
	$body = "<table>
				<tr>
					<th>Categoria</th>
					<th>Aulas restantes</th>
					<th>Nome</th>
					<th>Celular</th>
                    <th>Observação</th>
				</tr>";
	foreach($retorno as $dado)
	{
		$body = $body . "<tr>
							<td>{$dado->categoria}</td>
							<td>{$dado->aulas_restantes}</td>
							<td>{$dado->nome_aluno}</td>
                            <td>{$dado->celular_aluno}</td>
                            <td>{$dado->obs_aluno}</td>
						</tr>";
	}
	$body = $body . "</table>";
	$html = $head . $body;
	//$estilo = file_get_contents("estilo/pdf.css");
	//$mpdf->WriteHTML($estilo, 1);
	$mpdf->WriteHTML($html);
	$mpdf->output();