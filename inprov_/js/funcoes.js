//by Deivid G Mattos
//Teknow Lab. Criativo
//data 17/06/2013
//contato contato@teknow.com.br
jQuery.fn.centra_Hor = function() {
    this.css("position", "absolute");
    this.css("left", ($(window).width() - this.width()) / 2 + $(window).scrollLeft() + "px");
    return this;
}
jQuery.fn.centraliza = function() {
    this.css("position", "absolute");
    this.css("top", ($(window).height() - this.height()) / 2 + $(window).scrollTop() + "px");
    this.css("left", ($(window).width() - this.width()) / 2 + $(window).scrollLeft() + "px");
    return this;
}
jQuery.fn.center = function() {
    this.css("top", ($(window).height() - this.height()) / 2 + $(window).scrollTop() + "px");
    this.css("left", ($(window).width() - this.width()) / 2 + $(window).scrollLeft() + "px");
    return this;
}
jQuery.fn.center = function() {
    this.css('position', 'absolute');
    this.css("top", ($(window).height() - this.height()) / 2 + $(window).scrollTop() + "px");
    return this;
}
jQuery.fn.topcenter = function() {
    this.css("position", "absolute");
    this.css("left", ($(window).width() - this.width()) / 2 + $(window).scrollLeft() + "px");
    return this;
}
jQuery.fn.margincenter = function() {
    if ($(window).width() > 938) {
        this.css("margin-left", ($(window).width() - this.width()) / 2 + $(window).scrollLeft() + "px");
        return this;
    }
}

function isMobile() {
    var a = navigator.userAgent || navigator.vendor || window.opera;
    if (/android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|ip(hone|od|ad)|iris|kindle|lge |maemo|midp|mmp|mobile|o2|opera m(ob|in)i|palm( os)?|p(ixi|re)\/|plucker|pocket|psp|smartphone|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce; (iemobile|ppc)|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i.test(a))
        return true;
    else
        return false;
}

function isNumber(n) {
    var isNumeric = /^[-+]?(\d+|\d+\.\d*|\d*\.\d+)$/;
    return isNumeric.test(n);
    return !isNaN(parseFloat(n)) && isFinite(n);
}

/**
 * 
 * @param {String} s Texto para fazer o trim
 * @param {String} val [optional] Caracter(es) à procurar
 * @param {String} sub [optional] Caracter(es) à substituir
 * @returns {String} Texto tratado
 * 
 * 
 */
function trim(s, val, sub) {
    if (!val) {
        val = '\\s*';
    }
    if (!sub) {
        sub = '';
    }
//    var re = new RegExp(RegExp.quote(val), "g");
    var re = new RegExp('^' + val + '|' + val + '$', "ig"); //^-Inicio da palavra|$-Fim da palavra

    s = s.replace(re, sub);
//    alert("re: " + re);
//    alert("sub: " + sub);
//    alert("s: " + s);
    return s;
}

function preg_replace(pattern, pattern_replace, subject, limit) {
// Perform a regular expression search and replace
// 
// discuss at: http://geekfg.net/
// discuss at: http://blog.fgribreau.com/2009/10/php-pregreplace-javascript-equivalent.html
// +   original by: Francois-Guillaume Ribreau (http://fgribreau)
// *     example 1: preg_replace("/(\\@([^\\s,\\.]*))/ig",'<a href="http://twitter.com/\\0">\\1</a>','#followfriday @FGRibreau @GeekFG',1);
// *     returns 1: "#followfriday <a href="http://twitter.com/@FGRibreau">@FGRibreau</a> @GeekFG"
// *     example 2: preg_replace("/(\\@([^\\s,\\.]*))/ig",'<a href="http://twitter.com/\\0">\\1</a>','#followfriday @FGRibreau @GeekFG');
// *     returns 2: "#followfriday <a href="http://twitter.com/@FGRibreau">@FGRibreau</a> @GeekFG"
// *     example 3: preg_replace("/(\\#[^\\s,\\.]*)/ig",'<strong>$0</strong>','#followfriday @FGRibreau @GeekFG');
// *     returns 3: "<strong>#followfriday</strong> @FGRibreau @GeekFG"

    if (limit === undefined) {
        limit = -1;
    }

    var _flag = pattern.substr(pattern.lastIndexOf(pattern[0]) + 1),
            _pattern = pattern.substr(1, pattern.lastIndexOf(pattern[0]) - 1),
            reg = new RegExp(_pattern, _flag),
            rs = null,
            res = [],
            x = 0,
            y = 0,
            ret = subject;
    if (limit === -1) {
        var tmp = [];
        do {
            tmp = reg.exec(subject);
            if (tmp !== null) {
                res.push(tmp);
            }
        } while (tmp !== null && _flag.indexOf('g') !== -1)
    }
    else {
        res.push(reg.exec(subject));
    }

    for (x = res.length - 1; x > -1; x--) {//explore match
        tmp = pattern_replace;
        for (y = res[x].length - 1; y > -1; y--) {
            tmp = tmp.replace('${' + y + '}', res[x][y])
                    .replace('$' + y, res[x][y])
                    .replace('\\' + y, res[x][y]);
        }
        ret = ret.replace(res[x][0], tmp);
    }
    return ret;
}

function consolelog(txt, a) {
    if (window.console) {
        console.log(txt);
    } else {
        if (a === undefined) {
            a = false;
        }
        if (a) {
            alert('Não suporta console.log=>' + txt);
        }
    }
}

function addslashes(str) {
    str = str.replace(/\\/g, '\\\\');
    str = str.replace(/\'/g, '\\\'');
    str = str.replace(/\"/g, '\\"');
    str = str.replace(/\0/g, '\\0');
    return str;
}

function stripslashes(str) {
    str = str.replace(/\\'/g, '\'');
    str = str.replace(/\\"/g, '"');
    str = str.replace(/\\0/g, '\0');
    str = str.replace(/\\\\/g, '\\');
    return str;
}

function toggleClass_(element, className) {
    if (!element || !className) {
        return;
    }

    var classString = element.className, nameIndex = classString.indexOf(className);
    if (nameIndex == -1) {
        classString += ' ' + className;
    }
    else {
        classString = classString.substr(0, nameIndex) + classString.substr(nameIndex + className.length);
    }
    element.className = classString;
    //document.querySelector('#menu').classList.toggle('hidden-phone');
    //As an aside, you shouldn't be using IDs (they leak globals into the JS window object).
    //
    //
    //document.getElementById("menu").classList.toggle("hidden-phone");
}
function toggleClass(element, className) {
    if (!element || !className) {
        return;
    }

    element.classList.toggle(className);
//    var re = new RegExp('(?:^|\s)' + className + '(?!\S)', "g");
////    if (element.className.match(re)) {
//    if (classExist(element,className)) {
//        element.className = element.className.replace(re, '');
//    } else {
//        element.className += " "+className;
//    }

}

/**
 * 
 * @param {type} element
 * @param {type} className
 * @returns {Boolean}
 * 
 * (?:^|\s) # match the start of the string, or any single whitespace character
 * MyClass  # the literal text for the classname to remove
 * 
 * (?!\S)   # negative lookahead to verify the above is the whole classname
 *          # ensures there is no non-space character following
 *          # (i.e. must be end of string or a space)
 */
function classExist(element, className) {
    var re = new RegExp('(?:^|\\s)' + className + '(?!\\S)', "g");
    consolelog(re);
    return element.className.match(re) == className;
    return element.className.match(/(?:^|\s)classe(?!\S)/);
    function min(element) {
        if (!element.className.match(/(?:^|\s)classe(?!\S)/)) {
            element.className += " classe";
            element.childNodes[0].childNodes[0].className += " classe";
        }
    }
    function mout(element) {
        if (element.className.match(/(?:^|\s)classe(?!\S)/)) {
            element.className = element.className.replace(/(?:^|\s)classe(?!\S)/g, '');
            element.childNodes[0].childNodes[0].className = element.childNodes[0].childNodes[0].className.replace(/(?:^|\s)classe(?!\S)/g, '');
        }
    }
}

function min(el) {
    if (!el.className.match(/(?:^|\s)liover(?!\S)/)) {
        el.className += " liover";
        if (el.childNodes[0].childNodes[0]) {
            el.childNodes[0].childNodes[0].className += " spanliover";
//            (el.childNodes[0].childNodes[0].className || el.childNodes[0].childNodes[0].class) += " spanliover";
        }
        if (el.childNodes[1].childNodes[1]) {
            el.childNodes[1].childNodes[1].className += " spanliover";
//            (el.childNodes[1].childNodes[1].className || el.childNodes[1].childNodes[1].class)+= " spanliover";
        }
    }
}
function mout(el) {
    if (el.className.match(/(?:^|\s)liover(?!\S)/)) {
        el.className = el.className.replace(/(?:^|\s)liover(?!\S)/g, '');
        if (el.childNodes[0].childNodes[0]) {
            el.childNodes[0].childNodes[0].className = el.childNodes[0].childNodes[0].className.replace(/(?:^|\s)spanliover(?!\S)/g, '');
//            (el.childNodes[0].childNodes[0].className || el.childNodes[0].childNodes[0].class) = (el.childNodes[0].childNodes[0].className || el.childNodes[0].childNodes[0].class).replace(/(?:^|\s)spanliover(?!\S)/g, '');
        }
        if (el.childNodes[1].childNodes[1]) {
            el.childNodes[1].childNodes[1].className = el.childNodes[1].childNodes[1].className.replace(/(?:^|\s)spanliover(?!\S)/g, '');
//            (el.childNodes[1].childNodes[1].className || el.childNodes[1].childNodes[1].class) = (el.childNodes[1].childNodes[1].className || el.childNodes[1].childNodes[1].class).replace(/(?:^|\s)spanliover(?!\S)/g, '');
        }
    }
}
function submitPesquisaProduto(form, event) {
//    alert( form.municipios.length );
//    console.log(form.municipios);
    if (trim(form.searchinput.value) == "") {
        alert('Por favor, informe um produto para pesquisar');
        preventClick(event);
        return false;
    } else {
        form.submit();
        return false;
        return true;
    }
}
function submitPesquisaProdutoM(form, event) {
    var inputs, i, checados = 0;
    inputs = form.getElementsByTagName('input'); //pegando os inputs e jogando num array
    for (i = 0; i < inputs.length; i++) {//varrendo o array que tem os inputs
        if (inputs[i].type == 'checkbox') { //se os inputs forem checkbox
            if (inputs[i].checked == true) {
                checados++;
                break;
            }
        }
    }
    if (checados == 0) {
        alert('Por favor, informe ao menos uma cidade para pesquisar');
        preventClick(event);
        return false;
    }
    if (!submitPesquisaProduto(form, event)) {
        alert('Por favor, informe um produto para pesquisar');
        preventClick(event);
        return false;
    }
}
function checkbox(el, e) {
    e = e || window.event;
    var target = e.target || e.srcElement; //,text = target.textContent || text.innerText;
    if ((el.childNodes[2].childNodes[1] != target)) {
//        console.log(el.childNodes[2].childNodes);
        el.childNodes[2].childNodes[1].checked = !el.childNodes[2].childNodes[1].checked;
    }
}
function preventClick(event) {
    var e = event || window.event;
    if (e.stopPropagation) {  // W3C variant
        e.stopPropagation();
    } else { // IE<9 variant:
        e.cancelBubble = true;
    }
//    e.stopPropagation()||e.returnValue = false;
}

function kenterform(myform, target, event) {
    var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
//    consolelog(keyCode);
    // When enter key is pressed
    if (keyCode == 13) {
//        debugger;
//        console.log(myform.getElementsByName(target));
//        target = myform.getElementsByName(target)[0];
//        target.click();
        if (myform.mostrarminucipios) {
            myform.mostrarminucipios.click();
        } else {
            myform.submit();
        }
    }
}

function isScrolledIntoView(elem) {
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();
    var elemTop = $(elem).offset().top;
    return ((elemTop <= docViewBottom) && (elemTop >= docViewTop));
}
/**
 * Copyright (c) Mozilla Foundation http://www.mozilla.org/
 * This code is available under the terms of the MIT License
 */
if (!Array.prototype.map) {
    Array.prototype.map = function(fun /*, thisp*/) {
        var len = this.length >>> 0;
        if (typeof fun != "function") {
            throw new TypeError();
        }

        var res = new Array(len);
        var thisp = arguments[1];
        for (var i = 0; i < len; i++) {
            if (i in this) {
                res[i] = fun.call(thisp, this[i], i, this);
            }
        }

        return res;
    };
}

$().ready(function() {
    $('.full').hide();
    $('.ico').click(function() {
//        $('some', this).toggle(150);
//        $('.full', this).toggle(150);
        $('some', this).toggle();
        $('.full', this).toggle();
    });
});

var $F = function(id) {
    return document.getElementById(id);
}

function ExtraiScript(texto) {
    var ini, pos_src, fim, codigo;
    var objScript = null;
    ini = texto.indexOf('<script', 0);
    while (ini != -1) {
        var objScript = document.createElement("script");
        //Busca se tem algum src a partir do inicio do script
        pos_src = texto.indexOf(' src', ini);
        ini = texto.indexOf('>', ini) + 1;
        //Verifica se este e um bloco de script ou include para um arquivo de scripts
        if (pos_src < ini && pos_src >= 0) {//Se encontrou um "src" dentro da tag script, esta e um include de um arquivo script
            //Marca como sendo o inicio do nome do arquivo para depois do src
            ini = pos_src + 4;
            //Procura pelo ponto do nome da extencao do arquivo e marca para depois dele
            fim = texto.indexOf('.', ini) + 4;
            //Pega o nome do arquivo
            codigo = texto.substring(ini, fim);
            //Elimina do nome do arquivo os caracteres que possam ter sido pegos por engano
            codigo = codigo.replace("=", "").replace(" ", "").replace("\"", "").replace("\"", "").replace("\'", "").replace("\'", "").replace(">", "");
            // Adiciona o arquivo de script ao objeto que sera adicionado ao documento
            objScript.src = codigo;
        } else {//Se nao encontrou um "src" dentro da tag script, esta e um bloco de codigo script
            // Procura o final do script
            fim = texto.indexOf('</script>', ini);
            // Extrai apenas o script
            codigo = texto.substring(ini, fim);
            // Adiciona o bloco de script ao objeto que sera adicionado ao documento
            objScript.text = codigo;
        }

        //Adiciona o script ao documento
        document.body.appendChild(objScript);
        // Procura a proxima tag de <script
        ini = texto.indexOf('<script', fim);
        //Limpa o objeto de script
        objScript = null;
    }
}
function get_lastchild(n) {
    x = n.lastChild;
    while (x.nodeType != 1) {
        x = x.previousSibling;
    }
    return x;
}


/*
 * Note: this solution doesn't work for IE 7 and below. For more info about extending the DOM read this article.
 * http://perfectionkills.com/whats-wrong-with-extending-the-dom/
 * 
 */
Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
};
NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
    for (var i = 0, len = this.length; i < len; i++) {
        if (this[i] && this[i].parentElement) {
            this[i].parentElement.removeChild(this[i]);
        }
    }
};
/**
 * SetJaVisto na 'linha' do Orçamento
 * @param {type} linha
 * @returns {undefined}
 */
function setJaVisto(linha) {
//    linha.style.fontWeight = "normal";
//    $(linha).removeClass('nvisto');
//    $(linha).removeClass('nvisto').find('.abrirorc').removeClass('btn-inverse-ver').addClass('btn-inverse-org').val('Orçando');
    if ($(linha).find('.abrirorc').hasClass('Cancelado')) {
        $(linha).removeClass('nvisto').find('.abrirorc').removeClass('btn-inverse-ver').addClass('btn-inverse').val('Cancelado');
        $(linha).removeClass('nvisto').find('.abrirorc').removeClass('btn-inverse-ver').addClass('btn-inverse').val('Excluido');
    } else if ($(linha).find('.abrirorc').hasClass('Finalizado')) {
        $(linha).removeClass('nvisto').find('.abrirorc').removeClass('btn-inverse-ver').addClass('btn-inverse').val('Encerrado');
        $(linha).removeClass('nvisto').find('.abrirorc').removeClass('btn-inverse-ver').addClass('btn-inverse').val('Excluido');
    } else if ($(linha).find('.abrirorc').hasClass('Excluido')) {
        $(linha).removeClass('nvisto').find('.abrirorc').removeClass('btn-inverse-ver').addClass('btn-inverse').val('Excluido');
    } else {
        $(linha).removeClass('nvisto').find('.abrirorc').removeClass('btn-inverse-ver').addClass('btn-inverse-org').val('Em andamento');
    }
}

//$( document ).tooltip();
//$('[title]').tooltip({
//    show: null,
//    position: {
//        my: "left top",
//        at: "left bottom"
//    },
//    open: function(event, ui) {
//        console.log(ui.tooltip.position().offset().top)
//        ui.tooltip.animate({top: ui.tooltip.position().top + 20}, "fast");
//    }
//});

function scroolToEl(el) {
    var t = document.body.scrollHeight;
    if (el && ($('#' + el).length > 0)) {
        t = $('#' + el).offset().top - 20;
    }
//    var t = $('#'+el).offset().top || document.body.scrollHeight;//window.scrollHeight;
//    $('.back-on-top a').click(function(){
    $('html, body').animate({scrollTop: t}, 'slow');
//    });
}


function fSHeader(O) {
//            debugger;
//            console.log('incluirAoOrcamento');
    var par = "";
    if (O.Municipio) {
        par += "&Municipio=" + O.Municipio;
    }
    if (O.Segmento) {
        par += "&Segmento=" + O.Segmento;
    }
    XMLHttp.open("post", "fazSESSION.php", false);
    XMLHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    XMLHttp.onreadystatechange = function() {
        if ((XMLHttp.readyState == 4) && (XMLHttp.status == 200 || XMLHttp.status == 0)) {
//                    debugger;
//                    if (O.Municipio) {
//                        var result = XMLHttp.responseText;
//                        if (!document.getElementById('homeSegmento')){
//                            var ns = document.createElement('select');
//                            ns.className = "homeSegmento";
//                            ns.id = "homeSegmento";
//                        }else{
//                            var ns = document.getElementById('homeSegmento');
//                        }
//                        ns.onchange = function(){
//                            fS({Segmento:this.value});
//                        };
//                        ns.innerHTML = result;
//                        
//                        $('#FrmSelMunic').append(ns);
//                        $('.homeSegmento').selectpicker({
//                            size: 10
//                            , liveSearch: true
//                        });
//                        $('.homeSegmento').addClass('Corfundo').selectpicker('setStyle');
//                        $('.homeSegmento').selectpicker('refresh');
//                    }else if (O.Segmento) {
//                        $('.modalCloseImg').click();
//                        location.reload(true);
//                    }
//            $('.modalCloseImg').click();
            location.reload(true);
        }
    };
    XMLHttp.send(par);
}


function fazTamFonte(O) {
    if (!O.el || !O.h) {
        return;
    }
    if (!O.limit) {
        O.limit = 100;
    }
    var fs;
    var i = 0;
    if ($(O.el).height() > O.h) {
        while ($(O.el).height() > O.h) {
            fs = (parseInt($(O.el).css('font-size')) - 1) + "px";
            $(O.el).css('font-size', fs);
            i++;
            if (i == O.limit) {
                break;
            }
        }
    } else {
        while ($(O.el).height() < O.h) {
            fs = (parseInt($(O.el).css('font-size')) + 1) + "px";
            $(O.el).css('font-size', fs);
            i++;
            if (i == O.limit) {
                break;
            }
        }
    }
    return;
}

function getValTotal() {
//            debugger;
    var vl = $('#valTotal').html();
    while (vl.indexOf(',') > 0) {
        vl = vl.replace(',', "");
    }
    return parseFloat(vl.replace(/(...)(\d*)/, "$2"));
}
function setValTotal(valTotal) {
    valTotal = 'R$ ' + formatNumberJS(valTotal);
//            valTotal = valTotal.toFixed(2);
    $('#valTotal').html(valTotal);
}
function calculaOrcamento() {
//            $('.verPreco').click(function() {
    $(document).on('click', '.verPreco', function() {
        var valTotal = getValTotal();
        var qtd = parseFloat($(this).parents('tr').find('.verPrecoQtd').html().replace(',', '.'));

        var val = parseFloat($(this).parents('tr').find('.verPrecoVal').val().replace(',', '.').replace(/\s/, '').replace('R$', ''));
        if (!isNumber(val)) {
            val = 0;
        }

        if ($(this).is(':checked')) {
            valTotal = valTotal + (qtd * val);
        } else {
            valTotal = valTotal - (qtd * val);
        }
        setValTotal(valTotal);
    });
    $(document).on('blur', '.verPrecoVal', function() {
        if ($(this).parents('tr').find('.verPreco').is(':checked')) {
            setValTotal(0);
            var valTotal = 0;
            $(this).parents('tbody').children('.prodOrd').each(function() {
                var valTotalParcial = getValTotal();
                var qtd = parseFloat($(this).find('.verPrecoQtd').html().replace(',', '.'));
                var val = parseFloat($(this).find('.verPrecoVal').val().replace(',', '.').replace(/\s/, '').replace('R$', ''));
                if (!isNumber(val)) {
                    val = 0;
                }

                if ($(this).find('.verPreco').is(':checked')) {
                    valTotalParcial = valTotalParcial + (qtd * val);
                    valTotal += valTotalParcial;
                }
            });
            setValTotal(valTotal);
        }
    });
}


var timerMsg;
function LimpaMsg(fadeOut) {
    if (!fadeOut)
        fadeOut = 1000;
    $('#mensagem').fadeOut(fadeOut);
    clearInterval(timerMsg);
}
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
        , border: ''
        , mouse: false
        , timer: 2500
        , fadeIn: 1000
        , fadeOut: 1000
        , opacity: 1
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
}

var mouseX;
var mouseY;
$(document).mousemove(function(e) {
    mouseX = e.pageX;
    mouseY = e.pageY;
});

$(window).load(function() {
    centraliza('.center');
});
$(window).resize(function() {
    centraliza('.center');
});

function centraliza(el) {
//    debugger;
    $(el).css("position", "absolute");
    $(el).css("position", "fixed");
    $(el).css("top", ($(window).height() - $(el).height()) / 2 + $(window).scrollTop() + "px");
    $(el).css("left", ($(window).width() - $(el).width()) / 2 + $(window).scrollLeft() + "px");
}