/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

alert("Carregado");
        var chkPass = function() {
            debugger;
            var SenhaOld = document.getElementById('sa');
            var SenhaNova = document.getElementById('senhaNova');
            var SenhaConf = document.getElementById('confisenhaNova');
            var errosenha = document.getElementById('idErroSenha');

            var xx = document.getElementById('idErroSenha');
            return {
                fazErroSenha: function() {
                    errosenha.style.display = 'block';
                },
                VerSenhaOld: function() {
                    if (SenhaOld.value == '') {
                        chkPass.AcoesSetter.InsertMsg('Senha  Antiga invalida ...');
                        this.fazErroSenha();
                    }
                },
                VerSenhaNova: function() {
                    if (SenhaNova.value == '') {
                        chkPass.AcoesSetter.InsertMsg('nova senha invalida ....');
                        this.fazErroSenha();
                    }
                },
                VerficarSenhaGeral: function() {
                    this.VerSenhaAtu();
                    this.VerSenhaNova();
                    this.VerSenhaAtu();
                    if (SenhaNova.value.toString() !== SenhaConf.value.toString()) {
                        this.show();
                        chkPass.AcoesSetter.InsertMsg('Senhas não conferem! ...');
                        this.fazErroSenha();
                        return false;
                    } else {
//                        document.FrmSenha.submit();
                        var frm = document.getElementById('FrmSenha');
                        frm.submit();
                        $('.simplemodal-close').click();
                        getRespFomIframa();
                    }
                },
                VerSenhaAtu: function() {
                    if (SenhaConf.value == '') {
                        chkPass.AcoesSetter.InsertMsg('Confirmacao da senha invalida ....');
                        this.fazErroSenha();
                    }
                },
                toggle: function() {
                    errosenha.style.display = (errosenha.style.display == 'none') ? 'block' : 'none';
                },
                hide: function() {
                    chkPass.AcoesSetter.InsertMsg('...');
                    errosenha.style.display = 'none';
                },
                show: function() {
                    errosenha.style.display = 'block';
                },
                AcoesSetter: function() {
                    return {
                        InsertMsg: function(infInsert) {
                            errosenha.innerHTML = infInsert;
                        }
                    };
                }()
            };
        }();
