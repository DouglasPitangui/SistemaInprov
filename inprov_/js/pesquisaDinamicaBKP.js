/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$().ready(function() {
//    var browser = navigator.appName;
//    var browser_version = navigator.appVersion;
//
//    if (browser == 'Microsoft Internet Explorer' && browser_version < 10) {
//        return false;
//    } else {
//        $('#searchInput').fsearch();
//    }

    $('#searchInput').fsearch();
});

/*
 $(document).ready(function() {
 $('#searchInput').fsearch();
 });
 */


jQuery.fn.fsearch = function() {
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
                    var jsonResultLen = jsonResult.length;
                    if (jsonResultLen == 0) {
                        $resultDiv.hide();
//                        $resultDiv.find('div#search-footer').hide();
                        return false;
                    } else if (jsonResultLen > 6) {
                        jsonResultLen = 6;
                    }

                    var str = '';
//                    for (var i = 0; i < jsonResult.length; i++) {
                    for (var i = 0; i < jsonResultLen; i++) {

                        str += '<li id="' + jsonResult[i].id_produto + '" class="option" '
                                    + 'title="' + jsonResult[i].nome_produto + '"'
                                    + 'onclick="alert(\'' + jsonResult[i].id_produto + '\')"> '
                                + '<img class="profile_image" src="images/produtos_site/' + jsonResult[i].id_produto + '.jpg" '
                                + 'alt="' + jsonResult[i].nome_produto + '"/> '
                                + '<span class="name">' + jsonResult[i].nome_curto + '</span><br/>' + jsonResult[i].fabr_produto
                                + '</li>';
                    }
                    $resultDiv.find('ul').empty().prepend(str);
//                    $resultDiv.find('div#search-footer').text(jsonResult.length + " resultados encontrados...");
                    $resultDiv.find('div#search-footer').text(jsonResult.length - jsonResultLen + " outros resultados...");
                    $resultDiv.find('ul li').first().addClass('selected');

//                    console.log("Nome: " + document.getElementById('searchInput').value);
//                    for (var f = 0; f < $('#divResult ul li').length; f++) {
//                        doDestacaTextoBusca(document.getElementById('searchInput').value, $('#divResult ul li')[f]);
//                    }
                });

//                $('#divResult ul').bind("mouseenter", function() { console.log("Indice you rolled over") });
//                $('#divResult li').on("mouseover", function(e) { alert("Indice you rolled over") });
//                $("#divResult li").mousemove(function( event ) {
////                    $(this).
//                    current_index = $resultDiv.index(this);//$resultDiv.find('ul il').index(this);
//                    console.log('Indice: ' + current_index);
//
//                    var msg = "Handler for .mousemove() called at ";
//                    msg += event.pageX + ", " + event.pageY;
////                    $( "#log" ).append( "<div>" + msg + "</div>" );
//                    console.log("Indice you rolled over");
//                });
//                $("#divResult").children("li").each(function() {
//                    $(this).mouseover(function() {
//                        $(this).css("background-Color", "#c0c0c0");
//                        console.log("Indice you rolled over");
//                    });
////                    $(this).mouseout(function() {
////                        $(this).css("background-Color", "#FFF");
////                    });
//                });



//                $resultDiv.find('ul li').live('mouseover', function(e) {
//                    console.log('mousem');
//                    current_index = $resultDiv.find('ul il').index(this);
//                    console.log('Indice: ' + current_index);
//                    $options = $resultDiv.find('.option');
//                    change_selection($options, current_index);
//                });

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


