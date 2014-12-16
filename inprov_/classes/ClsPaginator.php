<?php

class ClsPaginator {
    
    /* Página atual */
    public $current_page = 0;

    /* Total de items */
    public $total_items = 0;

    /* Itens por página */
    public $items_per_page = 10;

    /* Total de páginas */
    public $total_pages;

    /* Primeiro item da página atual */
    public $current_first_item;

    /* Último item da página atual */
    public $current_last_item;

    /* Página anterior */
    public $previous_page;

    /* Próxima página */
    public $next_page;

    /* Número da PRIMEIRA página ou FALSE se não for a prmeira */
    public $first_page;

    /* Número da ÚLTIMA página ou FALSE se não for a prmeira */
    public $last_page;

    /* Número de Paginas Adjacentes */
    public $adjacentes = 3;

    /* OFFSET para o SQL */
    public $offset;

    /* LIMIT para o SQL */
    public $limit;

    public function paginate() {
        $this->total_pages = (int) ceil($this->total_items / $this->items_per_page);
        $this->current_page = (int) min(max(1, $this->current_page), max(1, $this->total_pages));
        $this->current_first_item = (int) min((($this->current_page - 1) * $this->items_per_page) + 1, $this->total_items);
        $this->current_last_item = (int) min($this->current_first_item + $this->items_per_page - 1, $this->total_items);
        $this->previous_page = ($this->current_page > 1) ? $this->current_page - 1 : FALSE;
        $this->next_page = ($this->current_page < $this->total_pages) ? $this->current_page + 1 : FALSE;
        $this->first_page = ($this->current_page === 1) ? FALSE : 1;
        $this->last_page = ($this->current_page >= $this->total_pages) ? FALSE : $this->total_pages;
        $this->offset = (int) (($this->current_page - 1) * $this->items_per_page);
        $this->limit = $this->items_per_page;

        return (array) $this;
    }

    private $paginacao = "";

    function getPaginacao() {
        return $this->paginacao;
    }

    function fazPaginacao($Url = "", $Attr = "") {
        $Pag = $this->current_page;
        $pagination = $this->paginate();

        $prox = $Pag + 1;
        $ant = $Pag - 1;
        $ultima_pag = ceil($this->total_items / $this->items_per_page);
        $ultima_pag = $this->last_page;
        $penultima = $ultima_pag - 1;
        $adjacentes = 3;
        if ($this->total_pages == 1) {
            $pagination['next_page'] = 1;
            $pagination['last_page'] = 1;
            $pagination['first_page'] = 1;
            $pagination['previous_page'] = 1;

            $prox = 1;
            $ant = 1;
            $ultima_pag = 1;
            $penultima = 1;
        }
        if ($pagination['last_page'] <= 0) {
            $pagination['last_page'] = $this->total_pages;
        }

        $this->paginacao = <<<pgn
            <span class="">Páginas</span>
pgn;
        if ($this->total_pages > 1) {

            $Penultima = ($pagination['last_page'] - 1);
            if (!is_numeric($pagination['last_page'])) {
                $pagination['last_page'] = $pagination['total_pages'];
            }

            if ($pagination['first_page']) {
                $this->paginacao .= <<<pgn
                <li class="previous-off"><a $Attr href="$Url&pageno={$pagination['first_page']}">&laquo;&laquo;</a></li>
                <li class="next-off"><a $Attr href="$Url&pageno={$pagination['previous_page']}">&laquo;</a></li>
pgn;
            } else {
                $this->paginacao .= <<<pgn
                <li class="a-focus">&laquo;&laquo;</li>
                <li class="a-focus">&laquo;</li>
pgn;
            }

            #<!-- 160 > (2 + (2 * 3 )) -->            
            if ($pagination['total_pages'] <= (2 + (2 * $pagination['adjacentes']))) { //(1+(2*3))=7          
                for ($i = 1; $i <= $pagination['total_pages']; $i++) {

                    if ($pagination['current_page'] == $i) {
                        $this->paginacao .= <<<pgn
                        <li class="active"><a class="active">$i</a></li>
pgn;
                    } else {
                        $this->paginacao .= <<<pgn
                        <li><a $Attr href="$Url&pageno=$i">$i</a></li>
pgn;
                    }
                }
            }

            #<!-- 160 > (2 + (2 * 3 )) -->                    
            if ($pagination['last_page'] > (2 + (2 * $pagination['adjacentes']))) { //(2+(2*3)))=8  /// verificando se tem mais de (2*Adj) paginas         
                #<!-- 160 <=	(2*3) -->
                if ($pagination['current_page'] <= ((2 * $pagination['adjacentes']))) { //((2*3))) =6             
                    for ($i = 1; $i <= (1 + (2 * $pagination['adjacentes'])); $i++) { // (1+(2*3)=8      
                        if ($i == $pagination['current_page']) {
                            $this->paginacao .= <<<pgn
                            <li class="active"><a  class="active">$i</a></li>
pgn;
                        } else {
                            $this->paginacao .= <<<pgn
                            <li><a $Attr href="$Url&pageno=$i">$i</a></li>
pgn;
                        }
                    }
                    $this->paginacao .= <<<pgn
                    <li class="previous-off">....</li>
                    <li><a $Attr href="$Url&pageno=$Penultima">$Penultima</a></li>
                    <li><a $Attr href="$Url&pageno={$pagination['last_page']}">{$pagination['last_page']}</a></li>
pgn;
                    #<!-- 160 > (2 + (2 * 3 )) -->
                } elseif ($pagination['current_page'] > (2 * $pagination['adjacentes']) && $pagination['current_page'] < $pagination['last_page'] - 3) {
                    $this->paginacao .= <<<pgn
                    <li><a $Attr href="$Url&pageno=1">1</a></li>
                    <li><a $Attr href="$Url&pageno=2">2</a></li>

                    <li class="previous-off">....</li>
pgn;

                    for ($i = $pagination['current_page'] - $pagination['adjacentes']; $i <= $pagination['current_page'] + $pagination['adjacentes']; $i++) {
                        if ($i == $pagination['current_page']) {
                            $this->paginacao .= <<<pgn
                            <li class="active"><a  class="active">$i</a></li>
pgn;
                        } else {
                            $this->paginacao .= <<<pgn
                            <li><a $Attr href="$Url&pageno=$i">$i</a></li>
pgn;
                        }
                    }
                    $this->paginacao .= <<<pgn
                    <li class="previous-off">....</li>
                    <li><a $Attr href="$Url&pageno=$Penultima">$Penultima</a></li>
                    <li><a $Attr href="$Url&pageno={$pagination['last_page']}">{$pagination['last_page']}</a></li>
pgn;
                } else {

                    #<!-- 160 > (2 + (2 * 3 )) -->
                    $this->paginacao .= <<<pgn
                    <li><a $Attr href="$Url&pageno=1">1</a></li>
                    <li><a $Attr href="$Url&pageno=2">2</a></li>
                    <li class="previous-off">....</li>
pgn;

                    for ($i = $pagination['last_page'] - (2 + (2 * $pagination['adjacentes'])); $i <= $pagination['last_page']; $i++) {

                        if ($i == $pagination['current_page']) {
                            $this->paginacao .= <<<pgn
                            <li class="active"><a  class="active">$i</a></li>
pgn;
                        } else {
                            $this->paginacao .= <<<pgn
                            <li><a $Attr href="$Url&pageno=$i">$i</a></li>
pgn;
                        }
                    }
                }
            }

            if (!is_numeric($pagination['last_page'])) {
                $pagination['last_page'] = $pagination['total_pages'];
            }
            if ($pagination['next_page'] > $pagination['total_pages']) {
                $pagination['next_page'] = $pagination['total_pages'];
            }


            if ($pagination['last_page']) {
//                $this->paginacao .= <<<pgn
//                <li class="next"><a $Attr href="$Url&pageno={$pagination['next_page']}">&raquo;</a></li>
//                <li class="next"><a $Attr href="$Url&pageno={$pagination['last_page']}">&raquo;&raquo;</a></li>
//pgn;
                if ($pagination['last_page'] == $pagination['current_page']) {
                    $this->paginacao .= <<<pgn
                    <li class="a-focus">&raquo;</li>
                    <li class="a-focus">&raquo;&raquo;</li>
pgn;
                } else {
                    $this->paginacao .= <<<pgn
                    <li class="next"><a $Attr href="$Url&pageno={$pagination['next_page']}">&raquo;</a></li>
                    <li class="next"><a $Attr href="$Url&pageno={$pagination['last_page']}">&raquo;&raquo;</a></li>
pgn;
                }
            } else {
                $this->paginacao .= <<<pgn
                <li><a $Attr href="$Url&pageno=1">1</a></li>
                <li><a $Attr href="$Url&pageno=2">2</a></li>
                <li class="previous-off">....</li>
pgn;

                for ($i = $pagination['current_page'] - (2 + (2 * $pagination['adjacentes'])); $i <= $pagination['current_page']; $i++) {

                    if ($i == $pagination['current_page']) {
                        $this->paginacao .= <<<pgn
                        <li class="active"><a class="active">$i</a></li>
pgn;
                    } else {
                        $this->paginacao .= <<<pgn
                        <li><a $Attr href="$Url&pageno=$i">$i</a></li>
pgn;
                    }
                }
                $this->paginacao .= <<<pgn
                <li class="a-focus">&raquo;</li>
                <li class="a-focus">&raquo;&raquo;</li>
pgn;
            }
        } else {
            $this->paginacao .= <<<pgn
            <li class="a-focus">&laquo;&laquo;</li>
            <li class="a-focus">&laquo;</li>
            <li><a $Attr class="active">1</a></li>
            <li class="a-focus">&raquo;</li>
            <li class="a-focus">&raquo;&raquo;</li>
pgn;
        }

//        GravaLogGrava(__FILE__ . " Linha: " . __LINE__ . "  " . __FUNCTION__ . " $this->paginacao ", basename(__FILE__));
        return $this->paginacao;
    }

    public function getCurrent_page() {
        return $this->current_page;
    }

    public function getTotal_items() {
        return $this->total_items;
    }

    public function getItems_per_page() {
        return $this->items_per_page;
    }

    public function getTotal_pages() {
        return $this->total_pages;
    }

    public function getCurrent_first_item() {
        return $this->current_first_item;
    }

    public function getCurrent_last_item() {
        return $this->current_last_item;
    }

    public function getPrevious_page() {
        return $this->previous_page;
    }

    public function getNext_page() {
        return $this->next_page;
    }

    public function getFirst_page() {
        return $this->first_page;
    }

    public function getLast_page() {
        return $this->last_page;
    }

    public function getAdjacentes() {
        return $this->adjacentes;
    }

    public function getOffset() {
        return $this->offset;
    }

    public function getLimit() {
        return $this->limit;
    }

    public function setCurrent_page($current_page) {
        $this->current_page = $current_page;
        return $this;
    }

    public function setTotal_items($total_items) {
        $this->total_items = $total_items;
        return $this;
    }

    public function setItems_per_page($items_per_page) {
        $this->items_per_page = $items_per_page;
        return $this;
    }

    public function setTotal_pages($total_pages) {
        $this->total_pages = $total_pages;
        return $this;
    }

    public function setCurrent_first_item($current_first_item) {
        $this->current_first_item = $current_first_item;
        return $this;
    }

    public function setCurrent_last_item($current_last_item) {
        $this->current_last_item = $current_last_item;
        return $this;
    }

    public function setPrevious_page($previous_page) {
        $this->previous_page = $previous_page;
        return $this;
    }

    public function setNext_page($next_page) {
        $this->next_page = $next_page;
        return $this;
    }

    public function setFirst_page($first_page) {
        $this->first_page = $first_page;
        return $this;
    }

    public function setLast_page($last_page) {
        $this->last_page = $last_page;
        return $this;
    }

    public function setAdjacentes($adjacentes) {
        $this->adjacentes = $adjacentes;
        return $this;
    }

    public function setOffset($offset) {
        $this->offset = $offset;
        return $this;
    }

    public function setLimit($limit) {
        $this->limit = $limit;
        return $this;
    }

}

?>
