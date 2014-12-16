<?php
session_start();
$matricula = $_SESSION['matricula'];
//var_dump($_REQUEST);
include_once '../auto_load.php';
$_paginator = new ClsPaginator;

$ItensPorPagina = 10;

$pag = (int) $_REQUEST['pageno'];
$_paginator->current_page = $pag;
if (!$_paginator->current_page) {
    $_paginator->current_page = 1;
}
$_paginator->items_per_page = $ItensPorPagina;

$filtrar = $_REQUEST['filtrar'];
$disciplina_id = $_REQUEST['disciplina_id'];
$parr = array(
    contar => 'S',
    filtrar => $filtrar,
    disciplina_id => $disciplina_id,
    matricula => $matricula
);

$_paginator->total_items = $Avaliacoes = ClsAvaliacao::selectAvaliacaoProfessor($parr);
$pagination = $_paginator->paginate();

unset($parr['contar']);
$parr['limit'] = $pagination['limit'];
$parr['offset'] = $pagination['offset'];

$Avaliacoes = ClsAvaliacao::selectAvaliacaoProfessor($parr);
?> 
<!--<div class="product-catalog register login" style="clear:both;">-->
<div class="" style="">
    <div class="col-md-12">
        <div class="col-md-6 col-sm-6 col-xs-8">
            <h3 style="font-style:italic">CADASTRO DE AVALIAÇÕES</h3>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-4 text-right">
            <button class="btn btn-primary" style="margin-top: 10px;" onclick="loadModal('avaliacao_');">Novo</button>
        </div>
    </div>
    <div class="">
        <form onsubmit="fazFiltro(this, event);">
            <div class="search-panel__wrapper">
                <div class="search-panel col-md-6">
                    <div class="search-panel__inner" style="padding-left:15px">
                        <div class="search-field col-md-10 col-sm-12 col-xs-12 widget-cart2">
                            <input type="text" placeholder="Buscar avaliação" name="filtrar" value="<?= $filtrar; ?>"/>
                            <div class="search-button__wrapper">
                                <button class="search-button" type="submit">
                                    <i class="search-button-icon"></i>
                                </button>
                            </div>
                        </div><!--search-fiel-->
                    </div><!--search-panel__inner-->
                </div><!--search-panel col-md-6-->
                <div class="search-panel col-md-6 col-sm-12 col-xs-12" style="margin-top:15px">
                    <div class="form-group col-md-2 col-sm-1 col-xs-2" style="margin-top:4px">
                        <label for="">Disciplina</label>
                    </div>
                    <div class="form-group col-md-10 col-sm-11 col-xs-10">
                        <select class="selectpicker" name="disciplina_id" onchange="fazFiltro(this.form, event);">
                            <option value=''>Todas</option>
                            <?php
                            $Disciplinas = ClsDisciplina::selectDisciplina();
                            foreach ($Disciplinas as $key) {
                                $selected = $key->disciplina_id==$disciplina_id?'selected':'';
                                echo "<option value='$key->disciplina_id' $selected>$key->nome</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div><!--search-panel col-md-6-->
            </div><!--search-panel__wrapper-->
        </form>
        <div class="clearfix"></div>
        <div class="" >
            <table class="table cart_tableS">
                <thead>
                    <tr style="background-color:rgb(249,249,249); border:medium 1px #CCCCCC;">
                        <th style="width: 8%;">ID</th>
                        <th>Disciplina</th>
                        <th>Avaliação</th>
                        <th>Professor</th>
                        <th>Período</th>
                        <th style="width: 5%;">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
//                    var_dump($Avaliacoes);
                    if (!($_paginator->total_items > 0)) {
                        echo "
                            <tr>
                                <td colspan='6'>
                                    Nenhuma avaliação encontrada!
                                </td>
                            </tr>";
                    }
                    foreach ($Avaliacoes as $key) {
//                        var_dump($key);
                        echo <<<html
                        <tr style="border-bottom: 1px solid #dddddd;">
                            <td align="center"><span class="in-stock">$key->avaliacao_id</span></td>
                            <td align="center"><a>$key->nomeDisciplina</a></td>
                            <td align="center"><span class="in-stock">$key->nome</span></td>
                            <td align="center"><span class="in-stock">$key->nomeProfessor</span></td>
                            <td align="center"><span class="in-stock">$key->dataInicio à $key->dataFim</span></td>
                            <td align="center" onclick="loadModal('avaliacao_',{avaliacao_id: $key->avaliacao_id});"><a style="cursor: pointer;" class="basic1"><img src="img/editar.png" style="margin-top:-10px"></a></td>
                        </tr>
html;
                    }
                    ?> 
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            <div class="row filter1">
                                <div class="">
                                    <script>
//                                        $('.pagination a').on('click', function(e) {
//                                            e.preventDefault();
//                                            debugger;
//                                            var parr = $.url($(this).attr('href')).param('pageno');
//                                            loadContent($(this).attr('parr'), $(this).attr('href'));
//                                        });
                                    </script>
                                    <div class="pagination">
                                        <ul>
                                            <?php
                                            $Url = "filtrar=$filtrar";

                                            echo $_paginator->fazPaginacao($Url, "onclick='fazPaginacao(this, event)' parr='questao'");
                                            ?> 
                                            <!--<span class="">Page</span>
                                            <ul>
                                            <li><a class="active" href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>-->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
</div>

<div id="modal" class="hid" style="width: 880px; height: 500px;">

</div>