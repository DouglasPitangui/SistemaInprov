/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//console.log(" Orcamento ver Carregado");

$().ready(function() {

    $('.simplemodal-close').click(function() {
//        alert("Estou saindo da pagina");
//         alert("  VERIFICANDO ORCAMENTO FUNCAO = " + VerDadosOrcamento.show_varGer('Id_UsuarioOrg').value);
        fnEnviaEmail();
//        var btnCaramba = document.getElementById('BtnPorrr');
//        btnCaramba.click();
    });
});

function fazEnviaMsg() {
//            alert("vou enviar uma mensagem");
    var frm = document.getElementById('FrmDadosMsg');
    var Id_OrcOrg = document.getElementById('Id_OrcOrg');
    var Id_UsuarioOrg = document.getElementById('Id_UsuarioOrg');
    var Id_LojaOrg = document.getElementById('Id_LojaOrg');
    var QuemAcessaOrg = document.getElementById('QuemAcessaOrg');
    var MsgAtu = document.getElementById('txtmsg');
//console.log(" Dados = " + Id_OrcOrg.value);
//console.log(" Id_UsuarioOrg = " + Id_UsuarioOrg.value);
//console.log(" Id_LojaOrg = " + Id_LojaOrg.value);
//console.log(" QuemAcessaOrg = " + QuemAcessaOrg.value);
    document.getElementById('Id_OrcMsg').value = Id_OrcOrg.value;
    document.getElementById('Id_UsuarioMsg').value = Id_UsuarioOrg.value;
    document.getElementById('Id_LojaMsg').value = Id_LojaOrg.value;
    document.getElementById('QuemAcessaMsg').value = QuemAcessaOrg.value;
    document.getElementById('txtDadosGravarMsg').value = MsgAtu.value;
//            console.log(" ---------------------------------------------------------------= " + Id_OrcOrg.value);
//            debugger;
    if ((MsgAtu.value.trim()).length > 0) {
        setIframeLimpaMyFrame();
        frm.submit();
        AjaxGetMsg("N");
//    var qpss = QuemAcessaOrg.value;
//    var el = document.getElementById('resultMsg');
//    var qlcs = ((qpss == "L") || (qpss == "G")) ? "loja" : "inter";
//    var txt = "<li class=" + qlcs + ">" + MsgAtu.value + "</li>";
//    el.innerHTML = el.innerHTML + txt;
        MsgAtu.value = "";
        scrollMsg();
//                getRespFomIframa();
    }


}
function setIframeLimpaMyFrame() {
    var meuIframe = document.getElementById("MyFrame");
    meuIframe.contentWindow.document.body.innerHTML = "";
}



function scrollMsg() {
    var el = document.getElementById('resultMsg');
    el.scrollTop = el.scrollHeight;
}


//function BlockBtn() {
//    var el = document.querySelectorAll('.verPrecoVal');
//    var elFab = document.querySelectorAll('.verFab');
//    var btnEnviar = $F('enviarPrecos');
//    var vlr = 0, fabric = '', faz = 'N';
//    debugger;
//    for (var i = 0; i < el.length; i++) {
//        vlr = parseFloat(el[i].value);
//        fabric = elFab[i].value;
//        if ((vlr > 0) && (fabric != "")) {
//            DesabCamposOrc(i);
//            faz = "S";
//        }
//    if (faz == "S") {
//        btnEnviar.setAttribute('disabled', true);
//    }
//        
//    }
//}
function BlockBtn() {
//    alert("inicio");
    debugger;
    var el = document.querySelectorAll('.verPrecoVal');
    var elFab = document.querySelectorAll('.verFab');
    var btnEnviar = $F('enviarPrecos');
    var vlr = 0, fabric = '', faz = 'N';
    for (var i = 0; i < el.length; i++) {
        vlr = parseFloat(el[i].value);
        fabric = elFab[i].value;
        if (isNaN(vlr)) {
            vlr = 0;
        }
        if (vlr <= 0) {
            vlr = 0;
        }
        if ((vlr > 0) && (fabric != "")) {
            DesabCamposOrc(i);
            faz = "S";
        }
        if (faz == "S") {
            $F('enviarPrecos').remove();
//            $F('enviarPrecos').setAttribute('disabled', true);
        } else {
            btnEnviar.removeAttribute('disabled');
        }

//        if (parseFloat(vlr > 0) && (fabric != "")) {
//            DesabCamposOrc(i);
//            faz = "S";
//        } else {
//            btnEnviar.removeAttribute('disabled');
////            alert("Informação de Valor ou Fabricante Incompleta... Verifique!");
//            return;
//        }
//        if (faz == "S") {
//            btnEnviar.setAttribute('disabled', true);
//        } else {
//            
//            btnEnviar.removeAttribute('disabled');
//        }

    }
}


function DesabCamposOrc(indx) {
    var el = document.querySelectorAll('.verPrecoVal');
    var elFab = document.querySelectorAll('.verFab');
    el[indx].setAttribute('disabled', true);
    elFab[indx].setAttribute('disabled', true);
}
function HabilitaCamposOrc() {
    var el = document.querySelectorAll('.verPrecoVal');
    var elFab = document.querySelectorAll('.verFab');
    for (var i = 0; i < el.length; i++) {
        el[i].removeAttribute('disabled');
        elFab[i].removeAttribute('disabled');
    }
}


var OrcRot = function() {
    return {
        setFofus: function(id) {
            return document.getElementById(id);
        },
        get_ID: function(ref) {
            return document.getElementById(ref);
        }
    };
}();

var getMsgAuto = '';
function AjaxGetMsg(Qfazer) {
//            debugger;
//            console.log("parametro = " + Qfazer);

    var Id_OrcOrg = document.getElementById('Id_OrcOrg');
    var Id_UsuarioOrg = document.getElementById('Id_UsuarioOrg');
    var Id_LojaOrg = document.getElementById('Id_LojaOrg');
    var QuemAcessaOrg = document.getElementById('QuemAcessaOrg');
    var Mensagem = document.getElementById('txtmsg');
//            var objUltMsg = document.getElementById('IdUltMsg');
    var objUltMsg = document.getElementById('IdUltMsgPass');
    var Url = './admin/getMsg.php';
    var dt = new Date();
    var parametros = "?";
    parametros += "Id_OrcaLoja=" + Id_OrcOrg.value;
    parametros += "&";
    parametros += "origem=" + QuemAcessaOrg.value;
    parametros += "&";
    parametros += "loja=" + Id_LojaOrg.value;
    parametros += "&";
    parametros += "ultMsg=" + objUltMsg.value;
    parametros += "&data=" + dt;
//            alert(parametros);
    xmlHttp = createRequest();
    xmlHttp.onreadystatechange = function() {
//                console.log("parametro onreadystatechange = " + Qfazer);
        if (xmlHttp.readyState == 4) {
//                    debugger;
            var data = xmlHttp.responseText;
            if (data.trim() == "") {
                return;
            }
            var Target = document.getElementById('resultMsg');
            var MsgNovas = document.createElement('ul');
            MsgNovas.innerHTML = data;
            var liMsgNova = MsgNovas.firstElementChild;
            if (Target.childElementCount > 0) {
                var MsgIniUlt = get_lastchild(Target);
                if (parseInt(MsgIniUlt.getAttribute('id_msg')) < parseInt(liMsgNova.getAttribute('id_msg'))) {
                    Target.innerHTML += MsgNovas.innerHTML;
                    objUltMsg.value = get_lastchild(MsgNovas).getAttribute('id_msg');
                    scrollMsg();
                }
            } else {
                Target.innerHTML += MsgNovas.innerHTML;
                objUltMsg.value = get_lastchild(MsgNovas).getAttribute('id_msg');
                scrollMsg();
            }

//                    var MsgIni = document.getElementById('resultMsg').innerHTML.replace(/\"/gi, "'").replace(/<br>/gi, "<br/>").replace(/\s{2,}/gi, " ");
//                    MsgIni = MsgIni.replace(/\s{2,}/gi, " ");
//                    var MsgFIM = xmlHttp.responseText.replace(/[  ]+/gi, " ");
//                    document.getElementById('resultMsg').innerHTML = xmlHttp.responseText;
//                    if (Qfazer != "N") {
//                        makeAlert(Qfazer);
//                        if (MsgFIM != MsgIni) {
//                            scrollMsg();
//                        }
//                    }
        }
    }
//            getMsgAuto = setTimeout('AjaxGetMsg()', 10000);
    getMsgAuto = setTimeout(function() {
        AjaxGetMsg("S");
    }, 10000);
    xmlHttp.open('GET', Url + parametros, true); //aqui configuramos o arquivo
    xmlHttp.send(null);
}

function enviaMsgOrc(event) {
    var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
    // When enter key is pressed
    if (keyCode == 13) {
        document.getElementById('enviaMsg').click();
    }
}

function funcSalvarDadosOrc() {
    if (confirm('Você deseja realmente enviar os preços informados ao internauta?' + '\n')) {

//                    alert(" Passando ");
        var table = document.getElementById('TableDdos');
        var rowLength = table.rows.length;
        var StrNome = "", StrQtd = "", StrVlr = "", StrEst = "", conta = 0, indx = 0;
        var TR = table.getElementsByTagName("tr");
        var myArray = new Array();
        for (var i = 0; i < TR.length; i++) {
            cells = TR[i].getElementsByTagName("td");
            if (cells.length > 1) {
                myArray[conta] = new Array(1);
                myArray[conta][0] = "";
                myArray[conta][1] = "";
                myArray[conta][2] = "";
                myArray[conta][3] = "";
                conta++;
            }
        }
//                    debugger;
        var Nome = "", Qtd = "0", Vlr = "0", IdVlr = "", Est = "0", IdEst = "", total = 0;
        var rows = document.getElementById("TableDdos").getElementsByTagName("tr");
//        alert(" Passando = ");
        debugger;
        indx = 0;
        for (row = 0, len = rows.length; row < len; row++) {
            cells = rows[row].getElementsByTagName("td");
            if (cells.length > 1) {
                if (cells.length == 6) {
                    Nome = cells[0].innerHTML;
                    Qtd = cells[1].childNodes[0].innerHTML;
                    IdVlr = cells[4].childNodes[1].childNodes[1].id;
                    Vlr = cells[4].childNodes[1].childNodes[1].value;
                    IdEst = cells[3].childNodes[1].childNodes[1].id;
                    Est = cells[3].childNodes[1].childNodes[1].value;
                    myArray[indx][0] = IdVlr;
                    myArray[indx][1] = Vlr;
                    myArray[indx][2] = IdEst;
                    myArray[indx][3] = Est;
                    indx++;
                } else if (cells.length == 5) {
//                    Nome = cells[0].innerHTML;
                    Qtd = cells[0].childNodes[0].innerHTML;
                    IdVlr = cells[3].childNodes[1].childNodes[1].id;
                    Vlr = cells[3].childNodes[1].childNodes[1].value;
                    IdEst = cells[2].childNodes[1].childNodes[1].id;
                    Est = cells[2].childNodes[1].childNodes[1].value;
                    myArray[indx][0] = IdVlr;
                    myArray[indx][1] = Vlr;
                    myArray[indx][2] = IdEst;
                    myArray[indx][3] = Est;
                    indx++;

                }
            }
        }
//                valTotal.innerHTML = total;

//        alert(" Passando1 = ");
        var val = "";
//                    debugger;
        for (var i = 0; i < indx; i++) {
            val = val + "" + myArray[i][0] + "!";
            val = val + "" + myArray[i][1] + "!";
            val = val + ":"
            val = val + "" + myArray[i][2] + "!";
            val = val + "" + myArray[i][3] + "!";
            val = val + "|"
        }

        var dados = document.getElementById('txtDadosGravar');
        dados.value = val;
        var frm = document.getElementById('FrmDados');
        var Id_OrcOrg = document.getElementById('Id_OrcOrg');
        var Id_UsuarioOrg = document.getElementById('Id_UsuarioOrg');
        var Id_LojaOrg = document.getElementById('Id_LojaOrg');
        var QuemAcessaOrg = document.getElementById('QuemAcessaOrg');
        var objUltMsg = document.getElementById('IdUltMsg');
        console.log(" Dados = " + Id_OrcOrg.value);
        console.log(" Id_UsuarioOrg = " + Id_UsuarioOrg.value);
        console.log(" Id_LojaOrg = " + Id_LojaOrg.value);
        console.log(" QuemAcessaOrg = " + QuemAcessaOrg.value);
        document.getElementById('Id_Orc').value = Id_OrcOrg.value;
        document.getElementById('Id_Usuario').value = Id_UsuarioOrg.value;
        document.getElementById('Id_Loja').value = Id_LojaOrg.value;
        document.getElementById('QuemAcessa').value = QuemAcessaOrg.value;
        document.getElementById('Ultmsg').value = objUltMsg.value;
//        alert(" Passando = ");
        setRespFomIframa()

        frm.submit();
        getRespFomIframa();

    } else {
        var btnEnviar = $F('enviarPrecos');
        HabilitaCamposOrc();
        btnEnviar.removeAttribute('disabled');

    }
}


// to aqui fazendo bloqueio do valor

function BlockVal() {
    var el = document.querySelectorAll('.verPrecoVal');
    var elFab = document.querySelectorAll('.verFab');
    var btnEnviar = $F('enviarPrecos');
    var vlr = 0, fabric = '', faz = 'N';
    debugger;
    for (var i = 0; i < el.length; i++) {
        vlr = parseFloat(el[i].value.replace(",", "."));
        if (isNaN(vlr)) {
            vlr = 0;
        }
        if (vlr <= 0) {
            vlr = 0;
        }
        fabric = elFab[i].value;
        if ((vlr > 0) && (fabric != "")) {
            DesabCamposOrc(i);
            faz = "S";
        } else if ((vlr == 0) && (fabric == "")) {
            faz = "S";
        } else {
            alert("Informação de Valor ou Fabricante Incompleta... Verifique!");
            btnEnviar.removeAttribute('disabled');
            return;
        }
        if (faz == "S") {
            btnEnviar.setAttribute('disabled', true);
        } else {
            btnEnviar.removeAttribute('disabled');
        }

    }
//    for (var i = 0; i < el.length; i++) {
//        vlr = parseFloat(el[i].value);
//        fabric = elFab[i].value;
//        if ((vlr > 0) && (fabric != "")) {
//            DesabCamposOrc(i);
////                        el[i].setAttribute('disabled', true);
////                        elFab[i].setAttribute('disabled', true);
//            faz = "S";
//        }
//    }
    if (faz == "S") {
        btnEnviar.setAttribute('disabled', true);
        funcSalvarDadosOrc();
    }
}

function getRespFomIframa() {
//                var vez = contar(1);
    var meuIframe = document.getElementById("MyFrame");
    var iFrameContent = meuIframe.contentWindow.document.body.innerHTML;
    if (iFrameContent != "") {
        FazMsg(iFrameContent, {mouse: false});
        BlockBtn()
//        var btnEnviar = $F('enviarPrecos');
//        btnEnviar.removeAttribute('disabled');

    } else {
        setTimeout("getRespFomIframa()", 1500);
    }
}

function setRespFomIframa() {
    var meuIframe = document.getElementById("MyFrame");
    meuIframe.contentWindow.document.body.innerHTML = "";
}
