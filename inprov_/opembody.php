<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
        <title>Inprov</title>
        <link href="css/inprov.css" rel="stylesheet" type="text/css"/>
        <link href="css/fonts.css" rel="stylesheet" type="text/css"/>
        <link href="css/inputc.css" rel="stylesheet" type="text/css"/>

        <!--<script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>-->
        <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
        <script src="js/purl.js" type="text/javascript"></script>
        <script src="js/Navgoco/jquery.cookie.js" type="text/javascript"></script>
        <script src="js/Navgoco/jquery.navgoco.js" type="text/javascript"></script>
        <link href="js/Navgoco/jquery.navgoco.css" rel="stylesheet" type="text/css"/>

        <script src="js/alertify/alertify.js" type="text/javascript"></script>
        <link href="js/alertify/alertify.bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="js/alertify/alertify.core.css" rel="stylesheet" type="text/css"/>
        <link href="js/alertify/alertify.default.css" rel="stylesheet" type="text/css"/>

        <link rel="stylesheet" href="css/bootstrap.css"/>
        <!--<link rel="stylesheet" href="js/selectpicker/bootstrap-selectv1.6.2.css"/>-->
        <link rel="stylesheet" href="css/bootstrap-select.css"/>
        <script type="text/javascript" src="js/jquery-ui-1.10.1.custom.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <!--<script type="text/javascript" src="js/bootstrap-select.js"></script>-->
        <script type="text/javascript" src="js/selectpicker/bootstrap-selectv1.6.2.js"></script>
        <script type="text/javascript" src="js/selectpicker/defaults-pt_BRv1.6.2.js"></script>
        <script type="text/javascript" src="js/bootstrap.touchspin.js"></script>
        <link rel="stylesheet" type="text/css" href="js/datetimepicker/jquery.datetimepicker.css" />
        <script type="text/javascript" src="js/datetimepicker/jquery.datetimepicker.js"></script>

        <script type="text/javascript" src="js/validacoes.js"></script>
        <script type="text/javascript" src="js/funcoes.js"></script>

        <script type="text/javascript" src="js/jquery.tooltipster.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/tooltip/tooltipster.css" />
        <link href="css/tooltip/themes/tooltipster-light.css" rel="stylesheet" type="text/css"/>
        <link href="css/tooltip/themes/tooltipster-noir.css" rel="stylesheet" type="text/css"/>
        <link href="css/tooltip/themes/tooltipster-punk.css" rel="stylesheet" type="text/css"/>
        <link href="css/tooltip/themes/tooltipster-shadow.css" rel="stylesheet" type="text/css"/>

        <link href="css/style.css" rel="stylesheet" type="text/css"/>

        <link href="css/basic.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="js/jquery.simplemodal.min.js"></script>

        <script>
            var dataHj = new Date().getDate() + '/' + new Date().getMonth() + '/' + new Date().getFullYear();
            function fazUI() {
                $('[title]:not([title=""])').each(function () {
                    var t = ($(this).attr('data-theme')) ? (($(this).attr('data-theme').trim() != "") ? $(this).attr('data-theme') : 'tooltipster-light') : 'tooltipster-light';
                    $(this).tooltipster({theme: t, contentAsHTML: true, position: $(this).attr('data-position')});
                });
                //data-live-search="true" data-size="10" multiple data-selected-text-format="count" data-count-selected-text="{0} de 3 selecionadas" data-hide-disabled="true" data-style="background: #e9e9e9;" data-popupAuto="true" data-container="body"
                $('.selectpicker').selectpicker({size: 10, liveSearch: true, container: 'body', liveSearchPlaceholder: 'Pesquise'});//, maxOptions: 2

//                var dataOpt = {lang: 'pt', mask: true, timepicker: false, format: 'd/m/Y', maxDate: dataHj};
//                $('.datepicker').each(function() {
//                    $(this).keypress(function(e) {
//                        e.preventDefault();
//                    });
//                    $(this).datetimepicker({lang: 'pt', mask: true, timepicker: false, datepicker: true, format: 'd/m/Y'});
//                });

                $('.datepicker').datetimepicker({lang: 'pt', timepicker: false, mask: true, datepicker: true, format: 'd/m/Y'});
                $('.timepicker').datetimepicker({lang: 'pt', mask: true, timepicker: true, datepicker: false, format: 'H:i:00', step: 10, defaultTime: '01:40'});
                $('.datetimepicker').datetimepicker({lang: 'pt', mask: true, timepicker: true, datepicker: true, format: 'd/m/Y H:i:s A'});
                $('.quantity:not(".decimals") input').TouchSpin({initval: $(this).attr('data-initval'), step: 1, decimals: 0, stepinterval: 100});
                $('.quantity.decimals input').TouchSpin({initval: $(this).attr('data-initval'), step: 1, decimals: 2, stepinterval: 100, forcestepdivisibility: 'none'});
            }
            $().ready(function () {
                fazUI();
            });
            $(window).on('hashchange', function (e) {
                if (!$.url().attr('fragment'))
                    return;
//                var origEvent = e.originalEvent;
//                console.log('Going to: ' + origEvent.newURL + ' from: ' + origEvent.oldURL);

//                $('a[href="#' + $.url().attr('fragment') + '"]').click();
                loadContent($.url().attr('fragment'));

                $('#mainMenu').find('.active').removeClass('active');
                $('a[href="#' + $.url().attr('fragment') + '"]').parent().addClass('active');

                tv = false;
                var t = contaEl($('#mainMenu'), $('a[href="#' + $.url().attr('fragment') + '"]'), 0);
                $('#mainMenu').navgoco('toggle', true, t - 1);
            });
            $(document).ready(function () {
//                $("#mainMenu").navgoco({accordion: true, cookie: {name: 'navgoco', expires: false, path: '/'}});
                $("#mainMenu").navgoco({accordion: false, cookie: {name: 'navgoco', expires: false, path: '/'}});

                var content = $('#conteudo');
                $('#mainMenu a[href^="#"]').on('click', function (e) {
//                    debugger;
//                $('a[href^="#"]').on('click', function(e) {
//                $('#mainMenu a').on('click', function(e) {
                    e.preventDefault();
//                    if (!window.location.hash) return;
                    if (!$(this).attr('href').substr(1))
                        return;

                    window.history.pushState(null, null, '' + $(this).attr('href'));
                    $('#mainMenu').find('.active').removeClass('active');
                    $(this).parent().addClass('active');

                    loadContent($(this).attr('href').substr(1), $(this).attr('parr'));
                });
                //pre carregando o gif
                var loading = new Image();
                loading.src = 'img/loader.gif';

                if ($.url().attr('fragment')) {
//                    debugger;
                    $('a[href="#' + $.url().attr('fragment') + '"]').click();
//                    $('#mainMenu').navgoco('toggle', true, 4);
                    tv = false;
                    var t = contaEl($('#mainMenu'), $('a[href="#' + $.url().attr('fragment') + '"]'), 0);
                    $('#mainMenu').navgoco('toggle', true, t - 1);
                }
            });
            function loadContent(page, parr) {
                var content = $('#conteudo');
                var href = 'pages/' + page + '.php';
                $.ajax({
                    url: href,
                    data: parr,
//                    dataType: 'html',
                    success: function (response) {
//                        debugger;
                        content.html('<center style="margin-top: 25%;"><img src="img/loader.gif" alt="Carregando..."/></center>');

                        content.delay(500).queue(function () {
                            $(this).html(response).dequeue();
                            fazUI();
                        });
                    },
                    error: function (response) {
                        if (response.status == 404) {
                            content.delay(500).html('Página não encontrada!').fadeIn();
                            alertify.error("Página não encontrada!");
                        }
                        content.html('');
                        console.log(response.responseText);
                    }
                });
            }
            function loadModal(page, parr) {
                var overlayCloseOpt = true;
                try {
                    if (parr.overlayClose && (parr.overlayClose !== undefined)) {
                        overlayCloseOpt = parr.overlayClose;
                    }
                }
                catch (err) {
                
                }
                var content = $('#modal');
                var href = 'pages/' + page + '.php';
                $.ajax({
                    url: href,
                    data: parr,
                    success: function (response) {
                        content.modal({overlayClose: overlayCloseOpt});//(body)overflow: hidden;
                        content.html('<center style="margin-top: 25%;"><img src="img/loader.gif" alt="Carregando..."/></center>');

                        content.delay(500).queue(function () {
                            $(this).html(response).dequeue();
                            fazUI();
                        });
                    },
                    error: function (response) {
                        if (response.status == 404) {
                            content.delay(500).html('Página não encontrada!').fadeIn();
                            alertify.error("Página não encontrada!");
                        }
                        content.html('');
                        console.log(response.responseText);
                    }
                });
            }
            function fazPaginacao(a, e) {
                e.preventDefault();
                var parr = $.url($(a).attr('href')).param('pageno');
                loadContent($(a).attr('parr'), $(a).attr('href'));
            }
            function contaEl(p, e, t) {
                var c = $(p).children().length;
                for (var i = 0; i < c; i++) {
                    if (tv)
                        break;
                    if ($(p).children().eq(i).is('UL')) {
                        t++;
                    }
                    if ($(p).children().eq(i).is($(e))) {
                        tv = true;
                        break;
                    }
                    t = contaEl($(p).children().eq(i), e, t);
                }
                return t;
            }


            function fazFiltro(form, e) {
                e.preventDefault();
                loadContent($.url().attr('fragment'), $(form).serialize());
            }
//            $('#formaluno, #formprofessor, #formdisciplina, #formquestao, #formavaliacao').on('submit', function(e) {
            function fazSubmit(form, e) {
                e.preventDefault();
//                debugger;

                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    success: function (jsonResult) {
                        debugger;
                        jsonResult = $.parseJSON(jsonResult);
                        if ((jsonResult.resp == 'OK')) {
                            alertify.success(jsonResult.mensagem);
                        } else {
                            alertify.error(jsonResult.mensagem);
                        }
                    },
                    error: function (response) {
                        debugger;
                        console.log(response);
                        alertify.error('Infelizmente algo aconteceu,<br/> tente novamente.');
                    }
                    , dataType: 'html'
                });
            }
            ;
        </script>
    </head>
    <body>