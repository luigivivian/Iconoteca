<div class="w3-row">
    <div class="w3-col" style="width:12%"><br></div>
    <div class="w3-container w3-threequarter w3-border w3-padding-32 w3-margin-top w3-white">
        <div class="w3-row w3-center">
            <h1><b>Área de Login</b></h1>
        </div>

    <?php if(isset($mensagem)): ?>
        <div class="w3-row">
            <div class="w3-container">
                  <?= $mensagem ?>
            </div>
        </div>
    <?php endif; ?>

        <?php if($this->uri->segment(2) == "adm"){?>
            <div class="w3-row">
                <div id="formLogin">
                    <?= form_open('index.php/usuario/login/adm', array('class' => "w3-container"))  ?>
                    <div class="w3-row w3-section">
                        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border" name="email" type="text" placeholder="Email" required autofocus>
                        </div>
                    </div>

                    <div class="w3-row w3-section">
                        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock"></i></div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border" name="senha" type="password" placeholder="Senha" required>
                        </div>
                    </div>

                    <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Entrar</button>
                    <?= form_close() ?>
                </div>
            </div>
        <?php }else{?>
        <div class="w3-row">
            <div id="formLogin">
                <?= form_open('index.php/efetuar_login', array('class' => "w3-container"))  ?>
                    <div class="w3-row w3-section">
                        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border" name="email" type="text" placeholder="Email" required autofocus>
                        </div>
                    </div>

                    <div class="w3-row w3-section">
                        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock"></i></div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border" name="senha" type="password" placeholder="Senha" required>
                        </div>
                    </div>

                    <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Entrar</button>
                <?= form_close() ?>
            </div>
        </div>
        <?php  } ?>
        <!--        Cadastro usuario visitante-->
        <div class="w3-row w3-margin">
            <div id="cadVisitante" class="w3-modal">
                <div class="w3-modal-content">
                    <header class="w3-container w3-green">
                        <span onclick="document.getElementById('cadVisitante').style.display='none'"
                              class="w3-button w3-display-topright">&times;</span>
                        <h2>Informe seus dados !</h2>
                    </header>
                    <div class="w3-container">
                        <div id="formInstituicao">
                            <?= form_open('index.php/cadVisitante', array('class' => "w3-container"))  ?>
                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
                                <div class="w3-rest">
                                    <input class="w3-input w3-border" id="inputNome" name="nome" type="text" placeholder="Digite seu nome" required autofocus>
                                </div>
                            </div>
                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
                                <div class="w3-rest">
                                    <input class="w3-input w3-border" id="inputEmail" name="email" type="email" placeholder="Digite o email que deseja receber as notificações !" required autofocus>
                                </div>
                            </div>
                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-location-arrow"></i></div>
                                <div class="w3-rest">
                                    <input class="w3-input w3-border" id="inputCidade" name="cidade" type="text" placeholder="Digite o nome da sua cidade !" required autofocus>
                                </div>
                            </div>
                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-location-arrow"></i></div>
                                <div class="w3-rest">
                                    <input class="w3-input w3-border" id="inputPais" name="pais" type="text" placeholder="Digite o nome do seu pais !" required autofocus>
                                </div>
                            </div>

                            <button id="btn_saveVisitante" class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Cadastrar email</button>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w3-row">
            <div class="w3-container w3-center">
                <div class="w3-row">
                    <a href="<?php echo base_url('index.php/cadastro/')?>" class="w3-button w3-block w3-blue w3-section w3-padding">Novo usuario? Cadastre-se !</a>
                </div>
                <div class="w3-row">
                    <a onclick="document.getElementById('cadVisitante').style.display='block'" class="w3-button w3-block w3-yellow w3-section w3-padding">Deseja receber notificações de novos artefatos? !</a>
                </div>
                <div class="w3-row w3-margin">
                        <a href="#" onclick="document.getElementById('recSenha').style.display='block'"><p class="w3-button, w3-text-dark-gray">Esqueci minha senha !</p></a>
                      <div id="recSenha" class="w3-modal">
                        <div class="w3-modal-content">
                          <header class="w3-container w3-green">
                                <span onclick="document.getElementById('recSenha').style.display='none'"
                                class="w3-button w3-display-topright">&times;</span>
                                <h2>Preencha os campos para recupera sua senha !</h2>
                          </header>
                          <div class="w3-container">
                              <div id="formRecSenha">
                                  <?= form_open('recuperar', array('class' => "w3-container"))  ?>
                                      <div class="w3-row w3-section">
                                          <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope"></i></div>
                                          <div class="w3-rest">
                                              <input class="w3-input w3-border" name="email" type="email" placeholder="Digite seu email" required autofocus>
                                          </div>
                                      </div>

                                      <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Recuperar Senha</button>
                                  <?= form_close() ?>
                              </div>
                          </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w3-col" style="width:12%"><br></div>
</div>
