<?php
	require_once 'cabecalho.php';
?>	
	<div class='content'>
		<div class='container'>
            <?php
                if(is_array($retorno))
                {
                    foreach($retorno as $dado)
                    {
                        echo "<div class='card' style='width: 18rem;'>
                            <img src='alunos/{$dado->imagem}' class='card-img-top' alt='...'>
                            <div class='card-body'>
                                <h5 class='card-title'>{$dado->nome} - AR: {$dado->aulas_restantes}</h5>
                                <a href='index.php?controle=agendamentoController&metodo=inserir&id={$dado->id_aluno}' class='btn btn-primary'>Agendar aula</a></div>
                                </div>";
                    }
                }
            ?>
		</div>
	</div
<?php	
	require_once 'rodape.html';
?>