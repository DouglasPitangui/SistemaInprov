/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//$().ready(function() {
////    var browser = navigator.appName;
////    var browser_version = navigator.appVersion;
////
////    if (browser == 'Microsoft Internet Explorer' && browser_version < 10) {
////        return false;
////    } else {
////        $('#searchinput').fsearch();
////    }
//
////    $('#searchinput').fsearch();
//});

/*
 $(document).ready(function() {
 $('#searchinput').fsearch();
 });
 */

function is_img(file) {
    /**
     * 
     * @type Image|@exp;document@call;createElement|Image|@exp;document@call;createElement
     */
    var img = new Image();
    img.src = file;
    img.onload = function() {
        console.log("A imagem " + file + " existe");
        return true;
    }
    img.onerror = function() {
        console.log("A imagem " + file + " NÃO existe");
        return false;
    }

    /**
     * 
     * @type Image|@exp;document@call;createElement
     */
//    var img = document.createElement('img');
//    img.src = file;
//
//    img.onload = function() {
//        console.log("A imagem " + file + " existe");
//    }
//    img.onerror = function() {
//        console.log("A imagem " + file + " NAO existe");
//    }

    /**
     * 
     * @type XMLHttpRequest
     */
//    var ajax = new XMLHttpRequest();
//    ajax.open("GET", file, true);
//    ajax.send();
//    ajax.onreadystatechange = function() {
//        if (ajax.readyState == 4) {
//            var jpg = ajax.responseText;
//
//            if (ajax.status === 200) {
//                console.log("A imagem " + file + " existe");
//            } else {
//                console.log("A imagem " + file + " NAO existe");
//            }
//        }
//    }
}

//function fazonClick(e) {
//    debugger;
//    e = e || window.event;
//    var target = e.target || e.srcElement;//,text = target.textContent || text.innerText;
//    if ($(this).children() == document.getElementById('divResult')) {
//        document.getElementById('divResult').style.display = 'none';
//    }
//    if (false) {
//        if (target == document.getElementById('divResult')
//                //            || target in (document.getElementById('divResult').childNodes)
//                //            || target in (document.getElementById('divResultLu').childNodes)
//                || target == (document.getElementById('divResultLu'))
//                || target.parentNode == (document.getElementById('divResultLu'))
//                || target.parentNode.parentNode == (document.getElementById('divResultLu'))
//                || target == document.getElementById('search-footer')
//                ) {
//
//        } else {
//            document.getElementById('divResult').style.display = 'none';
//        }
//    }
//    if (target == document.getElementById('searchinput')) {
//        if (document.getElementById('divResultLu').innerHTML == '') {
//            document.getElementById('divResult').style.display = 'none';
//        } else {
//            document.getElementById('divResult').style.display = '';
////            console.log(document.getElementById('divResultLu').innerHTML);
//        }
//    }
//}
$(document).mouseup(function(e) {
    var container = $('#divResult');

    if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) { // ... nor a descendant of the container
        container.hide();
//        console.log('T');
    } else {
//        console.log('F');
    }
    
    $('#searchinput').click(function() {
        if ($('#divResultLu').html() != "") {
            $('#divResult').show();
        }
    });
    /**
     * 
     * @type Array de elementos
     */
//    var container = new Array();
//    container.push($('#item_1'));
//    container.push($('#item_2'));
//    
//    $.each(container, function(key, value) {
//        if (!$(value).is(e.target) // if the target of the click isn't the container...
//            && $(value).has(e.target).length === 0) // ... nor a descendant of the container
//        {
//            $(value).hide();
//        }
//    });
});

//window.onload = function() {
//    document.getElementById('divResult').addEventListener('blur', function() {
//        document.getElementById('divResult').style.display = 'none';
//    });
//}

//if (document.addEventListener) {
//    document.addEventListener('click', function(e) {
//        //Also, ensure if you need to support < IE9 that you use attachEvent() instead of addEventListener().
////        fazonClick(e);
//    }, false);
//} else {
//    document.attachEvent('onclick', function(e) {
//        //Also, ensure if you need to support < IE9 that you use attachEvent() instead of addEventListener().
////        fazonClick(e);
//    }, false);
//}

var XMLHttp = createRequest();
function pesquisaProduto(q, loja, event) {
    var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
//    consolelog(keyCode);
    if (!XMLHttp) {
        pesquisaProduto = "";
        return false;
    }

    // Quando pressionar 'esquerda' ou 'direita' ou 'espaço' ou 'shift' ou 'control'
    if (keyCode == 37 || keyCode == 39 || keyCode == 32 || keyCode == 16 || keyCode == 17) {
        return false;
    } else
    // When Down Arrow key is pressed
    if (keyCode == 40) {
//        if (current_index + 1 < items_total) {
//            current_index++;
//            change_selection($options, current_index);
//        }
        return false;
    } else
    // When Up Arrow is pressed
    if (keyCode == 38) {
//        if (current_index > 0) {
//            current_index--;
//            change_selection($options, current_index);
//        }
        return false;
    } else
    // When enter key is pressed
    if (keyCode == 13) {

    }


    if (!loja) {
        loja = 0;
    }
    var limit = 10;
    var offset = 0;
    {//Para Limpar a lista ao digitar novo produto
        document.getElementById('divResultLu').innerHTML = '';
    }
    if (q.length < 1) {
        document.getElementById('divResult').style.display = 'none';
        return false;
    }
//    console.log(q.length % 2 > 0);
    if (q.length >= 2) {
        fazPesquisa(q, limit, offset, loja);
    }
}

function fazPesquisa(q, limit, offset, loja) {
//    debugger;
    var divResult = document.getElementById('divResult');
    var divResultLu = document.getElementById('divResultLu');
    var searchfooter = document.getElementById('search-footer');
    var par = "?searchword=" + q + "&limit=" + limit + "&offset=" + offset;
    XMLHttp.open("get", "json.php" + par, true);

//    XMLHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    searchfooter.innerHTML = "<img src='img/loader.gif' alt='Carregando...'/>";
    searchfooter.style.cursor = 'auto';
    searchfooter.style.display = '';
    divResult.style.display = '';

    XMLHttp.onreadystatechange = function() {
        if ((XMLHttp.readyState == 4) && (XMLHttp.status == 200 || XMLHttp.status == 0)) {
            var jsonResult = XMLHttp.responseText;
//            jsonResult = obj = JSON && JSON.parse(XMLHttp.responseText) || $.parseJSON(XMLHttp.responseText);
            jsonResult = eval("(function(){return " + XMLHttp.responseText + ";})()");
//            console.log(jsonResult);
            var str = '';
            for (var i = 0; i < jsonResult.length; i++) {
                var qtd = Math.floor((Math.random() * 10) + 1);
                var myclass = 'option';
                var itemorcamento = ' ';
                jsonResult[i].nome_produto = jsonResult[i].nome_produto
                        .replace('\"', '&CloseCurlyDoubleQuote;')
                        .replace('\'', '&CloseCurlyQuote;');

                if (jsonResult[i].item_orcamento == true) {
//                    myclass = 'itemorcamento';
                    itemorcamento = '\nItem Incluido ao Orçamento';
                }
//                if (is_img("../"+jsonResult[i].img)){
//                    jsonResult[i].img = '';
//                }
//jsonResult[i].nome_produto.split(" ")[0]
                str += '<li id="' + jsonResult[i].id_produto + '" class="' + myclass + '"'
                        + 'title="' + jsonResult[i].nome_produto + itemorcamento + '"'
//                            + 'onclick="incluirProdutoOrcamento(\'Orc: 0101\'' + ', \'loja: ' + loja + '\',\'Produto: ' + jsonResult[i].id_produto + '\')'
                        + 'onclick="location = \'?page=produtos&searchinput='+jsonResult[i].nome_produto.split(" ")[0]+'\'"'
//                        + 'onclick="incluirProdutoOrcamento(\'orcTeste\', \'0\',\'' + jsonResult[i].id_produto + '\',\'0\')"'
//                        + 'onmousemove="this.style.background = \'#e2e2e2\';"'
//                        + 'onmouseover="console.log(\'over\');this.style.background = \'red\';"'
//                        + 'onmouseout="this.style.background = \'white\'"'
//                        + 'onmouseover="console.log(\'over\');this.style.background-color = \'white\';"'
                        + ' > '
                        + '<img class="profile_image" src="' + jsonResult[i].img + '"'
                        + 'alt="' + jsonResult[i].nome_produto + '"/> '
//                        + '<span class="name">' + jsonResult[i].nome_curto + '</span>'
                        + '<span class="name">' + jsonResult[i].nome_curto + '</span>'
                        + '<br/>' + jsonResult[i].fabr_produto
//                        + '<input type="button" value="Incluir"         onclick="incluirProdutoOrcamento(\'orcTeste\', \'0\',\''+ jsonResult[i].id_produto +'\',\'0\');">'
//                        + '<input type="button" value="Alterar '+qtd+'" onclick="alterarProdutoOrcamento(\'orcTeste\', \'0\',\''+ jsonResult[i].id_produto +'\',\'0\',\''+qtd+'\');">'
//                        + '<input type="button" value="Remover"         onclick="removerProdutoOrcamento(\'orcTeste\', \'0\',\''+ jsonResult[i].id_produto +'\',\'0\');">' 
//                        + '<input type="button" value="Listar"          onclick="        listarOrcamento(\'orcTeste\', \'0\',\''+ jsonResult[i].id_produto +'\',\'0\');">' 
                        + '</li>';
            }
//            console.log(str);
            {//Para incluir os novos resultados ao final da lista (+=) senão substituir (=)
                divResultLu.innerHTML += str;
            }
            if (jsonResult.length > 0) {
                searchfooter.innerHTML = 'Mais Resultados...';
                searchfooter.style.cursor = 'pointer';
                divResultLu.onscroll = function() {
                    if (this.scrollTop >= this.scrollHeight - this.offsetHeight - 120) {
//                        document.getElementById('search-footer').click();
                        searchfooter.click();
                    }
                }
            } else {
                searchfooter.innerHTML = '';
                searchfooter.innerHTML = 'Resultados encontrados: ' + divResultLu.childNodes.length;
                searchfooter.title = '';
                searchfooter.style.cursor = 'auto';
//                searchfooter.style.display = 'none';
                divResultLu.onscroll = '';
            }

            if (divResultLu.childNodes.length > 0) {
                searchfooter.title = 'Resultados visíveis: ' + divResultLu.childNodes.length;
            } else {
                searchfooter.title = '';
                searchfooter.style.display = 'none';
            }
            if (jsonResult.length > 0) {
                searchfooter.title = '';
            }
            searchfooter.onclick = function() {
//                document.getElementById('divResultLu').scrollTop = document.getElementById('divResultLu').scrollHeight;
//                divResultLu.scrollTop = divResultLu.scrollHeight;

                fazPesquisa(q, limit, (offset + limit + 0), loja);
//                return false;
            };
        }
    };
    XMLHttp.send();

//    console.log('pesq ' + q + ',limit ' + limit + ',offset ' + (offset + limit + 1) + ' ,loja ' + loja);
//    document.getElementById('search-footer').onclick = function() {
//        var divResultLu = document.getElementById('divResultLu');
//        divResultLu.scrollTop(divResultLu.scrollHeight);
////        document.getElementById('divResultLu').scrollTop(document.getElementById('divResultLu').scrollHeight);
//        fazPesquisa(q, limit, (offset + limit + 0), loja);
//        return false;
//    };
}
/**
 * 
 * @param {String} string
 * @returns {unresolved}
 * 
 * Following JavaScript function handles ', ", \b, \t, \n, \f or \r equivalent of php function addslashes().
 */
function addslashes(string) {
    return string.replace(/\\/g, '\\\\').
            replace(/\u0008/g, '\\b').
            replace(/\t/g, '\\t').
            replace(/\n/g, '\\n').
            replace(/\f/g, '\\f').
            replace(/\r/g, '\\r').
            replace(/'/g, '\\\'').
            replace(/"/g, '\\"');
}

jQuery.fn.fsearch = function() {
    var limit = 40;
    var offset = 0;
    var $searchInput = $(this);
    $searchInput.after('<div id="divResult"></div>');
    $resultDiv = $('#divResult');
    $searchInput.focus();
    $searchInput.addClass('searchi');
    $resultDiv.html("<ul style='max-height: 300; overflow-y: auto;'></ul><div id='search-footer' class='searchf'></div>");

    $searchInput.keyup(function(e) {
        offset = 0;
        var q = $(this).val();
//        if (q != '') {
        if (q.length >= 3) {
            var current_index = $('.selected').index(),
                    $options = $resultDiv.find('.option'),
                    items_total = $options.length;

            // When Down Arrow key is pressed
            if (e.keyCode == 40) {
                if (current_index + 1 < items_total) {
                    current_index++;
                    change_selection($options, current_index);
                }
            }

            // When Up Arrow is pressed
            else if (e.keyCode == 38) {
                if (current_index > 0) {
                    current_index--;
                    change_selection($options, current_index);
                }
            }

            // When enter key is pressed
            else if (e.keyCode == 13) {
                var id = $resultDiv.find('ul li.selected').attr('id');
                var name = $resultDiv.find('ul li.selected').find('.name').text();
                $searchInput.val(name);
                $resultDiv.fadeOut();// Here you get the id and name of the element selected. You can change this to redirect to any page too. Just like facebook.   
            }
            else {
                $resultDiv.fadeIn();
                $resultDiv.find('#search-footer').html("<img src='img/loader.gif' alt='Carregando...'/>");

                $resultDiv.find('ul').html('');
                $resultDiv.find('ul').empty();
                fazPesquisaJquery(q, limit, offset);

//                $resultDiv.find('ul li').live('mouseover', function(e) {
//                    console.log('mousem');
//                    current_index = $resultDiv.find('ul il').index(this);
//                    console.log('Indice: ' + current_index);
//                    $options = $resultDiv.find('.option');
//                    change_selection($options, current_index);
//                });

            }
        }
        else {
            //Hide the results if there is no search input
            $resultDiv.hide();
            return false;
        }


        //faz a pesquisa
        function fazPesquisaJquery(q, limit, offset) {
            // Query search details from database
//            console.log('FP(' + q + ', ' + limit + ',offset' + (offset + limit + 1) + ')');
            $.getJSON("json.php", {searchword: q, limit: limit, offset: offset}, function(jsonResult) {
                var jsonResultLen = jsonResult.length;
                $resultDiv.find('div#search-footer').on('click', function() {
                });
                if (jsonResultLen == 0) {
                    $resultDiv.find('div#search-footer').hide();
                    if ($resultDiv.find('ul') == '') {
                        $resultDiv.hide();
//                        $resultDiv.find('div#search-footer').hide();                    
                    }
                    return false;
                } else {
                    $resultDiv.find('div#search-footer').show();
                }

                var str = '';
                for (var i = 0; i < jsonResult.length; i++) {

                    str += '<li id="' + jsonResult[i].id_produto + '" class="option" '
                            + 'title="' + jsonResult[i].nome_produto + '"'
                            + 'onclick="alert(\'' + jsonResult[i].id_produto + '\')"> '
                            + '<img class="profile_image" src="images/produtos_site/' + jsonResult[i].id_produto + '.jpg" '
                            + 'alt="' + jsonResult[i].nome_produto + '"/> '
                            + '<span class="name">' + jsonResult[i].nome_curto + '</span><br/>' + jsonResult[i].fabr_produto
                            + '</li>';
                }
//            $resultDiv.find('ul').empty().prepend(str);
//            $resultDiv.find('ul').prepend(str);
                $resultDiv.find('ul').append(str);

//            $resultDiv.find('div#search-footer').text(jsonResult.length + " resultados encontrados...");
                $resultDiv.find('div#search-footer').text("Mais resultados...");

//                $resultDiv.find('div#search-footer').on('click', function() {
//                    alert(q);
//                    fazPesquisa(q, limit, (offset + limit + 0));
//                    return false;
////                console.log('pesq '+ q + ',limit ' + limit + ',offset ' + (offset + limit + 1));
//                });

                document.getElementById('search-footer').onclick = function() {
                    fazPesquisaJquery(q, limit, (offset + limit + 0));
                    return false;
                };

                $resultDiv.find('ul li').first().addClass('selected');
            });

        }

        // Change selected element style by adding a css class
        function change_selection($options, current_index) {
            $options.removeClass('selected');
            $options.eq(current_index).addClass('selected');
        }
    });

    // Show previous search results when the search box is clicked
    $searchInput.click(function() {
        var q = $(this).val();
        if (q != '') {
            $resultDiv.fadeIn();
        }
    });

    // Hide the search result when clicked outside
    $(document).click(function(e) {
        //if ($(e.target).closest("#menuscontainer").length == 0) {
        // .closest can help you determine if the element 
        // or one of its ancestors is #menuscontainer

        var obj = $(event.target);
        obj = obj['context'];

        if ($('#searchInput').is(obj)
                || $('#divResult ul li').is(obj)
                || $('#divResult span').is(obj)
                || $('#divResult img').is(obj)
                || $('.searchi').is(obj)
                || $('.searchf').is(obj)
                ) {

//            console.log("show");
        } else {
            $resultDiv.fadeOut();
//            $('#divResult').hide();
//            console.log("hide");
        }
    });
//    jQuery(document).live("click", function(e) {
//        var $clicked = $(e.target);
////        alert($('#divResult') == $clicked);
//        if ($clicked.hasClass("searchi") || $clicked.hasClass("searchf")) {
//            
//        }
//        else {
//            $resultDiv.fadeOut();
//        }
//    });

//    // Select the element when it is clicked
//    $resultDiv.find('li').live("click", function(e) {
//        var id = $(this).attr('id');
//        var name = ($(this).find('.name').text());
//        $searchInput.val(name);
//    });

};

function doDestacaTexto(Texto, termoBusca) {

    /*******************************************************************/
    // CASO QUEIRA MODIFICAR O ESTILO DA MARCAÇÃO ALTERE ESSAS VARIÁVEIS
    /*******************************************************************/
    inicioTag = "<font style='color:#000;background-color:#A0FFFF'><b>";
    fimTag = "</b></font>";

    var novoTexto = "";
    var i = -1;
    var lcTermoBusca = termoBusca.toLowerCase();
    var lcTexto = Texto.toLowerCase();

    while (Texto.length > 0) {
        i = lcTexto.indexOf(lcTermoBusca, i + 1);
        if (i < 0) {
            novoTexto += Texto;
            Texto = "";
        }
        else {
            if (Texto.lastIndexOf(">", i) >= Texto.lastIndexOf("<", i)) {
                if (lcTexto.lastIndexOf("/script>", i) >= lcTexto.lastIndexOf("<script", i)) {
                    novoTexto += Texto.substring(0, i) + inicioTag + Texto.substr(i, termoBusca.length) + fimTag;
                    Texto = Texto.substr(i + termoBusca.length);
                    lcTexto = Texto.toLowerCase();
                    i = -1;
                }
            }
        }
    }
    ;
    return novoTexto;
}

function doDestacaTextoBusca(textoBusca, textoObj, ehFrase) {
    if (ehFrase) {
        arrayBusca = [textoBusca];
    } else {
        arrayBusca = textoBusca.split(" ");
    }

    var Texto = textoObj.innerHTML;

    for (var i = 0; i < arrayBusca.length; i++) {
        Texto = doDestacaTexto(Texto, arrayBusca[i]);
    }
//    console.log("Texto: " + Texto);
    textoObj.innerHTML = Texto;
    return true;
}

/*
 (function($) {
 $.fn.fsearch = function() {
 var $searchInput = $(this);
 $searchInput.after('<div id="divResult"></div>');
 $resultDiv = $('#divResult');
 $searchInput.focus();
 $searchInput.addClass('searchi');
 $resultDiv.html("<ul></ul><div id='search-footer' class='searchf'></div>");
 $searchInput.keyup(function(e) {
 var q = $(this).val();
 if (q != '') {
 var current_index = $('.selected').index(),
 $options = $resultDiv.find('.option'),
 items_total = $options.length;
 
 // When Down Arrow key is pressed
 if (e.keyCode == 40) {
 if (current_index + 1 < items_total) {
 current_index++;
 change_selection($options, current_index);
 }
 }
 
 // When Up Arrow is pressed
 else if (e.keyCode == 38) {
 if (current_index > 0) {
 current_index--;
 change_selection($options, current_index);
 }
 }
 
 // When enter key is pressed
 else if (e.keyCode == 13) {
 var id = $resultDiv.find('ul li.selected').attr('id');
 var name = $resultDiv.find('ul li.selected').find('.name').text();
 $searchInput.val(name);
 $resultDiv.fadeOut();// Here you get the id and name of the element selected. You can change this to redirect to any page too. Just like facebook.   
 }
 else {
 $resultDiv.fadeIn();
 $resultDiv.find('#search-footer').html("<img src='img/loader.gif' alt='Carregando...'/>");
 
 $resultDiv.find('ul').html('');
 
 // Query search details from database
 $.getJSON("json.php", {searchword: q}, function(jsonResult) {
 //                        if (jsonResult.length == 0){
 //                            $resultDiv.html('');
 //                        }
 
 var str = '';
 //                        for (var i = 0; i < jsonResult.length; i++)
 for (var i = 0; i < 6; i++)
 {
 str += '<li id=' + jsonResult[i].id_produto + ' class="option"><img class="profile_image" src="images/produtos_site/' + jsonResult[i].id_produto + '.jpg" alt="' + jsonResult[i].nome_produto + '"/><span class="name">' + jsonResult[i].nome_produto + '</span><br/>' + jsonResult[i].fabr_produto + '</li>';
 }
 $resultDiv.find('ul').empty().prepend(str);
 //                        $resultDiv.find('div#search-footer').text(jsonResult.length + " resultados encontrados...");
 $resultDiv.find('div#search-footer').text(jsonResult.length-6 + " outros resultados...");
 $resultDiv.find('ul li').first().addClass('selected');
 });
 
 $resultDiv.find('ul li').live('mouseover', function(e) {
 current_index = $resultDiv.find('ul li').index(this);
 $options = $resultDiv.find('.option');
 change_selection($options, current_index);
 });
 
 // Change selected element style by adding a css class
 function change_selection($options, current_index) {
 $options.removeClass('selected');
 $options.eq(current_index).addClass('selected');
 }
 }
 }
 else {
 //Hide the results if there is no search input
 $resultDiv.hide();
 }
 });
 
 // Hide the search result when clicked outside
 jQuery(document).live("click", function(e) {
 var $clicked = $(e.target);
 if ($clicked.hasClass("searchi") || $clicked.hasClass("searchf")) {
 }
 else {
 $resultDiv.fadeOut();
 }
 });
 
 // Show previous search results when the search box is clicked
 $searchInput.click(function() {
 var q = $(this).val();
 if (q != '')
 {
 $resultDiv.fadeIn();
 }
 });
 
 // Select the element when it is clicked
 $resultDiv.find('li').live("click", function(e) {
 var id = $(this).attr('id');
 var name = ($(this).find('.name').text());
 $searchInput.val(name);
 });
 
 };
 })(jQuery);
 */


