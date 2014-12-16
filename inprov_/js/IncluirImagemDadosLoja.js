/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function(w, d, undef) {

    console.log("Passai"); //undefined

//                        dClass = d.getElementsByClassName();
//                        w.open('http://www.google.com'); //window
//                        d.getElementById('menu'); //document
//                        dr('#menu').hide(); //jQuery

    var foo;
    var xx = 'teste anonimobom dia ';
    var yy = 'pessoal boa tarde!'
    function byz() {
        return xx + ' ' + yy;
    }
    Id = function(qId) {
        return d.getElementById(qId); //document
    }
    some = function(el) {
        el.style.display = 'none';
    }
    aparece = function(el) {
        el.style.display = 'block';
    }
    w.byz = byz;
    return;
})(window, document);
//console.log(byz());
////                    console.log(Id('byz'));
//console.log(Id('kelly'));
//some(Id('kelly'));

//alert("Carregado");

//var $chkImg = function() {
//    console.log("Carregado");
//    var doc = document;
//    var lst = ['instCatalogo', 'infBanner_1', 'infBanner_2'];
//    if (!Array.prototype.map) {
//        Array.prototype.map = function(fun /*, thisp*/) {
//            var len = this.length;
//            if (typeof fun != "function")
//                throw new TypeError();
//            var res = new Array(len);
//            var thisp = arguments[1];
//            for (var i = 0; i < len; i++) {
//                if (i in this)
//                    res[i] = fun.call(thisp, this[i], i, this);
//            }
//            return res;
//        };
//    }
//    var map = Array.prototype.map;
//    return    {
//        toggle: function(elId) {
//            var elT = Id(elId);
//            elT.style.display = (elT.style.display == 'none') ? 'block' : 'none';
//        },
//        hide: function(elId) {
//            var elT = Id(elId);
//            this.elT.style.display = 'none';
//        },
//        show: function(elId) {
//            var elT = Id(elId);
//            this.elT.style.display = 'none';
//        },
//        retElId: function(qId) {
//            alert(" RET ID = " + qId);
//            return doc.getElementById(qId); //document
//        },
//        fazMap: function(lst) {
//            alert("fazmap");
//            map.call(lst, function(el) {
//                var elCatalogo = Id(el);
//                console.log("Imagem funcao parent xx = " + elCatalogo.innerHTML);
//                if (!elCatalogo)
//                    return;
//                elCatalogo.addEventListener("click", function() {
//                    this.FazInf(el);
//                }, false);
//            });
//        },
//        FazInf: function(elId) {
//            alert("FazInf" + elId);
//            var elInf = this.retElId('informacao');
//
////        var elInfxx = Id('informacao')
//            //        alert("elInf" + elInf);
//            //        var elInf = document.getElementById('informacao');
//            //        var elInfxx = document.getElementById(elId).nextSibling.nextSibling.nextSibling.nextSibling;             
//            var elInfxx = document.getElementById(elId).nextSibling.nextSibling.nextSibling.nextSibling;
//            console.log("Imagem funcao parent xx = " + elInfxx.id);
//            console.log("Imagem funcao parent xxIMG = " + elInfxx.src);
//            if (elInfxx.src != 'imgfalse') {
//                document.getElementById('minhaImg').style.display = 'block';
//                document.getElementById('minhaImg').src = elInfxx.src;
//            }
//            (elInf.style.display != 'block') ? elInf.style.display = 'block' : elInf.style.display = 'none';
//            if (elInf.style.display == 'none') {
//                document.getElementById('divminhaImg').style.display = 'none';
//                document.getElementById('minhaImg').style.display = 'none';
//                document.getElementById('pp').style.display = 'none';
//            } else {
//                if (elInfxx.src != 'imgfalse') {
//                    document.getElementById('minhaImg').style.display = 'block';
//                    document.getElementById('divminhaImg').style.display = 'block';
//                    document.getElementById('pp').style.display = 'block';
//                }
//            }
//            var elImg = document.getElementById(elId).nextSibling.nextSibling;
//            elInf.src = elImg.src;
//        },
//        Fazprev: function() {
//            var infElement = this.retElId('instCatalogo');
//            console.log(" Id do Elemento IIIIIIDDDDDD = " + infElement.id)
//            console.log("Fazprev");
//            var lst = ['instCatalogo', 'infBanner_1', 'infBanner_2'];
//            var map = Array.prototype.map;
//            map.call(lst, function(el) {
//                var elCatalogo = document.getElementById(el);
//                if (!elCatalogo)
//                    return;
//                console.log(" Id do Elemento = " + elCatalogo.id)
//                elCatalogo.addEventListener("click", function() {
//                    this.FazInf(elCatalogo);
//                }, false);
//            });
////            alert(" saindo Fazprev");
//        }
//    };
//}();
//var chkImg = function() {
//    alert("Carregado");
//    var lst = ['instCatalogo', 'infBanner_1', 'infBanner_2'];
//    if (!Array.prototype.map) {
//        Array.prototype.map = function(fun /*, thisp*/) {
//            var len = this.length;
//            if (typeof fun != "function")
//                throw new TypeError();
//            var res = new Array(len);
//            var thisp = arguments[1];
//            for (var i = 0; i < len; i++) {
//                if (i in this)
//                    res[i] = fun.call(thisp, this[i], i, this);
//            }
//            return res;
//        };
//    }
//    var map = Array.prototype.map;
//    map.call(lst, function(el) {
//        var elCatalogo = document.getElementById(el);
//        if (!elCatalogo)
//            return;
//        elCatalogo.addEventListener("click", function() {
//            FazInf(el);
//        }, false);
//    });
//    return    {
//        FazInf = function(elId) {
//            var elInf = Id('informacao')
////        var elInfxx = Id('informacao')
////        alert("elInf" + elInf);
////        var elInf = document.getElementById('informacao');
////        var elInfxx = document.getElementById(elId).nextSibling.nextSibling.nextSibling.nextSibling;
//            var elInfxx = document.getElementById(elId).nextSibling.nextSibling.nextSibling.nextSibling;
//            console.log("Imagem funcao parent xx = " + elInfxx.id);
//            console.log("Imagem funcao parent xxIMG = " + elInfxx.src);
//            if (elInfxx.src != 'imgfalse') {
//                document.getElementById('minhaImg').style.display = 'block';
//                document.getElementById('minhaImg').src = elInfxx.src;
//            }
//            (elInf.style.display != 'block') ? elInf.style.display = 'block' : elInf.style.display = 'none';
//            if (elInf.style.display == 'none') {
//                document.getElementById('divminhaImg').style.display = 'none';
//                document.getElementById('minhaImg').style.display = 'none';
//                document.getElementById('pp').style.display = 'none';
//            } else {
//                if (elInfxx.src != 'imgfalse') {
//                    document.getElementById('minhaImg').style.display = 'block';
//                    document.getElementById('divminhaImg').style.display = 'block';
//                    document.getElementById('pp').style.display = 'block';
//                }
//            }
//            var elImg = document.getElementById(elId).nextSibling.nextSibling;
//            elInf.src = elImg.src;
//        },
//
//        function Fazprev() {
//
//            var lst = ['instCatalogo', 'infBanner_1', 'infBanner_2'];
//            var map = Array.prototype.map;
//            map.call(lst, function(el) {
//                var elCatalogo = document.getElementById(el);
//                if (!elCatalogo)
//                    return;
//                elCatalogo.addEventListener("click", function() {
//                    FazInf(el);
//                }, false);
//            });
//        },
//        function EliminaImg(caminho, img, id) {
//            var qimg = document.getElementById('PassandoImg');
//            if (confirm(" Você realmente deseja EXCLUIR a Imagem:")) {
//                qimg.value = caminho + img;
//                console.log(" Novo caminho - " + qimg.value);
//                document.getElementById('FrmDelImg').submit();
//                document.getElementById(id).style.display = 'none';
//                document.getElementById(id).previousElementSibling.src = 'img/basic/banner_prata_semImagem.jpg';
//            }
//        }
//    }
//}();

(function(funcName, baseObj) {
    // The public function name defaults to window.docReady
    // but you can pass in your own object and own function name and those will be used
    // if you want to put them in a different namespace
    funcName = funcName || "docReady";
    baseObj = baseObj || window;
    var readyList = [];
    var readyFired = false;
    var readyEventHandlersInstalled = false;

    // call this when the document is ready
    // this function protects itself against being called more than once
    function ready() {
        if (!readyFired) {
            // this must be set to true before we start calling callbacks
            readyFired = true;
            for (var i = 0; i < readyList.length; i++) {
                // if a callback here happens to add new ready handlers,
                // the docReady() function will see that it already fired
                // and will schedule the callback to run right after
                // this event loop finishes so all handlers will still execute
                // in order and no new ones will be added to the readyList
                // while we are processing the list
                readyList[i].fn.call(window, readyList[i].ctx);
            }
            // allow any closures held by these functions to free
            readyList = [];
        }
    }

    function readyStateChange() {
        if (document.readyState === "complete") {
            ready();
        }
    }

    // This is the one public interface
    // docReady(fn, context);
    // the context argument is optional - if present, it will be passed
    // as an argument to the callback
    baseObj[funcName] = function(callback, context) {
        // if ready has already fired, then just schedule the callback
        // to fire asynchronously, but right away
        if (readyFired) {
            setTimeout(function() {
                callback(context);
            }, 1);
            return;
        } else {
            // add the function and context to the list
            readyList.push({fn: callback, ctx: context});
        }
        // if document already ready to go, schedule the ready function to run
        if (document.readyState === "complete") {
            setTimeout(ready, 1);
        } else if (!readyEventHandlersInstalled) {
            // otherwise if we don't have event handlers installed, install them
            if (document.addEventListener) {
                // first choice is DOMContentLoaded event
                document.addEventListener("DOMContentLoaded", ready, false);
                // backup is window load event
                window.addEventListener("load", ready, false);
            } else {
                // must be IE
                document.attachEvent("onreadystatechange", readyStateChange);
                window.attachEvent("onload", ready);
            }
            readyEventHandlersInstalled = true;
        }
    }
})("docReady", window);
docReady(fn);

// use an anonymous function
docReady(function() {
    // code here
});

// pass a function reference and a context
// the context will be passed to the function as the first argument
docReady(fn, context);

// use an anonymous function with a context
docReady(function(context) {
    // code here that can use the context argument that was passed to docReady
}, ctx);

