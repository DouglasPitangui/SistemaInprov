<?php
//echo "HEADER";
//var_dump($_SESSION);
?> 
<div id="header" class="col-md-12">
    <!--INPROV-->
</div>





<?php
if (false) {
//session_start();

    $tipo = $_SESSION['tipo'];
    if ($tipo == 'P') {#PROFESSOR
        $user = new ClsProfessor;
        $adm = true;
    }
    ?>
    <!-- HEADER start -->
    <header id="header" class="internal-pages">
        <div class="header-layout">
            <div class="container header">
                <nav class="navbar row" role="navigation">

                    <!-- Header for computador -->
                    <div class="header-menu hidden-sm hidden-xs col-md-12 col-xs-6" style="height: 67px;">
                        <div class="hidden-xs" id="header-nav">
                            <div class="col-md-2">
                                <ul class="main-menu">
                                    <li style="padding: 10px; font-size: 35px;">
                                        INPROV
                                    </li>
                                </ul>
                            </div>
                            <ul class="main-menu">
                                <li>
                                    <a href="?page=home">INICIO</a>
                                </li>
                                <li>
                                    <a href="?page=avaliacao">AVALIAÇÕES</a>
                                </li>
                                <?php if ($adm) {#PROFESSOR   ?>
                                    <li>
                                        <a href="?page=cadastro">CADASTRO</a>
                                    </li>
                                <?php } ?>
                                <!--                            <li>
                                                                <a href="#">Entre em Contato</a>
                                                            </li>-->
                            </ul>
                            <div class="more-links1">

                            </div>
                            <div class="more-links" style="padding-top:15px; padding-right:15px; float:right">

                                <div class="powered-by">
                                    <form action="action/logout.php" id="logout" method="post" enctype="multipart/form-data">
                                        <button class="btn btn-inverse-org">Sair</button>
                                    </form>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <!-- Header for computador -->

                    <!-- Header for tablet -->
                    <div class="col-sm-12 header-tablet visible-sm hidden-xs hidden-md hidden-lg" style="">
                        <div class="col-sm-3">
                            <ul class="main-menu">
                                <li style="padding: 3px 10px; font-size: 35px; padding-top: 12px; font-size: 35px;">
                                    INPROV
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="catalog-tablet-menu col-sm-3">
                                <ul data-breakpoint="768" class="flexnav one-page with-js opacity lg-screen">
                                    <li class="item-with-ul catalog-dropdown"><a class="catalog-btn" href="#">MEU MENU</a>
                                        <!--<ul style="display: none;" onclick="$(this).toggle(500);">-->
                                        <ul style="display: block;">
                                            <li><a href="?page=home">INICIO</a></li>
                                            <li class="item-with-ulS"><a href="?page=avaliacao">AVALIAÇÕES</a></li>
                                            <?php if ($adm) {#PROFESSOR   ?>
                                                <li>
                                                    <a href="?page=cadastro">CADASTRO</a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="more-links" style="padding-top:15px; padding-right:15px; float:right">
                                <div class="powered-by">
                                    <form action="action/logout.php" id="logout" method="post" enctype="multipart/form-data">
                                        <button class="btn btn-inverse-org">Sair</button>
                                    </form>

                                    <script>
                                        $('form#logout').on('submit', function(e) {
                                            debugger;
                                            e.preventDefault();
                                            $.ajax({
                                                type: $(this).attr('method'),
                                                url: $(this).attr('action'),
                                                data: $(this).serialize(),
                                                success: function(resp) {
                                                    location.href = "?page=home";
                                                },
                                                error: function(resp) {
                                                    alert('Infelizmente algo aconteceu,<br/> tente novamente.');
                                                }
                                                , dataType: 'html'
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Header for tablet -->

                    <!-- Header for celular -->
                    <div class="menu-trigger visible-xs col-sm-12 col-xs-12" style="height: 67px;">
                        <div class="menu-trigger__inner col-xs-1" style="padding-left:10px;">
                            <a href="#menu" class="hidden-lg custom-menu-trigger-selector">
                                <img src="img/menu-trigger.png" alt=""/>
                                <!--<img src="img/menu-trigger.png" alt=""/>-->
                                <!--Menu--> 
                                <script>
                                    $('.menu-trigger').mouseover(function() {
                                        $(this).find('img').attr('src', 'img/menu-trigger-hover.png');
                                    });
                                    $('.menu-trigger').mouseout(function() {
                                        $(this).find('img').attr('src', 'img/menu-trigger.png');
                                    });
                                </script>
                            </a>
                        </div>
                        <div class="col-xs-4" style="padding-left: 0;">
                            <ul class="main-menu">
                                <li style="padding: 10px; font-size: 35px;">
                                    MENU
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-2">
                            <ul class="main-menu">
                                <li style="padding: 10px; font-size: 35px;">
                                    INPROV
                                </li>
                            </ul>

                            <!--                        <ul class="main-menu">
                                                        <li>
                                                            <a href="?page=avaliacao">AVALIAÇÕES</a>
                                                        </li>
                                                    </ul>-->
                        </div>

                        <!--                    <div class="more-links" style="padding-top:15px; padding-right:15px; float:right">
                                                <div class="powered-by">
                                                    <form action="action/logout.php" id="logout" method="post" enctype="multipart/form-data">
                                                        <button class="btn btn-inverse-org">Sair</button>
                                                    </form>
                                                </div>
                                            </div>-->
                    </div>
                    <!-- Header for celular -->
                </nav>
                <article class="col-md-12 col-sm-12 col-xs-12">
                    <h1 class="pad45">
                        <strong id="titulo">INPROV</strong>
                    </h1>
                </article>
            </div>
        </div>
    </header>   
    <!-- HEADER end -->
    <!-- MOBILE-MENU start -->
    <nav id="jPanelMenu-menu" class="jpanel-menu" style="width: 265px;">
        <ul>
            <li><a href="?page=home">INICIO</a></li>
            <li><a href="?page=avaliacao">AVALIAÇÕES</a></li>
            <?php if ($adm) {#PROFESSOR  ?>
                <li>
                    <a href="?page=cadastro">CADASTRO</a>
                </li>
            <?php } ?>
        </ul>
        <div class="more-links text-center" style="padding-top:15px; padding-right:15px; float:center">
            <div class="powered-by">
                <form action="action/logout.php" id="logout" method="post" enctype="multipart/form-data">
                    <button class="btn btn-inverse-org">Sair</button>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="more-links col-md-8">

        </div>
    </nav>
    <!-- MOBILE-MENU end -->

    <div class="container content internal-pages">
    <?php } ?> 