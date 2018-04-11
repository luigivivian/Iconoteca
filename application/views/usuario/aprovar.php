<div class="w3-container">
    <!-- Título da página -->
    <div class="w3-row">
        <h1><b>Aprovar Usuarios</b></h1>
    </div>

    <?php if(isset($mensagem)): ?>
        <div class="w3-row">
            <?= $mensagem ?>
        </div>
    <?php endif; ?>
    <?php if(isset($usuarios)){ ?>
    <?php if($usuarios->num_rows() == 0) { ?>
        <div class="w3-row">
            <h3>Nenhum usuario para ser aprovado !</h3>
        </div>
    <?php } else { ?>
        <div class="w3-row">
            <h3>Selecione um usuario</h3>
        </div>

        <div class="w3-responsive">
            <table class="w3-table-all">
                <thead>
                    <tr class="w3-black">
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Email</th>
                        <th>Area Atuação</th>
                        <th class="w3-center">Visualizar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($usuarios->result() as $user): ?>
                    <tr>
                        <td>
                            <h4><?= $user->nome ?></h4>
                        </td>

                        <td>
                            <h4><?= $user->sobrenome ?></h4>
                        </td>
                        <td>
                            <h4><?= $user->email ?></h4>
                        </td>
                        <td>
                            <h4><?= $user->areaAtuacao ?></h4>
                        </td>
                        <td>
                            <?= anchor(base_url("index.php/usuario/visualizarUsuario/$user->idUser"), "<i class='fa fa-search-plus fa-2x'></i>", array('class' => "w3-button w3-blue w3-hover-std-blue w3-block w3-small")) ?>
                        </td>

                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>

    <?php } ?>
<?php } ?>
</div>
