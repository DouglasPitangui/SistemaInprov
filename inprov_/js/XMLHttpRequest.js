/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function createRequest() {
    try {
        request = new XMLHttpRequest();
    } catch (tryMS) {
        try {
            request = new ActiveXObject("Msxml2.XMLHTTP");
//            alert("Msxls");
        } catch (otherMS) {
            try {
                request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (failed) {
                request = null;
            }
        }
    }
    return request;

}

function generateFieldsValues(formInsert) {
    var strReturn = new Array();
    for (var i = 0; i < formInsert.elements.length; i++) {
        var str = encodeURIComponent(formInsert.elements[i].name);
        str += "=";
        str += encodeURIComponent(formInsert.elements[i].value);
        strReturn.push(str);
//		 	alert("Form = " + str );
    }
    return strReturn.join("&");
}

{//Salvar "Meus Dados" do internauta
    function salvarInfInternauta(frm) {
        frm.resultado.style.display = 'none';
        frm.tipoSubmit.value = 'Normal';
        if (!validaFormInternauta(frm))
            return false;

        var Url;
        Url = './action/grava_Internauta.php';

        var XMLHttp = createRequest();
        if (XMLHttp == null)
            frm.submit();
        var fieldsValues = generateFieldsValues(frm);


        XMLHttp.open("post", Url, true);
        XMLHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        XMLHttp.onreadystatechange = function() {
            if (XMLHttp.readyState == 4) {
                if (XMLHttp.responseText.substr(0, 2) == 'OK') {
                    frm.resultado.value = "Cadastro alterado com sucesso";
                    frm.resultado.style.display = '';
                    window.scroll(0, 0);
                } else {
                    alert('Erro: ' + XMLHttp.responseText);
                }
            } else {
//                result.innerHTML = "Verificando conexao: " + XMLHttp.statusText;
            }
        };
//    alert(fieldsValues);
        XMLHttp.send(fieldsValues);

//    frm.tipoSubmit.value = 'Ajax';
//    var frmData = new FormData(frm);
//    XMLHttp.send(frmData);
    }
}

{//Avaliação para loja e profissional
    function vota(id, v) {
        if (id == 1) {
            document.getElementById('nota').innerHTML = "<font class='opcAvaliacao'>Ruím</font>";
        }
        if (id == 2) {
            document.getElementById('nota').innerHTML = "<font class='opcAvaliacao'>Regular</font>";
        }
        if (id == 3) {
            document.getElementById('nota').innerHTML = "<font class='opcAvaliacao'>Bom</font>";
        }
        if (id == 4) {
            document.getElementById('nota').innerHTML = "<font class='opcAvaliacao'>Muito bom</font>";
        }
        if (id == 5) {
            document.getElementById('nota').innerHTML = "<font class='opcAvaliacao'>Ótimo</font>";
        }
        for (i = 0; i < id; i++) {
            document.getElementById(i + 1).src = v+"img/icons/gold_star.png";
        }
    }

    function retira(id, v) {
        for (i = 5; i >= id; i--) {
            if (i == 1) {
                document.getElementById('nota').innerHTML = "<font class='opcAvaliacao'></font>";
//                break;
            }
            document.getElementById(i).src = v+"img/icons/silver_star.png";
        }
    }
    function salvaVoto(id_loja, valor) {
//            alert("AA");
        var dt = new Date();
        var Url;
        Url = 'action/votacao.php';
        var Parametro = '?';
        Parametro += "id_loja=" + id_loja;
        Parametro += "&voto=" + valor;
        Parametro += "&data=" + dt;

//            document.votacao.voto.value = valor;
//            alert("Voto: " + valor);
//            document.votacao.id_loja.value = id_loja;
//            alert("id_loja: " + document.votacao.id_loja.value);

        Url = Url + Parametro;
        var XMLHttp = createRequest();
        XMLHttp.open("get", Url, true);
//            XMLHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        XMLHttp.onreadystatechange = function() {
            if (XMLHttp.readyState == 4 && XMLHttp.status == 200) {
                notaVal.innerHTML = "Avaliação da Loja: " + XMLHttp.responseText;
                alert("Obrigado! Seu voto foi computado com sucesso.");
            } else {
//                result.innerHTML = "Verificando conexao: " + XMLHttp.statusText;
            }
        };
        XMLHttp.send();
    }
    function salvaVotoProfissional(id_loja, valor) {
//            alert("AA");
        var dt = new Date();
        var Url;
        Url = '../action/votacao.php';
        var Parametro = '?';
        Parametro += "id_loja=" + id_loja;
        Parametro += "&voto=" + valor;
        Parametro += "&data=" + dt;

//            document.votacao.voto.value = valor;
//            alert("Voto: " + valor);
//            document.votacao.id_loja.value = id_loja;
//            alert("id_loja: " + document.votacao.id_loja.value);

        Url = Url + Parametro;
        var XMLHttp = createRequest();
        XMLHttp.open("get", Url, true);
//            XMLHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        XMLHttp.onreadystatechange = function() {
            if (XMLHttp.readyState == 4 && XMLHttp.status == 200) {
                notaVal.innerHTML = "Média do Profissional: " + XMLHttp.responseText;
                alert("Obrigado! Seu voto foi computado com sucesso.");
            } else {
//                result.innerHTML = "Verificando conexao: " + XMLHttp.statusText;
            }
        };
        XMLHttp.send();
    }
}