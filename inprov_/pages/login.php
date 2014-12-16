<?php
$login = $_REQUEST['l'];
$pass = $_REQUEST['p'];

$login = 'admin';
$pass = 'admin';
$login = '';
$pass = '';
?>

<div id="login-panel" class="center" style="width: 370px; height: 395px; background-color: white;">
    <center><h1>Faça seu login</h1></center>
    <div class="form-group">
        <footer id="footer">
            <div class="row">
                <!--<div class="footer-col col-md-3 col-sm-6 col-xs-12">-->
                <div class="footer-col col-md-12 col-sm-12 col-xs-12">
                    <div class="newsletter">
                        <form action="action/login.php" method="post" enctype="multipart/form-data" onsubmit="//fazSubmitCliente(this, event);">
                            <h4>Login</h4>
                            <div class="email-subscribe">
                                <div class="field-wrapper">
                                    <input type="usuario" name="matricula" required="" value="<?= $login ?>" placeholder="Matricula" style="width: 100%;"/>
                                </div>
                            </div><br>
                            <div class="email-subscribe">
                                <div class="field-wrapper">
                                    <input type="password" name="senha" required="" value="<?= $pass ?>" placeholder="Senha" style="width: 100%;"/>
                                    <button type="submit">
                                        <img alt="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAcAAAAKCAYAAAEPy3SbAAAACXBIWXMAAAsTAAALEwEAmpwYAAABNmlDQ1BQaG90b3Nob3AgSUNDIHByb2ZpbGUAAHjarY6xSsNQFEDPi6LiUCsEcXB4kygotupgxqQtRRCs1SHJ1qShSmkSXl7VfoSjWwcXd7/AyVFwUPwC/0Bx6uAQIYODCJ7p3MPlcsGo2HWnYZRhEGvVbjrS9Xw5+8QMUwDQCbPUbrUOAOIkjvjB5ysC4HnTrjsN/sZ8mCoNTIDtbpSFICpA/0KnGsQYMIN+qkHcAaY6addAPAClXu4vQCnI/Q0oKdfzQXwAZs/1fDDmADPIfQUwdXSpAWpJOlJnvVMtq5ZlSbubBJE8HmU6GmRyPw4TlSaqo6MukP8HwGK+2G46cq1qWXvr/DOu58vc3o8QgFh6LFpBOFTn3yqMnd/n4sZ4GQ5vYXpStN0ruNmAheuirVahvAX34y/Axk/96FpPYgAAACBjSFJNAAB6JQAAgIMAAPn/AACA6AAAUggAARVYAAA6lwAAF2/XWh+QAAAAz0lEQVR42mL4////Uob/////BwAAAP//Yvj//z8DEwMDAwMAAAD//2L8////fwYGBgYAAAAA//9ihNIMTAwMDP8ZGBiiGP7//2/z//9/BgAAAAD//4Kp+cvAwMDOwMDwl4kBApgZGBgOMzAwMAAAAAD//2L4//8/D8xchv8QUIesl4GBgeEjMkeJ4f////dgegAAAAD//4Lpuff//39LmCC6JDI4/P//f0V0C5DBFwYGhixknX/+///f+P//f2ZkY1f8//+fH92+////MwAGAJ+8qntB0yI9AAAAAElFTkSuQmCC" />
                                    </button>
                                </div>
                            </div>
                            <p><br>
                                <a style="cursor: pointer;" onclick="$('.content-esqueceu-senha').modal();">Esqueceu sua senha?</a>
                            </p>
                            <label class="error"></label>
                        </form>
                    </div>

                    <div class="content-esqueceu-senha hid" style="width: 515px; height: 185px;">
                        <form enctype="multipart/form-data" method="post" action="">
                            <input type="hidden" name="txtAlSenha" class="campos" value="AlteraSenha">
                            <div class="" style="clear: both;">
                                <div class="col-md-12">
                                    <h3 style="font-style:italic; color: black;">Esqueceu sua senha?</h3>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Matricula *</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Sua matricula" 
                                               name="txtLoja_Username" />
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-inverse-org simplemodal-close" type="button" onclick="">Fechar</button>
                                    <button class="btn btn-inverse " type="submit" onclick="return validaDadosEsqueceuSenha(this.form);">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="footer-copyright__inner  col-xs-12 col-sm-12 col-md-12">
                    <div class="powered-by text-left">
                        Todos os direitos reservados <a href="">INPROV</a> &reg;. 
                    </div>
                    <!--    <div class="back-on-top">
                            <a style="cursor: pointer;">Subir<i></i></a>
                            <script>
                                $('.back-on-top a').click(function() {
                                    $('html, body').animate({scrollTop: 0}, 'slow');
                                });
                            </script>
                        </div>-->
                </div>
            </div>
        </footer>
    </div>
</div>

<script>
    (function($) {
        $(window).load(function() {
//            $('#jPanelMenu-style-master').remove();
//            $('#basic-modal-content1').modal();
        });
    })(jQuery);
    
    $('form').on('submit', function(e) {
        e.preventDefault();
        $('.error').html();
        
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(jsonResult) {
                jsonResult = $.parseJSON(jsonResult);
                if (!(jsonResult.resp == 'OK')) {
                    $('.error').html('Credenciais Inválidas');
                    $('.error').show('slow');
                    $('.error').delay(2000).hide('slow');
                }else{
                    location.href = "./#inicio";
                    location.reload(true);
                    
//                    location.href = "?page=home";
                }
            },
            error: function() {
                debugger;
//                alert('Infelizmente algo aconteceu,<br/> tente novamente.');
                alertify.error('Infelizmente algo aconteceu,<br/> tente novamente.');
            }
            , dataType: 'html'
        });
    });
</script>