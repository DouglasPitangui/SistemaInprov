<?php
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
$parr = array(
    contar => 'S',
//    matricula => 99,
    filtrar => $filtrar
);

$_paginator->total_items = $Professores = ClsProfessor::selectProfessor($parr);
$pagination = $_paginator->paginate();

unset($parr['contar']);
$parr['limit'] = $pagination['limit'];
$parr['offset'] = $pagination['offset'];

$Professores = ClsProfessor::selectProfessor($parr);
?> 
<!--<div class="product-catalog register login" style="clear:both;">-->
<div class="" style="">
    <div class="col-md-12">
        <div class="col-md-6 col-sm-6 col-xs-8">
            <h3 style="font-style:italic">PROFESSOR DISCIPLINA</h3>
        </div>
    </div>
    <div class="">
        <form onsubmit="fazFiltro(this, event);">
            <div class="search-panel__wrapper">
                <div class="search-panel col-md-6">
                    <div class="search-panel__inner" style="padding-left:15px">
                        <div class="search-field col-md-10 col-sm-12 col-xs-12 widget-cart2">
                            <input type="text" placeholder="Buscar professor" name="filtrar" value="<?= $filtrar; ?>"/>
                            <div class="search-button__wrapper">
                                <button class="search-button" type="submit">
                                    <i class="search-button-icon"></i>
                                </button>
                            </div>
                        </div><!--search-fiel-->
                    </div><!--search-panel__inner-->
                </div><!--search-panel col-md-6-->
                <div class="search-panel col-md-6 col-sm-12 col-xs-12 hidden" style="margin-top:15px">
                    <div class="form-group col-md-2 col-sm-1 col-xs-2" style="margin-top:4px">
                        <label for="">Curso</label>
                    </div>
                    <div class="form-group col-md-10 col-sm-11 col-xs-10">
                        <select class="selectpicker">
                            <option>Todos</option>
                            <option>Ciência</option>
                            <option>&nbsp;</option>
                            <option>&nbsp;</option>
                            <option>&nbsp;</option>
                            <option>&nbsp;</option>
                            <option>&nbsp;</option>
                            <option>&nbsp;</option>
                            <option>&nbsp;</option>
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
                        <th style="width: 8%;">Matricula</th>
                        <th>Nome</th>
                        <th>Formação</th>
                        <th>Cargo</th>
                        <th style="width: 5%;">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
//                    var_dump($Professores);
                    if (!($_paginator->total_items > 0)) {
                        echo "
                            <tr>
                                <td colspan='5'>
                                    Nenhum professor encontrado!
                                </td>
                            </tr>";
                    }
                    foreach ($Professores as $key) {
//                        var_dump($key);
                        echo <<<html
                        <tr>
                            <td align="center"><span class="in-stock">$key->matricula</span></td>
                            <td align="center"><a>$key->nome</a></td>
                            <td align="center"><span class="in-stock">$key->formacao</span></td>
                            <td align="center"><span class="in-stock">$key->funcao</span></td>
                            <td align="center" onclick="loadModal('professordisciplina_',{matricula: $key->matricula});"><a style="cursor: pointer;" class="basic1"><img src="img/editar.png" style="margin-top:-10px"></a></td>
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

                                            echo $_paginator->fazPaginacao($Url, "onclick='fazPaginacao(this, event)' parr='professor'");
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