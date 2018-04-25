<div class="w3-container">
    <div class="">
        <div class="w3-margin-top">
            <h2 class="w3-center">Dados Pessoais</h2>
        </div>
        <div class="w3-container w3-border w3-border-grey w3-margin-top w3-white w3-topbar w3-bottombar">
            <div class="w3-container w3-margin-top">
                <h5>Nome:</h5>
                <p class="w3-margin-left"><?= $usuario->row('nome') ?> <?= $usuario->row('sobrenome') ?></p>
                <h5>Email:</h5>
                <p class="w3-margin-left"><?= $usuario->row('email') ?></p>
                <h5>Área de atuação:</h5>
                <p class="w3-margin-left"><?= $usuario->row('areaAtuacao') ?></p>
                <h5>Instituição:</h5>
                <p class="w3-margin-left"><?= $instUser->row('nome') ?></p>
                <h5>Breve Curriculo:</h5>
                <p class="w3-margin-left"><?= $usuario->row('breveCurriculo') ?></p>
            </div>
        </div>

            <div style="margin-top: 100px;" class="row">
                <div class="w3-margin-top w3-col s6">
                    <?= anchor(base_url("index.php/usuario/aprovarUsuarios/".$usuario->row('idUser')), "Aprovar Usuario", array('class' => "w3-button w3-green w3-hover-std-green w3-block w3-xlarge")) ?>
                </div>
                <div class="w3-margin-top w3-col s6">
                    <?= anchor(base_url("index.php/usuario/deletarUsuario/".$usuario->row('idUser')), "Deletar Usuario", array('class' => "w3-button w3-red w3-hover-std-red w3-block w3-xlarge")) ?>
                </div>
            </div>
    </div>
</div>
