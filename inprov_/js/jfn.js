/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * < = &lt;
 > = &gt; 
 */

var $fn = function(w, d) {
    var scrollY = 0,
            distance = 40,
            speed = 24;
    var c = console;
    var tmpdiv = '',
            self = this,
            lst_chars = '0123456789abcdefghijlmnopqrstuvxzwykABCDEFGHIJLMNOPQRSTUVXZWYK-_/^~´`@.';

//      document = w.d,
//            window = w,
//            document = w.d,
//            docElem = document.documentElement;

    /***
     * 
     * @param {type} id
     * @returns {Objeto}
     * 
     * @description retorna um elemento com ID informado
     * <br/>Ex.: <br/>
     *  var ret = $_ID("div2")<br/>
     var vlr = ret.value;<br/>
     @example Removendo um Elemento :
     $_ID('muId').remove();
     */
    var $_ID = function(id) {
        return d.getElementById(id);
    }

    /***
     * 
     * @param {type} classe
     * @returns {nodeList}
     * 
     * @description retorna um nodeList com todos os elementos que contenham a classe informada
     * <br/>Ex.: <br/>
     *  var ret = $_CLASS("minhaClasse")<br/>
     var len = ret.length;<br/>
     */
    var $_CLASSE = function(classe) {
        return d.getElementsByClassName(classe);
    }

    /***
     * 
     * @param {type} classe
     * @returns {nodeList}
     * 
     * @description retorna um nodeList com todos os elementos que contenham a classe informada
     * <br/>Ex.: <br/>
     *  var ret = $_CLS_ALL("minhaClasse")<br/>
     var len = ret.length;<br/>
     
     var map = Array.prototype.map;
     var options = $_Cls_All('select option:checked');
     var values = map.call(options, function(opt) {
     return opt.value;
     });
     
     */
    var $_CLS_ALL = function(classes) {
        return document.querySelectorAll(classes)
    }

    /* @param {type} classe
     * @returns {nodeList}
     * 
     * @description retorna um nodeList com todos os elementos que contenham o nomeElemento informado
     * <br/>Ex.: <br/>
     *  var ret = $_NAME("nomeElemento")<br/>
     var len = ret.length;<br/>
     */
    var $_NAME = function(el) {
        return d.getElementsByName(el);
    }

    /***
     * 
     * @param {type} elId   Id do Elemento Pai
     * @param {type} children
     * @returns {nodeList}
     * 
     * @description retorna um nodeList com todos os elementos filhos do ID informado
     * <br/>Ex.: <br/>
     *  var ret = $_TagName("div2","p")<br/>
     var len = ret.length;<br/>
     */
    var $_TagName = function(elId, children) { //        var elTmp = document.getElementById(elId);
        var elTmp = $_ID(elId);
        return  elTmp.getElementsByTagName(children);
    }

    /***
     * 
     * @param {type} el   Id do Elemento alvo
     * @returns null
     * 
     * @description Leva a janela para a posição do elemento [id]
     * <br/>Ex.: <br/>
     *  &lt;a href="" onclick="return false;" onmousedown="$fn.fazScrollTo('div1');">Ver Opçoes &lt/a&gt; <br/>
     *  
     */
    var autoScrollTo = function(el) {
        var currentY = w.pageYOffset;
        var targetY = d.getElementById(el).offsetTop;
        var bodyHeight = d.body.offsetHeight;
        var yPos = currentY + w.innerHeight;
        c.log(" Elemento = " + el + " Posic y = " + currentY + "Posic targY = " + targetY);
        var animator = setTimeout(function() {
            autoScrollTo(el);
        }, speed)
        if (yPos > bodyHeight) {
            clearTimeout(animator);
        } else {
            if (currentY < targetY - distance) {
                scrollY = currentY + distance;
                w.scroll(0, scrollY);
            } else {
                clearTimeout(animator);
            }
        }
    }
    /*** @param {obj}{funcao} 
     * @returns {objeto formatado}
     * @description Valores Validos: <strong>fones, cep, Data, [ Valor , sparador ]</strong>
     * 
     * @description retorna um objeto formatado de acordo com o tipo
     * 
     * 
     * 
     * <br/>Ex.: <br/>
     *  onclick(StopPropag(this.event))<br/>
     para o borbulho na pagina apos disparar um evento<br/>
     */
    var StopPropag = function(evt) {
        if (typeof evt.stopPropagation != "undefined") {
            evt.stopPropagation();
        } else {
            evt.cancelBubble = true;
        }
    }
    /*** 
     * @param {obj}{funcao} 
     * @returns {objeto formatado}
     * 
     * @description manupula um contador interno 
     * 
     * 
     * 
     * <br/>Ex.: <br/>
     *  var ret = $fn.$_Conta.numReg() -> retorna O numero do contador atual<br/>
     *  $fn.$_Conta.somaReg(1) -> adiciona 1 ao valor atual<br/>
     *  $fn.$_Conta.somaReg(5) -> adiciona 5 ao valor atual<br/>
     *  $fn.$_Conta.resetReg() -> zera o contador<br/>
     */
    var mContador = (function() {
        var contar = 0;
        function somaReg(num) {
            contar += num;
        }
        function numReg() {
            return contar;
        }
        function resetReg() {
            contar = 0;
        }
        return {
            numReg: numReg,
            somaReg: somaReg,
            resetReg: resetReg
        }
    })();

    /*** 
     * @param {obj}{funcao} 
     * @param {vlr}{Valor a ser retornado} 
     * @param {fn}{funcao passada} {Ex.: fones, cep, Data} 
     * @param {extra}{sepadador} {Ex.: exemplo moeda = , ou .} 
     * @returns {objeto formatado}
     * @description Valores Validos: <strong>fones, cep, Data, [ Valor , sparador ]</strong>
     * 
     * @description retorna um objeto formatado de acordo com o tipo
     * 
     * 
     * 
     * <br/>Ex.: <br/>
     *  var ret = onlyMask("2730260008","fones") -> retorna (27) 3026-0008<br/>
     *  var ret = onlyMask("125361","Valor", ",") -> ret 1.253,61 <br/>
     retorna o valor no formato desejado<br/>
     */
    function onlyMask(vlr, fn, extra) {
        if (vlr) {
            return vlr = FazMascara[fn](vlr, extra);
        } else {
            return "";
        }
    }
    /*** 
     * @param {obj}{funcao} 
     * @param {vlr}{Valor a ser retornado} 
     * @param {fn}{funcao passada} {Ex.: fones, cep, Data} 
     * @param {extra}{sepadador} {Ex.: exemplo moeda = , ou .} 
     * @returns {objeto formatado}
     * @description Valores Validos: <strong>fones, cep, Data, [ Valor , sparador ]</strong>
     * 
     * @description retorna um objeto formatado de acordo com o tipo
     * 
     * 
     * 
     * <br/>Ex.: <br/>
     *  var ret = mascObj(this,"fones")<br/>
     *  var ret = mascObj(this,"Valor", ",")<br/>
     retorna o valor no formato desejado<br/>
     */
    function mascObj(obj, fn, extra) {
        setTimeout(function() {
            obj.value = FazMascara[fn](obj.value, extra);
        }, 1)
    }

    function fazVlr(vlr, patt, masc) {
        vlr = vlr.replace(patt, masc).replace(patt, masc);
        return vlr;
    }

    var FazMascara = {
        "fones": function(vlr) {
            vlr = fazVlr(fazVlr(fazVlr(vlr, /\D/g, ""), /^(\d{2})(\d)/g, "($1) $2"), /(\d{4,5})(\d{4})/, "$1-$2")
            return vlr
        },
        "cep": function(vlr) {
            vlr = fazVlr(fazVlr(fazVlr(vlr, /\D/g, ""), /^(\d{2})(\d)/, "$1.$2"), /^(\d{2})\.(\d{3})(\d)/, "$1.$2-$3");
            return vlr;
        },
        "Valor": function(vlr, separador) {
            vlr = fazVlr(fazVlr(fazVlr(fazVlr(vlr, /\D/g, ""), /(\d)(\d{8})$/, "$1.$2"), /(\d)(\d{5})$/, "$1.$2"), /(\d)(\d{2})$/, "$1" + separador + "$2");//coloca a virgula antes dos 2 últimos dígitos
            return vlr;
        },
        "Data": function(vlr) {
            vlr = fazVlr(fazVlr(vlr, /\D/g, ""), /(\d{2})(\d)/, "$1/$2");
//            vlr = fazVlr(fazVlr(fazVlr(vlr, /\D/g, ""),/(\d{2})(\d)/, "$1/$2"),/(\d{2})(\d)/, "$1/$2")
            if (vlr.length = 10) {
                var resp = validarData(vlr);
                if (resp) {
                    return vlr;
                } else {
                    vlr = vlr.replace(/\D/g, "");
                    return vlr;
                }
            }
        }
    };
    function validarData(data) {
        var maiorDia;
        data = data.replace(/[^0-9\/]/g, "");
        var partes = data.split("/");
        if (partes.length != 3) {
            return false;
        }
        var dia = partes[0];
        var mes = partes[1];
        var ano = partes[2];
        if (isNaN(dia) || isNaN(mes) || isNaN(ano)) {
            return false;
        }
        if (mes > 12 || mes < 1 || ano < 1 || dia < 1) {
            return false;
        }
        if (mes == 2) {
            maiorDia = (((!(ano % 4)) && (ano % 100)) || (!(ano % 400))) ? 29 : 28;
            if (dia > maiorDia)
                return false;
        } else {
            if (mes == 4 || mes == 6 || mes == 9 || mes == 11) {
                if (dia > 30)
                    return false;
            } else {
                if (dia > 31)
                    return false;
            }
        }
        return true;
    }



    var VoltaScroller = function(el) {
        var currentY = w.pageYOffset;
        var targetY = d.getElementById(el).offsetTop;
        var animator = setTimeout(function() {
            autoScrollTo(el);
        }, speed)

//        var animator = setTimeout('resetScroller(\'' + el + '\')', speed);
        if (currentY > targetY) {
            scrollY = currentY - distance;
            w.scroll(0, scrollY);
        } else {
            clearTimeout(animator);
        }
    }
    var getScrollOffsets = function(win) {
        c.clear();
        // Use the specified window or the current window if no argument
        w = win || window;
        // This works for all browsers except IE versions 8 and before
        if (w.pageXOffset != null) {
            c.log(" pageYOffset = " + w.pageYOffset);
            return {x: w.pageXOffset, y: w.pageYOffset};
        }

        // For IE (or any browser) in Standards mode
        var d = w.document;
        if (d.compatMode == "CSS1Compat") {
            c.log(" top = " + d.documentElement.scrollTop);
            return {x: d.documentElement.scrollLeft, y: d.documentElement.scrollTop};
        }

        // For browsers in Quirks mode
        c.log(" d.body.scrollTop = " + d.body.scrollTop);
        return {x: d.body.scrollLeft, y: d.body.scrollTop};
    }


    function inputOnlyDigits(e) {
        var chrTyped, chrCode = 0, evt = e ? e : event;
        if (evt.charCode != null)
            chrCode = evt.charCode;
        else if (evt.which != null)
            chrCode = evt.which;
        else if (evt.keyCode != null)
            chrCode = evt.keyCode;

        if (chrCode == 0)
            chrTyped = 'TECLA ESPEC.';
        else
            chrTyped = String.fromCharCode(chrCode);

        //[somente testa:] 
        self.status = 'inputOnlyDigits: chrTyped = ' + chrTyped;
        //Digits, special keys & backspace [\b] work as usual:
        if (chrTyped.match(/\d|[\b]|SPECIAL/))
            return true;
        if (evt.altKey || evt.ctrlKey || chrCode < 28)
            return true;

        //qqer outro input - previne para resposta default
        if (evt.preventDefault)
            evt.preventDefault();
        evt.returnValue = false;
        return false;
    }

    function addEventHandler(elem, eventType, handler) {
        //  ex.:  addEventHandler(document.f2.t1, 'keypress', inputDigitsOnly);
        if (elem.addEventListener)
            elem.addEventListener(eventType, handler, false);
        else if (elem.attachEvent)
            elem.attachEvent('on' + eventType, handler);
        else
            return 0;
        return 1;
    }


//            modContador.incrementa(23);
//            modContador.reset;
//            console.log(modContador.count());


    return {$_Id: $_ID, $_Classe: $_CLASSE, $_Cls_All: $_CLS_ALL, $_Nome: $_NAME, $_TgName: $_TagName, $_mascObj: mascObj,
        $_StopPropag: StopPropag, $_fazScrollTo: autoScrollTo, $_VoltaScroller: VoltaScroller,
        $_getScrollOffsets: getScrollOffsets, $_onlyMask: onlyMask, $_Conta: mContador};

}(window, document);

//VerDadosOrcamento.showGer();
//
//$F('enviarPrecos').remove();
//
//
//VerDadosOrcamento.verIds('Id_OrcOrg');
//var Todos = VerDadosOrcamento.verVarios('Todos');
//VerDadosOrcamento.verIds('Id_LojaOrg');
//console.log(" TODOS RETORNOS LOJA = " + Todos['IdLoja']);
//
//
//
//
//
///***
// * 

//<script>
//function sem_acento(e,args) {
//exemplo onKeyPress="return sem_acento(event);"
//        if (document.all){var evt=event.keyCode;} // caso seja IE
//        else{var evt = e.charCode;} 	// do contrário deve ser Mozilla
//        var valid_chars = '0123456789abcdefghijlmnopqrstuvxzwykABCDEFGHIJLMNOPQRSTUVXZWYK-_/^~´`@.'+args;      // criando a lista de teclas permitidas
//        var chr= String.fromCharCode(evt);      // pegando a tecla digitada
//        if (valid_chars.indexOf(chr)>-1 ){return true;} // se a tecla estiver na lista de permissão permite-a
//        // para permitir teclas como <BACKSPACE> adicionamos uma permissão para 
//        // códigos de tecla menores que 09 por exemplo (geralmente uso menores que 20)
//        if (valid_chars.indexOf(chr)>-1 || evt < 9){return true;} 
//		if (valid_chars.indexOf(chr)>30 || evt <35){return true;} //permite a tecla espaço
//        return false;   // do contrário nega
//}
//</script>
//
//
//
//No Input
//
//<input name="txt" type="text" maxlength="80" size="40" [b]onKeyPress="return sem_acento(event);"[/b] >
//
//
//Só acrescentar
//
//        "base": function(vlr) {
//            var v = '';
//            v = v.replace(/\D/g, "")
//            v = v.replace(/(\d{2})(\d)/, "$1/$2")
//            v = v.replace(/(\d{2})(\d)/, "$1/$2")
//            vlr = vlr.replace(/\D/g, "") 
//            
//            vlr = vlr.replace(/^([0-9]{3}\.?){3}-[0-9]{2}$/, "$1.$2");
//            vlr = vlr.replace(/(\d)(\d{2})$/, "$1" + separador + "$2") 
//
//            vlr = fazVlr(vlr, /\D/g, "");
//            vlr = fazVlr(vlr, /^(\d{2})(\d)/g, "($1) $2")
//            vlr = fazVlr(vlr, /(\d{4,5})(\d{4})/, "$1-$2")
//            return vlr
//
//        },



