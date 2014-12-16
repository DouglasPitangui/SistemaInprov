<!--<br/>-->

<!--FOOTER start--> 
<div class="rowS col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color: black; padding: 0; margin: 15px 0px; margin-bottom: 40px;">
    <footer id="footer">
        <div class="row">
            <div class="footer-colS col-md-6 col-sm-6 col-xs-12 text-center" style="margin: -15px 0px;">
                <nav role="footer-my-account">
                    <span style="color:#999999; font-size:12px">
                        Rodovia Serafim Derenzi, 3115 - Condusa<br>
                        Vitória - ES
                        <span style="color:rgb(204,204,204)">Tel.:</span> (27) 2122-4500 / 2122-4553<br>
                        <span style="color:rgb(204,204,204)">E-mail:</span> computacaoesistemas@faesa.br
                    </span>
                </nav>
            </div>            
            <div class="clearfix visible-xs"><br/><br/></div>
            <div class="footer-colS col-md-6 col-sm-6 col-xs-12 text-center" style="margin: -15px 0px;">
                <nav role="footer-my-account">
                    <span style="color:#999999; font-size:12px">
                        <span style="color:rgb(204,204,204)">Desenvolvido por:</span><br>
                        <span style="color:rgb(204,204,204)">Douglas Schwe Pitangui</span><br>
                        <span style="color:rgb(204,204,204)">João André da Costa Altoé</span>
                    </span>
                </nav>
            </div>
        </div>

        <div class="footer-copyright">
            <div class="footer-copyright__inner  col-xs-12 col-sm-12 col-md-12">

                <div class="powered-by text-left col-md-4 col-sm-5 col-xs-12">
                    Todos os direitos reservados <a href="#inicio">INPROV</a> &reg;. 
                </div>

                <!--                <div class="more-links text-center" style="padding-top:15px; padding-right:15px; float:right;">
                                    <div class="powered-by">
                                        <form action="action/logout.php" id="logout" method="post" enctype="multipart/form-data">
                                            <button class="btn btn-inverse-org">Sair</button>
                                        </form>
                                    </div>
                                </div>-->
                <div class="" style="float: right;">
                    <!--<div class="powered-by">-->
                        <form action="action/logout.php" id="logout" method="post" enctype="multipart/form-data">
                            <button class="btn btn-inverse-org" style="margin: -10px;">Sair</button>
                        </form>
                    <!--</div>-->
                    <!--<a style="cursor: pointer;">Subir<i></i></a>-->
                </div>
                <div class="back-on-top floating">
                    <div class="powered-by">
                        <a style="cursor: pointer;">Subir<i></i></a>
                        <script>
                            $('.back-on-top').click(function() {
                                $('html, body').animate({scrollTop: 0}, 'slow');
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<!--FOOTER start--> 
<br/>
<style>
    .back-on-top.floating:hover, .back-on-top.floating:hover a {
        opacity: 1;
        cursor: pointer;
        text-decoration: underline !important;
    }
    .back-on-top.floating {
        padding: 10px;
        background: black;
        border-radius: 10px;
        position: fixed;
        bottom: 3px;
        right: 10px;
        opacity: 0.5;
    }
</style>