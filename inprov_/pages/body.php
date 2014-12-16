<?php 
foreach ($_SESSION as $key => $value) {
    $$key = $value;
}
?>
<div class="col-md-12">
    <div class="col-md-3">
        <ul id="mainMenu" class="nav">
            <li class="active"><a href="#inicio" style="background-color: #4D90FE !important;">INPROV</a></li>
            <!--<li><a href="#">Cadastro</a>-->
            <?php if ($funcao_id) { ?>
            <li><a href="#">Cadastro</a>
                <ul>
                    <?php if ($funcao_id == 1) { ?>
                    <li><a href="#">Aluno</a>
                        <ul>
                            <li><a href="#aluno">Aluno</a></li>
                            <li><a href="#alunodisciplina">Aluno-Disciplina</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Professor</a>
                        <ul>
                            <li><a href="#professor">Professor</a></li>
                            <li><a href="#professordisciplina">Professor-Disciplina</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    <li><a href="#">Disciplina</a>
                        <ul>
                            <?php if ($funcao_id == 1) { ?>
                            <li><a href="#disciplina">Disciplina</a></li>
                            <?php } ?>
                            <li><a href="#">Questão</a>
                                <ul>
                                    <li><a href="#questao">Questão</a></li>
                                    <?php if ($funcao_id == 1) { ?>
                                    <li><a href="#assunto">Assunto</a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <li><a href="#avaliacao">Avaliação</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="#">Avaliações</a>
                <ul>
                    <!--<li><a href="#avaliacoes" parr="Tipo=E&Pessoa=P">Elaboradas</a></li>-->
                    <li><a href="#avaliacoesAplicadas" parr="Tipo=A&Pessoa=P">Aplicadas</a></li>
                    <li><a href="#avaliacoesCorrigidas" parr="Tipo=C&Pessoa=P">Corrigidas</a></li>
                </ul>
            </li>
            <?php } else { ?>
            <li><a href="#">Avaliações</a>
                <ul>
                    <li><a href="#avaliacoesPendentes" parr="Tipo=P&Pessoa=A">Pendentes</a></li>
                    <li><a href="#avaliacoesAplicadas" parr="Tipo=R&Pessoa=A">Realizadas</a></li>
                    <li><a href="#avaliacoesCorrigidas" parr="Tipo=C&Pessoa=A">Corrigidas</a></li>
                </ul>
            </li>
            <?php } ?>
        </ul>
<!--        <p class="external">
            <a href="#" id="mainMenucollapseAll">Retrair Todos</a> | <a href="#" id="mainMenuexpandAll">Expandir Todos</a>
        </p>-->
    </div>

    <div class="col-md-9" id="conteudo" style="min-height: 400px;">

    </div>
</div>