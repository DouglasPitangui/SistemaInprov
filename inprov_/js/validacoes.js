/*
 *       Script: Mascaras em Javascript
 *       Autor:  Matheus Biagini de Lima Dias
 *       Data:   26/08/2008
 *       Obs:    
 */
/*Função Pai de Mascaras*/
function Mascara(o, f) {
    v_obj = o;
    v_fun = f;
//        alert('A')
    setTimeout("execmascara()", 1);
}

/*Função que Executa os objetos*/
function execmascara() {
    v_obj.value = v_fun(v_obj.value);
}

/*Função que Determina as expressões regulares dos objetos*/
function leech(v) {
    v = v.replace(/o/gi, "0");
    v = v.replace(/i/gi, "1");
    v = v.replace(/z/gi, "2");
    v = v.replace(/e/gi, "3");
    v = v.replace(/a/gi, "4");
    v = v.replace(/s/gi, "5");
    v = v.replace(/t/gi, "7");
    return v;
}

/*Função que permite apenas numeros*/
function Integer(v) {
    return v.replace(/\D/g, "");
}

/*Função que padroniza telefone (11) 4184-1241*/
function Telefone(v) {
    v = v.replace(/\D/g, "");
    v = v.replace(/^(\d\d)(\d)/g, "($1) $2");
    v = v.replace(/(\d{4})(\d)/, "$1-$2");
    return v;
}

/*Função que padroniza telefone (11) 41841241*/
function TelefoneCall(v) {
    v = v.replace(/\D/g, "");
    v = v.replace(/^(\d\d)(\d)/g, "($1) $2");
    return v;
}

/*Função que padroniza telefone (11) 98811-5512*/
function Celular(v) {
    v = v.replace(/\D/g, "");
    v = v.replace(/^(\d\d)(\d)/g, "($1) $2");
    v = v.replace(/(\d{5})(\d)/, "$1-$2");
    return v;
}

/*Função que padroniza CNPJ*/
function Cnpj(v) {
    v = v.replace(/\D/g, "");
    v = v.replace(/^(\d{2})(\d)/, "$1.$2");
    v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
    v = v.replace(/\.(\d{3})(\d)/, ".$1/$2");
    v = v.replace(/(\d{4})(\d)/, "$1-$2");
    return v;
}

/*Função que padroniza CPF*/
function Cpf(v) {
    v = v.replace(/\D/g, "");
    v = v.replace(/(\d{3})(\d)/, "$1.$2");
    v = v.replace(/(\d{3})(\d)/, "$1.$2");
    v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
    return v;
}

/*Função que padroniza RG*/
function Rg(v){
    v=v.replace(/\D/g,"");                  //Remove tudo o que não é dígito
	v=v.replace(/(\d)(\d{7})$/,"$1.$2");    //Coloca o . antes dos últimos 3 dígitos, e antes do verificador
	v=v.replace(/(\d)(\d{4})$/,"$1.$2");    //Coloca o . antes dos últimos 3 dígitos, e antes do verificador
	v=v.replace(/(\d)(\d)$/,"$1-$2");       //Coloca o - antes do último dígito
    return v;
}

/*Função que padroniza CEP*/
function Cep(v) {
    v = v.replace(/\D/g, "");
//        v = v.replace(/^(\d{2})\.(\d)/, "$1.$2")
//        v = v.replace(/^(\d{2})\.(\d{3})-(\d{3})/, "$1.$2-$3")
////        v = v.replace(/^(\d{2}\.\d{3}\-\d{3}/, "$1.$2-$3")

    v = v.replace(/^(\d{2})(\d)/, "$1.$2");
    v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2-$3");
//        v = v.replace(/\.(\d{3})(\d)/, ".$1-$2")

//        v = v.replace(/^(\d{5})(\d)/, "$1-$2")
    return v;
}

/*Função que permite apenas numeros Romanos*/
function Romanos(v) {
    v = v.toUpperCase();
    v = v.replace(/[^IVXLCDM]/g, "");
    while (v.replace(/^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$ /, "") != "")
        v = v.replace(/.$/, "");
    return v;
}

/*Função que padroniza Cartão de Crédito*/
function mcc(v){
    v=v.replace(/\D/g,"");
    v=v.replace(/^(\d{4})(\d)/g,"$1 $2");
    v=v.replace(/^(\d{4})\s(\d{4})(\d)/g,"$1 $2 $3");
    v=v.replace(/^(\d{4})\s(\d{4})\s(\d{4})(\d)/g,"$1 $2 $3 $4");
    return v;
}

/*Função que padroniza o Site*/
//function Site(v) {
//    v = v.replace(/^http:\/\/?/, "");
//    dominio = v;
//    caminho = "";
//    if (v.indexOf("/") > -1)
//        dominio = v.split("/")[0];
//    caminho = v.replace(/[^\/]*/, "");
//    dominio = dominio.replace(/[^\w\.\+-:@]/g, "");
//    caminho = caminho.replace(/[^\w\d\+-@:\?&=%\(\)\.]/g, "");
//    caminho = caminho.replace(/([\?&])=/, "$1");
//    if (caminho != "")
//        dominio = dominio.replace(/\.+$/, "");
//    v = "http://" + dominio + caminho;
//    return v;
//}

/*Função que padroniza DATA*/
function Data(v) {
    v = v.replace(/\D/g, "");
    v = v.replace(/(\d{2})(\d)/, "$1/$2");
    v = v.replace(/(\d{2})(\d)/, "$1/$2");
    return v;
}

/*Função que padroniza DATA*/
function Hora(v) {
    v = v.replace(/\D/g, "");
    v = v.replace(/(\d{2})(\d)/, "$1:$2");
    return v;
}

/*Função que padroniza valor monétario*/
function Valor(v) {
    v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
    v = v.replace(/^([0-9]{3}\.?){3}-[0-9]{2}$/, "$1.$2");
    //v=v.replace(/(\d{3})(\d)/g,"$1,$2")
    v = v.replace(/(\d)(\d{2})$/, "$1.$2"); //Coloca ponto antes dos 2 últimos digitos
    return v;
}

/*Função que padroniza valor monétario, com virgula*/
function ValorV(v) {
    v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
    v = v.replace(/^([0-9]{3}\,?){3}-[0-9]{2}$/, "$1,$2");
    //v=v.replace(/(\d{3})(\d)/g,"$1,$2")
    v = v.replace(/(\d)(\d{2})$/, "$1,$2"); //Coloca virgula antes dos 2 últimos digitos
    return v;
}

/*Função que padroniza valor monétario, com virgulae divisão de milhar*/
function ValorVM(v) {
    v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
//    v = v.replace(/^([0-9]{3}\,?){3}-[0-9]{2}$/, "$1,$2");
//    //v=v.replace(/(\d{3})(\d)/g,"$1,$2")
    
    v=v.replace(/(\d)(\d{23})$/,"$1.$2");//coloca o ponto dos ?
    v=v.replace(/(\d)(\d{20})$/,"$1.$2");//coloca o ponto dos ?
    v=v.replace(/(\d)(\d{17})$/,"$1.$2");//coloca o ponto dos ?
    v=v.replace(/(\d)(\d{14})$/,"$1.$2");//coloca o ponto dos tilhões
    v=v.replace(/(\d)(\d{11})$/,"$1.$2");//coloca o ponto dos bilhões
    v=v.replace(/(\d)(\d{8})$/,"$1.$2");//coloca o ponto dos milhões
    v=v.replace(/(\d)(\d{5})$/,"$1.$2");//coloca o ponto dos milhares

    v = v.replace(/(\d)(\d{2})$/, "$1,$2"); //Coloca virgula antes dos 2 últimos digitos
    return v;
}

/*Função que padroniza Area*/
function Area(v) {
    v = v.replace(/\D/g, "");
    v = v.replace(/(\d)(\d{2})$/, "$1.$2");
    return v;
}

//function validaData(dia, mes, ano) {
function validaData(data) {
    var dia, mes, ano;
    data = data.split("/");
    dia = data[0];
    mes = data[1];
    ano = data[2];
    if ((ano > 1900) && (ano < 2100)) {
        switch (mes) {
            case '01':
            case '03':
            case '05':
            case '07':
            case '08':
            case '10':
            case '12':
                if (dia <= 31) {
                    return true;
                }
                break
            case '04':
            case '06':
            case '09':
            case '11':

                if (dia <= 30) {
                    return true;
                }
                break
            case '02':
                var bissexto;
                /* Validando ano Bissexto / fevereiro / dia */

                if ((ano % 4 == 0) || (ano % 100 == 0) || (ano % 400 == 0)) {
                    bissexto = 1;
                }

                if ((bissexto == 1) && (dia <= 29)) {
                    return true;
                }

                if ((bissexto != 1) && (dia <= 28)) {
                    return true;
                }
                break;
        }
    }

    return false;
}


function valida_cpf(cpf) {
    cpf = cpf.replace(/\D/g, "");
    var Números, digitos, soma, i, resultado, digitos_iguais;
    digitos_iguais = 1;
    if (cpf.length < 11)
        return false;
    for (i = 0; i < cpf.length - 1; i++)
        if (cpf.charAt(i) != cpf.charAt(i + 1)) {
            digitos_iguais = 0;
            break;
        }
    if (!digitos_iguais) {
        Números = cpf.substring(0, 9);
        digitos = cpf.substring(9);
        soma = 0;
        for (i = 10; i > 1; i--)
            soma += Números.charAt(10 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0))
            return false;
        Números = cpf.substring(0, 10);
        soma = 0;
        for (i = 11; i > 1; i--)
            soma += Números.charAt(11 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1))
            return false;
        return true;
    }
    else
        return false;
}

function valida_cnpj(cnpj) {
    cnpj = cnpj.replace(/\D/g, "");
    var Números, digitos, soma, i, resultado, pos, tamanho, digitos_iguais;
    digitos_iguais = 1;
    if (cnpj.length < 14 && cnpj.length < 15)
        return false;
    for (i = 0; i < cnpj.length - 1; i++)
        if (cnpj.charAt(i) != cnpj.charAt(i + 1)) {
            digitos_iguais = 0;
            break;
        }
    if (!digitos_iguais) {
        tamanho = cnpj.length - 2
        Números = cnpj.substring(0, tamanho);
        digitos = cnpj.substring(tamanho);
        soma = 0;
        pos = tamanho - 7;
        for (i = tamanho; i >= 1; i--) {
            soma += Números.charAt(tamanho - i) * pos--;
            if (pos < 2)
                pos = 9;
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0))
            return false;
        tamanho = tamanho + 1;
        Números = cnpj.substring(0, tamanho);
        soma = 0;
        pos = tamanho - 7;
        for (i = tamanho; i >= 1; i--) {
            soma += Números.charAt(tamanho - i) * pos--;
            if (pos < 2)
                pos = 9;
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1))
            return false;
        return true;
    }
    else
        return false;
}


//Verifica se eh numerico
function checkNumeric(value) {
    var anum = /(^\d+$)|(^\d+\.\d+$)/
    if (anum.test(value))
        return true;
    return false;
}

function validateEmail(email) {
//    alert(email);
    var sQtext = '[^\\x0d\\x22\\x5c\\x80-\\xff]';
    var sDtext = '[^\\x0d\\x5b-\\x5d\\x80-\\xff]';
    var sAtom = '[^\\x00-\\x20\\x22\\x28\\x29\\x2c\\x2e\\x3a-\\x3c\\x3e\\x40\\x5b-\\x5d\\x7f-\\xff]+';
    var sQuotedPair = '\\x5c[\\x00-\\x7f]';
    var sDomainLiteral = '\\x5b(' + sDtext + '|' + sQuotedPair + ')*\\x5d';
    var sQuotedString = '\\x22(' + sQtext + '|' + sQuotedPair + ')*\\x22';
    var sDomain_ref = sAtom;
    var sSubDomain = '(' + sDomain_ref + '|' + sDomainLiteral + ')';
    var sWord = '(' + sAtom + '|' + sQuotedString + ')';
    var sDomain = sSubDomain + '(\\x2e' + sSubDomain + ')*';
    var sLocalPart = sWord + '(\\x2e' + sWord + ')*';
    var sAddrSpec = sLocalPart + '\\x40' + sDomain; // complete RFC822 email address spec
    var sValidEmail = '^' + sAddrSpec + '$'; // as whole string

    var reValidEmail = new RegExp(sValidEmail);
    if (reValidEmail.test(email)) {
        return true;
    }
    return false;
//    var re = /\S+@\S+\.\S+/;
//    return re.test(email);

//    var atpos = email.indexOf("@");
//    var dotpos = email.lastIndexOf(".");
//    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length) {
////        alert("Not a valid e-mail address");
//        return false;
//    }

    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
//    console.log(re);
    return re.test(email);
}

function IsEmail(email) {
    debugger;
    var exclude = /[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
    var check = /@[\w\-]+\./;
    var checkend = /\.[a-zA-Z]{2,3}$/;
    if (((email.search(exclude) != -1) || (email.search(check)) == -1) || (email.search(checkend) == -1)) {
        return false;
    } else {
        return true;
    }
}

function is_numeric(input) {
    return typeof (input) == 'number';
}

function ValidaFone(fone) {
    var c1 = /\(\d{2}\) \d{4}\-\d{5}$/;
    var c2 = /\(\d{2}\) \d{4}\-\d{4}$/;
    if (fone == "") {    //campo vazio             return false;
    } else
        return ((c1.test(fone)) | (c2.test(fone)));
//TELEFONE
//        alert(fone);
    var c2 = /\(\d{2}\) \d{4}\-\d{4}/;
    if (fone == "") {    //campo vazio
        return false;
    } else if (!c2.test(fone)) {
        return false;
    }
}


function ValidaUrl() {
    var regex = /^http:///;        
    txt = document.getElementById('txtSite').value
    if (txt != "") {
        if (!regex.test(txt)) {
            txt = "http://" + txt;
        }
        document.getElementById('txtSite').value = txt;
    }
}

function ValidaUrl(el) {
    var regex = /^(http:)|(https:)///;        
    txt = el.value;
    if (txt.trim() != "") {
        if (!regex.test(txt)) {
            txt = "http://" + txt.trim();
        }
        el.value = txt;
    }
}

function ValidaUrlSite(url) {
//                var re = /^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/;
//                var re = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
    var re = /^(https?:\/\/)?(www\.)?([a-zA-Z0-9_\-]+)+\.([a-zA-Z]{2,4})/;
    return re.test(url);
}


/**
 * 
 * @param {input:type=file} element Input file para upload de imagem
 * @argument {integer} data-max-width Largura máxima da imagem
 * @argument {integer} data-max-height Altura máxima da imagem
 * @returns {undefined}
 */
function verImgUpload(element) {
    var ext = element.value.match(/\.([^\.]+)$/)[1];
    switch (ext) {
        case 'jpeg':
        case 'jpg':
        case 'bmp':
        case 'png':
        case 'tif':
        case 'gif':
//                alert('Formato de Imagem suportado');
//                alert(element.offsetWidth);
            var mw = element.getAttribute('data-max-width'), mh = element.getAttribute('data-max-height');
            var target = element.getAttribute('for') ? element.getAttribute('for') : 'uploadPreview';
            readImage(element.files[0], mw, mh, target);
            break;
        default:
            alert('Formato de Imagem não suportado');
            element.value = '';
    }
}
// var url = window.URL || window.webkitURL; // alternate use
function readImage(file, mw, mh, target) {
    var reader = new FileReader();
    var image = new Image();
    reader.readAsDataURL(file);
    reader.onload = function(_file, _mw, _mh, _target) {
        image.src = _file.target.result; // url.createObjectURL(file);
        image.onload = function() {
//            alert(mw + 'px de largura e ' + mh + 'px de altura');
//            debugger;
            var w = this.width;
            var h = this.height;
            var t = file.type; // ext only: // file.type.split('/')[1],
            var n = file.name;
            var s = ~~(file.size / 1024) + 'KB';

            if (mw && mh) {
                if (w <= mw && h <= mh) {
                    //$('#'+target).append('<img src="' + this.src + '"> ' + w + 'x' + h + ' ' + s + ' ' + t + ' ' + n + '<br>');
                    //document.getElementById('uploadPreview').innerHTML = '<img src="' + this.src + '" style="max-height:' + mh + 'px;' + 'max-width:' + mw + 'px;">'
                    //      + w + 'x' + h + ' ' + s + ' ' + t + ' ' + n + '<br>';
                    $('#' + target).html('<img src="' + this.src + '" style="max-height:' + mh + 'px;' + 'max-width:' + mw + 'px;">');
                } else {
                    $('#' + target).html('<span class="invalido">A imagem deve ter no máximo ' + mw + 'px de largura e ' + mh + 'px de altura</span>');
                }
            } else {
                $('#' + target).html('<img src="' + this.src + '" style="max-height:100%; max-width:100%;">');
            }
        };
        image.onerror = function() {
            alert('Formato Inválido: ' + file.type);
        };
    };
}
$("#choose").change(function(e) {
    if (this.disabled)
        return alert('File upload not supported!');
    var F = this.files;
    if (F && F[0])
        for (var i = 0; i < F.length; i++)
            readImage(F[i]);
});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
            var imglarg, imgalt, imgsize;
            imglarg = $('#blah').width();
            imgalt = $('#blah').height();
            imgsize = input.files[0].size;
            validaimg(imglarg, imgalt, imgsize, input);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
function validaimg(imglarg, imgalt, imgsize, input) {
    var maxsize = $(input).attr('data-max-size') * 1000;
    var maxlarg = $(input).attr('data-max-width');
    var maxalt = $(input).attr('data-max-height');
    var inputfamy = $(input).attr('data-input-famy');
    var Csucesso = '.' + inputfamy + 'S';
    var Cerro = '.' + inputfamy + 'E';
    var Clabel = '.' + inputfamy + 'L';
    if (imglarg > maxlarg) {
        $('.erro-campo').text($(Clabel).text());
        $(Cerro).fadeIn(250);
        $(Csucesso).fadeOut(250);
        $('.erro-larg').text('A imagem deve ter no max ' + maxlarg + 'px de largura.')
    }
    if (imgsize > maxsize) {
        $('.erro-campo').text($(Clabel).text());
        $(Cerro).fadeIn(250);
        $(Csucesso).fadeOut(250);
        $('.erro-size').text('A imagem deve ter no max ' + maxsize / 1000 + 'kb.');
    }
    if (imgalt > maxalt) {
        $('.erro-campo').text($(Clabel).text());
        $(Cerro).fadeIn(250);
        $(Csucesso).fadeOut(250);
        $('.erro-alt').text('A imagem deve ter no max ' + maxalt + 'px de altura.')
    }
    if (imglarg <= maxlarg && imgsize <= maxsize && imgalt <= maxalt) {
        $('.erro-alt,.erro-campo,.erro-larg,.erro-size').text('');
        $(Cerro).fadeOut(250);
        $(Csucesso).fadeIn(250);
    }
}



function locacao(element) {
    if (element.checked) {
        $('.locacao').fadeIn();
//        $('.locacao').show();
    } else {
        $('.locacao').fadeOut();
//        $('.locacao').hide();
    }
}

function formatNumberJS(number) {
    number = number.toFixed(2) + '';
    var x = number.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

