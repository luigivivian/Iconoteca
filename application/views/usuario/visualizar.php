<div class="w3-container">
    <div class="">
        <div class="w3-margin-top">
            <h2 class="w3-center">Usuario:</h2>
        </div>
        <div class="" style="margin-top: 100px; ">
            <table class="w3-table w3-bordered w3-striped">
                <tr>
                  <th>Nome completo</th>
                  <th>Email</th>
                  <th>Area Atuação</th>
                  <th>Instituição</th>
                </tr>
                <tr>
                  <td><?= $usuario->row('nome') ?> <?= $usuario->row('sobrenome') ?></td>
                  <td><?= $usuario->row('email') ?></td>
                  <td><?= $usuario->row('areaAtuacao') ?></td>
                  <td><?= $instUser->row('nome') ?></td>
                </tr>
            </table>
        </div>

        <div class="w3-container w3-margin-top w3-border-bottom w3-border-top w3-border-left w3-border-right">
            <h5>Breve Curriculo:</h5>
            <p class="w3-margin-left"><?= $usuario->row('breveCurriculo') ?></p>
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
