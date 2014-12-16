<?php
session_start();
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

$_paginator->total_items = $Alunos = ClsAluno::selectAluno($parr);
$pagination = $_paginator->paginate();

unset($parr['contar']);
$parr['limit'] = $pagination['limit'];
$parr['offset'] = $pagination['offset'];

$Alunos = ClsAluno::selectAluno($parr);
?> 
<!--<div class="product-catalog register login" style="clear:both;">-->
<div class="" style="">
    <div class="col-md-12">
        <div class="col-md-6 col-sm-6 col-xs-8">
            <h3 style="font-style:italic">Olá <?= ClsPessoa::selectPessoa(array(matricula => $_SESSION['matricula']))[0]->nome ?></h3>
        </div>
    </div>
    <div class="">
        <?php
//        var_dump($_SESSION);
        
        $pergunta = "Ao passar sobre um ponto de alagamento e perceber que o freio começa a apresentar falhas, o condutor deve?";
        $questao = "reduzir a velocidade, testar o freio e, se necessário, sinalizar, parar e procurar socorro";
        $resposta = "reduzir a velocidade, testar o freio e, se necessário, sinalizar, parar e procurar socorro";
//A - manter a velocidade constante até chegar ao destino
//B - reduzir a velocidade, testar o freio e, se necessário, sinalizar, parar e procurar socorro
//C - engrenar a primeira marcha para manter o motor acelerado
//D - acelerar utilizando somente uma marcha
//
//Correta: B | Sua resposta: C| Errou
        
        
        $pergunta = "Quando necessária a utilização do extintor de incêndio, onde o jato deve ser direcionado?";
        $questao = "para a base das chamas, em movimento horizontais";
        $resposta = "para a base das nao chamas, em não movimento não horizontais";
//        $resposta = "para a base das chamas, em movimento não horizontais não";
//        $resposta = "para a base das chamas, em deslocamento não horizontais não";
//A - para a base das chamas, em movimentos verticais
//B - para o topo das chamas, em movimentos verticais
//C - para a base das chamas, em movimentos horizontais
//D - para o topo das chamas, em movimentos horizontais
//
//Correta: C | Sua resposta: C| Acertou
            
            
//        $pergunta = "Sobre a crise de 29, qual pais ficou seriamente afetado e chegou a acusar um certo grupo por ser o culpado da crise, e por que?";
//        $questao = "A Alemanha ficou seriamente danificada com a crise. Seus habitantes não tinham emprego, eles não tinham poder bélico, eles não conseguiam vender. Culparam os judeus pois eles tem a cultura de serem mesquinhos e não gastarem comprando os produtos.";
//        $resposta = "A Alemanha, culparam os judeus, pois eles não gastavam";
//        $resposta = "A Alemanha, culparam os judeus, pois eles não possuiam trabalho, e os judeus não gastavam";

//        $pergunta = "'Uma força internacional acima das nações, na defesa da paz mundial, dos direitos do homem e da igualdade dos povos.' De que organização estamos falando, e para que ela foi criada?";
//        $questao = "A ONU foi formada para evitar a eclosão de uma nova guerra mundial.";
//        $questao = "ONU formada evitar nova guerra mundial";
//        $resposta = "A onu e foi criada para prevenir nova guerra mundial";
//        $resposta = "A onu e foi criada para prevenir que uma nova guerra mundial acontecesse";
//        
//        $resposta = "A onu e foi formada para evitar que uma nova guerra mundial acontecesse";
//        $resposta = "A onu e foi formada para prevenir que uma nova guerra mundial acontecesse";
        
//        $pergunta = "O Estados Unidos entrou na guerra por qual motivo?";
//        $questao = "Ataque, japonês, base, naval, Pearl Harbor";
//        $questao = "Ataque japonês base naval Pearl Harbor";
//        $resposta = "Ataque japonês à base naval americana de Pearl Harbor";
//        $resposta = "Ataque japonês à base naval americana de Pearl Harbor";
        
        
        
       // $resposta = "o salário mensal, o décimo terceiro salário, as gorjetas e as horas extras.";
      //  $resposta = "o salário mensal, o vale-transporte, o décimo terceiro salário e o vale-refeição.";
     //   $resposta = "o salário mensal, as férias indenizadas e respectivo adicional e o vale-refeição.";
     //   $resposta = "o salário mensal, o décimo terceiro salário, as gor-etas e o vale-refeição.";
     //   $resposta = "o décimo terceiro salário, as gorjetas, o vale-refeição, as férias indenizadas e o respectivo adicional.";
        
//        echo "Count resposta Professor:".count(preg_split("/\s+/", strtolower($questao)))."<br/>";
//        echo "Count resposta Aluno:".count(preg_split("/\s+/", strtolower($resposta)))."<br/><br/>";
//        echo "$questao<br/><br/>$resposta<br/>";
//        $result = ClsAvaliacao::corrigirQuestao($questao, $resposta);
        
        
        
        $questao = "A ONU, formada para evitar a eclosão de uma nova guerra mundial";
        $resposta = "A onu foi criada para prevenir uma nova guerra mundial";
        
        $questao = "Reduzir a velocidade, testar o freio e, se necessário, sinalizar, parar e procurar socorro";
        $resposta = "Aumentar a velocidade, testar o freio e, se necessário sinalizar, parar e procurar socorro";
//        
//        $questao = '"O lucro" é o agente da ação (sujeito) e "excelente" é uma qualidade do sujeito (predicativo do sujeito)';
//        $resposta = '"O lucro" é o agente da ação (sujeito) e "excelente" é uma qualidade do sujeito (predicativo do sujeito)';
//        
//        $questao = "Dicionário da EAP, linha de base do escopo e atualizações nos documentos de projeto";
//        $resposta = "Atualizações nos documentos de projeto, linha de base do escopo e dicionário da EA";
//        
//        $questao = "Um erro de compilação, indicando que houve uma tentativa de redefinir a variável x.";
//        $resposta = "Uma compilação sem erros ou advertências e a impressão do número 4";
//        
//        $questao = "Para a base das chamas, em movimento horizontal";
//        $resposta = "Para a essência das chamas, com movimento vertical";
//        
//        $questao = "Simples ou composto, determinado ou indeterminado.";
//        $resposta = "Simples e não indeterminado";
//        
//        $questao = "Comprarei livros ou comprarei um carro";
//        $resposta = "Não comprarei livros ou não comprarei um automóvel";
////        $questao = "Não Comprarei livros ou comprarei um carro";
////        $resposta = "comprarei livros ou não comprarei um automóvel";
//        
//        $questao = "Amanhã eu quererei ver os cadernos.";
//        $resposta = "Amanhã eu almejarei ver os cadernos";
//        
//        $questao = "Registrar, verificar se o problema está cadastrado como erro conhecido e se há workaround para ele";
//        $resposta = "Registrar, verificar se o problema está cadastrado como erro conhecido e se não há workaround para ele";
        
        
//        echo "Count resposta Professor:".count(preg_split("/\s+/", strtolower($questao)))."<br/>";
//        echo "Count resposta Aluno:".count(preg_split("/\s+/", strtolower($resposta)))."<br/><br/>";
//        echo "$questao<br/><br/>$resposta<br/>";
//        $result = ClsAvaliacao::corrigirQuestao($questao, $resposta);
//        var_dump($result);
        
//        $arrDescartar = array('o', 'os', 'um', 'uns', 'a', 'as', 'uma', 'umas', 'por', 'pelo', 'pelos', 'pela', 'pelas', 'em', 'no', 'nos', 'na', 'nas', 'de', 'do', 'dos', 'da', 'das', 'em', 'para', 'per', 'com'
//            , 'aquela', 'aquelas', 'aquele', 'aqueles', 'aquilo'
//        );
//        var_dump(count($arrDescartar));
//        
//        sort($arrDescartar);
//        echo "<table>";
//        for ($i = 1; $i <= 4; $i++) {
//            echo "<tr>";
//            
//            $f = 0;
//            foreach ($arrDescartar as $key => $value) {
//                $f++;
//                echo "<td>$arrDescartar[$key]<td>";
//                unset($arrDescartar[$key]);
//                if ($f == 8) {
//                    break;
//                }
//            }
//            echo "</tr>";
//        }
//        echo "</table>";
        
        $nota = 12.834;
        ?>
<!--        <div class="text-right quantity decimals">
            <input type="text" class="form-control" value="<?= $nota; ?>" placeholder="Nota" style="width: 100px;">
        </div>-->
    </div>
</div>