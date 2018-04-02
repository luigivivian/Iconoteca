<div class="w3-row">
    <div class="w3-col" style="width:12%"><br></div>
    <div class="w3-container w3-threequarter w3-border w3-padding-32 w3-margin-top w3-white">
        <div class="w3-row w3-center">
            <h1><b>Recuperação de senha !</b></h1>
        </div>

    <?php if(isset($mensagem)): ?>
        <div class="w3-row">
            <div class="w3-container">
                <?= $mensagem ?>
            </div>
        </div>
    <?php endif; ?>

        <div class="w3-row">
            <div id="formRecSenha">
                <?= form_open('index.php/usuario/recuperarSenha', array('class' => "w3-container"))  ?>
                    <div class="w3-row w3-section">
                        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border" name="email" type="text" placeholder="Digite seu email" required autofocus>
                        </div>
                    </div>
                    <div class="w3-row w3-section">
                        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border" name="email2" type="text" placeholder="Confirme seu email" required autofocus>
                        </div>
                    </div>

                    <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Recuperar Senha</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
    <div class="w3-col" style="width:12%"><br></div>
</div>
