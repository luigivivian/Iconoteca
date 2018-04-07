
<div class="w3-row">
    <div class="w3-col" style="width:12%"><br></div>
    <div class="w3-container w3-threequarter w3-border w3-padding-32 w3-margin-top w3-white w3-card-4">
        <div class="w3-row w3-center">
            <h1><b>Área de Cadastro</b></h1>
        </div>

        <div class="w3-row">
            <div class="w3-container">
                <?php echo validation_errors("<p class='mensagem-erro'>", "</p>"); ?>
            </div>
        </div>

        <?php if(isset($mensagem)): ?>
            <div class="w3-row">
                <div class="w3-container">
                    <?= $mensagem ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="w3-row">
            <div>
                    <?= form_open('index.php/cadastrar', array('class' => "w3-container", 'id' => 'formCadastro'))  ?>

                    <div class="w3-row w3-section">
                        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
                        <div class="w3-rest">
                            <div class="w3-half">
                                <input class="w3-input w3-border" value="<?= set_value('nome')?>" name="nome" type="text" placeholder="Nome" autofocus required>
                            </div>
                            <div class="w3-half">
                                <input class="w3-input w3-border" value="<?= set_value('sobrenome')?>" name="sobrenome" type="text" placeholder="Sobrenome" required>
                            </div>
                        </div>
                    </div>

                    <div class="w3-row w3-section">
                        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock"></i></div>
                        <div class="w3-rest">
                            <div class="w3-half">
                                <input class="w3-input w3-border" id="senha" name="senha" type="password" placeholder="Senha">
                            </div>
                            <div class="w3-half">
                                <input class="w3-input w3-border" name="confSenha" type="password" placeholder="Confirmação de senha">
                            </div>
                        </div>
                    </div>

                    <div class="w3-row w3-section">
                        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-at"></i></div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border" value="<?= set_value('email')?>" name="email" type="email" placeholder="E-mail">
                        </div>
                    </div>

                    <div class="w3-row w3-section">
                        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-wrench"></i></div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border" value="<?= set_value('areaAtuacao')?>" name="areaAtuacao" type="text" placeholder="Digite sua area de atuação !">
                        </div>
                    </div>
                    <div class="w3-row w3-section">
                        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-address-card"></i></div>
                        <div class="w3-rest">
                            <textarea rows="4" cols="50" style="resize: none;" class="w3-input w3-border" value="<?= set_value('bCurriculo')?>" name="bCurriculo" type="text" placeholder="Digite um breve curriculo sobre você !"></textarea>
                        </div>
                    </div>

                    <div class="w3-row w3-section">
                        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-graduation-cap"></i></div>
                        <div class="w3-rest">
                            <select class="w3-select" name="instituicao">
                                <option value="" disabled selected>Selecione sua instituição !</option>
                                <?php foreach ($universidades->result() as $v): ?>
                                    <option value="<?php echo $v->nome; ?>" ><?php echo $v->nome; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <a href="#" onclick="document.getElementById('cadInst').style.display='block'"><p class="w3-button, w3-text-dark-gray">Sua instituição não esta na lista? cadastre aqui !</p></a>
                    </div>

                    <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Cadastrar</button>

                    <?= form_close() ?>
            </div>

        </div>
        <div class="w3-row w3-margin">

            <div id="cadInst" class="w3-modal">
                <div class="w3-modal-content">
                    <header class="w3-container w3-green">
                        <span onclick="document.getElementById('cadInst').style.display='none'"
                        class="w3-button w3-display-topright">&times;</span>
                        <h2>Preencha os campos para cadastrar sua instituição !</h2>
                    </header>
                    <div class="w3-container">
                        <div id="formInstituicao">
                            <?= form_open('index.php/cadinst', array('class' => "w3-container"))  ?>
                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
                                <div class="w3-rest">
                                    <input class="w3-input w3-border" name="nome" type="text" placeholder="Digite o nome de sua instituição" required autofocus>
                                </div>
                            </div>

                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-location-arrow"></i></div>
                                <div class="w3-rest">
                                    <input class="w3-input w3-border" name="cidade" type="text" placeholder="Digite a cidade de sua instituição" required autofocus>
                                </div>
                            </div>
                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-location-arrow"></i></div>
                                <div class="w3-rest">
                                    <input class="w3-input w3-border" name="estado" type="text" placeholder="Digite o estado de sua instituição" required autofocus>
                                </div>
                            </div>

                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-location-arrow"></i></div>
                                <div class="w3-rest">
                                    <input class="w3-input w3-border" name="pais" type="text" placeholder="Digite o pais de sua instituição" required autofocus>
                                </div>
                            </div>
                            <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Cadastrar</button>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w3-col" style="width:12%"><br></div>
</div>
<script src="http://code.jquery.com/jquery-1.11.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.min.js"></script>
<script type="text/javascript">
$('#formCadastro').validate({
    // Define as regras
    rules: {
        nome: {
            required: true, minlength: 3
        },
        sobrenome: {
            required: true, minlength: 4
        },
        areaAtuacao: {
            required: true, minlength: 4
        },
        bCurriculo: {
            required: true, minlength: 4
        },
        instituicao: {
            required: true
        },
        email: {
            required: true, email: true
        },
        senha: {
            required: true, minlength: 4
        },
        confSenha: {
            required: true, minlength: 4, equalTo: "#senha"
        },
    },
    // Define as mensagens de erro para cada regra
    messages: {
        nome: {
            required: "Este campo é obrigatorio !", minlength: "Muito curto !"
        },
        nome: {
            required: "Este campo é obrigatorio !", minlength: "Muito curto !"
        },
        sobrenome: {
            required: "Este campo é obrigatorio !", minlength: "Muito curto !"
        },
        areaAtuacao: {
            required: "Este campo é obrigatorio !", minlength: "Muito curto !"
        },
        bCurriculo: {
            required: "Este campo é obrigatorio !", minlength: "Muito curto !"
        },
        instituicao: {
            required: "Este campo é obrigatorio !"
        },
        email: {
            required: "Este campo é obrigatorio !", minlength: "Muito curto !"
        },
        senha: {
            required: "Este campo é obrigatorio !", minlength: "Muito curto !"
        },
        confSenha: {
            required: "Este campo é obrigatorio !", minlength: "Muito curto !", equalTo:"As senhas devem ser iguais !"
        },
    }
});
</script>
