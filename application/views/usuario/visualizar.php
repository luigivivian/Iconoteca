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
                  <th>Breve curriculo</th>
                  <th>Instituição</th>
                </tr>
                <tr>
                  <td><?= $usuario->row('nome') ?> <?= $usuario->row('sobrenome') ?></td>
                  <td><?= $usuario->row('email') ?></td>
                  <td><?= $usuario->row('areaAtuacao') ?></td>
                  <td><?= $usuario->row('breveCurriculo') ?></td>
                  <td><?= $instUser->row('nome') ?></td>
                </tr>
            </table>
        </div>
            <div style="margin-top: 100px;">
                <div class="w3-margin-top">
                    <?= anchor(base_url("index.php/usuario/aprovarUsuarios/".$usuario->row('idUser')), "Aprovar Usuario", array('class' => "w3-button w3-green w3-hover-std-green w3-block w3-medium")) ?>
                </div>
                <div class="w3-margin-top">
                    <?= anchor(base_url("index.php/usuario/deletarUsuario/".$usuario->row('idUser')), "Deletar Usuario", array('class' => "w3-button w3-red w3-hover-std-red w3-block w3-medium")) ?>
                </div>
            </div>
    </div>
</div>
