/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function reFazQtdProdOrc(qtd) {
//    debugger;
    var qtdProdOrcamento = document.getElementsByName("qtdProdOrcamento");
    var itens = qtd == 1 ? " item" : " itens";
    for (var i = 0; i < qtdProdOrcamento.length; i++) {
//        qtdProdOrcamento[i].innerHTML = jsonResult.qtd;
        qtdProdOrcamento[i].innerHTML = "(" + qtd + itens + ")";
    }
    fazClkOrc();
}

function fazClkOrc() {
    if (!qtdProdOrc > 0){
        $('.wish-list').removeAttr('href');
//        $('.wish-list').attr('onclick', 'alert("Inclua Produtos para acessar essa página")');
        $('.wish-list').attr('onclick', 'alert("Para acessar a página do meu orçamento você precisa antes incluir produtos")');
    }else{
        $('.wish-list').removeAttr('onclick');
        $('.wish-list').attr('href', '?page=orcamento');
    }
}

var maxqtdProdOrc = 20;
//var qtdProdOrc = 0;
var XMLHttp = createRequest();
function incluirProdutoOrcamento(idOrc, idLoja, idProd, idInd) {
//    debugger;
//    console.log('incluirAoOrcamento');
    var par;
    par = "acao=incluir&idOrc=" + idOrc + "&idLoja=" + idLoja + "&idProd=" + idProd + "&idInd=" + idInd;

//    XMLHttp.open("get", "action/orcamento.php" + par, false);
    XMLHttp.open("post", "action/orcamento.php", false);
    XMLHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    XMLHttp.onreadystatechange = function() {
        if ((XMLHttp.readyState == 4) && (XMLHttp.status == 200 || XMLHttp.status == 0)) {
//            debugger;
            var jsonResult = XMLHttp.responseText;
            jsonResult = jsonResult.replace(/\n/, "");
            jsonResult = jsonResult.replace(/\t/, "");
            jsonResult = jsonResult.replace(/\s*/, "");
            jsonResult = jsonResult.replace(/(.*)(\{.*\})(.*)/, "$2");
//            jsonResult = obj = JSON && JSON.parse(XMLHttp.responseText) || $.parseJSON(XMLHttp.responseText);
//            jsonResult = eval("(function(){return " + XMLHttp.responseText + ";})()");
            jsonResult = eval("(function(){return " + jsonResult + ";})()");            
            
//            FazMsg("Produto Incluso ao Orçamento", {mouse: true});
            
//            alert('incluido: ' + jsonResult.resp);
//            consolelog('incluido: ' + jsonResult.resp);
//            console.log('jsonResult: '+jsonResult.resp);
//            var str = '';
//            for (var i = 0; i < jsonResult.length; i++) {
//            }

            qtdProdOrc = jsonResult.qtd;
            reFazQtdProdOrc(jsonResult.qtd);
//            consolelog('qtd' + jsonResult.qtd);
        }
    };
//    if (qtdProdOrc < maxqtdProdOrc){
    XMLHttp.send(par);
//    }else{
//        FazMsg("Muitos produtos no orçamento, para incluir um novo remova algum");
//    }
}

function alterarProdutoOrcamento(idOrc, idLoja, idProd, idInd, Qtd) {
//    console.log('alterarOrcamento');
    var par;
    par = "acao=alterar&idOrc=" + idOrc + "&idLoja=" + idLoja + "&idProd=" + idProd + "&idInd=" + idInd + "&Qtd=" + Qtd;

//    XMLHttp.open("get", "action/orcamento.php" + par, false);
    XMLHttp.open("post", "action/orcamento.php", false);
    XMLHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    XMLHttp.onreadystatechange = function() {
        if ((XMLHttp.readyState == 4) && (XMLHttp.status == 200 || XMLHttp.status == 0)) {
            var jsonResult = XMLHttp.responseText;
            jsonResult = jsonResult.replace(/\n/, "");
            jsonResult = jsonResult.replace(/\t/, "");
            jsonResult = jsonResult.replace(/\s*/, "");
            jsonResult = jsonResult.replace(/(.*)(\{.*\})(.*)/, "$2");
//            jsonResult = obj = JSON && JSON.parse(XMLHttp.responseText) || $.parseJSON(XMLHttp.responseText);
//            jsonResult = eval("(function(){return " + XMLHttp.responseText + ";})()");
            jsonResult = eval("(function(){return " + jsonResult + ";})()");

//            alert('alterado: ' + jsonResult.resp);
//            consolelog('alterado: ' + jsonResult.resp);
//            alert('jsonResult: '+jsonResult.sql);
//            console.log('jsonResult: '+jsonResult.sql);
//            console.log('jsonResult: '+jsonResult.resp);
//            var str = '';
//            for (var i = 0; i < jsonResult.length; i++) {
//            }
        }
    };
    XMLHttp.send(par);
}

function removerProdutoOrcamento(idOrc, idLoja, idProd, idInd) {
//    debugger;
//    console.log('removerOrcamento');
    var par;
    par = "acao=remover&idOrc=" + idOrc + "&idLoja=" + idLoja + "&idProd=" + idProd + "&idInd=" + idInd;

//    XMLHttp.open("get", "action/orcamento.php" + par, false);
    XMLHttp.open("post", "action/orcamento.php", false);
    XMLHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    var returno;
    XMLHttp.onreadystatechange = function(_returno) {
        if ((XMLHttp.readyState == 4) && (XMLHttp.status == 200 || XMLHttp.status == 0)) {
//            debugger;
            var jsonResult = XMLHttp.responseText;
            jsonResult = jsonResult.replace(/\n/, "");
            jsonResult = jsonResult.replace(/\t/, "");
            jsonResult = jsonResult.replace(/\s*/, "");
            jsonResult = jsonResult.replace(/(.*)(\{.*\})(.*)/, "$2");
//            jsonResult = obj = JSON && JSON.parse(XMLHttp.responseText) || $.parseJSON(XMLHttp.responseText);
//            jsonResult = eval("(function(){return " + XMLHttp.responseText + ";})()");
            jsonResult = eval("(function(){return " + jsonResult + ";})()");

//            FazMsg("Produto Removido do Orçamento", {mouse: true});
            
//            alert('removido: ' + jsonResult.resp);
//            consolelog('removido: ' + jsonResult.resp);
//            alert('jsonResult: '+jsonResult.sql);
//            console.log('jsonResult: '+jsonResult.resp);
//            console.log('jsonResult: '+jsonResult.sql);
//            var str = '';
//            for (var i = 0; i < jsonResult.length; i++) {
//            }

            qtdProdOrc = jsonResult.qtd;
            reFazQtdProdOrc(jsonResult.qtd);

            if (jsonResult.resp == 'OK') {
                returno = true;
            } else {
                returno = false;
            }
        }
    };
    XMLHttp.send(par);
    return returno;
}

function listarOrcamento(idOrc, idLoja, idProd, idInd) {
//    debugger;
//    console.log('listarOrcamento');
    var par;
    par = "acao=listar&idOrc=" + idOrc + "&idLoja=" + idLoja + "&idProd=" + idProd + "&idInd=" + idInd;

//    XMLHttp.open("get", "action/orcamento.php" + par, false);
    XMLHttp.open("post", "action/orcamento.php", false);
    XMLHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    XMLHttp.onreadystatechange = function() {
        if ((XMLHttp.readyState == 4) && (XMLHttp.status == 200 || XMLHttp.status == 0)) {
            var jsonResult = XMLHttp.responseText;
            jsonResult = jsonResult.replace(/\n/, "");
            jsonResult = jsonResult.replace(/\t/, "");
            jsonResult = jsonResult.replace(/\s*/, "");
            jsonResult = jsonResult.replace(/(.*)(\{.*\})(.*)/, "$2");
//            jsonResult = obj = JSON && JSON.parse(XMLHttp.responseText) || $.parseJSON(XMLHttp.responseText);
//            jsonResult = eval("(function(){return " + XMLHttp.responseText + ";})()");
            jsonResult = eval("(function(){return " + jsonResult + ";})()");

//            FazMsg("Orçamento");
//            alert('lista: ' + jsonResult.resp);
            consolelog('lista: ' + jsonResult.resp);

//            console.log('jsonResult: '+jsonResult.resp);
//            console.log(jsonResult.sql);
            var str = '';
            for (var i = 0; i < jsonResult.lista.length; i++) {
//                console.log(jsonResult.lista[i]);
//                alert(jsonResult.lista[i]);
                str += jsonResult.lista[i].Id_Produto + jsonResult.lista[i].nome_produto + jsonResult.lista[i].fabr_produto + "\n";
            }
//            alert(str);
//            console.log(str);
        }
    };
    XMLHttp.send(par);
}


var timerMsg;
function LimpaMsg(fadeOut) {
    if (!fadeOut) fadeOut = 1000;
    $('#mensagem').fadeOut(fadeOut);
    clearInterval(timerMsg);
}
//function FazMsg(Qmsg, Qbkg, Qmouse) {
function FazMsg(Qmsg, opts) {
    if (!opts) {
        opts = new Array();
    }
    var body = document.getElementsByTagName("body")[0];
    if (!document.getElementById('mensagem')) {
        var divMensagem = document.createElement('div');
        divMensagem.innerHTML = "<strong><span id='msg'></span></strong>";
        divMensagem.setAttribute('id', 'mensagem');
        body.appendChild(divMensagem);
//    }else{
//        var divMensagem = document.getElementById('mensagem');
    }
    var obj = document.getElementById('mensagem');
    var objMsg = document.getElementById('msg');

    objMsg.innerHTML = Qmsg;
//    $('#mensagem').centraliza();

    var O = {
        background: ''
        ,border: ''
        ,mouse: false
        ,timer: 2500
        ,fadeIn: 1000
        ,fadeOut: 1000
        ,opacity: 1
    }

//    debugger;
    if (opts.background) {
        O.background = opts.background;
    }
    if (opts.border) {
        O.border = opts.border;
    }
    if (opts.mouse) {
        O.mouse = opts.mouse;
    }
    if (opts.timer) {
        O.timer = opts.timer;
    }
    if (opts.fadeIn) {
        O.fadeIn = opts.fadeIn;
    }
    if (opts.opacity) {
        O.opacity = opts.opacity;
    }
    
    if (O.mouse) {
        $("#mensagem").css({position: "absolute", left: mouseX, top: mouseY});
    } else {
        $("#mensagem").css({right: 30});
    }
    
    $("#mensagem").css('background-color', O.background);
    
    $('#mensagem').fadeIn(O.fadeIn);
    clearInterval(timerMsg);
    timerMsg = setTimeout(function() {
        LimpaMsg(O.fadeOut);
    }, O.timer);

//    if (Qmouse) {
//        $("#mensagem").css({position: "absolute", left: mouseX, top: mouseY});
//    } else {
//        $("#mensagem").css({right: 30});
//    }
//
//    if (Qbkg) {
//        $("#mensagem").css('background-color', Qbkg);
//    } else {
//        $("#mensagem").css('background-color', '');
//    }
//    $('#mensagem').fadeIn(1000);
//    clearInterval(timerMsg);
//    timerMsg = setTimeout(function() {
//        LimpaMsg();
//    }, 2500);

//    var objMsgMostra = document.getElementById('MensagemAtual');
//    objMsg.innerHTML = objMsgMostra.value;
//    obj.style.display = 'block';
//    fadeIn('mensagem', 1);
}

var mouseX;
var mouseY;
$(document).mousemove(function(e) {
    mouseX = e.pageX;
    mouseY = e.pageY;
});

$().ready(function() {
    preparaFazerOrc();
});
function preparaFazerOrc() {
//    $('.verIndustriaOrcamento').hide();

//    $('.verIndustriaOrcamento > option').hover(function() {
//        $(this).toggleClass('option');
//    }, function() {
//        $(this).toggleClass('option');
//    });

    $('.fecharOrc').click(function() {
        $(this).closest('.verIndustriaOrcamento').hide();
    });

    $('.verIndustriaOrcamentolb').click(function() {
        $('.verIndustriaOrcamento').hide();
        $(this).next('.verIndustriaOrcamento').toggle();
    });

    $('.verIndustriaOrcamentoOption').click(function(event) {
        var idOrc = $(this).parent().attr('idOrc');
        var idLoja = $(this).parent().attr('idLoja');
        var idProd = $(this).parent().attr('idProd');
        var idInd = $(this).attr('idInd');
//        debugger;
        
//        alert(qtdProdOrc);
        
        var e = event || window.event; 
        if (!$(e.target).is('input')) {
//            e.stopPropagation();
            e.stopPropagation();
            e.preventDefault();
            e.stopImmediatePropagation();
            
            $(this).children('input').click();
            return;
        }
        
        if ($(this).children('input').is(':checked')) {
//            debugger;
            if (!(qtdProdOrc < maxqtdProdOrc)) {
                $(this).children('input').attr('checked', false);
                
                var t = $(this).parents('.verIndustriaOrcamento');
                t.tooltipster({
                    timer: 2500
                    ,trigger: 'click'
//                    ,position: 'right'
                    ,contentAsHTML: true
                    ,theme: 'tooltipster-light-noir'
                    ,content: '<center>Muitos produtos no orçamento,<br/> para incluir um novo remova algum</center>'
                });
                t.tooltipster('show');
                setTimeout(function(_t){
                    t.tooltipster('destroy');
                    t.removeAttr('title');
                }, 2500);
//                FazMsg("Muitos produtos no orçamento,<br/> para incluir um novo remova algum", {mouse: true});
                return;
            }
            incluirProdutoOrcamento(idOrc, idLoja, idProd, idInd);
            
            $(this).parents(':eq(5)').find('.mOrc').show();
            $(this).parents(':eq(5)').find('.mOrc').tooltipster('destroy');
            $(this).parents(':eq(5)').find('.mOrc').tooltipster({
                timer: 2500
                ,position: 'right'
                ,contentAsHTML: true
                ,theme: 'tooltipster-light'
                ,content: 'Produto incluso ao orçamento'
            });
            $(this).parents(':eq(5)').find('.mOrc').tooltipster('show');
        } else {
            removerProdutoOrcamento(idOrc, idLoja, idProd, idInd);
        }
        if ($(this).parent().children('dd').children("input:checked").length > 0){
            $(this).parents(':eq(5)').children('.mOrc').show();
            
            $(this).parents('.verIndustriaOrcamento').prev('.verIndustriaOrcamentolb').html('Produto incluso');
            $(this).parents('.verIndustriaOrcamento').prev('.verIndustriaOrcamentolb').addClass('inc btn-inverse-ver');
        }else{
            $(this).parents(':eq(5)').children('.mOrc').hide();
            
            $(this).parents('.verIndustriaOrcamento').prev('.verIndustriaOrcamentolb').html('Incluir ao orçamento +');
            $(this).parents('.verIndustriaOrcamento').prev('.verIndustriaOrcamentolb').removeClass('inc btn-inverse-ver');
        }
//        $(this).parent().parent().hide();
    });

//    $('.verIndustriaOrcamentoOption').click(function() {
//        $(this).toggleClass('checked');
//        var idOrc = $(this).parent().attr('idOrc');
//        var idLoja = $(this).parent().attr('idLoja');
//        var idProd = $(this).parent().attr('idProd');
//        var idInd = $(this).attr('idInd');
//        debugger;
//        if ($(this).hasClass('checked')) {
//            incluirProdutoOrcamento(idOrc, idLoja, idProd, idInd);
//        } else {
//            removerProdutoOrcamento(idOrc, idLoja, idProd, idInd);
//        }
//        $(this).parent().hide();
//    });


////    $('.verIndustriaOrcamento > option').click(function() {
//        $('.verIndustriaOrcamentoOption').click(function() {
//            var idOrc = $(this).parent().attr('idOrc');
//            var idLoja = $(this).parent().attr('idLoja');
//            var idProd = $(this).parent().attr('idProd');
//            debugger;
//            if ($(this).is(':checked')) {
//                incluirProdutoOrcamento(idOrc, idLoja, idProd, $(this).val());
//            } else {
//                removerProdutoOrcamento(idOrc, idLoja, idProd, $(this).val());
//            }
//            $(this).parent().hide();
//        });

//    $('.verIndustriaOrcamento').MultiSelect();
    /**
     * Método de (de)selecionar sem segurar control
     */
//    $('.verIndustriaOrcamento > option').mousedown(function(e) {
//        e.preventDefault();
//        $(this).prop('selected', $(this).prop('selected') ? false : true);
//        return false;
//    });
    /**
     * Outro método de (de)selecionar sem segurar control
     */
//    $('.verIndustriaOrcamento').each(function() {
//        var select = $(this), values = {};
//        $('option', select).each(function(i, option) {
//            values[option.value] = option.selected;
//        }).click(function(event) {
//            values[this.value] = !values[this.value];
//            $('option', select).each(function(i, option) {
//                option.selected = values[option.value];
//            });
//        });
//    });

}


function fcTeste(Msg, opts) {
    var O = {
        background: ''
        ,mouse: false
        ,timer: 2500
        ,fadeIn: 1000
        ,fadeOut: 1000
    }

//    debugger;
//    http://javascript.info/tutorial/native-prototypes
//    http://javascript.info/tutorial/arguments
//    for (key in O) {
////        if (arrayHasOwnIndex(O, key)) {
//        if (O.hasOwnProperty(key)) {
//            console.log(key);
//            console.log(O[key]);
//        }
//    }
    if (opts.background) {
        O.background = opts.background;
    }
    if (opts.mouse) {
        O.mouse = opts.mouse;
    }
    if (opts.timer) {
        O.timer = opts.timer;
    }
    if (opts.fadeIn) {
        O.fadeIn = opts.fadeIn;
    }
    
    if (O.mouse) {
        debugger;
        var mouseXT;
        var mouseYT;
        $(document).mousemove(function(e) {
            mouseXT = e.pageX;
            mouseYT = e.pageY;
        });
        $("#mensagem").css({position: "absolute", left: mouseX, top: mouseY});
    } else {
        $("#mensagem").css({right: 30});
    }
    
    $("#mensagem").css('background-color', O.background);
    
    $('#mensagem').fadeIn(O.fadeIn);
    clearInterval(timerMsg);
    timerMsg = setTimeout(function() {
        LimpaMsg(O.fadeOut);
    }, O.timer);
    
//    debugger;
//    for (var i = 0; i < arguments.length; i++) {
//        console.log("Hi, " + arguments[i]);
//    }
    
//    debugger;
//    var a = ["a", "b", "c"];
//    a.forEach(function(entry) {
//        console.log(entry);
//    });

//    debugger;
//    var args1 = [].slice.call(arguments); // slice without parameters copies all
//    args1 = args1.join(':'); // now .join works
//    args1.forEach(function(entry) {
//        var args1 = [].slice.call(entry); // slice without parameters copies all
//        args1 = args1.join(':');
//
//        console.log('1' + entry);
//        args1.forEach(function(entry2) {
//            var args2 = [].slice.call(entry2); // slice without parameters copies all
//            args2 = args1.join(':');
//            console.log('2' + args2);
//        });
//    });
//
//    debugger;
//    var t = arguments[1].join(':');
//    for (var i = 0; i < arguments[1].length; i++) {
//
//        console.log("Hi, " + arguments[1][i]);
//
//    }
//
//    debugger;
////var args = [].join.call(arguments, ':');
//
//    var args = [].slice.call(arguments); // slice without parameters copies all
//
//    console.log(args.join(':')); // now .join works
//
//    console.log("Teste, " + args);
//    console.log("Teste.Opt, " + args.Opt);
}


