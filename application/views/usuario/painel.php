<div class="w3-container w3-margin-bottom">
    <div class="w3-row">
        <h1><b>Minha conta</b></h1>
    </div>

<?php if(isset($mensagem)): ?>
    <div class="w3-row">
        <?= $mensagem ?>
    </div>
<?php endif; ?>

<?php if(isset($form_error) && $form_error): ?>
    <div class="w3-row">
        <div class="w3-container">
            <?php echo validation_errors("<p class='mensagem-erro'>", "</p>"); ?>
        </div>
    </div>
<?php endif; ?>

    <div class="w3-row">
        <!-- Dados -->
        <div class="w3-half">
            <div class="w3-col" style="width:99%">
                <div class="w3-row">
                    <h3>Meu dados</h3>
                    <table class="w3-table-all">
                        <tr>
                            <th>Nome</th>
                            <td><?= $this->session->userdata('nome') ?></td>
                        </tr>
                        <tr>
                            <th>Sobrenome</th>
                            <td><?= $this->session->userdata('sobrenome') ?></td>
                        </tr>
                        <tr>
                            <th>E-mail</th>
                            <td><?= $this->session->userdata('email') ?></td>
                        </tr>
                    </table>
                </div>

                <div class="w3-row w3-margin-top">
                    <button onclick="myFunction('dados')" class="w3-padding-16 w3-button w3-block w3-left-align w3-blue-gray w3-hover-gray">Dados &nbsp;<i class="fa fa-caret-down w3-left-align"></i></button>
                    <div id="dados" class="w3-hide w3-animate-zoom">
                        <button onclick="document.getElementById('formEmail').style.display='block'" class="w3-button w3-block w3-left-align w3-white">
                            <i class="fa fa-lg fa-at" aria-hidden="true"></i>
                            Alterar e-mail
                        </button>
                        <button onclick="document.getElementById('formSenha').style.display='block'" class="w3-button w3-block w3-left-align w3-white">
                            <i class="fa fa-lg fa-lock" aria-hidden="true"></i>
                            Alterar senha
                        </button>
                        <button onclick="document.getElementById('formExclusao').style.display='block'" class="w3-button w3-block w3-left-align w3-white">
                            <i class="fa fa-lg fa-remove" aria-hidden="true"></i>
                            Desativar conta
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="formEmail" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom w3-light-gray" style="max-width:600px">

                <div class="w3-row"><br>
                    <span onclick="document.getElementById('formEmail').style.display='none'" class="w3-button w3-large w3-hover-red w3-display-topright" title="Close Modal">
                        <i class="fa fa-close"></i>
                        Sair
                    </span>
                </div>

                <div class="w3-row">
                    <div class="w3-container">
                        <h2>Alterar e-mail</h2>
                    </div>
                </div>

                <?= form_open('conta/alterar/email', array('class' => "w3-container"))  ?>

                    <div class="w3-section">
                        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-at"></i></div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border" name="email" type="email" placeholder="Digite o novo e-mail" required autofocus>
                        </div>
                    </div>

                    <div class="w3-section">
                        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock"></i></div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border" name="senha" type="password" placeholder="Confirme sua senha" required>
                        </div>
                    </div>

                    <div class="w3-section">
                        <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Excluir</button>
                    </div>

                <?= form_close() ?>

            </div>
        </div>

        <div id="formSenha" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom w3-light-gray" style="max-width:600px">

                <div class="w3-row"><br>
                    <span onclick="document.getElementById('formSenha').style.display='none'" class="w3-button w3-large w3-hover-red w3-display-topright" title="Close Modal">
                        <i class="fa fa-close"></i>
                        Sair
                    </span>
                </div>

                <div class="w3-row">
                    <div class="w3-container">
                        <h2>Alterar senha</h2>
                    </div>
                </div>

                <?= form_open('conta/alterar/senha', array('class' => "w3-container"))  ?>

                    <div class="w3-section">
                        <input class="w3-input w3-border" name="senha_nova" type="password" placeholder="Digite a nova senha" required autofocus>
                    </div>

                    <div class="w3-section">
                        <input class="w3-input w3-border" name="conf_senha_nova" type="password" placeholder="Confirme sua nova senha" required>
                    </div>

                    <div class="w3-section">
                        <input class="w3-input w3-border" name="senha_antiga" type="password" placeholder="Digite sua senha antiga" required>
                    </div>

                    <div class="w3-section">
                        <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Excluir</button>
                    </div>

                <?= form_close() ?>

            </div>
        </div>

        <div id="formExclusao" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom w3-light-gray" style="max-width:600px">

                <div class="w3-row"><br>
                    <span onclick="document.getElementById('formExclusao').style.display='none'" class="w3-button w3-large w3-hover-red w3-display-topright" title="Close Modal">
                        <i class="fa fa-close"></i>
                        Sair
                    </span>
                </div>

                <div class="w3-row">
                    <div class="w3-container">
                        <h2 class="w3-text-red">Desativar conta</h2>
                        <p><b>CUIDADO!</b> Digite sua senha para realizar a desativação. Ao confirmar, sua conta será desativada, mas seus artefatos continuarão na página.</p>
                    </div>
                </div>

                <?= form_open('conta/desativar', array('class' => "w3-container"))  ?>
                    <div class="w3-section">
                        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock"></i></div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border" name="senha" type="password" placeholder="Digite sua senha" required autofocus>
                        </div>
                    </div>

                    <div class="w3-section">
                        <button class="w3-button w3-block w3-red w3-section w3-padding" type="submit">Excluir</button>
                    </div>
                <?= form_close() ?>

            </div>
        </div>

        <!-- Artefatos -->
        <div class="w3-half">
            <div class="w3-row">
                <h3>Meus artefatos
            <?php if($artefatos->num_rows() == 0) { ?>
                <small>Você não posssui nenhum artefato.</small></h3>
            <?php } else { ?>
                    <small>Você possui <b><?= $artefatos->num_rows() ?></b> artefato(s).</small>
            <?php if($artefatos->num_rows() > 10) { ?>
                    <small>Últimos <b>dez:</b></small>
            <?php } ?>
                </h3>
                <table class="w3-table-all">
                    <tr>
                        <th>Nome</th>
                        <th>Categoria</th>
                    </tr>
            <?php
                    $cont = 0;
                    foreach ($artefatos->result() as $a) {
            ?>
                    <tr>
                        <td><?= $a->nome ?></td>
                        <td><?= $a->categoria ?></td>
                    </tr>
            <?php
                        if(++$cont == 10) break;
                    }
            ?>
                </table>
            <?php
                }
            ?>
            </div>

            <div class="w3-row w3-margin-top">
                <button onclick="myFunction('artefatos')" class="w3-padding-16 w3-button w3-block w3-left-align w3-green w3-hover-dark-green">Artefatos &nbsp;<i class="fa fa-caret-down w3-left-align"></i></button>
                <div id="artefatos" class="w3-hide w3-animate-zoom">
                    <a href="artefato/adicionar" class="w3-button w3-block w3-left-align w3-white">
                        <i class="fa fa-lg fa-plus" aria-hidden="true"></i>
                        Adicionar
                    </a>
                    <a href="artefato/editar/p/1" class="w3-button w3-block w3-left-align w3-white">
                        <i class="fa fa-lg fa-edit" aria-hidden="true"></i>
                        Editar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function myFunction(id)
    {
        var x = document.getElementById(id);

        if(x.className.indexOf("w3-show") == -1)
            x.className += " w3-show";
        else
            x.className = x.className.replace(" w3-show", "");
    }
</script>
